<?php

define("intTICKS_TO_DIGEST", 8);
define("intCALORIES_PER_POUND", 2000);
define("dblLBS_PER_KG", 2.2);
define("dblCM_PER_FOOT", 30.48);
define("intFEET_PER_INCH", 12);

$arrNumberedClothingSizes = array(0 => "XS", 1 => "S", 2 => "M", 3 => "L", 4 => "XL", 5 => "XXL", 6 => "XXXL", 7 => "XXXXL");
$arrClothingSizes = array("XS" => 5, "S" => 15, "M" => 25, "L" => 35, "XL" => 45, "XXL" => 55, "XXXL" => 65, "XXXXL" => 75, "Stretch" => 0);

$arrArmourBodyParts = array("Arms", "Breasts", "Belly", "Butt", "Legs");
$arrTopBodyParts = array("Arms", "Breasts", "Belly");
$arrBottomBodyParts = array("Legs", "Butt", "Belly");

$arrStateNames = array(1 => "Event", 2 => "Combat", 3 => "Field", 4 => "Town", 5 => "Dungeon", 6 => "Shop", 7 => "Dead", 8 => "Tutorial", 9 => "Stats", 10 => "Skills", 11 => "Party");
$arrStateValues = array("Event" => 1, "Combat" => 2, "Field" => 3, "Town" => 4, "Dungeon" => 5, "Shop" => 6, "Dead" => 7, "Tutorial" => 8, "Stats" => 9, "Skills" => 10, "Party" => 11);

?>