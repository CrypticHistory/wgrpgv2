<?php

class DisplayMapInventory{

	public function __construct(){
		
	}
	
	public function toHTML(){
		ob_start(); ?>
		
		<div class='inventoryDiv hidden' id='inventoryDivMap'>
			<?php if(!$_SESSION['objUISettings']->getDisableInv()){?>
			<?php if($_SESSION['objRPGCharacter']->getTownID() != 1){?>
			<table class='mapTable'>
				<thead>
					<th class='floorMapHeader borderBottom'>Floor Map</th>
				</thead>
				<tbody>
					<tr class='textCenter' id='floorMap'>
						<td><?php echo $_SESSION['objRPGCharacter']->getCurrentFloor()->getMaze()->draw(); ?></td>
					</tr>
				</tbody>
			</table>
			<?php } ?>
			<?php } else { ?>
				<div class='insideOther'>
					Your inventory is locked during this event.
				</div>
			<?php } ?>
		</div>
		<?php
		$strHTML = ob_get_contents();
		ob_end_clean();
		
		echo $strHTML;
	}

}

?>