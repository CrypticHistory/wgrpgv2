<?php

class DisplayCharacterSkills{

	public function DisplayCharacterSkills(){
		
	}
	
	public static function toHTML(){
		ob_start(); ?>
		
			<div class='characterDiv hidden' id='characterDivSkills'>
				Skills
			</div>
		
		<?php
		$strHTML = ob_get_contents();
		ob_end_clean();
		
		echo $strHTML;
	}

}

?>