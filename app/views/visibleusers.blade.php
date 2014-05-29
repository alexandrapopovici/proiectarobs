@extends('layouts/users/userMaster')
@section('content')
<div id="aboutus">
    <h3 > Visible Users </h3>
    <br>
    @if(Session::has('message'))
    <p class="alert alert-info">{{ Session::get('message') }}</p>
    @endif
    <div>   
        <table class="table table-hover">
            <tr><td><b>Username</b></td><td><b>Birthdate</b></td><td>Send message</td></tr>
            @foreach ($users as $user)
            <tr>
                <td>{{$user->username}}</td> 
                <td>{{$user->birthdate}}</td>          
                <td><a href="#" class="sendmessages" id="{{ 'sendmessage_'.$user->id }}" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-envelope" data-toggle="tooltip" data-placement="bottom" title="Send Message"></span></a>
                    @endforeach
        </table>
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
</div>        
@stop


