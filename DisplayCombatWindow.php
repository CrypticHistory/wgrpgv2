<?php

class DisplayCombatWindow{

	public function DisplayCombatWindow(){
		
	}
	
	public static function toHTML(){
		ob_start(); ?>
		
			<div class='eventDiv' id='eventDivCombatWindow'>
				<?php
				
					if(isset($_SESSION['objCombat'])){
						foreach($_SESSION['objCombat']->getCombatMessage() as $key => $strCombatMessage){
							echo $strCombatMessage;
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