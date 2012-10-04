<?php

class PostPresenter extends \Tempest\MVC\Presenter {

	public function __contruct(){
	}

	public function beforeRender(){
		echo '<h2>beforeRender called</h2>';
	}

	public function afterRender(){
		echo '<h2>afterRender called</h2>';
	}

	public function showAllAction(){
		echo '<h1>Showing all posts!</h1>';
	}

	public function showPostAction($id){
		$this->template->id = $id;
	}

	public function showPostEvent($id){
		echo 'Event for action showPost '.$id;

	}

}