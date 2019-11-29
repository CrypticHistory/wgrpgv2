<?php

include_once 'DialogConditionFactory.php';
include_once 'RPGNPC.php';
include_once 'RPGRelationship.php';
include_once 'RPGTime.php';
include_once 'RPGCombat.php';
include_once 'RPGFloor.php';
include_once 'constants.php';

class DataGameUI{
	
	public function __construct(){
		$this->handleEvents();
		$this->handleTicks();
	}
	
	public function handleEvents(){
		global $arrStateNames;
		global $arrStateValues;
		
		// town events are accessed using the URL ($_GET)
		$this->handleTownEvents();
		$objEvent = $_SESSION['objRPGCharacter']->getEvent();
		$blnEndOfEvent = $objEvent->checkEndOfEvent();
		$objXML = new RPGXMLReader($objEvent->getXML());
		
		// check if event conditions satisfied
		if($_SESSION['objRPGCharacter']->getTownID() != 1 && $objXML && $objXML->getPrecondition()){
			
			$blnConditionsPassed = false;
			foreach($objXML->getPrecondition() as $key => $value){
				if (!DialogConditionFactory::evaluateCondition($value)){
					$blnConditionsPassed = false;
				}
				else{
					$blnConditionsPassed = true;
				}
			}
			
			// show standstill if conditions failed
			if(!$blnConditionsPassed){
				$objEvent = $_SESSION['objRPGCharacter']->getCurrentFloor()->getStandstill($_SESSION['objRPGCharacter']->getRPGCharacterID());
				$_SESSION['objRPGCharacter']->setEvent($objEvent);
				$blnEndOfEvent = true;
			}
			
		}
		
		// handle social link inside current event if one exists
		if(!$blnEndOfEvent && $objEvent->getNPCID() != null && $objEvent->getConversationLevel() != null){
			// first conversation with NPC
			if($objEvent->getConversationLevel() == 0 && !isset($_SESSION['objRelationship']) && !$objEvent->hasViewedEvent()){
				$_SESSION['objRelationship'] = new RPGRelationship($objEvent->getNPCID(), $_SESSION['objRPGCharacter']->getRPGCharacterID(), true);
			}
			else if(!isset($_SESSION['objRelationship'])){
				$_SESSION['objRelationship'] = new RPGRelationship($objEvent->getNPCID(), $_SESSION['objRPGCharacter']->getRPGCharacterID(), false);
			}
			
			// if this conversation level is too high, show standstill
			if($objEvent->getConversationLevel() != null && (($_SESSION['objRelationship']->getConversationLevel() != null && $objEvent->getConversationLevel() > $_SESSION['objRelationship']->getConversationLevel() + 1) || $_SESSION['objRelationship']->getConversationLevel() == null)){
				$objEvent = $_SESSION['objRPGCharacter']->getCurrentFloor()->getStandstill($_SESSION['objRPGCharacter']->getRPGCharacterID());
				$_SESSION['objRPGCharacter']->setEvent($objEvent);
				$blnEndOfEvent = true;
				unset($_SESSION['objRelationship']);
			}
		}
		
		// increment conversation level of social link within current event
		if($blnEndOfEvent && isset($_SESSION['objRelationship']) && $objEvent->getNPCID() != null && $objEvent->getConversationLevel() != null){
			// prevent incrementing convo level if the one in the event is less than your current (allows for revisiting convos)
			if($objEvent->getConversationLevel() > $_SESSION['objRelationship']->getConversationLevel()){
				$_SESSION['objRelationship']->incrementConversationLevel();
			}
			$_SESSION['objRelationship']->save();
			$_SESSION['objRPGCharacter']->setRelationship($_SESSION['objRelationship']);
		}
			
		// if initiated combat from an event
		if($_SESSION['objRPGCharacter']->getCombat()["EnemyTeam"] != null && !isset($_SESSION['objCombat'])){
			$_SESSION['objCombat'] = new RPGCombat($_SESSION['objRPGCharacter']->getParty(), $_SESSION['objRPGCharacter']->getCombat()["EnemyTeam"], $_SESSION['objRPGCharacter']->getCombat()["FirstTurn"]);
			$_SESSION['objCombat']->initiateCombat();
			$_SESSION['objRPGCharacter']->setStateID($arrStateValues['Combat']);
		}

		// enable/disable menus and such according to state we're in
		switch($arrStateNames[$_SESSION['objRPGCharacter']->getStateID()]){
			case "Tutorial":
				$_SESSION['objUISettings']->setDisableTraversal(true);
				$_SESSION['objUISettings']->setDisableInv(false);
				$_SESSION['objUISettings']->setDisableStats(true);
				$_SESSION['objUISettings']->setDisableSkills(true);
				$_SESSION['objUISettings']->setDisableParty(true);
				$_SESSION['objUISettings']->setEventFrame('Event');
				$_SESSION['objUISettings']->setCommandsFrame('Event');
				$_SESSION['objUISettings']->setNavigationFrame('Compass');
				break;
			case "Event":
				if((($objXML->getEventType() == "Forced Event") && !$blnEndOfEvent) || ($objEvent->getEventNodeID() != 0 && !$blnEndOfEvent)){
					$_SESSION['objUISettings']->setDisableTraversal(true);
					$_SESSION['objUISettings']->setDisableInv(true);
					$_SESSION['objUISettings']->setDisableStats(true);
					$_SESSION['objUISettings']->setDisableSkills(true);
					$_SESSION['objUISettings']->setDisableParty(true);
				}
				else{
					$_SESSION['objUISettings']->setDisableTraversal(false);
					$_SESSION['objUISettings']->setDisableInv(false);
					$_SESSION['objUISettings']->setDisableStats(false);
					$_SESSION['objUISettings']->setDisableSkills(false);
					$_SESSION['objUISettings']->setDisableParty(true);
				}
				$_SESSION['objUISettings']->setEventFrame('Event');
				if($blnEndOfEvent && $_SESSION['objRPGCharacter']->getTownID() == 1){
					$_SESSION['objUISettings']->setCommandsFrame('Return');	
					$_SESSION['objUISettings']->setNavigationFrame('Menu');
					$_SESSION['objUISettings']->setDisableTraversal(true);
				}
				else if(!$blnEndOfEvent && $_SESSION['objRPGCharacter']->getTownID() == 1){
					$_SESSION['objUISettings']->setCommandsFrame('Event');	
					$_SESSION['objUISettings']->setNavigationFrame('Compass');
					$_SESSION['objUISettings']->setDisableTraversal(true);
				}
				else{
					$_SESSION['objUISettings']->setCommandsFrame('Event');	
					$_SESSION['objUISettings']->setNavigationFrame('Compass');
				}
				break;
			case "Combat":
				$_SESSION['objUISettings']->setDisableTraversal(true);
				$_SESSION['objUISettings']->setDisableInv(true);
				$_SESSION['objUISettings']->setDisableStats(true);
				$_SESSION['objUISettings']->setDisableSkills(true);
				$_SESSION['objUISettings']->setDisableParty(true);
				$_SESSION['objUISettings']->setEventFrame('Combat');
				$_SESSION['objUISettings']->setCommandsFrame('Combat');
				$_SESSION['objUISettings']->setNavigationFrame('Compass');
				break;
			case "Field":
				$_SESSION['objUISettings']->setDisableTraversal(false);
				$_SESSION['objUISettings']->setDisableInv(false);
				$_SESSION['objUISettings']->setDisableStats(false);
				$_SESSION['objUISettings']->setDisableSkills(false);
				$_SESSION['objUISettings']->setDisableParty(true);
				$_SESSION['objUISettings']->setEventFrame('Event');
				$_SESSION['objUISettings']->setCommandsFrame('Event');
				$_SESSION['objUISettings']->setNavigationFrame('Compass');
				break;
			case "Town":
				$_SESSION['objUISettings']->setDisableTraversal(false);
				$_SESSION['objUISettings']->setDisableInv(false);
				$_SESSION['objUISettings']->setDisableStats(false);
				$_SESSION['objUISettings']->setDisableSkills(false);
				$_SESSION['objUISettings']->setDisableParty(false);
				$_SESSION['objUISettings']->setEventFrame('Town');
				$_SESSION['objUISettings']->setCommandsFrame('Town');
				$_SESSION['objUISettings']->setNavigationFrame('Menu');
				break;
			case "Stats":
				$_SESSION['objUISettings']->setDisableTraversal(true);
				$_SESSION['objUISettings']->setDisableInv(true);
				$_SESSION['objUISettings']->setDisableStats(false);
				$_SESSION['objUISettings']->setDisableSkills(true);
				$_SESSION['objUISettings']->setDisableParty(true);
				$_SESSION['objUISettings']->setEventFrame('StatGain');
				$_SESSION['objUISettings']->setCommandsFrame('Return');
				$_SESSION['objUISettings']->setNavigationFrame('Compass');
				break;
			case "Shop":
				$_SESSION['objUISettings']->setDisableTraversal(false);
				$_SESSION['objUISettings']->setDisableInv(false);
				$_SESSION['objUISettings']->setDisableStats(false);
				$_SESSION['objUISettings']->setDisableSkills(false);
				$_SESSION['objUISettings']->setDisableParty(true);
				$_SESSION['objUISettings']->setEventFrame('Shop');
				$_SESSION['objUISettings']->setCommandsFrame('Return');
				$_SESSION['objUISettings']->setNavigationFrame('Menu');
				break;
			case "Skills":
				$_SESSION['objUISettings']->setDisableTraversal(true);
				$_SESSION['objUISettings']->setDisableInv(true);
				$_SESSION['objUISettings']->setDisableStats(true);
				$_SESSION['objUISettings']->setDisableSkills(false);
				$_SESSION['objUISettings']->setDisableParty(true);
				$_SESSION['objUISettings']->setEventFrame('SkillView');
				$_SESSION['objUISettings']->setCommandsFrame('Return');
				$_SESSION['objUISettings']->setNavigationFrame('Compass');
				break;
			case "Party":
				$_SESSION['objUISettings']->setDisableTraversal(true);
				$_SESSION['objUISettings']->setDisableInv(true);
				$_SESSION['objUISettings']->setDisableStats(true);
				$_SESSION['objUISettings']->setDisableSkills(true);
				$_SESSION['objUISettings']->setDisableParty(false);
				$_SESSION['objUISettings']->setEventFrame('PartyView');
				$_SESSION['objUISettings']->setCommandsFrame('Return');
				$_SESSION['objUISettings']->setNavigationFrame('Compass');
				break;
			default:
				$_SESSION['objRPGCharacter']->setStateID($arrStateValues['Tutorial']);
				$_SESSION['objUISettings']->setDisableTraversal(true);
				$_SESSION['objUISettings']->setDisableInv(false);
				$_SESSION['objUISettings']->setDisableStats(true);
				$_SESSION['objUISettings']->setDisableSkills(true);
				$_SESSION['objUISettings']->setDisableParty(true);
				$_SESSION['objUISettings']->setEventFrame('Event');
				$_SESSION['objUISettings']->setCommandsFrame('Event');
				$_SESSION['objUISettings']->setNavigationFrame('Compass');
				break;
		}	

	}
	
