@extends('layouts/users/userMaster')
@section('content')
<div id="aboutus">
    @if(Session::has('message'))
    <p class="alert alert-info">{{ Session::get('message') }}</p>
    @endif
    <div>
        <?php $id = Auth::user()->id; ?>
        {{ Form::open(array( 'url' => '/user/changepassword/'.$id, 'method' => 'post', 'id' => 'validate-new_password')) }}
    </div>
    <div class="form-group">
        {{ Form::label('password', 'Password') }}
        {{ Form::password('password', array('class'  => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('new_password', 'New Password') }}
        {{ Form::password('new_password', array('class'  => 'form-control')) }}
    </div>
    {{ Form::submit('Change Password', array('class'  => 'btn btn-primary')) }}
    {{ HTML::linkAction('UserController@dashboard', 'Cancel', array('class'=>'btn btn-primary')) }} 
    {{ Form::close() }}
</div>
@stop