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
				<?=getStareDownText($_SESSION['objRPGCharacter']->getFace())?>
				<br/><br/>
				<?php
					$arrClothingTypes = array("Armour", "Top", "Bottom");
					$blnIsEquipped = false;
					foreach($arrClothingTypes as $strClothingType){
						$strGetFunction = "getEquipped" . $strClothingType;
						if($_SESSION['objRPGCharacter']->$strGetFunction()->getXML() !== null){
							$objXML = new RPGOutfitReader($_SESSION['objRPGCharacter']->$strGetFunction()->getXML());
							if(isset($objXML)){
								global $arrArmourBodyParts;
								global $arrTopBodyParts;
								global $arrBottomBodyParts;
								global $arrClothingSizes;
								if($strClothingType == 'Armour'){
									$arrBodyParts = $arrArmourBodyParts;
								}
								else if($strClothingType == 'Top'){
									$arrBodyParts = $arrTopBodyParts;
								}
								else{
									$arrBodyParts = $arrBottomBodyParts;
								}
								$blnIsEquipped = true;
								$intClothingBMI = $arrClothingSizes[$_SESSION['objRPGCharacter']->$strGetFunction()->getSize()];
								$intCharacterBMI = $_SESSION['objRPGCharacter']->getBMI();
								$intBMIDifference = round($intCharacterBMI - $intClothingBMI);
								if(isset($_SESSION['objUISettings']->getOverrides()[2]) || $_SESSION['objRPGCharacter']->$strGetFunction()->getSize() == 'Stretch'){
									$intBMIDifference = 0;
								}
								$node = $objXML->findNodeBetweenBMI('appearance', $intBMIDifference);
								if(isset($node[0]->overall->text)){
									echo $node[0]->overall->text . " ";
								}
								foreach($arrBodyParts as $strBodyPart){
									$strBodyPartLC = strtolower($strBodyPart);
									$strGetRipFunction = "get" . $strBodyPart . "RipLevel";
									$armourRipLevel = $_SESSION['objRPGCharacter']->getBody()->$strGetRipFunction();
									if(isset($_SESSION['objUISettings']->getOverrides()[2]) || $_SESSION['objRPGCharacter']->$strGetFunction()->getSize() == 'Stretch'){
										$armourRipLevel = 0;
									}
									$node = $objXML->findNodeAtBMI('appearance', $armourRipLevel);
									if(isset($node[0]->$strBodyPartLC->text)){
										echo $node[0]->$strBodyPartLC->text . " ";
									}
								}
								echo "<br/>";
							}
						}
					}
					if(!$blnIsEquipped){
						echo "You are not wearing any clothes or armour.<br/>" . getBellyText($_SESSION['objRPGCharacter']->getBelly());
					}
				?>
				<br/>
				<?=getFPEquipmentText($_SESSION['objRPGCharacter']->getEquippedWeapon()->getItemName())?>
				<br/><br/>
				Naturally, it's difficult to examine your entire appearance in first-person. You should seek out a full-body mirror to have a better look at yourself.
			</div>
		
		<?php
		$strHTML = ob_get_contents();
		ob_end_clean();
		
		echo $strHTML;
	}

}

?>