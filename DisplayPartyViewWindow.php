<?php

include_once 'RPGNPC.php';

class DisplayPartyViewWindow{

	public function __construct(){
		
	}
	
	public static function toHTML(){
		ob_start(); ?>
		
			<script type='text/javascript'>

				$(document).ready(function(){
					
					$('.modifyParty').click(function(){
						NPCID = $(this).attr("NPCID");
						window.location.replace("command.php?toggleParty=" + NPCID);
					});
					
				});

			</script>
			
			<div class='eventDiv' id='eventDivPartyViewWindow'>
				<div class='insideEvent'>
					<?php
					if(isset($_GET['intNPCID'])){
						$_GET['intNPCID'] = intval($_GET['intNPCID']);
						$objNPC = new RPGNPC($_GET['intNPCID'], $_SESSION['objRPGCharacter']->getRPGCharacterID());
						
						if(!$objNPC->getNPCInstanceID()){
							echo "Error: NPC does not exist, or you've never met this NPC before.";
						}
						else{
					?>
					
					<h3><?=$objNPC->getNPCName()?></h3>
					
					<table class='charTable' align='center' style='padding-right:7px;'>
						<th class='tableHeader borderBottom statHeader' colspan='2'>Body Stats</th>
						<tr>
							<td>Height:</td><td id='charHeight'><?=$objNPC->getHeightInFeet()?></td>
						</tr>
						<tr>
							<td>Weight:</td><td id='charWeight'><?=round($objNPC->getWeight(), 2)?> lbs</td>
						</tr>
						<tr>
							<td>Digestion Rate:</td><td id='charDigestion'><?=$objNPC->getDigestionRate()?> cal/tick</td>
						</tr>
						<tr>
							<td>Fullness:</td><td id='charHunger'><?=$objNPC->getCurrentHunger()?> / <?=$objNPC->getStats()->getCombinedStatsSecondary('intMaxHunger')?></td>
						</tr>
						<tr>
							<td class='borderTop' colspan='2'>&nbsp;</td>
						</tr>
					</table>
					<table class='charTable' align='center' style='padding-right:7px;'>
						<th class='tableHeader borderBottom statHeader' colspan='2'>Combat Stats</th>
						<tr>
							<td>Level:</td><td id='charLevel'><?=$objNPC->getLevel()?></td>
						</tr>
						<tr>
							<td>Experience:</td><td id='charExperience'>
							<?=$objNPC->getExperience()?> / <?=$objNPC->loadRequiredExperience()?></td>
						</tr>
						<tr>
							<td>Current HP:</td><td id='charMaxHP'><?=max(0, $objNPC->getCurrentHP())?> / <?=$objNPC->getModifiedMaxHP()?></td>
						</tr>
						<tr>
							<td>Strength:</td><td id='charStrength'>
								<?=$objNPC->getModifiedStrength()?>
							</td>
						</tr>
						<tr>
							<td>Intelligence:</td><td id='charIntelligence'>
								<?=$objNPC->getModifiedIntelligence()?>
							</td>
						</tr>
						<tr>
							<td>Agility:</td><td id='charAgility'>
								<?=$objNPC->getModifiedAgility()?>
							</td>
						</tr>
						<tr>
							<td>Vitality:</td><td id='charVitality'>
								<?=$objNPC->getModifiedVitality()?>
							</td>
						</tr>
						<tr>
							<td>Willpower:</td><td id='charWillpower'>
								<?=$objNPC->getModifiedWillpower()?>
							</td>
						</tr>
						<tr>
							<td>Dexterity:</td><td id='charDexterity'>
								<?=$objNPC->getModifiedDexterity()?>
							</td>
						</tr>
						<tr>
							<td class='borderTop' colspan='2'>&nbsp;</td>
						</tr>
					</table>
					<?php 
						}
					}
					else{
					?>
					<h3>Active Party</h3>
					<table class='charTable'>
						<thead>
							<th class='greyBG textLeft' style="width:40%;">Name</th>
							<th class='greyBG textRight' style="width:10%;">Lvl</th>
							<th class='greyBG textRight' style="width:15%;">Exp</th>
							<th class='greyBG textRight' style="width:15%;">HP</th>
							<th class='greyBG' style="width:20%;">Actions</th>
						</thead>
						<tbody>
							<?php
								
								$arrSortedParty = $_SESSION['objRPGCharacter']->getPartyMembers()->getActivePartyMembers();
								ksort($arrSortedParty);
								
								foreach($arrSortedParty as $strPartyObj => $objNPC){
								
									echo "<tr><td>" . $objNPC->getNPCName() . "</td><td class='textRight'>" . $objNPC->getLevel() . "</td><td class='textRight'>" . round(($objNPC->getExperience() / $objNPC->loadRequiredExperience() * 100), 2) . "%</td><td class='textRight'>" . round((max(0, $objNPC->getCurrentHP()) / $objNPC->getModifiedMaxHP() * 100), 2) . "%</td></td><td class='textCenter'><button class='modifyParty' NPCID='" . $objNPC->getNPCInstanceID() . "' type='button'>Remove</button></tr>";
									
								}
							
							?>
						</tbody>
					</table>
					<h3>Inactive Party</h3>
					<table class='charTable'>
						<thead>
							<th class='greyBG textLeft' style="width:40%;">Name</th>
							<th class='greyBG textRight' style="width:10%;">Lvl</th>
							<th class='greyBG textRight' style="width:15%;">Exp</th>
							<th class='greyBG textRight' style="width:15%;">HP</th>
							<th class='greyBG' style="width:20%;">Actions</th>
						</head>
						<tbody>
							<?php
							
							foreach($_SESSION['objRPGCharacter']->getPartyMembers()->getReservePartyMembers() as $intNPCID => $objNPC){
								
								echo "<tr><td>" . $objNPC->getNPCName() . "</td><td class='textRight'>" . $objNPC->getLevel() . "</td><td class='textRight'>" . round(($objNPC->getExperience() / $objNPC->loadRequiredExperience() * 100), 2) . "%</td><td class='textRight'>" . round((max(0, $objNPC->getCurrentHP()) / $objNPC->getModifiedMaxHP() * 100), 2) . "%</td></td><td class='textCenter'><button class='modifyParty' NPCID='" . $objNPC->getNPCInstanceID() . "' type='button'>Add</button></tr>";
								
							}
							
							?>
						</tbody>
					</table>
					<?php
					}
					?>
				</div>
			</div>
		
		<?php
		$strHTML = ob_get_contents();
		ob_end_clean();
		
		echo $strHTML;
	}

}

?>