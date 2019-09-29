<?php

	include_once 'RPGClass.php';
	include_once 'RPGSkill.php';
	include_once 'RPGStatusEffect.php';

class DisplaySkillViewWindow{

	public function __construct(){
		
	}
	
	public static function toHTML(){
		ob_start(); ?>
		
			<script type='text/javascript'>

				$(document).ready(function(){
					
					$('.skillUseButton').click(function(){
						skillID = $(this).attr("skillid");
						classID = $(this).attr("classid");
						window.location.replace("useSkill.php?intSkillID=" + skillID + "&intClassID=" + classID);
					});
					
				});

			</script>
		
			<?php
			if(isset($_GET['intClassID'])){
				$objClass = new RPGClass($_GET['intClassID'], $_SESSION['objRPGCharacter']->getRPGCharacterID(), true);
			
			?>
			
			<div class='eventDiv' id='eventDivSkillViewWindow'>
				<div class='insideEvent'>
					<h3>Skill List - <?=$objClass->getClassName()?></h3>
					<table class='charTable'>
						<thead>
							<th class='greyBG' style="width:23%;" title="Name">Name</th>
							<th class='greyBG' style="width:12%;" title="Weapon Requirement">WR</th>
							<th class='greyBG' style="width:7.5%;" title="Cooldown">CD</th>
							<th class='greyBG' style="width:50%;" title="Description">Desc.</th>
							<th class='greyBG'></th>
						</thead>
						<tbody>
							<?php
								
								foreach($objClass->getSkills()->getSkillList() as $intSkillID => $objSkill){
									
									$strDisabledText = (($objSkill->getUsableOutsideBattle() && $_SESSION['objRPGCharacter']->getClasses()->getCurrentClass()->getClassID() == $objClass->getClassID() && $_SESSION['objRPGCharacter']->getTownID() < 1) ? "" : " disabled");
									
									if($_SESSION['objRPGCharacter']->getClasses()->getCurrentClass() != false){
										if($objSkill->getUsableOutsideBattle() && $_SESSION['objRPGCharacter']->getClasses()->getCurrentClass()->getClassID() == $objClass->getClassID()){
											$strButtonTitle = "Use Skill";
										}
										else if(!$objSkill->getUsableOutsideBattle() && $_SESSION['objRPGCharacter']->getClasses()->getCurrentClass()->getClassID() == $objClass->getClassID()){
											$strButtonTitle = "This skill is not usable outside of battle.";
										}
										else{
											$strButtonTitle = "This skill cannot be used because the class it belongs to is currently disabled.";
										}
									}
									else{
										$strButtonTitle = "This skill cannot be used because the class it belongs to is currently disabled.";
									}
									
									if($objSkill->getStatusEffectID() != NULL){
										$objStatusEffect = new RPGStatusEffect(NULL, $objSkill->getStatusEffectID());
										if($objStatusEffect->getKillBuff()){
											if($_SESSION['objRPGCharacter']->hasStatusEffect($objStatusEffect->getStatusEffectName())){
												$strButtonText = "Deactivate";
											}
											else{
												$strButtonText = "Activate";
											}
										}
										else{
											$strButtonText = "Use";
										}
									}
									else{
										$strButtonText = "Use";
									}
									
									echo "<tr><td class='textCenter'>" . $objSkill->getSkillName() . "</td><td class='textCenter'>" . $objSkill->getWeaponType() . "</td><td class='textCenter'>" . $objSkill->getCooldown() . "</td><td>" . $objSkill->getSkillDesc() . "</td><td><button class='skillUseButton' classid='" . $objClass->getClassID() . "' skillid='" . $objSkill->getSkillID() . "' type='button'" . $strDisabledText . " title='" . $strButtonTitle . "'>" . $strButtonText . "</button></td></tr>";
								}
							
							?>
						</tbody>
					</table>
				</div>
			</div>
			
			<?php
			
			}
			else{
				echo "<div class='eventDiv' id='eventDivSkillViewWindow'>
						<div class='insideEvent'>
							<h3>Skill List</h3>
							No class ID specified.
						</div>
					  </div>";
			}
			
			?>
		
		<?php
		$strHTML = ob_get_contents();
		ob_end_clean();
		
		echo $strHTML;
	}

}

?>