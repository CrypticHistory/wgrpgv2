<?php

include_once "UISettings.php";
include_once "RPGLocation.php";

class DisplayNavigationMenuWindow{

	public function __construct(){
		
	}
	
	public static function toHTML(){
		ob_start(); ?>
		
			<div class='compassDiv' id='menuDiv'>
				<?php
				
				if(!$_SESSION['objUISettings']->getDisableTraversal()){
					echo "<table class='innerBorder'>";
					echo "<thead>";
					echo "<th colspan='2' class='textCenter'>Districts</th>";
					echo "</thead>";
					echo "<tbody>";
					echo "<tr>";
					echo "<td><a href='main.php?page=DisplayGameUI&LocationID=2'><input type='button' class='compass' value='Residential'></input></a></td>";
					echo "<td><a href='main.php?page=DisplayGameUI&LocationID=3'><input type='button' class='compass' value='Commercial'></input></a></td>";
					echo "</tr>";
					echo "<tr>";
					echo "<td><a href='main.php?page=DisplayGameUI&LocationID=4'><input type='button' class='compass' value='Development'></input></a></td>";
					echo "<td><a href='main.php?page=DisplayGameUI&LocationID=5'><input type='button' class='compass' value='Red Light'></input></a></td>";
					echo "</tr>";
					echo "<tr>";
					echo "<td class='textCenter' colspan='2'><a href='main.php?page=DisplayGameUI&LocationID=1'><input type='button' class='compass' value='Tower Entrance'></input></a></td>";
					echo "</tr>";
					echo "</tbody>";
					echo "</table>";
					
				} else { ?>
				<div class='insideOther'>
					Traversing is currently disabled.
				</div>
				<?php } ?>
			</div>
		
		<?php
		$strHTML = ob_get_contents();
		ob_end_clean();
		
		echo $strHTML;
	}

}

?>