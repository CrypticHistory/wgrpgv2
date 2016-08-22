<?php

class DisplayCombatWindow{

	public function DisplayCombatWindow(){
		
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
								<div class="combatSubHeader">Player</div>
								<div class="combatHPBar"><progress max="<?=$_SESSION['objCombat']->getPlayer()->getModifiedMaxHP()?>" value="<?=$_SESSION['objCombat']->getPlayer()->getCurrentHP()?>"></progress></div>
							</div>
							
							<div class="combatTopMid">
								<div class="combatHeader">VS. <?=$_SESSION['objCombat']->getEnemy()->getNPCName()?></div>
								<div class="combatTurnCount">
									Turn: <?=$_SESSION['objCombat']->getTurnCount()?>
								</div>
							</div>
							
							<div class="combatTopRight">
								<div class="combatSubHeader">Enemy</div>
								<div class="combatHPBar"><progress max="<?=$_SESSION['objCombat']->getEnemy()->getModifiedMaxHP()?>" value="<?=$_SESSION['objCombat']->getEnemy()->getCurrentHP()?>"></progress></div>
							</div>
						</div>
						
						<div class="combatTurnLog">
							<div class="combatLogHeader">Combat Log</div>
							<?php
							
							for($i=1;$i<=$_SESSION['objCombat']->getTurnCount();$i++){
								
								if($_SESSION['objCombat']->getCombatMessage("Combat")[$i]["Player"] == ""){
									$strPlayerTurn = "";
								}
								else{
									$strPlayerTurn = "<div class='combatTurn player'>" . $_SESSION['objCombat']->getCombatMessage("Combat")[$i]["Player"] . "</div>";
								}
								
								if($_SESSION['objCombat']->getCombatMessage("Combat")[$i]["Enemy"] == ""){
									$strEnemyTurn = "";
								}
								else{
									$strEnemyTurn = "<div class='combatTurn enemy'>" . $_SESSION['objCombat']->getCombatMessage("Combat")[$i]["Enemy"] . "</div>";
								}
								
								echo $strPlayerTurn;
								echo $strEnemyTurn;
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