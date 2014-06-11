<?php

class Tutorial extends Eloquent
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tutorials';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('update_at', 'created_at');

	public function tutor()
    {
		return $this->belongsTo('User');
    }

    public function classes()
    {
    	return $this->belongsToMany('Classe', 'lessons');
    }
}