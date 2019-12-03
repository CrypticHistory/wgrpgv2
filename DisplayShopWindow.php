<?php

include_once "RPGShop.php";
include_once "RPGItem.php";
include_once "constants.php";
include_once "common.php";

class DisplayShopWindow{

	public function __construct(){
		
	}
	
	public static function toHTML(){
		ob_start(); ?>
		
			<script src="JS/jquery.numeric.js" type="text/javascript"></script>
			<script type='text/javascript'>

				$(document).ready(function(){
					<?php if(isset($_POST['staySell'])){
						echo "$('#sellLink').click();";
					}?>
					
					var total = {};
					
					$('#shopTable tbody tr').each(function(){
						total[$(this).attr('id')] = 0;
					});
					
					var table = $("#shopTable").DataTable({
						"info": false,
						"bInfo": false,
						"bFilter": false,
						"bLengthChange": false,
						"pageLength": 7,
						"order": [[ 1, "asc" ]]
					});
					
					$('#shopTable tbody').on('keyup', 'input', function() {
						newTotal = parseInt($(this).val()) * parseInt($(this).closest('tr').find('td.price').text());
						quantity = parseInt($(this).val());
						total[$(this).closest('tr').attr('id')] = newTotal;
						$("#hiddenItem" + $(this).closest('tr').attr('id')).find('.quantity').val(quantity);
						changeTotal();
					});
					
					$('#shopTable tbody').on('change', 'select', function() {
						$("#hiddenItem" + $(this).closest('tr').attr('id')).find('.size').val($(this).val());
					});
					
					function changeTotal(){
						newTotal = 0;
						$.each(total, function(key, val){
							newTotal += val;
						});
						if(!isNaN(newTotal)){
							$("#totalRow").html("<b>" + newTotal + "</b>");
						}
					}
					
					$("#purchaseButton").on('click', function(){
						$("#buyForm").submit();
					});
					
					$(".paginationContainer").append($(".dataTables_paginate"));
					
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
					
					$('#buyLink').click(function(){
						$('#buyDiv').show();
						$('#sellForm').hide();
						$('#buyLink').addClass('bold');
						$('#sellLink').removeClass('bold');
					});
					
					$('#sellLink').click(function(){
						$('#sellForm').show();
						$('#buyDiv').hide();
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
							if($('.shopName').text() == "Turician Enchanter"){
								$('#enchantInfoItemName').html('<b>' + $(this).find('.itemName:first').text() + '</b>');
								$('#enchantInfoItemName').after("<input type='hidden' name='itemInstanceID' value='" + $(this).next().text() + "'/>")
								$('#enchantInfoItemName').after("<input type='hidden' name='itemType' value='" + $(this).closest('tr').find("[name='itemType']").text() + "'/>");
								$('#enchantInfoPrefixName').text($(this).find('.prefix:first').text());
								$('#enchantInfoPrefixNameLabel').removeClass("hidden");
								if($(this).find('.prefix:first').text() != ''){
									$('#enchantInfoPrefixDesc').html("<button type='submit' class='shortButton' value='Prefix' name='Remove'>Remove Enchant</button>");
								}
								else{
									$('#enchantInfoPrefixName').text('No Prefix');
								}
								$('#enchantInfoSuffixName').text($(this).find('.suffix:first').text());
								$('#enchantInfoSuffixNameLabel').removeClass("hidden");
								if($(this).find('.suffix:first').text() != ''){
									$('#enchantInfoSuffixDesc').html("<button type='submit' class='shortButton' value='Suffix' name='Remove'>Remove Enchant</button>");
								}
								else{
									$('#enchantInfoSuffixName').text('No Suffix');
								}
								return false;
							}
							else if($('.shopName').text() == "Repair Clothing"){
								$('#repairInfoItemName').html('<b>' + $(this).find('.itemName:first').text() + '</b>');
								$('#repairInfoItemName').after("<input type='hidden' name='itemInstanceID' value='" + $(this).next().text() + "'/>")
								intSellPrice = parseInt($(this).closest('tr').find("[name='itemSellPrice']").text()) * 5;
								$('#repairInfoItemName').after("<input type='hidden' name='itemSellPrice' value='" + intSellPrice + "'/>");
								$('#repairInfoPriceValue').text(intSellPrice);
								strRipped = $(this).closest('tr').find("[name='blnRipped']").text() == "1" ? "Ripped" : "Intact";
								$('#repairInfoStatusValue').text(strRipped);
								if(strRipped == "Ripped"){
									$('#repairButton').html('<button class="shortButton" type="submit">Repair Item</button>');
								}
								else{
									$('#repairButton').html('<button class="shortButton" disabled>Cannot repair</button>');
								}
								return false;
							}
							else if($('.shopName').text() == "Resize Clothing"){
								$('#itemSizeSelect').removeClass('hidden');
								$('#resizeInfoItemName').html('<b>' + $(this).find('.itemName:first').text() + '</b>');
								$('#resizeInfoItemName').after("<input type='hidden' name='itemInstanceID' value='" + $(this).next().text() + "'/>")
								intSellPrice = parseInt($(this).closest('tr').find("[name='itemSellPrice']").text()) * 5;
								$('#resizeInfoItemName').after("<input type='hidden' name='itemSellPrice' value='" + intSellPrice + "'/>");
								$('#resizeInfoPriceValue').text(intSellPrice);
								itemType = $(this).closest('tr').find("[name='itemType']").text();
								if(itemType == "Armour" || itemType == "Top" || itemType == "Bottom"){
									$('#resizeButton').html('<button class="shortButton" type="submit">Resize Item</button>');
								}
								else{
									$('#resizeButton').html('<button class="shortButton" disabled>Cannot resize</button>');
								}
								return false;
							}
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

			</script>
		
			<div class='shopDiv' id='eventDivShopWindow'>
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
					global $arrNumberedClothingSizes;
					global $arrClothingSizes;
					if($objShop->getShopType() == "Tailor" || $objShop->getShopType() == "Blacksmith" || $objShop->getShopType() == "Magic Shop" || $objShop->getShopType() == "Apothecary" || $objShop->getShopType() == "Grocer" || $objShop->getShopType() == "Armourer"){
						$strClosestClothingSize = array_search(getClosest($_SESSION['objRPGCharacter']->getBMI(), array_values($arrClothingSizes)), $arrClothingSizes);
						?>
						<div class='insideEvent'>
							<h3>Shop : <span class='shopName'><?=$objShop->getShopName()?></span></h3>
							<p>Tip: Mouse over item names listed in the shop window to see their description and stats before buying.</p>
							<fieldset class='shopFieldset'>
								<legend><span id='buyLink' class='underline pointer bold'>Buy</span> | <span id='sellLink' class='underline pointer'>Sell</span></legend>
								<div id="buyDiv">
									<form method='post' action='shoptransactionbuy.php' id='buyForm' style="margin:0px">
										<?php
										
										foreach($objShop->getShopInv() as $arrItemDetails){
											echo "<div id='hiddenItem" . $arrItemDetails['objItem']->getItemID() . "'>";
												echo "<input type='hidden' class='itemID' name='itemID[]' value='" . $arrItemDetails['objItem']->getItemID() . "'/>";
												echo "<input type='hidden' class='price' name='price[]' value='" . $arrItemDetails['dblPrice'] . "'/>";
												echo "<input type='hidden' class='size' name='size[]'>";
												echo "<input type='hidden' class='quantity' name='quantity[]' value='0'/>";
											echo "</div>";
										}
										
										?>
									</form>
									<table id="shopTable" class='charTable'>
										<thead>
											<th style="width:50%;" class='tableHeader'>Item Name</th><th class='tableHeader'>Price</th><?=(($objShop->getShopType() == 'Tailor' || $objShop->getShopType() == 'Armourer') ? "<th class='tableHeader'>Size <img id='sizeTooltip' class='pointer' title='The recommended size for your weight and height is selected by default.' src='tooltip.png'/></th>" : "")?><th class='tableHeader'>Quantity</th>
										</thead>
										<tbody>
										<?php
										
										foreach($objShop->getShopInv() as $arrItemDetails){
											$strDamage = (strpos($arrItemDetails['objItem']->getItemType(),'Weapon') !== false && $arrItemDetails['objItem']->getStatDamage() == "Strength" && strpos($arrItemDetails['objItem']->getItemType(),'Shield') == false) ? "<br/><b>Damage:</b> " . $arrItemDetails['objItem']->getDamage() : "";
											$strMagicDamage = (strpos($arrItemDetails['objItem']->getItemType(),'Weapon') !== false && $arrItemDetails['objItem']->getStatDamage() == "Intelligence")  ? "<br/>Magic Damage: " . $arrItemDetails['objItem']->getMagicDamage() : "";
											$strDefence = (strpos($arrItemDetails['objItem']->getItemType(), 'Armour') !== false || strpos($arrItemDetails['objItem']->getItemType(),'Shield') !== false) ? "<br/><b>Defence:</b> " . $arrItemDetails['objItem']->getDefence() : "";
											$strMagicDefence = strpos($arrItemDetails['objItem']->getItemType(), 'Armour') !== false ? "<br/><b>Magic Defence:</b> " . $arrItemDetails['objItem']->getMagicDefence() : "";
											$strHPHeal = strpos($arrItemDetails['objItem']->getItemType(), 'Food') !== false || strpos($arrItemDetails['objItem']->getItemType(), 'Potion') !== false ? "<br/><b>HP Heal:</b> " . $arrItemDetails['objItem']->getHPHeal() : "";
											$strCalories = strpos($arrItemDetails['objItem']->getItemType(), 'Food') !== false || strpos($arrItemDetails['objItem']->getItemType(), 'Potion') !== false ? "<br/><b>Calories:</b> " . $arrItemDetails['objItem']->getCalories() : "";
											$strItemType = "<br/><b>Type:</b> " . $arrItemDetails['objItem']->getTypeSecondary();
											$strTooltip = "<b>Description:</b> " . htmlspecialchars($arrItemDetails['objItem']->getItemDesc(), ENT_QUOTES) . $strItemType . $strDamage . $strMagicDamage . $strDefence . $strHPHeal . $strCalories;
											echo "<tr id='" . $arrItemDetails['objItem']->getItemID() . "'><td><div class='tooltipShop'><span class='tooltipText'>" . $strTooltip . "</span>" . $arrItemDetails['objItem']->getItemName() . "</div></td><td class='price'>" . $arrItemDetails['dblPrice'] . "</td>";
											if($objShop->getShopType() == 'Tailor' || $objShop->getShopType() == 'Armourer'){
												echo "<td><select autocomplete='off'>";
												foreach($arrNumberedClothingSizes as $key => $val){
													$strSelected = ($strClosestClothingSize == $val) ? " selected" : "";
													echo "<option" . $strSelected . ">" . $val . "</option>";
												}
												echo "</select></td>";
											}
											echo "<td><input type='text' id='quantity" . $arrItemDetails['objItem']->getItemID() . "' class='quantityWidth' maxlength='2' value='0'/></td></tr>";
										}
										
										?>
										</tbody>
										<tr style="background-color:#ffffff;"><td><b>Total</b></td><td id='totalRow' colspan='<?=(($objShop->getShopType() == 'Tailor' || $objShop->getShopType() == 'Armourer') ? "3" : "2")?>'><b>0</b></td></tr>
									</table>
									<div class="shopBottomLine">
										<div class="purchaseButton"><button id='purchaseButton'>Purchase Items</button></div>
										<div class="paginationContainer"></div>
									</div>
								</div>
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
					else if($objShop->getShopType() == "Enchanter"){
					?>
						<div class='insideEvent'>
							<h3><span class="shopName"><?=$objShop->getShopName()?></span></h3>
							<form method='post' action='shoptransactionenchant.php' id='enchantForm'>
								<div id='itemDescBeforeDrag'>
									Right click items in your inventory to view their enchantment info. A fee of <b>1 gold</b> will be charged to remove an enchant.
								</div>
								<fieldset class='shopFieldset'>
									<legend class="itemTableHeader" id="enchantInfoItemName"></legend>
									<div id='itemDescAfterDrag' class='hidden'>
										<table class='inline-block textCenter paddedTable'>
											<thead>
												<tr>
													<th style="width:220px;"></th>
													<th></th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td id="enchantInfoPrefixNameLabel" class="hidden"><b>Prefix: </b><span id="enchantInfoPrefixName"></span></td>
													<td id="enchantInfoSuffixNameLabel" class="hidden"><b>Suffix: </b><span id="enchantInfoSuffixName"></span></td>
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
					else if($objShop->getShopType() == "Repair"){
					?>
						<div class='insideEvent'>
							<h3><span class="shopName"><?=$objShop->getShopName()?></span></h3>
							<form method='post' action='shoptransactionrepair.php' id='repairForm'>
								<div id='itemDescBeforeDrag'>
									Right click items in your inventory to bring up their info. Fees vary based on the value of your clothing items.
								</div>
								<fieldset class='shopFieldset'>
									<legend class="itemTableHeader" id="repairInfoItemName"></legend>
									<div id='itemDescAfterDrag' class='hidden'>
										<table class='inline-block textCenter paddedTable'>
											<thead>
												<tr>
													<th style="width:50%;"></th>
													<th></th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td id='repairInfoStatusLabel'><b>Status:</b></td>
													<td id='repairInfoStatusValue'></td>
												</tr>
												<tr>
													<td id='repairInfoPriceLabel'><b>Fee:</b></td>
													<td id='repairInfoPriceValue'></td>
												</tr>
												<tr>
													<td id="repairButton" colspan="2"></td>
												</tr>
											</tbody>
										</table>
									</div>
								</fieldset>
							</form>
						</div>
					<?php
					}
					else if($objShop->getShopType() == "Resize"){
					?>
						<div class='insideEvent'>
							<h3><span class="shopName"><?=$objShop->getShopName()?></span></h3>
							<form method='post' action='shoptransactionresize.php' id='resizeForm'>
								<div id='itemDescBeforeDrag'>
									Right click items in your inventory to bring up their info. Fees vary based on the value of your clothing items.
								</div>
								<fieldset class='shopFieldset'>
									<legend class="itemTableHeader" id="resizeInfoItemName"></legend>
									<div id='itemDescAfterDrag' class='hidden'>
										<table class='inline-block textCenter paddedTable'>
											<thead>
												<tr>
													<th style="width:50%;"></th>
													<th></th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td id='resizeInfoSizeLabel'><b>Size:</b></td>
													<td id='resizeInfoSizeValue'><select class="hidden" id="itemSizeSelect" name='itemSize' autocomplete='off'>
														<?php
														$arrClothingSizesWithoutStretch = $arrNumberedClothingSizes;
														array_pop($arrClothingSizesWithoutStretch);
														foreach($arrClothingSizesWithoutStretch as $key => $val){
															echo "<option>" . $val . "</option>";
														}
														?>
													</select></td>
												</tr>
												<tr>
													<td id='resizeInfoPriceLabel'><b>Fee:</b></td>
													<td id='resizeInfoPriceValue'></td>
												</tr>
												<tr>
													<td id="resizeButton" colspan="2"></td>
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
					echo "<div class='insideEvent'>" . $_SESSION['strShopError'] . "</div>";
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