@extends('layouts/users/userMaster')
@section('content')
<div id="aboutus">
    @foreach ($messages as $message)
    <?php $sender_user = DB::table('users')->where('id', $message->sender_id)->pluck('username'); ?>
    <?php $receiver_user = DB::table('users')->where('id', $message->receiver_id)->pluck('username'); ?>
    <b>FROM:&nbsp;&nbsp;</b>{{$sender_user}}<br><hr>
    <b>To:&nbsp;&nbsp;</b>{{$receiver_user}}<br><hr>
    <b>DATE:&nbsp;&nbsp;</b>{{$message->date}}<br><hr>
    <b>SUBJECT:&nbsp;&nbsp;</b>{{$message->subject}}<br><hr>
    <b>MESSAGE:</b><br>{{$message->content}}<br> 
    <br>
    <br>
    <?php $username = Auth::user()->username;
    if ($sender_user !== $username) {
        ?>
        <p align="right"><a href="#" class="sendmessages" id="{{ 'sendmessage_'.$sender_user }}" data-toggle="modal" data-target="#myModal">REPLY</a></p>   
<?php } ?>
    @endforeach
    <br>
    <br>
    <a href="{{ URL::previous() }}">Go Back</a>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Create Message</h4>
                </div>
                <div class="modal-body">
                    @include('layouts/users/modalmessage')
                </div>
            </div>
        </div>
    </div>
</div>
@stop
