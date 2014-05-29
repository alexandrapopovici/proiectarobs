<?php if (isset($user)) { ?>
    <div>
        {{ Form::open(array('url' => 'message/confirm', 'method' => 'post')) }} 
        {{Form::hidden('receiver_name','',array('class'  => 'receiver'))}}
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
        {{ Form::button( 'Cancel', array('class'=>'btn btn-primary','id'=>'cancelsendmessage')) }} 
        {{ Form::close() }}
    </div> 
<?php } ?>
