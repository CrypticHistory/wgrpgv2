<?php

include_once "RPGLocation.php";

class DisplayTownCommandsWindow{

	public function __construct(){
		
	}
	
	public static function toHTML(){
		ob_start(); ?>

			<div class='commandsDiv' id='commandsDivTownCommands'>
				
				<?php
				
				$objLocation = new RPGLocation($_SESSION['objRPGCharacter']->getLocationID());
				$arrEventLinks = $objLocation->getLocationEventLinks();
				$arrShopLinks = $objLocation->getLocationShopLinks();
				$arrXRLinks = $objLocation->getLocationXRLinks();
				if($objLocation->getLocationID() == 1){
					$arrFloorLinks = $objLocation->getFloorLinks($_SESSION['objRPGCharacter']);
				}
				
				foreach($arrXRLinks as $objXRLocation){
					echo "<a href='main.php?page=DisplayGameUI&LocationID=" . $objXRLocation->getLocationID() . "'><button type='button'>" . $objLocation->getLinkName($objXRLocation->getLocationID()) . "</button></a>";
				}
				
				foreach($arrEventLinks as $objEvent){
					echo "<a href='main.php?page=DisplayGameUI&LocationID=" . $objLocation->getLocationID() . "&EventID=" . $objEvent->getEventID() . "'><button type='button'>" . $objEvent->getLinkName($objLocation->getLocationID()) . "</button></a>";
				}
				
				foreach($arrShopLinks as $objShop){
					echo "<a href='main.php?page=DisplayGameUI&LocationID=" . $objLocation->getLocationID() . "&ShopID=" . $objShop->getShopID() . "'><button type='button'>" . $objShop->getLinkName($objLocation->getLocationID()) . "</button></a>";
				}
				
				if($objLocation->getLocationID() == 1){
					foreach($arrFloorLinks as $objFloor){
						echo "<a href='main.php?page=DisplayGameUI&EnterFloorID=" . $objFloor->getFloorID() . "'><button type='button'>Floor " . $objFloor->getFloorID() . "</button></a>";
					}
				}
				
				?>
			</div>
		
		<?php
		$strHTML = ob_get_contents();
		ob_end_clean();
		
		echo $strHTML;
	}

}

?>