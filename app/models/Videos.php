<?php

class Videos extends \Phalcon\Mvc\Collection {

	public $_id;
	public $name;
	public $title;
	public $descr;
	public $code;
	public $created_at;
	public $updated_at;
	public $tags;
	
	public function getSource() {
		return "videos";
	}
	
	public function beforeCreate() {
        $this->created_at = time();
    }

    public function beforeUpdate() {
        $this->updated_at = time();
    }
}
