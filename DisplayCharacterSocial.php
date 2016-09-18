<?php

class DisplayCharacterSocial{

	public function DisplayCharacterSocial(){
		
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
							echo "<tr><td>Your character does not have any relationships yet.</td></tr>";
						}
					?>
				</table>
			</div>
		
		<?php
		$strHTML = ob_get_contents();
		ob_end_clean();
		
		echo $strHTML;
	}

}

?>