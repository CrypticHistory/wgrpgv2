<?php

require_once "Database.php";
include_once "Lottery.php";
include_once "RPGEvent.php";
include_once "Maze.php";
include_once "RPGNPC.php";
include_once "RPGEnemyTeam.php";

class RPGFloor{

	private $_intFloorID;
	private $_strFloorName;
	private $_strFloorType;
	private $_intDimension;
	private $_dtmCreatedOn;
	private $_strCreatedBy;
	private $_objMaze;
	private $_dtmModifiedOn;
	private $_strModifiedBy;
	private $_arrApplicableEvents;
	private $_arrApplicableEnemies;
	
	public function __construct($intFloorID = null){
		if($intFloorID != 0 && $intFloorID != null){
			$this->loadFloorInfo($intFloorID);
		}
	}
	
	private function populateVarFromRow($arrFloorInfo){
		$this->setFloorID($arrFloorInfo['intFloorID']);
		$this->setFloorName($arrFloorInfo['strFloorName']);
		$this->setFloorType($arrFloorInfo['strFloorType']);
		$this->setDimension($arrFloorInfo['intDimension']);
		$this->setCreatedOn($arrFloorInfo['dtmCreatedOn']);
		$this->setCreatedBy($arrFloorInfo['strCreatedBy']);
		$this->setModifiedOn($arrFloorInfo['dtmModifiedOn']);
		$this->setModifiedBy($arrFloorInfo['strModifiedBy']);
	}
	
	private function loadFloorInfo($intFloorID){
		$objDB = new Database();
		$arrFloorInfo = array();
			$strSQL = "SELECT *
						FROM tblfloor
							WHERE intFloorID = " . $objDB->quote($intFloorID);
			$rsResult = $objDB->query($strSQL);
			while ($arrRow = $rsResult->fetch(PDO::FETCH_ASSOC)){
				$arrFloorInfo['intFloorID'] = $arrRow['intFloorID'];
				$arrFloorInfo['strFloorName'] = $arrRow['strFloorName'];
				$arrFloorInfo['strFloorType'] = $arrRow['strFloorType'];
				$arrFloorInfo['intDimension'] = $arrRow['intDimension'];
				$arrFloorInfo['dtmCreatedOn'] = $arrRow['dtmCreatedOn'];
				$arrFloorInfo['strCreatedBy'] = $arrRow['strCreatedBy'];
				$arrFloorInfo['dtmModifiedOn'] = $arrRow['dtmModifiedOn'];
				$arrFloorInfo['strModifiedBy'] = $arrRow['strModifiedBy'];
			}
		$this->populateVarFromRow($arrFloorInfo);
	}
	
	public function setApplicableEvents($intRPGCharacterID){
		$objDB = new Database();
		$strSQL = "SELECT intEventID, intOccurrenceRating, intCountPerFloor
					FROM tblflooreventxr
						INNER JOIN tblevent
							USING (intEventID)
						WHERE intEventID NOT IN
							(SELECT intEventID
								FROM tblcharactereventxr
									INNER JOIN tblevent
										USING (intEventID)
									WHERE intRPGCharacterID = " . $objDB->quote($intRPGCharacterID) . "
										AND blnRepeating = 0)
							AND strEventType = 'Event'
							AND intFloorID = " . $objDB->quote($this->getFloorID());
		$rsResult = $objDB->query($strSQL);
		while ($arrRow = $rsResult->fetch(PDO::FETCH_ASSOC)){
			$this->_arrApplicableEvents[$arrRow['intEventID']]['intOccurrenceRating'] = $arrRow['intOccurrenceRating'];
			$this->_arrApplicableEvents[$arrRow['intEventID']]['intCountPerFloor'] = $arrRow['intCountPerFloor'];
			$this->_arrApplicableEvents[$arrRow['intEventID']]['objEvent'] = new RPGEvent($arrRow['intEventID'], $intRPGCharacterID);
		}
	}
	
