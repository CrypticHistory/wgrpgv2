<?php

class DisplayCombatWindow{

	public function __construct(){
		
	}
	
	public static function toHTML(){
		ob_start(); ?>
		
			<script type='text/javascript'>
				$(document).ready(function(){
					$('.combatTurnLog').scrollTop($('.combatTurnLog')[0].scrollHeight);
				});
			</script>
		
			<div class='combatDiv' id='eventDivCombatWindow'>
				<?php
				
					if(isset($_SESSION['objCombat'])){
						?>
						
						<div class="combatTopLine">
						
							<div class="combatTopLeft">
								<div class="combatSubHeader">Player Team</div>
								<div class="combatHPBar"><progress max="<?=$_SESSION['objCombat']->getPlayerTeam()->getPlayer()->getModifiedMaxHP()?>" value="<?=$_SESSION['objCombat']->getPlayerTeam()->getPlayer()->getCurrentHP()?>"></progress></div>
								<?php
								
								if($_SESSION['objCombat']->getPlayerTeam()->getPartyOne() != null){
									echo "<div class='combatHPBar'><progress max=" . $_SESSION['objCombat']->getPlayerTeam()->getPartyOne()->getModifiedMaxHP() . " value=" . $_SESSION['objCombat']->getPlayerTeam()->getPartyOne()->getCurrentHP() . "></progress></div>";
								}
								
								if($_SESSION['objCombat']->getPlayerTeam()->getPartyTwo() != null){
									echo "<div class='combatHPBar'><progress max=" . $_SESSION['objCombat']->getPlayerTeam()->getPartyTwo()->getModifiedMaxHP() . " value=" . $_SESSION['objCombat']->getPlayerTeam()->getPartyTwo()->getCurrentHP() . "></progress></div>";
								}
								
								?>
							</div>
							
							<div class="combatTopMid">
								<div class="combatHeaderVersus">VS.</div>
								<div class="combatHeader"><?=$_SESSION['objCombat']->getEnemyTeam()->getLeader()->getNPCName()?></div>
								<?php
								
								if($_SESSION['objCombat']->getEnemyTeam()->getEnemyOne() != null){
									echo "<div class='combatHeader'>" . $_SESSION['objCombat']->getEnemyTeam()->getEnemyOne()->getNPCName() . "</div>";
								}
								
								if($_SESSION['objCombat']->getEnemyTeam()->getEnemyTwo() != null){
									echo "<div class='combatHeader'>" . $_SESSION['objCombat']->getEnemyTeam()->getEnemyTwo()->getNPCName() . "</div>";
								}
								
								?>
							</div>
							
							<div class="combatTopRight">
								<div class="combatSubHeader">Enemy Team</div>
								<div class="combatHPBar"><progress max="<?=$_SESSION['objCombat']->getEnemyTeam()->getLeader()->getModifiedMaxHP()?>" value="<?=$_SESSION['objCombat']->getEnemyTeam()->getLeader()->getCurrentHP()?>"></progress></div>
								<?php
								
								if($_SESSION['objCombat']->getEnemyTeam()->getEnemyOne() != null){
									echo "<div class='combatHPBar'><progress max=" . $_SESSION['objCombat']->getEnemyTeam()->getEnemyOne()->getModifiedMaxHP() . " value=" . $_SESSION['objCombat']->getEnemyTeam()->getEnemyOne()->getCurrentHP() . "></progress></div>";
								}
								
								if($_SESSION['objCombat']->getEnemyTeam()->getEnemyTwo() != null){
									echo "<div class='combatHPBar'><progress max=" . $_SESSION['objCombat']->getEnemyTeam()->getEnemyTwo()->getModifiedMaxHP() . " value=" . $_SESSION['objCombat']->getEnemyTeam()->getEnemyTwo()->getCurrentHP() . "></progress></div>";
								}
								
								?>
							</div>
						</div>
						
						<div class="combatTurnLog">
							<div class="combatLogHeader">Combat Log</div>
							<?php
							
							foreach($_SESSION['objCombat']->getCombatMessage("Entity") as $intIndex => $strEntity){
								
								if($strEntity == "Player" || $strEntity == "PartyOne" || $strEntity == "PartyTwo"){
									echo "<div class='combatTurn player'>" . $_SESSION['objCombat']->getCombatMessage("Action")[$intIndex] . "</div>";
								}
								else{
									echo "<div class='combatTurn enemy'>" . $_SESSION['objCombat']->getCombatMessage("Action")[$intIndex]  . "</div>";
								}
								
							}
							
							if(!empty($_SESSION['objCombat']->getCombatMessage("System"))){
								
								?>
								
								<div class="combatSystemMessage system">
								
								<?php
								
								foreach($_SESSION['objCombat']->getCombatMessage("System") as $key => $strCombatMessage){
									echo $strCombatMessage . "<br/>";
								}
							
								?>
								
								</div>
								
								<?php
							}
							
							?>
							
						
						</div>
						
						<?php
						
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