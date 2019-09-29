<?php

include_once "UISettings.php";
include_once "RPGCharacter.php";

class DisplayNavigationCompassWindow{

	public function __construct(){
		
	}
	
	public static function toHTML(){
		ob_start(); ?>
		
			<div class='compassDiv' id='compassDiv'>
				<?php if(!$_SESSION['objUISettings']->getDisableTraversal()){ ?>
				<form action='command.php' method='post'>
					<div class='compassNLine'>
						<input name='traverse' class='compassP' type='submit' value='North' <?=(($_SESSION['objRPGCharacter']->getCurrentFloor()->getMaze()->isValidMove('North')) ? "" : "disabled")?>/>
					</div>
					<div class='compassMidLine'>
						<input name='traverse' class='fL compassP' type='submit' value='West' <?=(($_SESSION['objRPGCharacter']->getCurrentFloor()->getMaze()->isValidMove('West')) ? "" : "disabled")?>/>
						<input name='exitField' class='fL compassReturn' type='submit' value='Return to Town'/>
						<input name='traverse' class='fR compassP' type='submit' value='East' <?=(($_SESSION['objRPGCharacter']->getCurrentFloor()->getMaze()->isValidMove('East')) ? "" : "disabled")?>/>
					</div>
					<div class='compassSLine'>
						<input name='traverse' class='compassP' type='submit' value='South' <?=(($_SESSION['objRPGCharacter']->getCurrentFloor()->getMaze()->isValidMove('South')) ? "" : "disabled")?>/>
					</div>
				</form>
				<?php } else { ?>
					<div class='insideOther'>
						Traversing is currently disabled.
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