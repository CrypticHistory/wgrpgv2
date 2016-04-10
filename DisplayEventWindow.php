<?php

class DisplayEventWindow{

	public function DisplayEventWindow(){
		
	}
	
	public static function toHTML(){
		ob_start(); ?>
		
			<div class='eventDiv' id='eventDivEventWindow'>
				<?php
				
				if($_SESSION['objRPGCharacter']->getEquipClothingText() !== null){
					echo "<i>" . $_SESSION['objRPGCharacter']->getEquipClothingText() . "</i>";
					echo "<br/><br/>";
					$_SESSION['objRPGCharacter']->setEquipClothingText(null);
				}
				
				$intCounter = 0;
				$objEvent = new RPGEvent($_SESSION['objRPGCharacter']->getEventID());
				$objXML = new RPGXMLReader($objEvent->getXML());
				foreach($objXML->getEventTextList($_SESSION['objRPGCharacter']->getEventNodeID()) as $key => $value){
					if(($objXML->hasEventTextPrecondition($_SESSION['objRPGCharacter']->getEventNodeID(), $intCounter) == true && DialogConditionFactory::evaluateCondition($objXML->getEventTextPrecondition($_SESSION['objRPGCharacter']->getEventNodeID(), $intCounter)) == true)
						|| $objXML->hasEventTextPrecondition($_SESSION['objRPGCharacter']->getEventNodeID(), $intCounter) == false){
						echo self::extractVariables(nl2br($value));
					}
					$intCounter++;
				}
				
				echo "<br/><br/>";
				
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