<?php

class RPGTime {

	public static function addTickToTime($strTime){
		$arrTime = explode(':', $strTime);
		if($arrTime[1] == '45'){
			$arrTime[1] = '00';
			if($arrTime[0] == '23'){
				$arrTime[0] = '00';
				self::incrementDay();
			}
			else{
				$arrTime[0] = strval(intval($arrTime[0]) + 1);
			}
		}
		else{
			$arrTime[1] = strval(intval($arrTime[1]) + 15);
		}
		return implode(':', $arrTime);
	}
	
	public static function addHoursToTime($strTime, $intHours){
		$arrTime = explode(':', $strTime);
		if(($arrTime[0] + $intHours) > 23){
			$arrTime[0] = ($arrTime[0] + $intHours) % 24;
			self::incrementDay();
		}
		else{
			$arrTime[0] = $arrTime[0] + $intHours;
		}
		return implode(':', $arrTime);
	}
	
	public static function incrementDay(){
		$_SESSION['objRPGCharacter']->setDay(intval($_SESSION['objRPGCharacter']->getDay()) + 1);
	}
	
}

?>