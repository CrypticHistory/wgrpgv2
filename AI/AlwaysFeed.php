<?php

class AlwaysFeed{
	
	private $_objNPC;
	
	public function AlwaysFeed($objNPC){
		$this->_objNPC = $objNPC;
	}
	
	public function determineAction(){
		// todo: multiple feed skills?
		$arrSkills = $this->_objNPC->getSkillList('Feed');
		$objSkill = $arrSkills[0];
		$strClassName = $objSkill->getClassName();
		
		return "Skill" . $strClassName;
	}
}

?>