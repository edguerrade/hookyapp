<?php

class Lesson extends \Eloquent {
	protected $fillable = [];

	public function tutorial()
    {
		return $this->belongsTo('Tutorial', 'tutorial_id', 'id');
    }

    public function classe()
    {
		return $this->belongsTo('Classe', 'classe_id', 'id');
    }

    public function timetable()
    {
		return $this->belongsTo('Timetable', 'timetable_id', 'id');
    }

    public function getTimeAttribute()
    {
    	return json_decode($this->timetable->time);
    }
}