<?php

	include_once "Database.php";

	function get_enum_values( $table, $field ){
		$objDB = new Database();
		$rsResult = $objDB->query( "SHOW COLUMNS FROM {$table} WHERE Field = '{$field}'" );
		$arrRow = $rsResult->fetch(PDO::FETCH_ASSOC);
		$regex = "/'(.*?)'/";
		preg_match_all($regex, $arrRow['Type'], $enum_array);
		return $enum_array[1];
	}
	
	function getHeightInCM($intFeet, $intInches){
		$intActualFeet = $intFeet + ($intInches / intFEET_PER_INCH);
		$intCMs = $intActualFeet * dblCM_PER_FOOT;
		return round($intCMs);
	}
	
	function getClosest($search, $arr) {
	   $closest = null;
	   foreach ($arr as $key => $val) {
		  if ($closest === null || abs($search - $closest) > abs($val - $search)) {
			 $closest = $val;
		  }
	   }
	   return $closest;
	}

?>