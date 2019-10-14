<?php

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
					<h3>Active Party</h3>
					<table class='charTable'>
						<thead>
							<th class='greyBG' style="width:46%;">Name</th>
							<th class='greyBG' style="width:10%;">Lvl</th>
							<th class='greyBG' style="width:15%;">Exp</th>
							<th class='greyBG' style="width:15%;">HP</th>
							<th class='greyBG' style="width:15%;">Actions</th>
						</thead>
						<tbody>
							<?php
								
								foreach($_SESSION['objRPGCharacter']->getPartyMembers()->getActivePartyMembers() as $strPartyObj => $objNPC){
								
									echo "<tr><td>" . $objNPC->getNPCName() . "</td><td>" . $objNPC->getLevel() . "</td><td>" . round(($objNPC->getExperience() / $objNPC->loadRequiredExperience() * 100), 2) . "%</td><td>" . round(($objNPC->getCurrentHP() / $objNPC->getModifiedMaxHP() * 100), 2) . "%</td></td><td><button class='modifyParty' NPCID='" . $objNPC->getNPCInstanceID() . "' type='button'>Remove</button></tr>";
									
								}
							
							?>
						</tbody>
					</table>
					<h3>Inactive Party</h3>
					<table class='charTable'>
						<thead>
							<th class='greyBG' style="width:46%;">Name</th>
							<th class='greyBG' style="width:10%;">Lvl</th>
							<th class='greyBG' style="width:15%;">Exp</th>
							<th class='greyBG' style="width:15%;">HP</th>
							<th class='greyBG'>Actions</th>
						</head>
						<tbody>
							<?php
							
							foreach($_SESSION['objRPGCharacter']->getPartyMembers()->getReservePartyMembers() as $intNPCID => $objNPC){
								
								echo "<tr><td>" . $objNPC->getNPCName() . "</td><td>" . $objNPC->getLevel() . "</td><td>" . round(($objNPC->getExperience() / $objNPC->loadRequiredExperience() * 100), 2) . "%</td><td>" . round(($objNPC->getCurrentHP() / $objNPC->getModifiedMaxHP() * 100), 2) . "%</td></td><td><button class='modifyParty' NPCID='" . $objNPC->getNPCInstanceID() . "' type='button'>Add</button></tr>";
								
							}
							
							?>
						</tbody>
					</table>
				</div>
			</div>
		
		<?php
		$strHTML = ob_get_contents();
		ob_end_clean();
		
		echo $strHTML;
	}

}

?>