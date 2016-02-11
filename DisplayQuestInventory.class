<?php

class DisplayQuestInventory{

	public function DisplayQuestInventory(){
		
	}
	
	public function toHTML(){
		ob_start(); ?>
		
		<div class='inventoryDiv hidden' id='inventoryDivQuest'>
		<?php if(!$_SESSION['objUISettings']->getDisableInv()){?>
				Quest
		<?php }else{ ?>
				Your quest inventory is locked during this event.
		<?php } ?>
			</div>
		<?php
		$strHTML = ob_get_contents();
		ob_end_clean();
		
		echo $strHTML;
	}

}

?>