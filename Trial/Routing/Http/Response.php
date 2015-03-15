<?php namespace Trial\Routing\Http;

class Response {
	
	private $body;
	
	private $code = 200;
	private $headers = [];
	
	public function getCode () {
		return $this->code;
	}
	
	public function setCode ($code) {
		if (!is_int($code)) {
			return false;
		}
		
		$this->code = $code;
	}
	
	public function getBody () {
		return $this->body;
	}
	
	public function setBody ($body) {
		$this->body = $body;
	}
	
	public function setHeader ($name, $value) {
		$this->headers[$name] = $value;
	}
	
	public function redirect ($url) {
		$this->setHeader('Location', $url);
	}
	
	public function send () {
		$this->sendHeaders();
		
		if ($this->body instanceof Output) {
			$this->body->render($this);
		}
		else {
			echo $this->body;
		}
	}
	
	public function sendHeaders () {
		http_response_code($this->code);
		
		foreach ($this->headers as $header => $value) {
			header("$header: $value");
		}
	}
	
}