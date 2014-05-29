@extends('layouts/users/userMaster')
@section('content')
@if(Session::has('message'))
<p class="alert alert-info">{{ Session::get('message') }}</p>
@endif
<div id="aboutus">
    <h3> Create Message</h3><br>
    {{ Form::open(array('url' => 'message/confirm', 'method' => 'post')) }} 
    <div class="form-group">    
        {{ Form::label('receiver_id', 'To') }}
        {{ Form::text('receiver_name', Input::old('receiver_name'), array('class'  => 'form-control')) }}   
    </div>
    <div class="form-group">   
        {{ Form::label('subject', 'Subject') }}<br/>
        {{ Form::text('subject',Input::old('subject'),array('class'=>'form-control'))}}   
    </div>
    <div class="form-group">   
        {{ Form::label('content','Message')}}</br>
        {{ Form::textarea('content',Input::old('content'),array('class'=>'form-control'))}}    
    </div>
    <?php $id = Auth::user()->id; ?>
    {{Form::hidden('sender_id', $id)}}
    {{ Form::submit('Send Message', array('class'  => 'btn btn-primary')) }}
    {{ HTML::linkAction('UserController@dashboard', 'Cancel', array('class'=>'btn btn-primary')) }} 
    {{ Form::close() }}
</div> 
@stop


