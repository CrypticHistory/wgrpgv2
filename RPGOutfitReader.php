<?php

class RPGOutfitReader {

	private $_objXML;
	
	public function RPGOutfitReader($strXMLFileName){
		$this->_objXML = simplexml_load_file('XML/Outfits/' . $strXMLFileName);
	}
	
	public function findNodeBetweenBMI($strNodeType, $intBMI){
		return $this->_objXML->xpath("//" . $strNodeType . "[maxBMI>=$intBMI][minBMI<=$intBMI]");
	}
	
	public function findNodeAtBMI($strNodeType, $intBMI){
		return $this->_objXML->xpath("//" . $strNodeType . "[BMI=$intBMI]");
	}
}

?>