<?php

class RPGOutfitReader {

	private $_objXML;
	
	public function RPGOutfitReader($strXMLFileName){
		$this->_objXML = simplexml_load_file('XML/Outfits/' . $strXMLFileName);
	}
	
	public function getAppearanceText($intNodeID){
		return $this->_objXML->appearanceList->appearance[$intNodeID]->text;
	}
	
	public function getAppearanceMinBMI($intNodeID){
		return $this->_objXML->appearanceList->appearance[$intNodeID]->minBMI;
	}
	
	public function getAppearanceMaxBMI($intNodeID){
		return $this->_objXML->appearanceList->appearance[$intNodeID]->maxBMI;
	}
	
	public function getResponseText($intNodeID){
		return $this->_objXML->responseList->response[$intNodeID]->text;
	}
	
	public function getResponseBMI($intNodeID){
		return $this->_objXML->responseList->response[$intNodeID]->bmi;
	}
	
	public function getEquipText($intNodeID){
		return $this->_objXML->equipList->equip[$intNodeID]->text;
	}
	
	public function getEquipMaxBMI($intNodeID){
		return $this->_objXML->equipList->equip[$intNodeID]->maxBMI;
	}
	
	public function getEquipMinBMI($intNodeID){
		return $this->_objXML->equipList->equip[$intNodeID]->minBMI;
	}
	
	public function findNodeList($strNodeType){
		return $this->_objXML->xpath("//" . $strNodeType);
	}
	
	public function findNodeBetweenBMI($strNodeType, $intBMI){
		return $this->_objXML->xpath("//" . $strNodeType . "[maxBMI>=$intBMI][minBMI<=$intBMI]");
	}
	
	public function findNodeAtBMI($strNodeType, $intBMI){
		return $this->_objXML->xpath("//" . $strNodeType . "[BMI=$intBMI]");
	}
}

?>