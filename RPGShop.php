<?php

require_once "Database.php";
include_once "RPGItem.php";

class RPGShop{

	private $_intShopID;
	private $_strShopName;
	private $_txtShopDesc;
	private $_strShopType;
	private $_arrShopInv;
	
	public function __construct($intShopID = null){
		if($intShopID != null){
			$this->loadShopInfo($intShopID);
		}
	}
	
	private function populateVarFromRow($arrShopInfo){
		$this->setShopID($arrShopInfo['intShopID']);
		$this->setShopName($arrShopInfo['strShopName']);
		$this->setShopDesc($arrShopInfo['txtShopDesc']);
		$this->setShopType($arrShopInfo['strShopType']);
	}
	
	private function loadShopInfo($intShopID){
		$objDB = new Database();
		$arrShopInfo = array();
			$strSQL = "SELECT *
						FROM tblshop
							WHERE intShopID = " . $objDB->quote($intShopID);
			$rsResult = $objDB->query($strSQL);
			while ($arrRow = $rsResult->fetch(PDO::FETCH_ASSOC)){
				$arrShopInfo['intShopID'] = $arrRow['intShopID'];
				$arrShopInfo['strShopName'] = $arrRow['strShopName'];
				$arrShopInfo['txtShopDesc'] = $arrRow['txtShopDesc'];
				$arrShopInfo['strShopType'] = $arrRow['strShopType'];
			}
		$this->populateVarFromRow($arrShopInfo);
		$this->loadShopInventory();
	}
	
	private function loadShopInventory(){
		$objDB = new Database();
		$strSQL = "SELECT intItemID, dblPrice FROM tblshopitemxr
					WHERE intShopID = " . $objDB->quote($this->_intShopID) . "
						ORDER BY dblPrice ASC";
		$rsResult = $objDB->query($strSQL);
		while ($arrRow = $rsResult->fetch(PDO::FETCH_ASSOC)){
			$this->_arrShopInv[$arrRow['intItemID']]['objItem'] = new RPGItem($arrRow['intItemID']);
			$this->_arrShopInv[$arrRow['intItemID']]['dblPrice'] = $arrRow['dblPrice'];
		}
	}
	
	public function getLinkName($intLocationID){
		$objDB = new Database();
		$strSQL = "SELECT strLinkName
					FROM tbllocationshoplink
						WHERE intLocationID = " . $objDB->quote($intLocationID) . "
							AND intShopID = " . $objDB->quote($this->_intShopID);
		$rsResult = $objDB->query($strSQL);
		$arrRow = $rsResult->fetch(PDO::FETCH_ASSOC);
		return $arrRow['strLinkName'];
	}
	
	public function hasItem($intItemID){
		if(!empty($this->_arrShopInv[$intItemID])){
			return true;
		}
		else{
			return false;
		}
	}
	
	public function getItemPrice($intItemID){
		return $this->_arrShopInv[$intItemID]['dblPrice'];
	}
	
	public function getShopID(){
		return $this->_intShopID;
	}
	
	public function setShopID($intShopID){
		$this->_intShopID = $intShopID;
	}
	
	public function getShopName(){
		return $this->_strShopName;
	}
	
	public function setShopName($strShopName){
		$this->_strShopName = $strShopName;
	}
	
	public function getShopDesc(){
		return $this->_txtShopDesc;
	}
	
	public function setShopDesc($txtShopDesc){
		$this->_txtShopDesc = $txtShopDesc;
	}
	
	public function getShopInv(){
		return $this->_arrShopInv;
	}
	
	public function setShopInv($arrShopInv){
		$this->_arrShopInv = $arrShopInv;
	}
	
	public function getShopType(){
		return $this->_strShopType;
	}
	
	public function setShopType($strShopType){
		$this->_strShopType = $strShopType;
	}
}

?>