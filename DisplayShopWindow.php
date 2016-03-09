<?php

include_once "RPGShop.php";
include_once "RPGItem.php";
include_once "constants.php";

class DisplayShopWindow{

	public function DisplayShopWindow(){
		
	}
	
	public static function toHTML(){
		ob_start(); ?>
		
			<script src="JS/jquery.numeric.js" type="text/javascript"></script>
			<script type='text/javascript'>

				$(document).ready(function(){
					$('input[type=text]').numeric();
					$('input[type=text]').keypress(function(event) {
					  if ( event.which == 45 || event.which == 189 ) {
						  event.preventDefault();
					   }
					});
				});

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
				global $arrNumberedClothingSizes;
				?>
				<h3>Shop : <?=$objShop->getShopName()?></h3>
				<form method='post' action='shoptransaction.php'>
					<table>
						<th class='tableHeader'>Item Name</th><th class='tableHeader'>Price</th><?=(($objShop->getShopType() == 'Tailor') ? "<th class='tableHeader'>Size</th>" : "")?><th class='tableHeader'>Quantity</th>
						<?php
						
						foreach($objShop->getShopInv() as $arrItemDetails){
							echo "<input type='hidden' name='itemID[]' value='" . $arrItemDetails['objItem']->getItemID() . "'/>";
							echo "<input type='hidden' name='price[]' value='" . $arrItemDetails['dblPrice'] . "'/>";
							echo "<tr><td>" . $arrItemDetails['objItem']->getItemName() . "</td><td>" . $arrItemDetails['dblPrice'] . "</td>";
							if($objShop->getShopType() == 'Tailor'){
								echo "<td><select name='size[]'>";
								foreach($arrNumberedClothingSizes as $key => $val){
									echo "<option>" . $val . "</option>";
								}
								echo "</select></td>";
							}
							echo "<td><input type='text' name='quantity[]' value='0'/></td></tr>";
						}
						
						?>
					</table>
					<button type='submit'>Purchase</button>
				</form>
				<?php
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