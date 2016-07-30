<?php

include_once "RPGShop.php";
include_once "RPGItem.php";
include_once "constants.php";
include_once "common.php";

class DisplayShopWindow{

	public function DisplayShopWindow(){
		
	}
	
	public static function toHTML(){
		ob_start(); ?>
		
			<script src="JS/jquery.numeric.js" type="text/javascript"></script>
			<script type='text/javascript'>

				$(document).ready(function(){
					<?php if(isset($_POST['staySell'])){
						echo "$('#sellLink').click();";
					}?>
					
					  $(function() {
						$('#sizeTooltip').tooltip();
						$('#itemNameTooltip').tooltip();
					  });
					
					$('input[type=text]').numeric();
					$('input[type=text]').keypress(function(event) {
					  if ( event.which == 45 || event.which == 189 ) {
						  event.preventDefault();
					   }
					});
					
					$('input[name="quantity[]"]').keyup(function(){
						var total = 0;
						var prices = [];
						var quantities = [];
						$('input[name="price[]"]').each(function(){
							prices.push($(this).val());
						});
						$('input[name="quantity[]"]').each(function(){
							quantities.push($(this).val());
						});
						for (i = 0; i < prices.length; i++) {
							total += prices[i] * quantities[i];
						}
						$('#totalRow').html('<b>' + total + '</b>');
					});
					
					$('#buyLink').click(function(){
						$('#buyForm').show();
						$('#sellForm').hide();
						$('#buyLink').addClass('bold');
						$('#sellLink').removeClass('bold');
					});
					
					$('#sellLink').click(function(){
						$('#sellForm').show();
						$('#buyForm').hide();
						$('#sellLink').addClass('bold');
						$('#buyLink').removeClass('bold');
					});
					
					 $("#sellDiv").droppable({
						drop: function( event, ui ) {
							createNode(ui.draggable.text(), $(ui.draggable).parent(), $(ui.draggable).next('[name="itemInstanceID"]').text(), $(ui.draggable).closest('tr').find('[name="itemID"]').text(), $(ui.draggable).closest('tr').find('[name="itemSellPrice"]').text())
							$('#sellTotalRow').html(parseInt($('#sellTotalRow').text()) + parseInt($(ui.draggable).closest('tr').find('[name="itemSellPrice"]').text()));
							$(ui.draggable).parent().hide();
							$(ui.draggable).parent().next('[id^=equipItemDetails]').hide();
							$('.invTable tbody tr:visible:odd').css({'background-color': '#F5F5F5'});
							$('.invTable tbody tr:visible:even').css({'background-color': '#E8E8E8'});
						}
					});
					
					$('.invTable > tbody > tr > #itemName').mousedown(function(e){
						$('#enchantInfoPrefixDesc').html('');
						$('#enchantInfoSuffixDesc').html('');
						if(e.button == 2){
							$('#enchantInfoItemName').html('<b>' + $(this).find('.itemName:first').text() + '</b>');
							$('#enchantInfoItemName').after("<input type='hidden' name='itemInstanceID' value='" + $(this).next().text() + "'/>")
							$('#enchantInfoItemName').after("<input type='hidden' name='itemType' value='" + $(this).closest('tr').find("[name='itemType']").text() + "'/>");
							$('#enchantInfoPrefixName').text($(this).find('.prefix:first').text());
							if($(this).find('.prefix:first').text() != ''){
								$('#enchantInfoPrefixDesc').html("<button type='submit' value='Prefix' name='Remove'>Remove</button>");
							}
							else{
								$('#enchantInfoPrefixName').html('No Prefix');
							}
							$('#enchantInfoSuffixName').text($(this).find('.suffix:first').text());
							if($(this).find('.suffix:first').text() != ''){
								$('#enchantInfoSuffixDesc').html("<button type='submit' value='Suffix' name='Remove'>Remove</button>");
							}
							else{
								$('#enchantInfoSuffixName').html('No Suffix');
							}
							return false;
						}
						return false;
					});
				});
				
				function createNode(text, origNode, itemInstanceID, itemID, sellPrice) {
				   var $node = $('<span class="node"/>').html(text).append(
					   $('<span class="close"/>').click(function () {
						   if (origNode !== undefined) origNode.show();
						   $(this).parent().next().remove();
						   $(this).parent().next().remove();
						   $(this).parent().remove();
						   $('#sellTotalRow').html(parseInt($('#sellTotalRow').text()) - sellPrice);
						   $('.invTable tbody tr:visible:odd').css({'background-color': '#F5F5F5'});
						   $('.invTable tbody tr:visible:even').css({'background-color': '#E8E8E8'});
					   }).html('x')
				   );
				   $('#sellDiv').append($node);
				   $('#sellDiv').append("<input type='hidden' name='sellItemInstanceID[]' value='" + itemInstanceID + "'/>");
				   $('#sellDiv').append("<input type='hidden' name='sellItemID[]' value='" + itemID + "'/>");
				}
				
				function test(hi){
					alert(hi);
					return false;
				}

			</script>
		
			<div class='eventDiv' id='eventDivShopWindow'>
				<?php
				
				$blnShowShop = true;
				if(isset($_GET['ShopID'])){
					$objShop = new RPGShop($_GET['ShopID']);
					$_SESSION['intLastShopID'] = $_GET['ShopID'];	
				}
				else if (isset($_SESSION['intLastShopID'])){
					$objShop = new RPGShop($_SESSION['intLastShopID']);
				}
				else{
					$blnShowShop = false;
				}
				
				if($blnShowShop){
					if($objShop->getShopType() != "Enchanter"){
						global $arrNumberedClothingSizes;
						global $arrClothingSizes;
						$strClosestClothingSize = array_search(getClosest($_SESSION['objRPGCharacter']->getBMI(), array_values($arrClothingSizes)), $arrClothingSizes);
						?>
						<div class='insideEvent'>
							<h3>Shop : <?=$objShop->getShopName()?></h3>
							<p>Tip: Mouse over item names listed in the shop window to see their description and stats before buying.</p>
							<fieldset class='shopFieldset'>
								<legend><span id='buyLink' class='underline pointer bold'>Buy</span> | <span id='sellLink' class='underline pointer'>Sell</span></legend>
								<form method='post' action='shoptransactionbuy.php' id='buyForm'>
									<table class='charTable'>
										<th class='tableHeader'>Item Name</th><th class='tableHeader'>Price</th><?=(($objShop->getShopType() == 'Tailor') ? "<th class='tableHeader'>Size <img id='sizeTooltip' class='pointer' title='The recommended size for your weight and height is selected by default.' src='tooltip.png'/></th>" : "")?><th class='tableHeader'>Quantity</th>
										<?php
										
										foreach($objShop->getShopInv() as $arrItemDetails){
											$strDamage = (strpos($arrItemDetails['objItem']->getItemType(),'Weapon') !== false && $arrItemDetails['objItem']->getStatDamage() == "Strength" && strpos($arrItemDetails['objItem']->getItemType(),'Shield') == false) ? "\nDamage: " . $arrItemDetails['objItem']->getDamage() : "";
											$strMagicDamage = (strpos($arrItemDetails['objItem']->getItemType(),'Weapon') !== false && $arrItemDetails['objItem']->getStatDamage() == "Intelligence")  ? "\nMagic Damage: " . $arrItemDetails['objItem']->getMagicDamage() : "";
											$strDefence = (strpos($arrItemDetails['objItem']->getItemType(), 'Armour') !== false || strpos($arrItemDetails['objItem']->getItemType(),'Shield') !== false) ? "\nDefence: " . $arrItemDetails['objItem']->getDefence() : "";
											$strMagicDefence = strpos($arrItemDetails['objItem']->getItemType(), 'Armour') !== false ? "\nMagic Defence: " . $arrItemDetails['objItem']->getMagicDefence() : "";
											$strHPHeal = strpos($arrItemDetails['objItem']->getItemType(), 'Food') !== false || strpos($arrItemDetails['objItem']->getItemType(), 'Potion') !== false ? "\nHP Heal: " . $arrItemDetails['objItem']->getHPHeal() : "";
											$strCalories = strpos($arrItemDetails['objItem']->getItemType(), 'Food') !== false || strpos($arrItemDetails['objItem']->getItemType(), 'Potion') !== false ? "\nCalories: " . $arrItemDetails['objItem']->getCalories() : "";
											$strTooltip = "Description: " . htmlspecialchars($arrItemDetails['objItem']->getItemDesc(), ENT_QUOTES) . $strDamage . $strMagicDamage . $strDefence . $strHPHeal . $strCalories;
											echo "<input type='hidden' name='itemID[]' value='" . $arrItemDetails['objItem']->getItemID() . "'/>";
											echo "<input type='hidden' name='price[]' value='" . $arrItemDetails['dblPrice'] . "'/>";
											echo "<tr><td><span class='itemNameTooltip pointer' title='" . $strTooltip . "'>" . $arrItemDetails['objItem']->getItemName() . "</span></td><td>" . $arrItemDetails['dblPrice'] . "</td>";
											if($objShop->getShopType() == 'Tailor'){
												echo "<td><select name='size[]' autocomplete='off'>";
												foreach($arrNumberedClothingSizes as $key => $val){
													$strSelected = ($strClosestClothingSize == $val) ? " selected" : "";
													echo "<option" . $strSelected . ">" . $val . "</option>";
												}
												echo "</select></td>";
											}
											echo "<td><input type='text' name='quantity[]' class='quantityWidth' maxlength='2' value='0'/></td></tr>";
										}
										
										?>
										<tr><td><b>Total</b></td><td id='totalRow' colspan='<?=(($objShop->getShopType() == 'Tailor') ? "3" : "2")?>'><b>0</b></td></tr>
									</table>
									<button type='submit'>Purchase Items</button>
								</form>
								<form method='post' action='shoptransactionsell.php' class='hidden' id='sellForm'>
									Drag items you wish to sell from your inventory into the box below.
									<div id='sellDiv'></div>
									<b>Total: <span id='sellTotalRow'>0</span></b><br/>
									<input type='submit' value='Sell Items'/>
								</form>
							</fieldset>
						</div>
						<?php
					}
					else{
					?>
						<div class='insideEvent'>
							<h3><?=$objShop->getShopName()?></h3>
							<form method='post' action='shoptransactionenchant.php' id='buyForm'>
								<div id='itemDescBeforeDrag'>
									Right click items in your inventory to view their enchantment info. A fee of <b>1 gold</b> will be charged to remove an enchant.
								</div>
								<br/><br/>
								<fieldset class='shopFieldset'>
									<legend>Enchantment Info</legend>
									<div id='itemDescAfterDrag' class='hidden'>
										<table class='inline-block charTable textCenter'>
											<tbody>
												<tr>
													<td colspan='2' id='enchantInfoItemName'></td>
												</tr>
												<tr>
													<td id='enchantInfoPrefixName'></td>
													<td id='enchantInfoSuffixName'></td>
												</tr>
												<tr>
													<td id='enchantInfoPrefixDesc'></td>
													<td id='enchantInfoSuffixDesc'></td>
												</tr>
											</tbody>
										</table>
									</div>
								</fieldset>
							</form>
						</div>
					<?php
					}
				}
				else{
					echo "You do not have permission to view this shop.";
				}
				if(isset($_SESSION['strShopError'])){
					echo $_SESSION['strShopError'];
					unset($_SESSION['strShopError']);
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