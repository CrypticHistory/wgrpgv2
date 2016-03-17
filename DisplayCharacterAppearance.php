<?php

include_once 'fatAdjs.php';

class DisplayCharacterAppearance{

	public function DisplayCharacterAppearance(){
		
	}
	
	public static function toHTML(){
		ob_start(); ?>
		
			<div class='characterDiv hidden' id='characterDivAppearance'>
				You are <b><?=getFatAdj($_SESSION['objRPGCharacter']->getBMI(), true)?> human <?=strtolower($_SESSION['objRPGCharacter']->getGender())?></b> that weighs <b><?=$_SESSION['objRPGCharacter']->getWeight()?></b> pounds, standing at <b><?=$_SESSION['objRPGCharacter']->getHeightInFeet()?></b> tall.
				<br/><br/>
				You have <b><?=strtolower($_SESSION['objRPGCharacter']->getHairLength())?> <?=strtolower($_SESSION['objRPGCharacter']->getHairColour())?> hair</b>, striking <b><?=strtolower($_SESSION['objRPGCharacter']->getEyeColour())?> eyes</b>, and a <b><?=strtolower($_SESSION['objRPGCharacter']->getEthnicity())?></b> skintone.
				<br/><br/>
				<?=getStareDownText($_SESSION['objRPGCharacter']->getBMI())?>
				<br/><br/>
				<?php 
					$objArmourXMLFile = $_SESSION['objRPGCharacter']->getEquippedArmour()->getXML(); 
					if(isset($objArmourXMLFile)){
						$objArmourXML = new RPGOutfitReader($_SESSION['objRPGCharacter']->getEquippedArmour()->getXML());
						$armourRipLevel = $_SESSION['objRPGCharacter']->getArmourRipLevel();
						if(isset($_SESSION['objUISettings']->getOverrides()[1]) || $_SESSION['objRPGCharacter']->getEquippedArmour()->getSize() == 'Stretch'){
							$armourRipLevel = 4;
						}
						$node = $objArmourXML->findNodeAtBMI('appearance', $armourRipLevel);
						echo $node[0]->text;
					}
					else{
						echo "You are not wearing any clothes or armour.<br/>" . getBellyText($_SESSION['objRPGCharacter']->getBMI());
					}
				?>
				<br/><br/>
				<?=getFPEquipmentText($_SESSION['objRPGCharacter']->getEquippedWeapon()->getItemName())?>
				<br/><br/>
				Naturally, it's difficult to examine your entire appearance in first-person. You should seek out a <b>full-body mirror</b> to have a better look at yourself.
			</div>
		
		<?php
		$strHTML = ob_get_contents();
		ob_end_clean();
		
		echo $strHTML;
	}

}

?>