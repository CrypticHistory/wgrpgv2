<?php

	include_once 'RPGClass.php';
	include_once 'RPGSkill.php';

class DisplaySkillViewWindow{

	public function DisplaySkillViewWindow(){
		
	}
	
	public static function toHTML(){
		ob_start(); ?>
		
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
									echo "<tr><td class='textCenter'>" . $objSkill->getSkillName() . "</td><td class='textCenter'>" . $objSkill->getWeaponType() . "</td><td class='textCenter'>" . $objSkill->getCooldown() . "</td><td>" . $objSkill->getSkillDesc() . "</td><td><button type='button'" . ($objSkill->getUsableOutsideBattle() ? "" : " disabled title='This skill cannot be used outside of battle'") . ">Use</button></td></tr>";
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