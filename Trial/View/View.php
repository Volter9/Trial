<?php namespace Trial\View;

use Trial\Injection\Container,
	Trial\Routing\Http\Output,
	Trial\Routing\Http\Response;

use Trial\View\Template\Data;

class View implements Output {
	
	protected $data;
	protected $path;
	
	public function __construct (Data $data, $path) {
		$this->path = $path;
		$this->data = $data;
	}
	
	public function render (Response $response = null) {
		$closure = $this->isolate();
		$closure($this->path, $this->data->content());
	}
	
	protected function isolate () {
		return function ($__view, $__data) {
			extract($__data);
			
			include $__view;
		};
	}
	
	public function getData () {
		return $this->data;
	}
	
}