<?php

class DisplayEventWindow{

	public function __construct(){
		
	}
	
	public static function toHTML(){
		ob_start(); ?>
		
			<div class='eventDiv' id='eventDivEventWindow'>
				<div class='spacedDiv'>
				<?php
				
				if($_SESSION['objRPGCharacter']->getErrorText() !== null){
					echo "<b>Error: " . $_SESSION['objRPGCharacter']->getErrorText() . "</b>";
					echo "<br/><br/>";
					$_SESSION['objRPGCharacter']->setErrorText(null);
				}
				else{
					if($_SESSION['objRPGCharacter']->getEquipClothingText() !== null){
						echo "<i>" . $_SESSION['objRPGCharacter']->getEquipClothingText() . "</i>";
						echo "<br/><br/>";
						$_SESSION['objRPGCharacter']->setEquipClothingText(null);
					}
					
					if($_SESSION['objRPGCharacter']->getHungerText() !== null){
						echo "<i>" . $_SESSION['objRPGCharacter']->getHungerText() . "</i>";
						echo "<br/><br/>";
						$_SESSION['objRPGCharacter']->setHungerText(null);
					}
					
					$intCounter = 0;
					$objEvent = $_SESSION['objRPGCharacter']->getEvent();
					
					$objXML = new RPGXMLReader($objEvent->getXML());
					foreach($objXML->getEventTextList($objEvent->getEventNodeID()) as $key => $value){
						if(($objXML->hasEventTextPrecondition($objEvent->getEventNodeID(), $intCounter) == true && DialogConditionFactory::evaluateCondition($objXML->getEventTextPrecondition($objEvent->getEventNodeID(), $intCounter)) == true)
							|| $objXML->hasEventTextPrecondition($objEvent->getEventNodeID(), $intCounter) == false){
							echo self::extractVariables(nl2br($value));
						}
						$intCounter++;
					}
					
					echo "<br/><br/>";
					
					echo "<i>" . $_SESSION['objRPGCharacter']->ripClothingCheck('Top') . "</i><br/>";
					echo "<i>" . $_SESSION['objRPGCharacter']->ripClothingCheck('Bottom') . "</i><br/>";
					echo "<i>" . $_SESSION['objRPGCharacter']->ripClothingCheck('Armour') . "</i>";
					
					if($objEvent->checkEndOfEvent()){
						unset($_SESSION['objEnemy']);
						unset($_SESSION['objRelationship']);
					}
				}
				
				?>
				</div>
			</div>
		
		<?php
		$strHTML = ob_get_contents();
		ob_end_clean();
		
		echo $strHTML;
	}
	
	public static function extractVariables($text){
		if(preg_match_all('/{(.*?)}/', $text, $matches)){
			foreach($matches[1] as $key => $value){
				if($value == "EventItem"){
					$text = str_replace($matches[0][$key], $_SESSION['objRPGCharacter']->getEvent()->getEventItem()->getItemName(), $text);
				}
				else{
					$text = str_replace($matches[0][$key], $_SESSION['objRPGCharacter']->$value(), $text);
				}
			}
		}
		return $text;
	}

}

?>