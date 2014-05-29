@extends('layouts/site/siteMaster')
@section('content')
<div class="flexslider" align="center">
    <ul class="slides">
        <li>
            <img src="{{ URL::to('img/slider/img2.jpg') }}" height="330px" />
        </li>
        <li>
            <img src="{{ URL::to('img/slider/img4.jpg') }}" height="330px"  />
        </li>
    </ul>
</div>
@if(Session::has('message'))
<p class="alert alert-info">{{ Session::get('message') }}</p>
@endif
<div id="indexdiv" style="background:ghostwhite;height:100px;width:600px;position:absolute;">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Forget about screaming...Have fun!
    <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Join Messagers' Community now!!
</div>
<br><br><br><br><br><br>
@stop