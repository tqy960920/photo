<?php 

class ResponseInfo{
	public $code;
	public $message;
	public $data;

	public function __construct($code , $message , $data){
		$this->code = $code;
		$this->message = $message;
		$this->data = $data;
	}
}