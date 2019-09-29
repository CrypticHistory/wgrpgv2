<?php

	include_once "RPGPlayerTeam.php";

	class RPGEnemyTeam extends RPGPlayerTeam{
	
		public function __construct($objLeader = null, $objEnemyOne = null, $objEnemyTwo = null){
			parent::__construct($objLeader, $objEnemyOne, $objEnemyTwo);
		}
		
		public function getLeader(){
			return parent::getPlayer();
		}
		
		public function setLeader($objLeader){
			parent::setPlayer($objLeader);
		}
		
		public function getEnemyOne(){
			return parent::getPartyOne();
		}
		
		public function setEnemyOne($objEnemyOne){
			parent::setPartyOne($objEnemyOne);
		}
		
		public function getEnemyTwo(){
			return parent::getPartyTwo();
		}
		
		public function setEnemyTwo($objEnemyTwo){
			parent::setPartyTwo($objEnemyTwo);
		}
		
		public function loadActiveSkillList(){
			parent::getPlayer()->loadActiveSkillList();
			if(parent::getPartyOne() != null){
				parent::getPartyOne()->loadActiveSkillList();
			}
			if(parent::getPartyTwo() != null){
				parent::getPartyTwo()->loadActiveSkillList();
			}
		}
		
		public function getExperienceGiven(){
			$intExperience = parent::getPlayer()->getExperienceGiven();
			$dblExperienceModifier = 1;
			if(parent::getPartyOne() != null){
				$intExperience += parent::getPartyOne()->getExperienceGiven();
				$dblExperienceModifier = 1.1;
			}
			if(parent::getPartyTwo() != null){
				$intExperience += parent::getPartyTwo()->getExperienceGiven();
				$dblExperienceModifier = 1.2;
			}
			return round($intExperience * $dblExperienceModifier);
		}
		
		public function getGoldDropMax(){
			$intGoldDropMax = parent::getPlayer()->getGoldDropMax();
			$dblGoldModifier = 1;
			if(parent::getPartyOne() != null){
				$intGoldDropMax += parent::getPartyOne()->getGoldDropMax();
				$dblGoldModifier = 1.1;
			}
			if(parent::getPartyTwo() != null){
				$intGoldDropMax += parent::getPartyTwo()->getGoldDropMax();
				$dblGoldModifier = 1.2;
			}
			return round($intGoldDropMax * $dblGoldModifier);
		}
		
		public function getGoldDropMin(){
			$intGoldDropMin = parent::getPlayer()->getGoldDropMin();
			$dblGoldModifier = 1;
			if(parent::getPartyOne() != null){
				$intGoldDropMin += parent::getPartyOne()->getGoldDropMin();
				$dblGoldModifier = 1.1;
			}
			if(parent::getPartyTwo() != null){
				$intGoldDropMin += parent::getPartyTwo()->getGoldDropMin();
				$dblGoldModifier = 1.2;
			}
			return round($intGoldDropMin * $dblGoldModifier);
		}
		
		public function getRandomDrops(){
			$arrReturn = array();
			$arrReturn = $arrReturn + parent::getPlayer()->getRandomDrops();
			if(parent::getPartyOne() != null){
				$arrReturn = $arrReturn + parent::getPartyOne()->getRandomDrops();
			}
			if(parent::getPartyTwo() != null){
				$arrReturn = $arrReturn + parent::getPartyTwo()->getRandomDrops();
			}
			return $arrReturn;
		}
	
	}

?>