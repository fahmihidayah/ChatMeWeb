<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	public function list_send_messages()
	{
		return $this->belongsTo('Message', 'user_id_sender', 'id');
	}

	public function list_receive_messages()
	{
		return $this->belongsTo('Message', 'user_id_receiver', 'id');
	}

	public function list_groups()
	{
		return $this->belongsToMany('Group', 'group_user', 'group_id', 'user_id');
	}

}
