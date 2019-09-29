<?php

class RPGXMLReader {

	private $_objXML;
	
	public function __construct($strXMLFileName){
		$this->_objXML = simplexml_load_file('XML/' . $strXMLFileName);
	}
	
	public function getEndNodes(){
		return $this->_objXML->end;
	}
	
	public function getEventTextList($intID){
		return $this->_objXML->dialog[intval($intID)]->eventText;
	}
	
	public function getEventText($intID){
		return $this->_objXML->dialog[intval($intID)]->eventText[0];
	}
	
	public function getCommandList($intID){
		return $this->_objXML->dialog[intval($intID)]->option;
	}
	
	public function getCommandListNodeIDs($intID){
		$arrReturn = array();
		$n = count($this->_objXML->dialog[intval($intID)]->option);
		for($i=0;$i<$n;$i++){
			$arrReturn[] = $this->_objXML->dialog[intval($intID)]->option[$i]->attributes()->id;
		}
		return $arrReturn;
	}
	
	public function getCommandID($intID, $key){
		return $this->_objXML->dialog[intval($intID)]->option[intval($key)]->attributes()->id;
	}
	
	public function getCommandAction($intID, $key){
		return $this->_objXML->dialog[intval($intID)]->option[intval($key)]->attributes()->action;
	}
	
	public function getCommandPrecondition($intID, $key){
		return $this->_objXML->dialog[intval($intID)]->option[intval($key)]->attributes()->precondition;
	}
	
	public function getPrecondition(){
		return $this->_objXML->precondition;
	}
	
	public function hasCommandPrecondition($intID, $key){
		return ($this->_objXML->dialog[intval($intID)]->option[intval($key)]->attributes()->precondition != null);
	}
	
	public function hasCommandAction($intID, $key){
		return ($this->_objXML->dialog[intval($intID)]->option[intval($key)]->attributes()->action != null);
	}
	
	public function getEventTextPrecondition($intID, $key){
		return $this->_objXML->dialog[intval($intID)]->eventText[intval($key)]->attributes()->precondition;
	}
	
	public function hasEventTextPrecondition($intID, $key){
		return ($this->_objXML->dialog[intval($intID)]->eventText[intval($key)]->attributes()->precondition != null);
	}
	
	public function hasEventTextAction($intID, $key){
		return ($this->_objXML->dialog[intval($intID)]->eventText[intval($key)]->attributes()->action != null);
	}
	
	public function getEventType(){
		return $this->_objXML->type;
	}
	
	public function isValidNodeID($intFromNodeID, $intToNodeID){
		if(in_array($intToNodeID, (array)$this->getCommandListNodeIDs($intFromNodeID))){
			return true;
		}
		else{
			return false;
		}
	}
}

?>