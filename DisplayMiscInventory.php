<?php

class DisplayMiscInventory{

	public function __construct(){
		
	}
	
	public function toHTML(){
		ob_start(); ?>
		
		<div class='inventoryDiv hidden' id='inventoryDivMisc'>
			<div class='insideOther'>
				<?php if(!$_SESSION['objUISettings']->getDisableInv()){?>
						Misc
				<?php }else{ ?>
						Your misc. inventory is locked during this event.
				<?php } ?>
			</div>
		</div>
		<?php
		$strHTML = ob_get_contents();
		ob_end_clean();
		
		echo $strHTML;
	}

}

?>