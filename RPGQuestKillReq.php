<?php

class RPGQuestKillReq extends RPGQuestReq {

	private $_intKillReqID;
	private $_intKillReq;
	private $_intCurrentKillCount;
	
	public function __construct(){
		
	}
	
	public function getKillReqID(){
		return $this->_intKillReqID;
	}
	
	public function setKillReqID($intKillReqID){
		$this->_intKillReqID = $intKillReqID;
	}
	
	public function getKillReq(){
		return $this->_intKillReq;
	}
	
	public function setKillReq($intKillReq){
		$this->_intKillReq = $intKillReq;
	}
	
	public function getCurrentKillCount(){
		return $this->_intCurrentKillCount;
	}
	
	public function setCurrentKillCount($intCurrentKillCount){
		$this->_intCurrentKillCount = $intCurrentKillCount;
	}
	
	public function incrementKillCount(){
		if(parent::getCompleted() == '0000-00-00 00:00:00'){
			if($this->_intCurrentKillCount + 1 == $this->_intKillReq){
				parent::setCompleted(date("Y-m-d H:i:s"));
			}
			$this->_intCurrentKillCount++;
		}
	}

}

?>