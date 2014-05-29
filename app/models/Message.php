<?php

class Message extends Eloquent {
    public $timestamps = false;
    protected $table = 'messages';
    protected $fillable = array('id_mess','sender_id', 'receiver_id', 'subject', 'content', 'read');
}