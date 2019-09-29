<?php

class DisplayStatGainWindow{

	public function __construct(){
		
	}
	
	public static function toHTML(){
		ob_start(); ?>
		
			<script src="JS/jquery.numeric.js" type="text/javascript"></script>
			<script type='text/javascript'>

				$(document).ready(function(){
					$('input[type=text]').numeric();
					$('input[type=text]').keypress(function(event) {
					  if ( event.which == 45 || event.which == 189 ) {
						  event.preventDefault();
					   }
					});
				});

			</script>
		
			<div class='eventDiv' id='eventDivStatGainWindow'>
				<div class='insideEvent'>
					<h3>Stat Allocation</h3>
					<h4>Stat points available: <?=$_SESSION['objRPGCharacter']->getStatPoints()?></h4>
					<form method='post' action='statgain.php'>
						<table>
							<tr>
								<td>Strength:</td><td><input type='text' name='intStrength' value='0'/></td>
							</tr>
							<tr>
								<td>Intelligence:</td><td><input type='text' name='intIntelligence' value='0'/></td>
							</tr>
							<tr>
								<td>Agility:</td><td><input type='text' name='intAgility' value='0'/></td>
							</tr>
							<tr>
								<td>Vitality:</td><td><input type='text' name='intVitality' value='0'/></td>
							</tr>
							<tr>
								<td>Willpower:</td><td><input type='text' name='intWillpower' value='0'/></td>
							</tr>
							<tr>
								<td>Dexterity:</td><td><input type='text' name='intDexterity' value='0'/></td>
							</tr>
						</table>
						<button type='submit'>Save</button>
					</form>
				<?php 
					if(isset($_SESSION['strStatError'])){
						echo $_SESSION['strStatError'];
						unset($_SESSION['strStatError']);
					}
				?>
				</div>
			</div>
		
		<?php
		$strHTML = ob_get_contents();
		ob_end_clean();
		
		echo $strHTML;
	}

}

?>