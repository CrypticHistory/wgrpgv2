<?php

class DialogConditionFactory {

	public static function evaluateCondition($strCondition){
		
		// determine which entity we evaluate the condition on
		if(strpos($strCondition, 'Enemy') !== false){
			$strSession = 'objEnemy';
		}
		else if(strpos($strCondition, 'Relationship') !== false){
			$strSession = 'objRelationship';
		}
		else{
			$strSession = 'objRPGCharacter';
		}
		
		// if this is a stat roll condition
		if(preg_match_all('/{(.*?)}/', $strCondition, $matches)){
			// failure/success of previous roll
			if($matches[1][0] == "LastRollFailed"){
				if($_SESSION[$strSession]->getLastRoll() == 0){
					$blnReturn = true;
				}
				else{
					$blnReturn = false;
				}
			}
			else if($matches[1][0] == "LastRollSucceeded"){
				if($_SESSION[$strSession]->getLastRoll() == 1){
					$blnReturn = true;
				}
				else{
					$blnReturn = false;
				}
			}
			else if($matches[1][0] == "5050Roll"){
				
				// if roll for this stat already exists in current dialog node
				if($_SESSION['objRPGCharacter']->getEvent()->getRolls("FiftyFifty") != 0){
					$intStatRoll = $_SESSION['objRPGCharacter']->getEvent()->getRolls("FiftyFifty");
				}
				else{
					$intStatRoll = mt_rand(0, 1);
					$_SESSION['objRPGCharacter']->getEvent()->setRolls("FiftyFifty", $intStatRoll);
				}

				$_SESSION[$strSession]->setLastRoll($intStatRoll);
				$blnReturn = $intStatRoll;
				
			}
			else{
				foreach($matches[1] as $key => $value){
					$strSplit = explode("~", $value);
					$strStatName = $strSplit[0];
					$intStatValue = $strSplit[1];
					$strQueryFunction = "getModified" . $strStatName;
					$intCharacterStatValue = $_SESSION[$strSession]->$strQueryFunction();
					
					// if roll for this stat already exists in current dialog node
					if($_SESSION['objRPGCharacter']->getEvent()->getRolls($strStatName) != 0){
						$intStatRoll = $_SESSION['objRPGCharacter']->getEvent()->getRolls($strStatName);
					}
					else{
						$intStatRoll = mt_rand(1, $intStatValue);
						$_SESSION['objRPGCharacter']->getEvent()->setRolls($strStatName, $intStatRoll);
					}
					
					if($intCharacterStatValue >= $intStatRoll){
						$blnReturn = true;
						$_SESSION[$strSession]->setLastRoll(1);
					}
					else{
						$blnReturn = false;
						$_SESSION[$strSession]->setLastRoll(0);
						break;
					}
				}
			}
			return $blnReturn;
		}
		
		// recursion for multiple conditions
		if(strpos($strCondition, '&')){
			$strSplit = explode('&', $strCondition);
			$intSplitCount = count($strSplit);
			$blnValue = array();
			for($i = 0; $i < $intSplitCount; $i++){
				$blnValue[$i] = self::evaluateCondition($strSplit[$i]);
				if($blnValue[$i] == false){
					return false;
				}
			}
			return true;
		}
		else{
			// this is a function that takes in an argument
			if(strpos($strCondition, '~')){
				if(strpos($strCondition, '>=')){
					$variable = explode('>=', $strCondition);
					$long_function = $variable[0];
					$args = explode("~", $long_function);
					$function = $args[0];
					return (intval($_SESSION[$strSession]->$function($args[1], (isset($args[2]) ? $args[2] : null), (isset($args[3]) ? $args[3] : null), (isset($args[4]) ? $args[4] : null), (isset($args[5]) ? $args[5] : null), (isset($args[6]) ? $args[6] : null))) >= intval($variable[1]));
				}
				else if(strpos($strCondition, '<=')){
					$variable = explode('<=', $strCondition);
					$long_function = $variable[0];
					$args = explode("~", $long_function);
					$function = $args[0];
					return (intval($_SESSION[$strSession]->$function($args[1], (isset($args[2]) ? $args[2] : null), (isset($args[3]) ? $args[3] : null), (isset($args[4]) ? $args[4] : null), (isset($args[5]) ? $args[5] : null), (isset($args[6]) ? $args[6] : null))) <= intval($variable[1]));
				}
				else if(strpos($strCondition, '>')){
					$variable = explode('>', $strCondition);
					$long_function = $variable[0];
					$args = explode("~", $long_function);
					$function = $args[0];
					return (intval($_SESSION[$strSession]->$function($args[1], (isset($args[2]) ? $args[2] : null), (isset($args[3]) ? $args[3] : null), (isset($args[4]) ? $args[4] : null), (isset($args[5]) ? $args[5] : null), (isset($args[6]) ? $args[6] : null))) > intval($variable[1]));
				}
				else if(strpos($strCondition, '<')){
					$variable = explode('<', $strCondition);
					$long_function = $variable[0];
					$args = explode("~", $long_function);
					$function = $args[0];
					return (intval($_SESSION[$strSession]->$function($args[1], (isset($args[2]) ? $args[2] : null), (isset($args[3]) ? $args[3] : null), (isset($args[4]) ? $args[4] : null), (isset($args[5]) ? $args[5] : null), (isset($args[6]) ? $args[6] : null))) < intval($variable[1]));
				}
				else if(strpos($strCondition, '=')){
					$variable = explode('=', $strCondition);
					$long_function = $variable[0];
					$args = explode("~", $long_function);
					$function = $args[0];
					return (intval($_SESSION[$strSession]->$function($args[1], (isset($args[2]) ? $args[2] : null), (isset($args[3]) ? $args[3] : null), (isset($args[4]) ? $args[4] : null), (isset($args[5]) ? $args[5] : null), (isset($args[6]) ? $args[6] : null))) == intval($variable[1]));
				}
			}
			else{
				if(strpos($strCondition, '>=')){
					$variable = explode('>=', $strCondition);
					$function = 'get' . $variable[0];
					return (intval($_SESSION[$strSession]->$function()) >= intval($variable[1]));
				}
				else if(strpos($strCondition, '<=')){
					$variable = explode('<=', $strCondition);
					$function = 'get' . $variable[0];
					return (intval($_SESSION[$strSession]->$function()) <= intval($variable[1]));
				}
				else if(strpos($strCondition, '>')){
					$variable = explode('>', $strCondition);
					$function = 'get' . $variable[0];
					return (intval($_SESSION[$strSession]->$function()) > intval($variable[1]));
				}
				else if(strpos($strCondition, '<')){
					$variable = explode('<', $strCondition);
					$function = 'get' . $variable[0];
					return (intval($_SESSION[$strSession]->$function()) < intval($variable[1]));
				}
				else if(strpos($strCondition, '=')){
					$variable = explode('=', $strCondition);
					$function = 'get' . $variable[0];
					return ($_SESSION[$strSession]->$function() == $variable[1]);
				}
			}
		}
	}
	
