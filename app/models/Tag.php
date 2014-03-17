<?php

class Tag extends \Phalcon\Mvc\Model
{

	public $id_video;

	public $tag;
	
	public function initialize()
    {
        $this->belongsTo("id_video", "Video", "id");
    }
}
