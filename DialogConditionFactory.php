<?php

class DialogConditionFactory {

	public static function evaluateCondition($strCondition){
		if(strpos($strCondition, 'Enemy') !== false){
			$strSession = 'objEnemy';
		}
		else{
			$strSession = 'objRPGCharacter';
		}
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
	
	public static function evaluateAction($strAction){
		if(strpos($strAction, 'Enemy') !== false){
			$strSession = 'objEnemy';
		}
		else{
			$strSession = 'objRPGCharacter';
		}
		if(strpos($strAction, '+')){
			$variable = explode('+', $strAction);
			$setFunction = 'set' . $variable[0];
			$getFunction = 'get' . $variable[0];
			$_SESSION[$strSession]->$setFunction(intval($_SESSION[$strSession]->$getFunction()) + intval($variable[1]));
		}
		else if(strpos($strAction, '-')){
			$variable = explode('-', $strAction);
			$setfunction = 'set' . $variable[0];
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
			if(!isset($function[1])){
				$_SESSION[$strSession]->$function[0]();
			}
			else{
				$_SESSION[$strSession]->$function[0]($function[1], (isset($function[2]) ? $function[2] : null), (isset($function[3]) ? $function[3] : null), (isset($function[4]) ? $function[4] : null));
			}
		}
	}
}

?>