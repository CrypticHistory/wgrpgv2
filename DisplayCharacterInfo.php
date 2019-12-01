<?php

class DisplayCharacterInfo{

	public function __construct(){
	
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
						<td>Attitude on Fat (self)</td><td id='charFeedee'><?=($_SESSION['objRPGCharacter']->getLikesFatSelf() ? "Positive" : "Negative")?></td>
					</tr>
					<tr>
						<td>Attitude on Fat (others)</td><td id='charFatAdmirer'><?=($_SESSION['objRPGCharacter']->getLikesFatOthers() ? "Positive" : "Negative")?></td>
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
						<td>Fullness:</td><td id='charHunger'><?=$_SESSION['objRPGCharacter']->getCurrentHunger()?> / <?=$_SESSION['objRPGCharacter']->getStats()->getCombinedStatsSecondary('intMaxHunger')?></td>
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
						<td>
							<div class='tooltip'>
								Strength:
								<span class='tooltipText'>Increases Physical Damage and Immobility Resistance</span>
							</div>
						</td>
						<td id='charStrength' class='tooltip'>
							<?=$_SESSION['objRPGCharacter']->getModifiedStrength()?>
							<span class='tooltipText'>Base: <?=$_SESSION['objRPGCharacter']->getStats()->getBaseStats()["intStrength"]?><br/>Abilities: <?=$_SESSION['objRPGCharacter']->getStats()->getAbilityStats()["intStrength"]?><br/>Status Effects: <?=$_SESSION['objRPGCharacter']->getStats()->getStatusEffectStatsAll("intStrength")?><br/>Equipment: <?=$_SESSION['objRPGCharacter']->getEquipmentStats("Strength")?></span>
						</td>
					</tr>
					<tr>
						<td>
							<div class='tooltip'>
								Intelligence:
								<span class='tooltipText'>Increases Magic Damage and Magic Defence</span>
							</div>
						</td>
						<td id='charIntelligence' class='tooltip'>
							<?=$_SESSION['objRPGCharacter']->getModifiedIntelligence()?>
							<span class='tooltipText'>Base: <?=$_SESSION['objRPGCharacter']->getStats()->getBaseStats()["intIntelligence"]?><br/>Abilities: <?=$_SESSION['objRPGCharacter']->getStats()->getAbilityStats()["intIntelligence"]?><br/>Status Effects: <?=$_SESSION['objRPGCharacter']->getStats()->getStatusEffectStatsAll("intIntelligence")?><br/>Equipment: <?=$_SESSION['objRPGCharacter']->getEquipmentStats("Intelligence")?></span>
						</td>
					</tr>
					<tr>
						<td>
							<div class='tooltip'>
								Agility:
								<span class='tooltipText'>Increases Evasion and Flee Rate, Decreases Wait Time between attacks</span>
							</div>
						</td>
						<td id='charAgility' class='tooltip'>
							<?=$_SESSION['objRPGCharacter']->getModifiedAgility()?>
							<span class='tooltipText'>Base: <?=$_SESSION['objRPGCharacter']->getStats()->getBaseStats()["intAgility"]?><br/>Abilities: <?=$_SESSION['objRPGCharacter']->getStats()->getAbilityStats()["intAgility"]?><br/>Status Effects: <?=$_SESSION['objRPGCharacter']->getStats()->getStatusEffectStatsAll("intAgility")?><br/>Equipment: <?=$_SESSION['objRPGCharacter']->getEquipmentStats("Agility")?></span>
						</td>
					</tr>
					<tr>
						<td>
							<div class='tooltip'>
								Vitality:
								<span class='tooltipText'>Increases Max HP and Defence</span>
							</div>
						</td>
						<td id='charVitality' class='tooltip'>
							<?=$_SESSION['objRPGCharacter']->getModifiedVitality()?>
							<span class='tooltipText'>Base: <?=$_SESSION['objRPGCharacter']->getStats()->getBaseStats()["intVitality"]?><br/>Abilities: <?=$_SESSION['objRPGCharacter']->getStats()->getAbilityStats()["intVitality"]?><br/>Status Effects: <?=$_SESSION['objRPGCharacter']->getStats()->getStatusEffectStatsAll("intVitality")?><br/>Equipment: <?=$_SESSION['objRPGCharacter']->getEquipmentStats("Vitality")?></span>
						</td>
					</tr>
					<tr>
						<td>
							<div class='tooltip'>
								Willpower:
								<span class='tooltipText'>Increases Status Effect Success Rate, Status Effect Resistance, and Final Damage</span>
							</div>
						</td>
						<td id='charWillpower' class='tooltip'>
							<?=$_SESSION['objRPGCharacter']->getModifiedWillpower()?>
							<span class='tooltipText'>Base: <?=$_SESSION['objRPGCharacter']->getStats()->getBaseStats()["intWillpower"]?><br/>Abilities: <?=$_SESSION['objRPGCharacter']->getStats()->getAbilityStats()["intWillpower"]?><br/>Status Effects: <?=$_SESSION['objRPGCharacter']->getStats()->getStatusEffectStatsAll("intWillpower")?><br/>Equipment: <?=$_SESSION['objRPGCharacter']->getEquipmentStats("Willpower")?></span>
						</td>
					</tr>
					<tr>
						<td>
							<div class='tooltip'>
								Dexterity:
								<span class='tooltipText'>Increases Critical Hit Rate, Accuracy, and Critical Hit Resistance</span>
							</div>
						</td>
						<td id='charDexterity' class='tooltip'>
							<?=$_SESSION['objRPGCharacter']->getModifiedDexterity()?>
							<span class='tooltipText'>Base: <?=$_SESSION['objRPGCharacter']->getStats()->getBaseStats()["intDexterity"]?><br/>Abilities: <?=$_SESSION['objRPGCharacter']->getStats()->getAbilityStats()["intDexterity"]?><br/>Status Effects: <?=$_SESSION['objRPGCharacter']->getStats()->getStatusEffectStatsAll("intDexterity")?><br/>Equipment: <?=$_SESSION['objRPGCharacter']->getEquipmentStats("Dexterity")?></span>
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