	public function setApplicableEnemies(){
		$objDB = new Database();
		$strSQL = "SELECT intFloorNPCXRID, intNPCID, intNPCID2, intNPCID3, intOccurrenceRating
					FROM tblfloornpcxr
						WHERE intFloorID = " . $objDB->quote($this->getFloorID()) . "
							AND intOccurrenceRating <> 9999";
		$rsResult = $objDB->query($strSQL);
		while ($arrRow = $rsResult->fetch(PDO::FETCH_ASSOC)){
			$this->_arrApplicableEnemies[$arrRow['intFloorNPCXRID']]['intOccurrenceRating'] = $arrRow['intOccurrenceRating'];
			$this->_arrApplicableEnemies[$arrRow['intFloorNPCXRID']]['intNPCID'] = $arrRow['intNPCID'];
			$this->_arrApplicableEnemies[$arrRow['intFloorNPCXRID']]['intNPCID2'] = $arrRow['intNPCID2'];
			$this->_arrApplicableEnemies[$arrRow['intFloorNPCXRID']]['intNPCID3'] = $arrRow['intNPCID3'];
		}
	}
	
	public function getApplicableEvents(){
		return $this->_arrApplicableEvents;
	}
	
	public function getApplicableEnemies(){
		return $this->_arrApplicableEnemies;
	}
	
	public function getRandomEnemy(){
		$objLottery = new Lottery();
		foreach($this->getApplicableEnemies() as $key => $arrEnemyInfo){
			$objLottery->addEntry($key, $arrEnemyInfo['intOccurrenceRating']);
		}
		$intWinner = $objLottery->getWinner();
		$objEnemyTeam = new RPGEnemyTeam();
		$objEnemyTeam->setLeader(new RPGNPC($this->_arrApplicableEnemies[$intWinner]['intNPCID']));
		if(isset($this->_arrApplicableEnemies[$intWinner]['intNPCID2']) && $this->_arrApplicableEnemies[$intWinner]['intNPCID2'] != 0){
			$objEnemyTeam->setEnemyOne(new RPGNPC($this->_arrApplicableEnemies[$intWinner]['intNPCID2']));
		}
		else{
			$objEnemyTeam->setEnemyOne(null);
		}
		if(isset($this->_arrApplicableEnemies[$intWinner]['intNPCID3']) && $this->_arrApplicableEnemies[$intWinner]['intNPCID3'] != 0){
			$objEnemyTeam->setEnemyTwo(new RPGNPC($this->_arrApplicableEnemies[$intWinner]['intNPCID3']));
		}
		else{
			$objEnemyTeam->setEnemyTwo(null);
		}
		return $objEnemyTeam;
	}
	
	public function pickFromApplicableEvents(){
		$arrReturn = array();
		if(!empty($this->getApplicableEvents())){
			foreach($this->getApplicableEvents() as $key => $arrEventInfo){
				for($i=0;$i<$arrEventInfo['intCountPerFloor'];$i++){
					$intRoll = mt_rand(1, 1000);
					if($arrEventInfo['intOccurrenceRating'] >= $intRoll){
						$arrReturn[] = $arrEventInfo['objEvent'];
					}
				}
			}
		}
		return $arrReturn;
	}
	
	public function loadMaze($intDimension, $intRPGCharacterID){
		$this->setApplicableEvents($intRPGCharacterID);
		$this->setApplicableEnemies();
		$this->_objMaze = new Maze($intDimension, $this->pickFromApplicableEvents(), $this->getStartEvent($intRPGCharacterID), $this->getEndEvent($intRPGCharacterID));
	}
	
	public function getStartEvent($intRPGCharacterID){
		$objDB = new Database();
		$strSQL = "SELECT intEventID
					FROM tblevent
						INNER JOIN tblflooreventxr
							USING (intEventID)
						WHERE strEventType = 'Start Event'
							AND intFloorID = " . $objDB->quote($this->_intFloorID) . "
							AND intEventID NOT IN
							(SELECT intEventID
								FROM tblcharactereventxr
									INNER JOIN tblevent
										USING (intEventID)
									WHERE intRPGCharacterID = " . $objDB->quote($intRPGCharacterID) . "
										AND blnRepeating = 0)";
		$rsResult = $objDB->query($strSQL);
		$arrRow = $rsResult->fetch(PDO::FETCH_ASSOC);
		if(!isset($arrRow['intEventID'])){
			return null;
		}
		else{
			$objEvent = new RPGEvent($arrRow['intEventID'], $intRPGCharacterID);
			return $objEvent;
		}
	}
	
