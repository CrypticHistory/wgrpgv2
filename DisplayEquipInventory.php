<?php

class DisplayEquipInventory{

	public function DisplayEquipInventory(){
		
	}
	
	public function toHTML(){
		ob_start(); ?>
		
			<script type='text/javascript'>
				$(function() {
					$( ".invTable > tbody > tr > #itemName" ).draggable({
						cancel: ".equipped",
						appendTo: "body",
						helper: "clone"
					});
				});
			</script>
		
			<div class='inventoryDiv hidden' id='inventoryDivEquipment'>
				<?php if(!$_SESSION['objUISettings']->getDisableInv()){?>
				<table class='invTable'>
					<thead>
						<th class='itemNameHeader borderBottom'>Item Name</th>
						<th class='itemTypeHeader borderBottom'>Type</th>
					</thead>
					<tbody>
					<?php
						$arrUseItems = $this->getEquipInventory();
						$intCounter = 0;
						
						foreach($arrUseItems as $intKey => $arrCategoryNames){
							$arrItemType = explode(':', $arrCategoryNames['strItemType']);
							if($arrItemType[0] == 'Armour'){
								$strItemType = $arrItemType[1];
							}
							else{
								$strItemType = $arrItemType[0];
							}
							if(isset($_SESSION['objUISettings']->getOverrides()[1]) && $arrItemType[0] == 'Armour'){
								$strDisabled = " disabled ";
							}
							else{
								$strDisabled = "";
							}
							
							echo "<tr class='textCenter' id='equipItem" . $intCounter . "'>";
							echo "<td id='itemName' class='" . (($_SESSION['objRPGCharacter']->isEquipped($arrCategoryNames['intItemInstanceID'])) ? "equipped" : "") . "'><a href=\"javascript:showItemDetails('equip', '" . $intCounter . "');\"><span class='prefix'>" . $arrCategoryNames['strPrefix'] . "</span> <span class='suffix'>" . $arrCategoryNames['strSuffix'] . "</span> <span class='itemName'>" . $arrCategoryNames['strItemName'] . "</span></a>" . ($_SESSION['objRPGCharacter']->isEquipped($arrCategoryNames['intItemInstanceID']) ? " (E)" : "") . "</td>";
							echo "<td class='hidden' name='itemInstanceID'>" . $arrCategoryNames['intItemInstanceID'] . "</td>";
							echo "<td class='hidden' name='itemID'>" . $arrCategoryNames['intItemID'] . "</td>";
							echo "<td class='hidden' name='itemSellPrice'>" . $arrCategoryNames['intSellPrice'] . "</td>";
							echo "<td class='hidden' name='itemType'>" . $strItemType . "</td>";
							echo "<td>" . $arrItemType[1] . "</td>";
							echo "</tr>";
							echo "<tr id='equipItemDetails" . $intCounter . "' class='hidden'><td colspan='5' class='itemDesc background" . ($intCounter % 2) . "'><b>Description:</b><br/>" . $arrCategoryNames['txtItemDesc'] . "
									<form method='post' action='command.php'>
										<input type='hidden' name='itemInstanceID' value='" . $arrCategoryNames['intItemInstanceID'] . "'/>
										<input type='hidden' name='itemType' value='" . $strItemType . "'/>
										<input type='hidden' name='itemID' value='" . $arrCategoryNames['intItemID'] . "'/>
										<button type='submit' name='itemAction'" . $strDisabled . "value='" . ($_SESSION['objRPGCharacter']->isEquipped($arrCategoryNames['intItemInstanceID']) ? "unequip'>Unequip" : "equip'>Equip") . "</button>
										" . ($_SESSION['objRPGCharacter']->isEquipped($arrCategoryNames['intItemInstanceID']) ? "" : "<button type='submit' name='itemAction' value='drop'>Drop</button>") . "
										<a href=\"javascript:viewItem(" . $arrCategoryNames['intItemID'] . ", '" . $arrCategoryNames['strItemName'] . "');\"><button type='button' id='viewButton" . $arrCategoryNames['intItemInstanceID'] . "'>View</button></a> 
									</form></td><td></td><td></td>
								  </tr>";
							$intCounter++;
						}
					?>
					</tbody>
				</table>
					<?php } else { ?>
					<div class='insideOther'>
						Your equipment inventory is locked during this event.
					</div>
					<?php } ?>
			</div>
		
		<?php
		$strHTML = ob_get_contents();
		ob_end_clean();
		
		echo $strHTML;
	}

	private function getEquipInventory(){
		$arrReturn = array();
		$objDB = new Database();
		$strSQL = "SELECT tblcharacteritemxr.intItemInstanceID as intItemInstanceID, strItemName, txtItemDesc, intItemID, intSellPrice, strItemType, intDamage, intDefence, strSize, tblSuffix.strEnchantName as strSuffix, tblPrefix.strEnchantName as strPrefix
					FROM tblitem
						INNER JOIN tblcharacteritemxr
							USING (intItemID)
						LEFT JOIN tbliteminstanceenchant
							USING (intItemInstanceID)
						LEFT JOIN tblenchant tblSuffix
							ON (tbliteminstanceenchant.intSuffixEnchantID = tblSuffix.intEnchantID)
						LEFT JOIN tblenchant tblPrefix
							ON (tbliteminstanceenchant.intPrefixEnchantID = tblPrefix.intEnchantID)
					WHERE (strItemType LIKE 'Armour:%' OR strItemType = 'Accessory' OR strItemType LIKE 'Weapon:%')
							AND intRPGCharacterID = " . $objDB->quote($_SESSION['objRPGCharacter']->getRPGCharacterID());
		$rsResult = $objDB->query($strSQL);
		$intCounter = 0;
		while($arrRow = $rsResult->fetch(PDO::FETCH_ASSOC)){
			$arrReturn[$intCounter]['intItemInstanceID'] = $arrRow['intItemInstanceID'];
			$arrReturn[$intCounter]['strItemName'] = $arrRow['strItemName'];
			$arrReturn[$intCounter]['txtItemDesc'] = $arrRow['txtItemDesc'];
			$arrReturn[$intCounter]['intItemID'] = $arrRow['intItemID'];
			$arrReturn[$intCounter]['strItemType'] = $arrRow['strItemType'];
			$arrReturn[$intCounter]['intDamage'] = $arrRow['intDamage'];
			$arrReturn[$intCounter]['intDefence'] = $arrRow['intDefence'];
			$arrReturn[$intCounter]['intSellPrice'] = $arrRow['intSellPrice'];
			$arrReturn[$intCounter]['strSize'] = $arrRow['strSize'];
			$arrReturn[$intCounter]['strPrefix'] = !is_null($arrRow['strPrefix']) ? '[' . $arrRow['strPrefix'] . ']' : '';
			$arrReturn[$intCounter]['strSuffix'] = !is_null($arrRow['strSuffix']) ? '[' . $arrRow['strSuffix'] . ']' : '';
			$intCounter++;
		}
		return $arrReturn;
	}
}

?>