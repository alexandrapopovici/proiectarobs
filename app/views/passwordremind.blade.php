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
    {{ Form::open(array('url' => 'user/postremindpassword', 'method' => 'post', 'class' => 'form')) }}
    <h3>Remind Password</h3><br>
    <div class="form-group">
        {{ Form::label('email', 'Email') }}
        {{ Form::email('email', Input::old('email'), array('class'  => 'form-control')) }}
    </div>
    <div>
        {{ Form::submit('Send reminder', array('class'  => 'btn btn-primary')) }}
        {{ HTML::linkAction('UserController@login', 'Cancel', array('class'=>'btn btn-primary')) }} 
        {{ Form::close() }}
    </div> 
</div>
@stop
