<?php

class DisplayReturnCommandsWindow{

	public function __construct(){
		
	}
	
	public static function toHTML(){
		ob_start(); ?>

			<div class='commandsDiv' id='commandsDivReturnCommands'>
				<form method='post' action='command.php'>
					<button type='submit' name='return' value='return'>Return</button>
				</form>
			</div>
		
		<?php
		$strHTML = ob_get_contents();
		ob_end_clean();
		
		echo $strHTML;
	}

}

?>