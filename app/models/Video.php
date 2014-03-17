<?php

class Video extends \Phalcon\Mvc\Model
{

	public $id;

	public $name;

	public $code;

	public $descr;

	public $updated_at;
	
	public $created_at;
	
	public function initialize()
    {
        $this->hasMany("id", "Tag", "id_video");
    }
}
