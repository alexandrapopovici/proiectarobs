@extends('layouts/site/siteMaster')
@section('content')
<div>
    <?php
    $error = Session::get('validateError');
    if (!empty($error)) {
        ?>
        <div class="alert alert-warning clearfix">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <ul>
                    <?php foreach ($error as $err) { ?>
                    <li class="errorMessages">
                    <?php echo $err; ?>                  
                    </li>
    <?php } ?>
            </ul>  
        </div>
<?php } ?>
    {{ Form::open(array('url' => '/createuser', 'method' => 'post', 'class' => 'form', 'id' => 'validate-user')) }}
    <h3>SignIn</h3><br>
    <div class="form-group">
        {{Form::label('username', 'Username')}} 
        {{ Form::text('username', Input::old('username'), array('class'  => 'form-control')) }}
    </div>
    <div class="form-group">
        {{Form::label('email', 'Email')}} 
        {{ Form::text('email', Input::old('email'), array('class'  => 'form-control')) }}
    </div>
    <div class="form-group">
        {{Form::label('birthdate', 'BirthDate')}} 
        <br>{{'The date must be in the format YYYY/MM/DD'}}
        {{ Form::text('birthdate', Input::old('birthdate'), array('class'  => 'form-control', 'id' => 'datepicker')) }}
    </div>
    <div class="form-group">
        {{Form::label('password', 'Password')}} 
        {{ Form::password('password', array('class'  => 'form-control', 'id' => 'password')) }}
    </div>
    <div class="form-group">
        {{Form::label('confirm_password', 'Confirm Password')}} 
        {{ Form::password('confirm_password', array('class'  => 'form-control')) }}
    </div>
    {{ Form::submit('Sign In', array('class'  => 'btn btn-primary')) }}
    {{ HTML::linkAction('UserController@signin', 'Cancel', array('class'=>'btn btn-primary')) }} 
    {{ Form::close() }}
</div>
@stop