<?php

class UserController extends BaseController {

    public function login() {
        return View::make('login');
    }

    public function confirmLogin() {
        $credentials = array(
            'username' => Input::get('username'),
            'password' => Input::get('password')
        );
        if (Auth::attempt($credentials)) {
            return Redirect::to('user/dashboard')
                            ->with('message', 'You are now logged in!');
        } else {
            return Redirect::to('/login')
                            ->with('message', 'Your username/password combination was incorrect')
                            ->withInput();
        }
    }

    public function validateUser($user, $type) {
        if ($type == 'create') {
            $validator = Validator::make(
                            $user, array(
                        'username' => 'required|unique:users',
                        'password' => 'required|min:8',
                        'birthdate' => 'date',
                        'email' => 'required|email|unique:users'
                            )
            );
        } elseif ($type == 'update') {
            $validator = Validator::make(
                            $user, array(
                        'username' => 'required|unique:users',
                        'email' => 'required|email|unique:users'
                            )
            );
        }
        if ($validator->fails()) {
            return ($validator->messages());
        } else {
            return null;
        }
    }

    public function createUser() {
        if (Input::get('id')) {
            $user = array(
                'username' => Input::get('username'),
                'email' => Input::get('email'),
                'birthdate' => Input::get('birthdate'),
            );
            $message = $this->validateUser($user, 'update');
            if ($message === null) {

                User::where('id', Input::get('id'))->update($user);
                return Redirect::to('user/dashboard')
                                ->with('message', "The details have been modified");
            }

            $user_object = new User;
            $user_object->id = Input::get('id');
            $user_object->username = $user['username'];
            $user_object->email = $user['email'];
            $user_object->birthdate = $user['birthdate'];

            return View::make('edituser', array(
                        'user' => $user_object,
                        'validate_messages' => $message));
        } else {
            $user = array(
                'username' => Input::get('username'),
                'password' => Input::get('password'),
                'email' => Input::get('email'),
                'birthdate' => Input::get('birthdate')
            );
            $message = $this->validateUser($user, 'create');
            if ($message === null) {
                User::create(array(
                    'username' => Input::get('username'),
                    'password' => Hash::make(Input::get('password')),
                    'email' => Input::get('email'),
                    'birthdate' => Input::get('birthdate')
                        )
                );
                return Redirect::to('/login')
                                ->with('message', "Your account has been created");
            }
            $user_object = new User;
            $user_object->username = $user['username'];
            $user_object->email = $user['email'];
            $user_object->birthdate = $user['birthdate'];

            return View::make('/signin', array(
                        'user' => $user_object,
                        'validate_messages' => $message));
        }
    }

    public function editUser($id) {
        if (Auth::check()) {
            $user = new User();
            $userData = $user->find($id);

            return View::make('edituser', array('user' => $userData));
        } else {
            return Redirect::to('/login')
                            ->with('message', 'You need to log in first!');
        }
    }

    public function signin() {
        return View::make('signin');
    }

    public function dashboard() {
        return View::make('dashboard');
    }

    public function logout() {
        Auth::logout();
        return Redirect::to('/');
    }
//visibleon si visibleoff sunt pentru a fi vizibil tuturor utilizatorilor
    //apare in visible list
    public function visibleon($id) {
        if (Auth::check()) {
            $user = User::find($id);
            $user->visible = '1';
            $user->save();

            return Redirect::to('user/dashboard')
                            ->with('message', 'Your user is now visible!');
        } else {
            return Redirect::to('/login')
                            ->with('message', 'You need to log in first!');
        }
    }

    public function visibleoff($id) {
        if (Auth::check()) {
            $user = User::find($id);
            $user->visible = '0';
            $user->save();
            return Redirect::to('user/dashboard')
                            ->with('message', 'Your user is now invisible');
        } else {
            return Redirect::to('/login')
                            ->with('message', 'You need to log in first!');
        }
    }

    public function visibleUsers() {
        if (Auth::check()) {
            $users = DB::table('users')->where('visible', '1')->get();

            return View::make('visibleusers', array('users' => $users));
        } else {
            return Redirect::to('/login')
                            ->with('messageLogin', 'You need to log in first!');
        }
    }

    public function deleteUser($id) {
        User::destroy($id);
        $this->logout();
        return Redirect::to('/')
                        ->with('message', 'Your account has been deleted');
    }
//utilizatorii care au ziua de nastere in ziua curenta
    public function birthdayUsers() {
        if (Auth::check()) {
            $date = date('m-d');
            $users = DB::table('users')->where('birthdate', 'LIKE', '%' . $date)->get();
            return View::make('birthdayusers', array('users' => $users));
        } else {
            return Redirect::to('/login')
                            ->with('message', 'You need to log in first!');
        }
    }

    public function newPassword() {
        return View::make('changepassword');
    }

    public function changePassword($id) {
        $user = Auth::user();
        if (!Hash::check(Input::get('password'), $user->password)) {
            $message = 'Please specify the good current password';
            return Redirect::to('user/dashboard')->with('message', $message);
        } else {
            $user->password = Hash::make(Input::get('new_password'));
            $user->save();
            $message = 'Your password has been changed';
            return Redirect::to('user/dashboard')->with('message', $message);
        }
    }

}
