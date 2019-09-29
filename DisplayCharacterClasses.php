<?php

class DisplayCharacterClasses{

	public function __construct(){
		
	}
	
	public static function toHTML(){
		ob_start(); ?>
		
			<div class='characterDiv hidden' id='characterDivClasses'>
				<table class='invTable' align='center'>
					<thead>
						<th class='tableHeader borderBottom statHeader'>Classes</th>
					</thead>
					<tbody>
						<?php
							if(!empty($_SESSION['objRPGCharacter']->getClasses()->getClassList())){
								$intCounter = 0;
								foreach($_SESSION['objRPGCharacter']->getClasses()->getClassList() as $intClassID => $objClass){
									echo "<tr class='textCenter" . (($_SESSION['objUISettings']->getClassTab() == $intCounter) ? " selectedRow" : "") . "' id='classEntry" . $intCounter . "'>";
									echo "<td id='className'><span class='itemName className'><a href=\"javascript:showClassDetails('" . $intCounter . "');\">" . $objClass->getClassName() . " - " . ($objClass->getCurrentClass() ? "<span class='playerClassActive'>Active</span>" : "<span class='playerClassInactive'>Inactive</span>") . "</a></span></td>";
									echo "</tr>";
									echo "<tr id='classEntryDetails" . $intCounter . "' class='" . (($_SESSION['objUISettings']->getClassTab() == $intCounter) ? "" : "hidden") . "'>
											<td class='itemDesc background" . ($intCounter % 2) . "'><b>Level:</b> " . $objClass->getClassLevel() . "<br/><b>Experience: </b>" . $objClass->getClassExperience() . " / " . $objClass->getRequiredExperience() . "<br/><br/><b>Description:</b><br/>" . $objClass->getClassDesc() . "<br/>";
									if(!$_SESSION['objUISettings']->getDisableSkills()){
										echo
												"<form method='post' action='command.php'>
													<a href='changeEventWindow.php?changeTo=SkillView&intClassID=" . $objClass->getClassID() . "'><button type='button'>View Skills</button></a>
													<button type='submit' name='toggleClass' value='" . $objClass->getClassID() . "'>" . ($objClass->getCurrentClass() ? "Disable" : "Enable") . "</button>
												</form>";
									}
									else{
										echo "<br/>";
									}
										echo
											"</td>
										  </tr>";
								  $intCounter++;
								}
							}
							else{
								echo "<tr><td>You do not have any classes yet.</td></tr>";
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