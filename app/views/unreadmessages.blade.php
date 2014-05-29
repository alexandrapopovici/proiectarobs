@extends('layouts/users/userMaster')
@section('content')
<div id="aboutus">
    <h3 > Unread Messages </h3>
    <br>
    @if(Session::has('message'))
    <p class="alert alert-info">{{ Session::get('message') }}</p>
    @endif
    <p id="message"></p>
    <div>  
        <?php if (!$messages)
            echo'You have no unread messages';
        else {
            ?>
            <table class="table table-hover">
                <tr><td><b>From</b></td><td><b>Subject</b></td><td></td><td></td></tr>
                @foreach ($messages as $message)
                <tr id="{{ 'message_'.$message->id_mess }}">
                    <td>
    <?php $user = DB::table('users')->where('id', $message->sender_id)->pluck('username'); ?>
                        {{$user}}</td> 
                    <td>{{$message->subject}}</td>
                    <td><a href="{{ url('message/read/'.$message->id_mess) }}" ><span class="glyphicon glyphicon-edit" data-toggle="tooltip" data-placement="bottom" title="Read Message"></span></a></td>
                    <td><a href="#" class="deletemessage" id="{{ 'deletemessage_'.$message->id_mess }}" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-trash" data-toggle="tooltip" data-placement="bottom" title="Delete Message"></span></a></td>
                </tr>
                @endforeach
            </table>
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel">Delete Message</h4>
                        </div>
                        <div class="modal-body">
                            Do you really want to delete this message?
                        </div>
                        <div class="modal-footer">
                            <a href="#" id="confdeletemessage" class="btn btn-primary">Delete</a>
                            <a href="#" id="canceldelmessage" class="btn">Cancel</a>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php } ?>
</div>          
@stop





