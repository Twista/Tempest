<?php

/**
 * Description of HTMLElement
 * Simple class representing HTML Element
 * @author Michal Haták [Twista] <me@twista.cz>
 * @package Tempest
 */

namespace Tempest\Utils;

class HTMLElement {

	private $not_pair = array('img','hr','br');

    private $element_name;

    private $pair = null;

    private $properties;

    private $content = null;

    public function __construct($elementname){
        $this->element_name = strtolower($elementname);
        $this->properties = new \Stdclass();
    }

    public function __get($varName) {
    	if(isset($this->$varName))
		    return $this->$varName;
    }

     public function __set($varName, $value){
     	if($varName == 'content')
            $this->content = $value;
        else
            $this->properties->{$varName} = $value;
     }

     public function pair(){
     	$this->pair = true;
     }

     public function notPair(){
     	$this->pair = false;
     }

     public function __toString(){
     	return $this->createElement();
     }

     public function render(){
     	echo $this->createElement();
     }

     public function createElement(){
     	$string = '<'.$this->element_name;
     	foreach ($this->properties as $key => $value) {
     		$string .= ' '.$key.'="'.$value.'"';
     	}
     	if((is_null($this->pair) && (in_array($this->element_name, $this->not_pair)))
            || ($this->pair == false)
            || (is_null($this->pair) && is_null($this->content)) ){

     		$string .= ' />';
		} else {
			$string .= '>'.$this->content.'</'.$this->element_name.'>';
		}
		return $string;
     }

}
