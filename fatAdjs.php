<?php

function getFatAdj($intBMI, $a){
	if($intBMI < 5){
		$strReturn = 'skeletal';
	}
	else if($intBMI < 10){
		$strReturn = 'emaciated';
	}
	else if($intBMI < 15){
		$strReturn = 'underweight';
	}
	else if($intBMI < 20){
		$strReturn = 'skinny';
	}
	else if($intBMI < 22){
		$strReturn = 'thin';
	}
	else if($intBMI < 24){
		$strReturn = 'average';
	}
	else if($intBMI < 26){
		$strReturn = 'thick';
	}
	else if($intBMI < 28){
		$strReturn = 'overweight';
	}
	else if($intBMI < 30){
		$strReturn = 'chubby';
	}
	else if($intBMI < 32){
		$strReturn = 'plump';
	}
	else if($intBMI < 34){
		$strReturn = 'heavy';
	}
	else if($intBMI < 36){
		$strReturn = 'fat';
	}
	else if($intBMI < 38){
		$strReturn = 'chunky';
	}
	else if($intBMI < 40){
		$strReturn = 'obese';
	}
	else if($intBMI < 50){
		$strReturn = 'rotund';
	}
	else if($intBMI < 60){
		$strReturn = 'corpulent';
	}
	else if($intBMI < 70){
		$strReturn = 'hefty';
	}
	else if($intBMI < 80){
		$strReturn = 'excessively fleshy';
	}
	else if($intBMI < 100){
		$strReturn = 'blubbery'; 
	}
	else if($intBMI < 120){
		$strReturn = 'oversized';
	}
	else if($intBMI < 150){
		$strReturn = 'whalelike';
	}
	else if($intBMI < 200){
		$strReturn = 'gargantuan';
	}
	else{
		$strReturn = 'bloblike';
	}
	return ($a == true) ? preg_replace('/\b(a)\s+([aeiou])/i', '$1n $2', 'a ' . $strReturn) : $strReturn;
}

function getStareDownText($intBMI){
	if($intBMI < 25){
		return 'You peer down at your thin figure.';
	}
	else if($intBMI < 28){
		return 'As you peer down at your body, you feel your neck fold into a slight double chin.';
	}
	else if($intBMI < 35){
		return 'As you peer down at your body, you feel your neck fold into a double chin. Running your fingers along your neck, you confirm that this is indeed the case.';
	}
	else if($intBMI < 45){
		return 'As you peer down at your body, you feel your neck fold into a prominent double chin. Running your thick fingers along your neck, you confirm that you are indeed showcasing an undeniable double chin.' ;
	}
	else if($intBMI < 60){
		return 'As you peer down at your body, you feel your neck fold into a double, possibly a triple chin. Running your swollen fingers along your neck blubber, you do feel a slight third chin forming.';
	}
	else if($intBMI < 80){
		return 'As you peer down at your body, you feel your neck fold into several rolls. Running your puffy fingers along your neck blubber, you count three distinct rolls.';
	}
	else if($intBMI > 79){
		return 'As you peer down at your body, you feel your neck fold into multiple rolls. Your sausage-like fingers graze over three, possibly four rolls before hitting the soft indent of your collarbone.';
	}
}

function getBellyText($intBMI){
	if($intBMI < 25){
		return 'It shouldn\'t be too difficult finding clothes to fit your thin figure.';
	}
	else if($intBMI < 30){
		return 'Your perky breasts and chubby tummy are on display. You may want to cover up.';
	}
	else if($intBMI < 35){
		return 'Your full bust and plump belly are on display. You may want to cover up.';
	}
	else if($intBMI < 40){
		return 'Your voluptuous breasts and swollen belly are on display. You may want to cover up.';
	}
	else if($intBMI < 50){
		return 'Your sagging breasts and belly are on display. You may want to cover up.';
	}
	else if($intBMI < 60){
		return 'Your massive breasts and multiple belly rolls are on display. You may want to cover up.';
	}
	else if($intBMI < 70){
		return 'Your blubbery breasts and belly rolls are on display. You may want to cover up.';
	}
	else if($intBMI < 80){
		return 'Your gigantic breasts and belly rolls are on display. You may want to cover up.';
	}
	else if($intBMI < 100){
		return 'Your oversized breasts and belly rolls are on display. You may want to cover up.';
	}
		else if($intBMI < 300){
		return 'Your bloblike breasts and belly rolls are on display. You may want to cover up.';
	}
}

function getFPEquipmentText($strItemName){
	if($strItemName == ''){
		return 'You are not wielding any weapon.';
	}
	else{
		return 'You are wielding a ' . $strItemName . ' as a weapon.';
	}
}

?>