	public function getEndEvent($intRPGCharacterID){
		$objDB = new Database();
		$strSQL = "SELECT intEventID
					FROM tblevent
						INNER JOIN tblflooreventxr
							USING (intEventID)
						WHERE strEventType = 'End Event'
							AND intFloorID = " . $objDB->quote($this->_intFloorID) . "
							AND intEventID NOT IN
							(SELECT intEventID
								FROM tblcharactereventxr
									INNER JOIN tblevent
										USING (intEventID)
									WHERE intRPGCharacterID = " . $objDB->quote($intRPGCharacterID) . "
										AND blnRepeating = 0)";
		$rsResult = $objDB->query($strSQL);
		$arrRow = $rsResult->fetch(PDO::FETCH_ASSOC);
		if(!isset($arrRow['intEventID'])){
			return null;
		}
		else{
			$objEvent = new RPGEvent($arrRow['intEventID'], $intRPGCharacterID);
			return $objEvent;
		}
	}
	
	public function getStandstill($intRPGCharacterID){
		$objDB = new Database();
		$strSQL = "SELECT intEventID
					FROM tblevent
						INNER JOIN tblflooreventxr
							USING (intEventID)
						WHERE strEventType = 'Standstill'
							AND intFloorID = " . $objDB->quote($this->_intFloorID) . "
							AND intEventID NOT IN
							(SELECT intEventID
								FROM tblcharactereventxr
									INNER JOIN tblevent
										USING (intEventID)
									WHERE intRPGCharacterID = " . $objDB->quote($intRPGCharacterID) . "
										AND blnRepeating = 0)";
		$rsResult = $objDB->query($strSQL);
		$arrRow = $rsResult->fetch(PDO::FETCH_ASSOC);
		$objEvent = new RPGEvent($arrRow['intEventID'], $intRPGCharacterID);
		return $objEvent;
	}
	
	public function getFloorID(){
		return $this->_intFloorID;
	}
	
	public function setFloorID($intFloorID){
		$this->_intFloorID = $intFloorID;
	}
	
	public function getFloorName(){
		return $this->_strFloorName;
	}
	
	public function setFloorName($strFloorName){
		$this->_strFloorName = $strFloorName;
	}
	
	public function getMaze(){
		return $this->_objMaze;
	}
	
	public function setMaze($objMaze){
		$this->_objMaze = $objMaze;
	}
	
	public function getFloorType(){
		return $this->_strFloorType;
	}
	
	public function setFloorType($strFloorType){
		$this->_strFloorType = $strFloorType;
	}
	
	public function getDimension(){
		return $this->_intDimension;
	}
	
	public function setDimension($intDimension){
		$this->_intDimension = $intDimension;
	}
	
	public function getCreatedOn(){
		return $this->_dtmCreatedOn;
	}
	
	public function setCreatedOn($dtmCreatedOn){
		$this->_dtmCreatedOn = $dtmCreatedOn;
	}
	
	public function getCreatedBy(){
		return $this->_strCreatedBy;
	}
	
	public function setCreatedBy($strCreatedBy){
		$this->_strCreatedBy = $strCreatedBy;
	}
	
	public function getModifiedOn(){
		return $this->_dtmModifiedOn;
	}
	
	public function setModifiedOn($dtmModifiedOn){
		$this->_dtmModifiedOn = $dtmModifiedOn;
	}
	
	public function getModifiedBy(){
		return $this->_strModifiedBy;
	}
	
	public function setModifiedBy($strModifiedBy){
		$this->_strModifiedBy = $strModifiedBy;
	}
}

?>