	public static function evaluateAction($strAction){
		
		// determine which entity to evaluate the action on
		if(strpos($strAction, 'Enemy') !== false){
			$strSession = 'objEnemy';
		}
		else if(strpos($strAction, 'Relationship') !== false){
			$strSession = 'objRelationship';
		}
		else{
			$strSession = 'objRPGCharacter';
		}
		
		// recursion for multiple actions
		if(strpos($strAction, '&')){
			$strSplit = explode('&', $strAction);
			$intSplitCount = count($strSplit);
			for($i = 0; $i < $intSplitCount; $i++){
				self::evaluateAction($strSplit[$i]);
			}
		}
		else{
			if(strpos($strAction, '+')){
				$variable = explode('+', $strAction);
				$setFunction = 'set' . $variable[0];
				$getFunction = 'get' . $variable[0];
				$_SESSION[$strSession]->$setFunction(intval($_SESSION[$strSession]->$getFunction()) + intval($variable[1]));
			}
			else if(strpos($strAction, '-')){
				$variable = explode('-', $strAction);
				$setFunction = 'set' . $variable[0];
				$getFunction = 'get' . $variable[0];
				$_SESSION[$strSession]->$setFunction(intval($_SESSION[$strSession]->$getFunction()) - intval($variable[1]));
			}
			else if(strpos($strAction, '*')){
				$variable = explode('*', $strAction);
				$setFunction = 'set' . $variable[0];
				$getFunction = 'get' . $variable[0];
				$_SESSION[$strSession]->$setFunction(floatval($variable[1]) * floatval($_SESSION[$strSession]->$getFunction()));
			}
			else if(strpos($strAction, '~')){
				$function = explode('~', $strAction);
				$function1 = $function[0];
				if(!isset($function[1])){
					$_SESSION[$strSession]->$function[0]();
				}
				else{
					$_SESSION[$strSession]->$function1($function[1], (isset($function[2]) ? $function[2] : null), (isset($function[3]) ? $function[3] : null), (isset($function[4]) ? $function[4] : null), (isset($function[5]) ? $function[5] : null));
				}
			}
		}
	}
}

?>