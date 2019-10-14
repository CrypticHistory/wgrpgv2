<?php

class DisplayCombatCommandsWindow{

	public function __construct(){
		
	}
	
	public static function toHTML(){
		ob_start(); ?>
		
			<script type='text/javascript'>

				$(document).ready(function(){
					
					if($('#hiddenTarget').length == 0){
						$("#attackButton").on("click", function(){
							$("#skillButton").attr("disabled", false);
							$("#confirmButtonCol").html("<button type='submit' id='confirmButton'>Confirm</button>");
							$(this).attr("disabled", true);
							$("#targetTable").removeClass("hidden");
							$("#skillTable").addClass("hidden");
							$(".hiddenAction").each(function(){
								$(this).remove();
							});
							$(this).after("<input class='hiddenAction' type='hidden' name='command' value='attack'/>");
						});
					}
					else{
						$("#attackButton").on("click", function(){
							$(".hiddenAction").each(function(){
								$(this).remove();
							});
							$(this).after("<input class='hiddenAction' type='hidden' name='command' value='attack'/>");
							$("#attackForm").submit();
						});
					}
					
					$("#skillButton").on("click", function(){
						$("#attackButton").attr("disabled", false);
						$(this).attr("disabled", true);
						$("#targetTable").removeClass("hidden");
						$("#skillTable").removeClass("hidden");
						$(".hiddenAction").each(function(){
							$(this).remove();
						});
						$(this).after("<input class='hiddenAction' type='hidden' name='command' value='skill'/>");
					});
					
					$("#confirmButton").on("click", function(){
						$("#attackForm").submit();
					});
					
					$(".skillRadio").change(function(){
						if($(this).attr("targets") == "3"){
							$(".allEnemyTargets").removeClass("hidden");
							$(".individualTargets").addClass("hidden");
							$("#leaderRadio").prop("checked", false);
							$("#enemyOneRadio").prop("checked", false);
							$("#enemyTwoRadio").prop("checked", false);
							$("#allEnemyRadio").prop("checked", true);
						}
						else{
							$(".allEnemyTargets").addClass("hidden");
							$(".individualTargets").removeClass("hidden");
							$("#enemyOneRadio").prop("checked", false);
							$("#enemyTwoRadio").prop("checked", false);
							$("#allEnemyRadio").prop("checked", false);
							$("#leaderRadio").prop("checked", true);
							if(!$("#leaderRadio").length && !$("#enemyOneRadio").length){
								$("#enemyTwoRadio").prop("checked", true);
							}
							else if(!$("#leaderRadio").length){
								$("#enemyOneRadio").prop("checked", true);
							}
						}
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
							<td><button id='attackButton' type='button' name='command' value='attack'>Attack</button></td>
							<input id='hiddenTarget' type='hidden' name='target' value='Leader'/>
							<?php } else { ?>
							<td><button id='attackButton' type='button' name='command' value='attack'>Attack</button></td>
							<?php } ?>
							<?php if($_SESSION['objCombat']->getEnemyTeam()->getLeader()->getNPCName() != 'Seraphine the Tutorial Fairy'){?>
							<td><button id='skillButton' type='button' name='command' value='skill'>Skill</button></td>
							<td><button type='submit' name='command' value='wait'>Wait</button></td>
							<td><button type='submit' name='command' value='flee'>Flee</button></td>
						<?php } ?>
						</tr>
					<?php } ?>
					</table>
					<table id='skillTable' class='hidden'>
						<tr>
							<td>Skill:</td>
							<?php
							
							
							if(!$_SESSION['objRPGCharacter']->getClasses()->getCurrentClass()){
								echo "<td>No skills available.</td>";
								$blnDisableConfirm = true;
							}
							else{
								$intCounter = 0;
								$arrSkillCooldowns = array();
								foreach($_SESSION['objRPGCharacter']->getClasses()->getCurrentClass()->getSkills()->getActiveSkillList() as $intSkillID => $objSkill){
									$strChecked = (($intCounter == 0 && $objSkill->isOffCooldown()) ? " checked='checked'" : "");
									$strDisabled = $objSkill->isOffCooldown() ? "" : " disabled";
									if(!$objSkill->isOffCooldown()){
										$arrSkillCooldowns[] = true;
									}
									else{
										$arrSkillCooldowns[] = false;
									}
									echo "<td><input class='skillRadio' targets='" . $objSkill->getTargetCount() . "' type='radio' name='intSkillID' value='" . $intSkillID . "'" . $strChecked . $strDisabled . ">" . $objSkill->getSkillName() . " (" . $objSkill->getCurrentCooldown() . ")</td>";
									$intCounter++;
								}

								if(count(array_unique($arrSkillCooldowns)) === 1){
									$blnDisableConfirm = current($arrSkillCooldowns);
								}
								else{
									$blnDisableConfirm = false;
								}
							}
							
							?>
						</tr>
					</table>
					<table id='targetTable' class='hidden'>
						<tr>
							<td>Target:</td>
							<?php
							if(isset($_SESSION['objCombat']->getWaitTimes()["Leader"])){ ?>
							<td class='individualTargets'><input id='leaderRadio' type='radio' name='target' value='Leader' checked="checked"/> Leader</td>
							<?php }
							if(isset($_SESSION['objCombat']->getWaitTimes()["EnemyOne"])){ ?>
							<td class='individualTargets'><input id='enemyOneRadio' type='radio' name='target' value='EnemyOne' <?=(!isset($_SESSION['objCombat']->getWaitTimes()["Leader"]) ? "checked='checked'" : "")?>/> Enemy One</td>
							<?php }
							if(isset($_SESSION['objCombat']->getWaitTimes()["EnemyTwo"])){ ?>
							<td class='individualTargets'><input id='enemyTwoRadio' type='radio' name='target' value='EnemyTwo' <?=((!isset($_SESSION['objCombat']->getWaitTimes()["Leader"]) && !isset($_SESSION['objCombat']->getWaitTimes()["EnemyOne"])) ? "checked='checked'" : "")?>/> Enemy Two</td>
							<?php } ?>
							<td class='allEnemyTargets hidden'><input id='allEnemyRadio' type='radio' name='target' value='AllEnemy'/> All Enemies</td>
						</tr>
						<tr>
							<td id='confirmButtonCol'>
						<?php
						if(!$blnDisableConfirm){
						?>
								<button type='button' id='confirmButton'>Confirm</button>
						<?php
						}
						?>
							</td>
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