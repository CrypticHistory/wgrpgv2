<?php

class DisplayCombatCommandsWindow{

	public function DisplayCombatCommandsWindow(){
		
	}
	
	public static function toHTML(){
		ob_start(); ?>
		
			<script type='text/javascript'>

				$(document).ready(function(){
					if($('#hiddenTarget').length == 0){
						$("#attackButton").on("click", function(){
							$(this).attr("disabled", true);
							$("#targetTable").removeClass("hidden");
							$(this).after("<input class='hiddenAction' type='hidden' name='command' value='attack'/>");
						});
					}
					$("#confirmButton").on("click", function(){
						$("#attackForm").submit();
					});
				});

			</script>

			<div class='commandsDiv' id='commandsDivCombatCommands'>
				<?php if(isset($_SESSION['objCombat'])){ ?>
				<form id='attackForm' method='post' action='combat.php'>
					<table>
						<tr>
						<?php if($_SESSION['objCombat']->getCombatState() != 'In Progress'){ ?>
							<td><button type='submit' name='command' value='end'>Continue</button></td>
						<?php } else { ?>
							<?php if($_SESSION['objCombat']->getEnemyTeam()->getEnemyOne() == null && $_SESSION['objCombat']->getEnemyTeam()->getEnemyTwo() == null){ ?>
							<td><button id='attackButton' type='submit' name='command' value='attack'>Attack</button></td>
							<input id='hiddenTarget' type='hidden' name='target' value='Leader'/>
							<?php } else { ?>
							<td><button id='attackButton' type='button' name='command' value='attack'>Attack</button></td>
							<?php } ?>
							<?php if($_SESSION['objCombat']->getEnemyTeam()->getLeader()->getNPCName() != 'Seraphine the Tutorial Fairy'){?>
							<td><button type='submit' name='command' value='wait'>Wait</button></td>
							<td><button type='submit' name='command' value='flee'>Flee</button></td>
						<?php } ?>
						</tr>
					<?php } ?>
					</table>
					<table id='skillTable' class='hidden'>
						<tr>
						
						</tr>
					</table>
					<table id='targetTable' class='hidden'>
						<tr>
							<td>Target:</td>
							<?php
							if(isset($_SESSION['objCombat']->getWaitTimes()["Leader"])){ ?>
							<td><input type='radio' name='target' value='Leader'/ checked="checked"> Leader</td>
							<?php }
							if(isset($_SESSION['objCombat']->getWaitTimes()["EnemyOne"])){ ?>
							<td><input type='radio' name='target' value='EnemyOne'/> Enemy One</td>
							<?php }
							if(isset($_SESSION['objCombat']->getWaitTimes()["EnemyTwo"])){ ?>
							<td><input type='radio' name='target' value='EnemyTwo'/> Enemy Two</td>
							<?php } ?>
						</tr>
						<tr>
							<td><button type='button' id='confirmButton'>Confirm</button></td>
						</tr>
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