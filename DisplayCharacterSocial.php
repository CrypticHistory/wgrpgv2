<?php

class DisplayCharacterSocial{

	public function __construct(){
		
	}
	
	public static function toHTML(){
		ob_start(); ?>
		
			<script type='text/javascript'>

				$(document).ready(function(){
					
					$('.viewStats').click(function(){
						NPCID = $(this).attr("NPCID");
						window.location.replace("changeEventWindow.php?changeTo=PartyView&intNPCID=" + NPCID);
					});
					
				});

			</script>
		
			<div class='characterDiv hidden' id='characterDivSocial'>
				<table class='charTable' align='center'>
					<thead>
						<tr>
							<th class='tableHeader statHeader'>Active Party</th>
						</tr>
						<tr>
							<th class='greyBG textLeft' style="width:30%;">Name</th>
							<th class='greyBG textRight' style="width:10%;">Lvl</th>
							<th class='greyBG textRight' style="width:15%;">Exp</th>
							<th class='greyBG textRight' style="width:15%;">HP</th>
							<th class='greyBG' style="width:25%;">Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php
							if(!empty($_SESSION['objRPGCharacter']->getPartyMembers())){
								if(!empty($_SESSION['objRPGCharacter']->getPartyMembers()->getActivePartyMembers())){
									$arrSortedParty = $_SESSION['objRPGCharacter']->getPartyMembers()->getActivePartyMembers();
									ksort($arrSortedParty);
									foreach($arrSortedParty as $strPartyObj => $objNPC){
										echo "<tr><td>" . $objNPC->getShortName() . "</td><td class='textRight'>" . $objNPC->getLevel() . "</td><td class='textRight'>" . round(($objNPC->getExperience() / $objNPC->loadRequiredExperience() * 100), 2) . "%</td><td class='textRight'>" . round((max(0, $objNPC->getCurrentHP()) / $objNPC->getModifiedMaxHP() * 100), 2) . "%</td></td><td class='textCenter'>" . ($_SESSION['objUISettings']->getDisableStats() && $_SESSION['objUISettings']->getEventFrame() != "PartyView" ? "" : "<button class='viewStats' NPCID='" . $objNPC->getNPCID() . "' type='button'>Stats</button>") . "</tr>";
									}
									echo $_SESSION['objUISettings']->getDisableParty() || !$_SESSION['objRPGCharacter']->getTownID() ? "" : "<tr><td colspan='5' class='textCenter'><a href='changeEventWindow.php?changeTo=PartyView'>[ Modify Party ]</a></td></tr>";
								}
								else{
									echo "<tr><td colspan='5' class='textCenter'>No Active Party</td></tr>" . ($_SESSION['objUISettings']->getDisableParty() ? "" : "<tr><td colspan='5' class='textCenter'><a href='changeEventWindow.php?changeTo=PartyView'>[ Modify Party ]</a></td></tr>");
								}
							}
							else{
								echo "<tr><td>You do not have any NPCs eligible to be party members.</td></tr>";
							}
						?>
						<tr>
							<td class='borderTop' colspan='5'>&nbsp;</td>
						</tr>
					</tbody>
				</table>
				<table class='invTable' align='center'>
					<thead>
						<th class='tableHeader borderBottom statHeader'>Quests</th>
					</thead>
					<tbody>
						<?php
							if(!empty($_SESSION['objRPGCharacter']->getQuests()->getQuestList())){
								$intCounter = 0;
								foreach($_SESSION['objRPGCharacter']->getQuests()->getQuestList() as $intQuestID => $objQuest){
									$strQuestStatus = $objQuest->getCompleted() != "0000-00-00 00:00:00" ? "<span class='completedQuest'>Completed</span>" : "<span class='inprogressQuest'>In Progress</span>";
									echo "<tr class='textCenter" . (($_SESSION['objUISettings']->getQuestTab() == $intCounter) ? " selectedRow" : "") . "' id='questEntry" . $intCounter . "'>";
									echo "<td id='questName'><a href=\"javascript:showQuestDetails('" . $intCounter . "');\"><span class='itemName questName'>" . $objQuest->getQuestName() . " - " . $strQuestStatus . "</span></a></td>";
									echo "</tr>";
									echo "<tr id='questEntryDetails" . $intCounter . "' class='" . (($_SESSION['objUISettings']->getQuestTab() == $intCounter) ? "" : "hidden") . "'>";
									echo "<td class='itemDesc background" . ($intCounter % 2) . "'><b>Requirements:</b><br/>";
									$intReqCounter = 0;
									foreach($objQuest->getAllRequirements()["Kill"] as $intNPCID => $objReq){
										echo "<span class='" . (($objReq->getCompleted() != "0000-00-00 00:00:00") ? "completedReq" : "") . "'>" . ($intReqCounter+1) . ") " . $objReq->getReqName() . " - " . $objReq->getCurrentKillCount() . " / " . $objReq->getKillReq() . "</span><br/><br/>";
										$intReqCounter++;
									}
									echo "<b>Description:</b><br/>" . $objQuest->getQuestDesc() . "<br/><br/></td>";
									echo "</tr>";
									$intCounter++;
								}
							}
							else{
								echo "<tr><td>You do not have any quests active.</td></tr>";
							}
						?>
						<tr>
							<td class='borderTop' colspan='2'>&nbsp;</td>
						</tr>
					</tbody>
				</table>
				<table class='charTable' align='center'>
					<th class='tableHeader borderBottom statHeader'>Relationships</th>
					<?php
						if(!empty($_SESSION['objRPGCharacter']->getRelationships())){
							foreach($_SESSION['objRPGCharacter']->getRelationships() as $intNPCID => $objRelationship){
								echo "<tr><td>" . $objRelationship->getNPCName() . " - Lvl " . $objRelationship->getRelationshipLevel() . "</td></tr>";
							}
						}
						else{
							echo "<tr><td>You do not have any relationships yet.</td></tr>";
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