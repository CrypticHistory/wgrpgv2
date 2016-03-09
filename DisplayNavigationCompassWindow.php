<?php

include_once "UISettings.php";

class DisplayNavigationCompassWindow{

	public function DisplayNavigationCompassWindow(){
		
	}
	
	public static function toHTML(){
		ob_start(); ?>
		
			<div class='compassDiv' id='compassDiv'>
				<?php if(!$_SESSION['objUISettings']->getDisableTraversal()){ ?>
				<?php if(0){ ?>
				<form action='command.php' method='post'>
					<div class='compassNLine'>
						<input name='traverse' class='compass' type='submit' value='North'/>
					</div>
					<div class='compassMidLine'>
						<input name='traverse' class='fL compass' type='submit' value='West'/>
						<input name='traverse' class='fR compass' type='submit' value='East'/>
					</div>
					<div class='compassSLine'>
						<input name='traverse' class='compass' type='submit' value='South'/>
					</div>
				</form>
				<?php } ?>
				<form action='command.php' method='post'>
					<input name='traverse' class='fL compass' type='submit' value='Explore'/>
					<input name='exitField' class='fL compass' type='submit' value='Return to Town'/>
				</form>
				<?php } else { ?>
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