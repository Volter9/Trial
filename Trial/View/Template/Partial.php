<?php namespace Trial\View\Template;

use Trial\Routing\Http\Response;

use Trial\View\Attachable,
	Trial\View\View;

class Partial extends View implements Attachable {
	
	protected $attachment;
	
	public function attach ($attachment) {
		$this->attachment = $attachment;
	}
	
	public function render (Response $response = null) {
		$closure = $this->isolate()->bindTo($this->attachment);
		$closure($this->path, $this->data->content());
	}
	
}