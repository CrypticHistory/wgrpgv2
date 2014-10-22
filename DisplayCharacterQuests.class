<?php

class DisplayCharacterQuests{

	public function DisplayCharacterQuests(){
		
	}
	
	public static function toHTML(){
		ob_start(); ?>
		
			<div class='characterDiv hidden' id='characterDivQuests'>
				Quests
			</div>
		
		<?php
		$strHTML = ob_get_contents();
		ob_end_clean();
		
		echo $strHTML;
	}

}

?>