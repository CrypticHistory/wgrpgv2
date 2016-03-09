<?php

include_once "UISettings.php";
include_once "RPGLocation.php";

class DisplayNavigationMenuWindow{

	public function DisplayNavigationMenuWindow(){
		
	}
	
	public static function toHTML(){
		ob_start(); ?>
		
			<div class='compassDiv' id='menuDiv'>
				<?php
				
				$objLocation = new RPGLocation($_SESSION['objRPGCharacter']->getLocationID());
				if(!$_SESSION['objUISettings']->getDisableTraversal()){
					$arrXRLinks = $objLocation->getHubLinks();
					foreach($arrXRLinks as $objXRLocation){
						echo "<a href='main.php?page=DisplayGameUI&LocationID=" . $objXRLocation->getLocationID() . "'><button type='button'>" . $objLocation->getLinkName($objXRLocation->getLocationID()) . "</button></a>";
					}
				} else { ?>
				Traversing is currently disabled.
				<?php } ?>
			</div>
		
		<?php
		$strHTML = ob_get_contents();
		ob_end_clean();
		
		echo $strHTML;
	}

}

?>