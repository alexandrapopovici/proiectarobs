<?php

class MessageController extends BaseController {

    public function createMessage() {
        return View::make('createmessage');
    }

    public function confirmMessage() {
        //daca username-ul nu exista este afisat un mesaj
        // $username este o variabila care poate sa fie username-ul userului sau id-ul userului
        $username = Input::get('receiver_name');
        $user_exist=DB::table('users') ->where('username','=', $username)
                                        ->orWhere('id', '=', $username)
                ->get();
        if(!$user_exist)
        {
           $message = 'The username does not exists.Please try again!';
           return Redirect::to('message/create')->with('message', $message);
        }else{
        if (is_numeric($username)) {
            $receiver_id = Input::get('receiver_name');
        }
        else
            $receiver_id = DB::table('users')->where('username', '=', $username)->pluck('id');
        Message::create(array(
            'sender_id' => Input::get('sender_id'),
            'receiver_id' => $receiver_id,
            'subject' => Input::get('subject'),
            'content' => Input::get('content'),
                )
        );
        $message = 'Your message has been sent!';
        return Redirect::to('user/dashboard')->with('message', $message);
        }
    }

    public function inboxMessages() {
        //join intre tabele
        //se afiseaza cele cu inbox_status=1, adica cele pe care userul nu le-a sters din inbox
        $messagesIds = DB::table('messages')
                ->join('users', function($join) {
                            $join->on('users.id', '=', 'messages.receiver_id')
                            ->where('users.id', '=', Auth::user()->id)
                            ->where('inbox_status', '=', '1');
                        })
                ->get();
        return View::make('inboxmessages', array('messages' => $messagesIds));
    }

    public function sentMessages() {
        //join intre tabele
        //se afiseaza cele cu sent_status=1, adica cele pe care userul nu le-a sters din sentmessages
        $messagesIds = DB::table('messages')
                ->join('users', function($join) {
                            $join->on('users.id', '=', 'messages.sender_id')
                            ->where('users.id', '=', Auth::user()->id)
                            ->where('sent_status', '=', '1');
                            ;
                        })
                ->get();
        return View::make('sentmessages', array('messages' => $messagesIds));
    }

    public function unreadMessages() {
        //join intre tabele
        //se afiseaza cele cu inbox_status=1, adica cele pe care userul nu le-a sters
        //si cele cu read=0, cele care nu sunt citite
        $messagesIds = DB::table('messages')
                ->join('users', function($join) {
                            $join->on('users.id', '=', 'messages.receiver_id')
                            ->where('users.id', '=', Auth::user()->id)
                            ->where('messages.read', '=', '0')
                            ->where('inbox_status', '=', '1');
                            ;
                        })
                ->get();;
        return View::make('unreadmessages', array('messages' => $messagesIds));
    }

    public function readMessage($id) {
        //se ia mesajul citit, si se modifica read=1
        $message = new Message();
        $messageData = DB::table('messages')->where('id_mess', '=', $id)->get();
        foreach ($messageData as $message) {
            DB::table('messages')
                    ->where('id_mess', $id)
                    ->update(array('read' => 1));
        }
        return View::make('readmessage', array('messages' => $messageData));
    }

    public function deleteMessage($id) {  
        if (Auth::check()) {
            try {
                $sender_id = DB::table('messages')->where('id_mess', '=', $id)->pluck('sender_id');
                $receiver_id = DB::table('messages')->where('id_mess', '=', $id)->pluck('receiver_id');
                $id_user = Auth::user()->id;
                //daca userul este cel care a trimis mesajul pe care vrea sa-l stearga
                //sent_status devine 0
                if ($sender_id == $id_user) {
                    DB::table('messages')
                            ->where('id_mess', $id)
                            ->update(array('sent_status' => 0));
                }
                //daca userul este cel care a primit mesajul pe care vrea sa-l stearga
                //inbox_status devine 0
                if ($receiver_id == $id_user) {
                    DB::table('messages')
                            ->where('id_mess', $id)
                            ->update(array('inbox_status' => 0));
                }
                return Response::json(array(
                            'succes' => 'true',
                            'message' => 'The message has been deleted!'));
            } catch (Exception $ex) {
                return Response::json(array(
                            'succes' => 'false',
                            'message' => 'You need to log in first!'));
            }
        }
    }

}