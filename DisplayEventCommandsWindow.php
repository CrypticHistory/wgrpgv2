<?php

class DisplayEventCommandsWindow{

	public function __construct(){
		
	}
	
	public static function toHTML(){
		ob_start(); ?>
		
			<div class='commandsDiv' id='commandsDivEventCommands'>
				<form method='post' action='command.php'>
					<?php
					$objEvent = $_SESSION['objRPGCharacter']->getEvent();
					$objXML = new RPGXMLReader($objEvent->getXML());
					$intCounter = 0;
					foreach($objXML->getCommandList($objEvent->getEventNodeID()) as $key => $value){
						if(($objXML->hasCommandPrecondition($objEvent->getEventNodeID(), $intCounter) == true && DialogConditionFactory::evaluateCondition($objXML->getCommandPrecondition($objEvent->getEventNodeID(), $intCounter)) == true)
						|| $objXML->hasCommandPrecondition($objEvent->getEventNodeID(), $intCounter) == false){
							if($objXML->hasCommandAction($objEvent->getEventNodeID(), $intCounter) == true){
								echo "<input type='hidden' name='commandIndex" . $objXML->getCommandID($objEvent->getEventNodeID(), $intCounter) . "' value='" . $intCounter . "'/>";
							}
							echo "<button type='submit' name='command' value='" . $objXML->getCommandID($objEvent->getEventNodeID(), $intCounter) . "'>" . $value . "</button>";
							if(strlen($value) > 15){
								echo "<br/>";
							}
						}
						$intCounter++;
					}
					?>
				</form>
			</div>
		
		<?php
		$strHTML = ob_get_contents();
		ob_end_clean();
		
		echo $strHTML;
	}

}

?>