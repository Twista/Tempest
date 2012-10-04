<?php

class PostPresenter extends \Tempest\MVC\Presenter {

	public function __contruct(){
		parent::__construct();
	}

	public function beforeRender(){
		echo '<h2>beforeRender called</h2>';
	}

	public function afterRender(){
		echo '<h2>afterRender called</h2>';
	}

	public function showAll(){
		echo '<h1>Showing all posts!</h1>';
	}

	public function showPost($id){
		echo('<pre>'); print_r(func_get_args()); echo('</pre>');
		echo('<pre>'); print_r($id); echo('</pre>');
		echo '<h1>Showing post with id '.$id.'!</h1>';
	}

}