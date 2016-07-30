<?php

class DisplayCombatCommandsWindow{

	public function DisplayCombatCommandsWindow(){
		
	}
	
	public static function toHTML(){
		ob_start(); ?>

			<div class='commandsDiv' id='commandsDivCombatCommands'>
				<?php if(isset($_SESSION['objCombat'])){ ?>
				<form method='post' action='combat.php'>
					<table>
						<tr>
						<?php if($_SESSION['objCombat']->getCombatState() != 'In Progress'){ ?>
							<td><button type='submit' name='command' value='end'>Continue</button></td>
						<?php } else { ?>
							<td><button type='submit' name='command' value='attack'>Attack</button></td>
							<?php if($_SESSION['objCombat']->getEnemy()->getNPCName() != 'Seraphine the Tutorial Fairy'){?>
							<td><button type='submit' name='command' value='wait'>Wait</button></td>
							<td><button type='submit' name='command' value='flee'>Flee</button></td>
						</tr>
					</table>
					<table>
						<tr>
							
						</tr>
					</table>
						<?php } 
					} ?>
					</table>
				</form>
				<?php } else { ?>
				<form method='post' action='command.php'>
					<button type='submit' name='return' value='return'>Return</button>
				</form>
				<?php } ?>
			</div>
		
		<?php
		$strHTML = ob_get_contents();
		ob_end_clean();
		
		echo $strHTML;
	}

}

?>