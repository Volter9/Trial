<?php namespace Trial\Routing\Http;

class Response {
	
	private $body;
	
	private $code = 200;
	private $headers = [];
	
	public function getCode () {
		return $this->code;
	}
	
	public function setCode ($code = 200) {
		if (!is_int($code)) {
			return false;
		}
		
		$this->code = $code;
	}
	
	public function setBody ($body) {
		if (!is_string($body) && !$body instanceof Output) {
			return false;
		}
		
		$this->body = $body;
	}
	
	public function setHeader ($name, $value) {
		$this->headers[$name] = $value;
	}
	
	public function text ($text) {
		$this->body = (string)$text;
		
		return $this;
	}
	
	public function json (array $data) {
		$this->body = json_encode($data, JSON_UNESCAPED_UNICODE);
		
		return $this;
	}
	
	public function redirect ($url) {
		$this->setHeader('Location', $url);
		
		return $this;
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
		if ($this->code !== 200) {
			http_response_code($this->code);
		}
		
		foreach ($this->headers as $header => $value) {
			header("$header: $value");
		}
	}
	
}