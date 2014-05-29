@extends('layouts/site/siteMaster')
@section('content')
<div id="aboutus">
    <?php $errorLogin = Session::get('messageLogin'); ?>
    <?php if (!empty($errorLogin)) { ?> 
        <div class="alert alert-warning clearfix ">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <div class="errorLog">
                <?php echo $errorLogin; ?>
            </div>
        <?php } ?>               
    </div>
    {{ Form::open(array('url' => '/confirmlogin', 'method' => 'post', 'class' => 'form', 'id' => 'validate-login')) }}
    <h3>LogIn</h3><br>
    <div class="form-group">
        {{ Form::label('username', 'Username') }}
        {{ Form::text('username', Input::old('username'), array('class'  => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('password', 'Password') }}
        {{ Form::password('password', array('class'  => 'form-control')) }}
    </div>
    <div>
        {{ Form::submit('Login', array('class'  => 'btn btn-primary')) }}
        {{ HTML::linkAction('UserController@login', 'Cancel', array('class'=>'btn btn-primary')) }} 
        {{ Form::close() }}
    </div>
    <br>
    {{ HTML::linkAction('RemindersController@getRemind', 'Forgotten Password', array('class'=>'btn btn-primary')) }} 
</div>
@stop