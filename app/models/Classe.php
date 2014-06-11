<?php

	class Classe extends Eloquent
	{
		protected $fillable = [];

		public function parent()
	    {
	    	// return $this->hasOne('Classe', 'id', 'parent_id');
	    	return $this->belongsTo('Classe', 'parent_id');
	    }

	    public function childrens()
	    {
	        return $this->hasMany('Classe', 'parent_id');
	    }

	    public function teachers()
	    {
	    	return $this->belongsToMany('User', 'teachers_classes', 'classe_id', 'professor_id');
	    }

	    public function getUrlAttribute ()
	    {
	    	$urlItem = '/'. $this->code;
			$item = $this->parent;
			while($item != NULL)
			{
				$urlItem = '/'. $item->code . $urlItem;
				$item = $item->parent;
			}
			return $urlItem;
	    }

	}