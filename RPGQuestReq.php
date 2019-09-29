<?php

class RPGQuestReq{

	private $_intQuestID;
	private $_intNPCID;
	private $_strReqName;
	private $_dtmStarted;
	private $_dtmCompleted;
	
	public function __construct(){
		
	}
	
	public function getQuestID(){
		return $this->_intQuestID;
	}
	
	public function setQuestID($intQuestID){
		$this->_intQuestID = $intQuestID;
	}
	
	public function setReqName($strReqName){
		$this->_strReqName = $strReqName;
	}
	
	public function getReqName(){
		return $this->_strReqName;
	}
	
	public function getNPCID(){
		return $this->_intNPCID;
	}
	
	public function setNPCID($intNPCID){
		$this->_intNPCID = $intNPCID;
	}
	
	public function getStarted(){
		return $this->_dtmStarted;
	}
	
	public function setStarted($dtmStarted){
		$this->_dtmStarted = $dtmStarted;
	}
	
	public function getCompleted(){
		return $this->_dtmCompleted;
	}
	
	public function setCompleted($dtmCompleted){
		$this->_dtmCompleted = $dtmCompleted;
	}

}

?>