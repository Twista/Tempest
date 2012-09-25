<?php

class PostController {

	public function __contruct(){

	}

	public function showAll(){
		echo '<h1>Showing all posts!</h1>';
	}

	public function showPost($id,$year){
		echo('<pre>'); print_r(func_get_args()); echo('</pre>');
		echo('<pre>'); print_r($id); echo('</pre>');
		echo '<h1>Showing post with id '.$id.' - '.$year.'!</h1>';
	}

}