	public function handleTownEvents(){
		global $arrStateValues;
		
		if(isset($_GET['EnterFloorID'])){
			if($_SESSION['objRPGCharacter']->getFloor() >= $_GET['EnterFloorID'] && $_SESSION['objRPGCharacter']->getTownID() == 1){
				$_SESSION['objRPGCharacter']->enterFloor($_GET['EnterFloorID']);
				return;
			}
		}
		
		if($_SESSION['objRPGCharacter']->getTownID() == 1){
			// todo: verify with eventlinkxr or shoplinkxr that they are allowed to view the event/shop
			
			if(isset($_GET['LocationID'])){
				$_SESSION['objRPGCharacter']->setLocationID($_GET['LocationID']);
				$_SESSION['objRPGCharacter']->setStateID($arrStateValues['Town']);
			}
			
			if(isset($_GET['EventID'])){
				$objEvent = new RPGEvent($_GET['EventID'], $_SESSION['objRPGCharacter']->getRPGCharacterID());
				$_SESSION['objRPGCharacter']->setEvent($objEvent);
				$objXML = new RPGXMLReader($objEvent->getXML());
				
				$blnConditionsPassed = false;
				foreach($objXML->getPrecondition() as $key => $value){
					if (!DialogConditionFactory::evaluateCondition($value)){
						$blnConditionsPassed = false;
					}
					else{
						$blnConditionsPassed = true;
					}
				}
				
				if($blnConditionsPassed){
					$_SESSION['objRPGCharacter']->setEvent($objEvent);
					$_SESSION['objRPGCharacter']->setStateID($arrStateValues['Event']);
				}
				else{
					// Turici
					$_SESSION['objRPGCharacter']->setTownID(1);
					// Town State
					$_SESSION['objRPGCharacter']->setStateID(4);
					// Home Location
					$_SESSION['objRPGCharacter']->setLocationID(6);
					// Set default event
					$objEvent = new RPGEvent(1, $_SESSION['objRPGCharacter']->getRPGCharacterID());
					$_SESSION['objRPGCharacter']->setEvent($objEvent);
				}
			}
			else if(isset($_GET['ShopID'])){
				$_SESSION['objRPGCharacter']->setStateID($arrStateValues['Shop']);
			}
			
			
		}
	}
	
	public function handleTicks(){
		$_SESSION['objRPGCharacter']->setTime(RPGTime::addTickToTime($_SESSION['objRPGCharacter']->getTime()));
		$_SESSION['objRPGCharacter']->digestItems();
		$_SESSION['objRPGCharacter']->tickStatusEffects();
		$_SESSION['objRPGCharacter']->tickHunger();

		// immobility debuff
		if($_SESSION['objRPGCharacter']->getImmobilityFactor() > 0.04 && !isset($_SESSION['objUISettings']->getOverrides()[4])){
			$_SESSION['objRPGCharacter']->addToStatusEffects('Burdened by Weight');
		}
		else if($_SESSION['objRPGCharacter']->getImmobilityFactor() < 0.04 && isset($_SESSION['objUISettings']->getOverrides()[4])){
			$_SESSION['objRPGCharacter']->removeFromStatusEffects('Burdened by Weight');		
		}
		$_SESSION['objRPGCharacter']->save();
		
		foreach($_SESSION['objRPGCharacter']->getPartyMembers()->getActivePartyMembers() as $strPartyObj => $objNPC){
			$objNPC->tickHunger();
			$objNPC->save();
		}
	}	
}

?>