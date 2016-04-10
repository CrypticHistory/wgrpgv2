<?php

include_once "RPGLocation.php";

class DisplayTownWindow{

	public function DisplayTownWindow(){
		
	}
	
	public static function toHTML(){
		ob_start(); ?>
		
			<div class='eventDiv' id='eventDivTownWindow'>
				<?php
	
				if($_SESSION['objRPGCharacter']->getEquipClothingText() !== null){
					echo "<i>" . $_SESSION['objRPGCharacter']->getEquipClothingText() . "</i>";
					echo "<br/><br/>";
					$_SESSION['objRPGCharacter']->setEquipClothingText(null);
				}
				
				$objLocation = new RPGLocation($_SESSION['objRPGCharacter']->getLocationID());
				
				echo $objLocation->getDescription() . "<br/><br/>";
				
				echo "<i>" . $_SESSION['objRPGCharacter']->ripClothingCheck('Top') . "</i><br/>";
				echo "<i>" . $_SESSION['objRPGCharacter']->ripClothingCheck('Bottom') . "</i><br/>";
				echo "<i>" . $_SESSION['objRPGCharacter']->ripClothingCheck('Armour') . "</i>";
					
				?>
			</div>
		
		<?php
		$strHTML = ob_get_contents();
		ob_end_clean();
		
		echo $strHTML;
	}
	
	public static function extractVariables($text){
		if(preg_match_all('/{(.*?)}/', $text, $matches)){
			foreach($matches[1] as $key => $value){
				$text = str_replace($matches[0][$key], $_SESSION['objRPGCharacter']->$value(), $text);
			}
		}
		return $text;
	}

}

?>