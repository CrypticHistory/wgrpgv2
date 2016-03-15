<?php

class DisplayCharacterInfo{

	public function DisplayCharacterInfo(){
	
	}
	
	public function toHTML(){
		ob_start(); ?>
		
			<div class='characterDiv hidden' id='characterDivInfo'>
				<table class='charTable' align='center'>
					<th class='tableHeader borderBottom statHeader' colspan='2'>Basic Stats</th>
					<tr>
						<td>Name:</td><td id='charName'><?=$_SESSION['objRPGCharacter']->getRPGCharacterName()?></td>
					</tr>
					<tr>
						<td>Gender:</td><td id='charGender'><?=$_SESSION['objRPGCharacter']->getGender()?></td>
					</tr>
					<tr>
						<td>Sexual Orientation:</td><td id='charOrientation'><?=$_SESSION['objRPGCharacter']->getOrientation()?></td>
					</tr>
					<tr>
						<td>Personality:</td><td id='charPersonality'><?=$_SESSION['objRPGCharacter']->getPersonality()?></td>
					</tr>
					<tr>
						<td>Stance on Fat:</td><td id='charFatStance'><?=$_SESSION['objRPGCharacter']->getFatStance()?></td>
					</tr>
					<tr>
						<td class='borderTop' colspan='2'>&nbsp;</td>
					</tr>
				</table>
				<table class='charTable' align='center'>
					<th class='tableHeader borderBottom statHeader' colspan='2'>Body Stats</th>
					<tr>
						<td>Height:</td><td id='charHeight'><?=$_SESSION['objRPGCharacter']->getHeightInFeet()?></td>
					</tr>
					<tr>
						<td>Weight:</td><td id='charWeight'><?=round($_SESSION['objRPGCharacter']->getWeight(), 2)?> lbs</td>
					</tr>
					<tr>
						<td>Digestion Rate:</td><td id='charDigestion'><?=$_SESSION['objRPGCharacter']->getDigestionRate()?> cal/tick</td>
					</tr>
					<tr>
						<td class='borderTop' colspan='2'>&nbsp;</td>
					</tr>
				</table>
				<table class='charTable' align='center'>
					<th class='tableHeader borderBottom statHeader' colspan='2'>Combat Stats</th>
					<?php if($_SESSION['objRPGCharacter']->getStatPoints() != 0 && !$_SESSION['objUISettings']->getDisableStats()){?>
						<form method='post' action='changeEventWindow.php'>
							<tr><td>You have <span id='unspentStats'><?=$_SESSION['objRPGCharacter']->getStatPoints()?></span> unspent stat points!</td><td><button type='submit'>Spend</button></td></tr>
							<input type='hidden' name='changeTo' value='StatGain'/>
						</form>
					<?php } ?>
					<tr>
						<td>Level:</td><td id='charLevel'><?=$_SESSION['objRPGCharacter']->getLevel()?></td>
					</tr>
					<tr>
						<td>Experience:</td><td id='charExperience'>
						<?=$_SESSION['objRPGCharacter']->getExperience()?> / <?=$_SESSION['objRPGCharacter']->getRequiredExperience()?></td>
					</tr>
					<tr>
						<td>Current HP:</td><td id='charMaxHP'><?=max(0, $_SESSION['objRPGCharacter']->getCurrentHP())?> / <?=$_SESSION['objRPGCharacter']->getModifiedMaxHP()?></td>
					</tr>
					<tr>
						<td>Strength:</td><td id='charStrength'>
							<?php $intCombinedStrength = $_SESSION['objRPGCharacter']->getStats()->getBaseStats()['intStrength'] + $_SESSION['objRPGCharacter']->getStats()->getAbilityStats()['intStrength']; ?>
							<?=$intCombinedStrength?>
						</td>
					</tr>
					<tr>
						<td>Intelligence:</td><td id='charIntelligence'>
							<?php $intCombinedIntelligence = $_SESSION['objRPGCharacter']->getStats()->getBaseStats()['intIntelligence'] + $_SESSION['objRPGCharacter']->getStats()->getAbilityStats()['intIntelligence']; ?>
							<?=$intCombinedIntelligence?>
						</td>
					</tr>
					<tr>
						<td>Agility:</td><td id='charAgility'>
							<?php $intCombinedAgility = $_SESSION['objRPGCharacter']->getStats()->getBaseStats()['intAgility'] + $_SESSION['objRPGCharacter']->getStats()->getAbilityStats()['intAgility']; ?>
							<?=$intCombinedAgility?>
						</td>
					</tr>
					<tr>
						<td>Vitality:</td><td id='charVitality'>
							<?php $intCombinedVitality = $_SESSION['objRPGCharacter']->getStats()->getBaseStats()['intVitality'] + $_SESSION['objRPGCharacter']->getStats()->getAbilityStats()['intVitality']; ?>
							<?=$intCombinedVitality?>
						</td>
					</tr>
					<tr>
						<td>Willpower:</td><td id='charWillpower'>
							<?php $intCombinedWillpower = $_SESSION['objRPGCharacter']->getStats()->getBaseStats()['intWillpower'] + $_SESSION['objRPGCharacter']->getStats()->getAbilityStats()['intWillpower']; ?>
							<?=$intCombinedWillpower?>
						</td>
					</tr>
					<tr>
						<td>Dexterity:</td><td id='charDexterity'>
							<?php $intCombinedDexterity = $_SESSION['objRPGCharacter']->getStats()->getBaseStats()['intDexterity'] + $_SESSION['objRPGCharacter']->getStats()->getAbilityStats()['intDexterity']; ?>
							<?=$intCombinedDexterity?>
						</td>
					</tr>
					<tr>
						<td class='borderTop' colspan='2'>&nbsp;</td>
					</tr>
				</table>
				<table class='charTable' align='center'>
					<th class='tableHeader borderBottom statHeader' colspan='2'>Status Effects</th>
					<?php
						$arrStatusEffectList = $_SESSION['objRPGCharacter']->getStatusEffectList();
						if(!empty($arrStatusEffectList)){
							$intCounter = 0;
							foreach($arrStatusEffectList as $key => $objStatusEffect){
								echo
								"<tr>
									<td>" . $objStatusEffect->getStatusEffectName() . "</td>
								</tr>";
								$intCounter++;
							}
						}
						else{
							echo "<tr><td>None</td></tr>";
						}
					?>
					<tr>
						<td class='borderTop' colspan='2'>&nbsp;</td>
					</tr>
				</table>
			</div>
		
		<?php
		$strHTML = ob_get_contents();
		ob_end_clean();
		
		echo $strHTML;
	}

}

?>