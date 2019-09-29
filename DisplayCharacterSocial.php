<?php

class DisplayCharacterSocial{

	public function __construct(){
		
	}
	
	public static function toHTML(){
		ob_start(); ?>
		
			<div class='characterDiv hidden' id='characterDivSocial'>
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
			</div>
		
		<?php
		$strHTML = ob_get_contents();
		ob_end_clean();
		
		echo $strHTML;
	}

}

?>