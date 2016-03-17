<?php

class DisplayUseInventory{

	public function DisplayUseInventory(){
		
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
						<th class='caloriesHeader borderBottom'>Calories</th>
						<th class='HPHealHeader borderBottom'>Health</th>
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
							echo "<td>" . $arrCategoryNames['intCalories'] . "</td>";
							echo "<td>" . $arrCategoryNames['intHPHeal'] . "</td>";
							echo "</tr>";
							echo "<tr id='useItemDetails" . $intCounter . "' class='hidden'><td colspan='4' class='itemDesc'><b>Description:</b><br/>" . $arrCategoryNames['txtItemDesc'] . "<br/>
									<form method='post' action='command.php'>
										<input type='hidden' name='itemInstanceID' value='" . $arrCategoryNames['intItemInstanceID'] . "'/>
										<input type='hidden' name='itemHPHeal' value='" . $arrCategoryNames['intHPHeal'] . "'/>
										<button type='submit' name='itemAction' value='use'>Use</button>
										<button type='submit' name='itemAction' value='drop'>Drop</button>
										<a href=\"javascript:viewItem(" . $arrCategoryNames['intItemID'] . ", '" . $arrCategoryNames['strItemName'] . "');\"><button type='button' id='viewButton" . $arrCategoryNames['intItemInstanceID'] . "'>View</button></a> 
									</form></td><td></td><td></td>
								  </tr>";
							$intCounter++;
						}
					?>
					</tbody>
				</table>
				<?php } else { ?>
					Your use inventory is locked during this event.
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
		$strSQL = "SELECT intItemInstanceID, strItemName, txtItemDesc, strItemType, intItemID, intSellPrice, intCalories, intHPHeal
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
			$arrReturn[$intCounter]['intSellPrice'] = $arrRow['intSellPrice'];
			$arrReturn[$intCounter]['intCalories'] = $arrRow['intCalories'];
			$arrReturn[$intCounter]['intItemID'] = $arrRow['intItemID'];
			$intCounter++;
		}
		return $arrReturn;
	}

}

?>