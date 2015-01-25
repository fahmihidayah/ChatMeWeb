<?php


class Message extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'messages';

	public function user_sender()
	{
		return $this->belongsTo('User', 'user_id_sender');
	}

	public function user_receiver()
	{
		return $this->belongsTo('User','user_id_receiver');
	}

	public function group()
	{
		return $this->belongsTo('Group');
	}
}
