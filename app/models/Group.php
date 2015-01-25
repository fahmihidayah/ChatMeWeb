<?php


class Group extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'groups';

	public function list_users()
	{
		return $this->belongsToMany('User', 'group_user', 'group_id', 'user_id');
	}

	public function list_messages()
	{
		return $this->hasMany('Message');
	}
}
