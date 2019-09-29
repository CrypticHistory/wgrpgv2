<?php

class DisplayUseInventory{

	public function __construct(){
		
	}
	
	public function toHTML(){
		ob_start(); ?>
		
			<script type='text/javascript'>
				$(function() {
					$( ".invTable > tbody > tr > #itemName" ).draggable({
						appendTo: "body",
						helper: "clone"
					});
				});
			</script>
		
			<div class='inventoryDiv hidden' id='inventoryDivConsumable'>
				<?php if(!$_SESSION['objUISettings']->getDisableInv()){?>
				<table class='invTable'>
					<thead>
						<th class='itemNameHeader borderBottom'>Item Name</th>
						<th class='itemTypeHeader borderBottom'>Type</th>
					</thead>
					<tbody>
					<?php
						$arrUseItems = $this->getUseInventory();
						$intCounter = 0;
						foreach($arrUseItems as $intKey => $arrCategoryNames){
							echo "<tr class='textCenter' id='useItem" . $intCounter . "'>";
							echo "<td id='itemName'><a href=\"javascript:showItemDetails('use', '" . $intCounter . "');\">" . $arrCategoryNames['strItemName'] . "</td>";
							echo "<td class='hidden' name='itemInstanceID'>" . $arrCategoryNames['intItemInstanceID'] . "</td>";
							echo "<td class='hidden' name='itemID'>" . $arrCategoryNames['intItemID'] . "</td>";
							echo "<td class='hidden' name='itemSellPrice'>" . $arrCategoryNames['intSellPrice'] . "</td>";
							echo "<td>" . $arrCategoryNames['strItemType'] . "</td>";
							echo "</tr>";
							echo "<tr id='useItemDetails" . $intCounter . "' class='hidden'><td colspan='4' class='itemDesc'><b>Description:</b><br/>" . $arrCategoryNames['txtItemDesc'] . "<br/>
									<form method='post' action='command.php'>
										<input type='hidden' name='itemInstanceID' value='" . $arrCategoryNames['intItemInstanceID'] . "'/>
										<input type='hidden' name='itemID' value='" . $arrCategoryNames['intItemID'] . "'/>
										<input type='hidden' name='itemHPHeal' value='" . $arrCategoryNames['intHPHeal'] . "'/>
										<input type='hidden' name='itemFullness' value='" . $arrCategoryNames['intFullness'] . "'/>
										<button type='submit' name='itemAction' value='use'>Use</button>
										<button type='submit' name='itemAction' value='drop'>Drop</button>
									</form></td><td></td><td></td>
								  </tr>";
							$intCounter++;
						}
					?>
					</tbody>
				</table>
				<?php } else { ?>
					<div class='insideOther'>
						Your inventory is locked during this event.
					</div>
				<?php } ?>
			</div>
		
		<?php
		$strHTML = ob_get_contents();
		ob_end_clean();
		
		echo $strHTML;
	}
	
	private function getUseInventory(){
		$arrReturn = array();
		$objDB = new Database();
		$strSQL = "SELECT intItemInstanceID, strItemName, txtItemDesc, strItemType, intItemID, intFullness, intSellPrice, intCalories, intHPHeal
					FROM tblitem
						INNER JOIN tblcharacteritemxr
						USING (intItemID)
					WHERE (strItemType = 'Food' OR strItemType = 'Potion')
							AND blnDigesting = 0
							AND intRPGCharacterID = " . $objDB->quote($_SESSION['objRPGCharacter']->getRPGCharacterID());
		$rsResult = $objDB->query($strSQL);
		$intCounter = 0;
		while($arrRow = $rsResult->fetch(PDO::FETCH_ASSOC)){
			$arrReturn[$intCounter]['intItemInstanceID'] = $arrRow['intItemInstanceID'];
			$arrReturn[$intCounter]['strItemName'] = $arrRow['strItemName'];
			$arrReturn[$intCounter]['txtItemDesc'] = $arrRow['txtItemDesc'];
			$arrReturn[$intCounter]['strItemType'] = $arrRow['strItemType'];
			$arrReturn[$intCounter]['intHPHeal'] = $arrRow['intHPHeal'];
			$arrReturn[$intCounter]['intFullness'] = $arrRow['intFullness'];
			$arrReturn[$intCounter]['intSellPrice'] = $arrRow['intSellPrice'];
			$arrReturn[$intCounter]['intCalories'] = $arrRow['intCalories'];
			$arrReturn[$intCounter]['intItemID'] = $arrRow['intItemID'];
			$arrReturn[$intCounter]['txtItemDesc'] .= "<br/><i>* Heals " . $arrRow['intHPHeal'] . " HP, and contains " . $arrRow['intCalories'] . " calories.</i>";
			$intCounter++;
		}
		return $arrReturn;
	}

}

?>