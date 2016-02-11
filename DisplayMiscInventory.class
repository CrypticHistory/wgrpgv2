<?php

class DisplayMiscInventory{

	public function DisplayMiscInventory(){
		
	}
	
	public function toHTML(){
		ob_start(); ?>
		
		<div class='inventoryDiv hidden' id='inventoryDivMisc'>
		<?php if(!$_SESSION['objUISettings']->getDisableInv()){?>
				Misc
		<?php }else{ ?>
				Your misc. inventory is locked during this event.
		<?php } ?>
			</div>
		<?php
		$strHTML = ob_get_contents();
		ob_end_clean();
		
		echo $strHTML;
	}

}

?>