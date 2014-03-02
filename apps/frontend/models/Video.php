<?php

namespace Shagtv\Frontend\Models;

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
        $this->updated_at = date("Y-m-d H:s:i");
        //Skips only when updating
        $this->skipAttributesOnUpdate(array('created_at'));
    }
	
}
