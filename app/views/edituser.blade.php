@extends('layouts/users/userMaster')
@section('content')
<div id="aboutus">
    <div>      
        {{ Form::open(array('url' => '/createuser', 'method' => 'post', 'class' => 'form-signin form-validate', 'id' => 'create-user-details')) }}
        <div class="form-group">      		
            @if(isset($validate_messages) && $validate_messages->has('username')) 
            <div class="form-group has-error" data-toggle="popover" >
                <label class="control-label" for="inputError1">
                    {{$validate_messages->first('username')}}
                </label>
            </div>
            @endif		        		       		         
            {{Form::label('username', 'Username')}} 
            {{Form::text('username', isset($user) ? $user->username : '', array('class'  => 'form-control'))}}            
        </div>         
        <div class="form-group">        
            @if (isset($validate_messages) && $validate_messages->has('email')) 
            <div class="form-group has-error" data-toggle="popover" >
                <label class="control-label" for="inputError1">
                    {{$validate_messages->first('email')}}
                </label>
            </div>
            @endif			        
            {{Form::label('email', 'Email')}} 
            {{Form::text('email',isset($user) ? $user->email : '', array('class'  => 'form-control'))}}
        </div>
        <div class="form-group">        			        
            {{Form::label('birthdate', 'Birthdate')}} 
            {{Form::text('birthdate',isset($user) ? $user->birthdate : '', array('class'  => 'form-control'))}}
        </div>
        <div class="form-group">
            @if (!isset($user) || !isset($user->id))
            @if (isset($validate_messages) && $validate_messages->has('password')) 
            <div class="form-group has-error" data-toggle="popover" >
                <label class="control-label" for="inputError1">
                    {{$validate_messages->first('password')}}
                </label>
            </div>
            @endif		
            {{Form::label('password', 'Password')}} 
            {{ Form::password('password', array('class'  => 'form-control')) }}
            @endif           
        </div>        
        @if (isset($user))
        {{Form::hidden('id', $user->id)}}
        {{Form::hidden('visible', $user->visible)}}
        @endif
        {{ Form::submit(isset($user) && isset($user->id) ? 'Update' : 'Create', array('class'  => 'btn btn-primary')) }} 
        {{ HTML::linkAction('UserController@dashboard', 'Cancel', array('class'=>'btn btn-primary')) }} 
        {{ Form::close() }}	
    </div>
</div>          
@stop




