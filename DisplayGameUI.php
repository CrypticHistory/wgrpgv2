<?php

include_once 'DataGameUI.php';
include_once 'RPGCharacter.php';
include_once 'RPGFloor.php';
include_once 'RPGEvent.php';
include_once 'RPGXMLReader.php';
include_once 'UISettings.php';
include_once "DisplayCharacterInfo.php";
include_once "DisplayCharacterAppearance.php";
include_once "DisplayCharacterClasses.php";
include_once "DisplayCharacterSocial.php";
include_once "DisplayEventWindow.php";
include_once "DisplayCombatWindow.php";
include_once "DisplayStatGainWindow.php";
include_once "DisplaySkillViewWindow.php";
include_once "DisplayPartyViewWindow.php";
include_once "DisplayTownWindow.php";
include_once "DisplayShopWindow.php";
include_once "DisplayUseInventory.php";
include_once "DisplayEquipInventory.php";
include_once "DisplayMiscInventory.php";
include_once "DisplayMapInventory.php";
include_once "DisplayEventCommandsWindow.php";
include_once "DisplayCombatCommandsWindow.php";
include_once "DisplayReturnCommandsWindow.php";
include_once "DisplayTownCommandsWindow.php";
include_once "DisplayNavigationCompassWindow.php";
include_once "DisplayNavigationMenuWindow.php";

class DisplayGameUI extends DataGameUI{

	protected $_objCharacterInfo;
	protected $_objCharacterAppearance;
	protected $_objCharacterClasses;
	protected $_objCharacterSocial;
	protected $_objTownWindow;
	protected $_objEventWindow;
	protected $_objCombatWindow;
	protected $_objStatGainWindow;
	protected $_objSkillViewWindow;
	protected $_objPartyViewWindow;
	protected $_objShopWindow;
	protected $_objUseInventory;
	protected $_objEquipInventory;
	protected $_objMiscInventory;
	protected $_objMapInventory;
	protected $_objEventCommandsWindow;
	protected $_objCombatCommandsWindow;
	protected $_objReturnCommandsWindow;
	protected $_objTownCommandsWindow;
	protected $_objNavigationCompassWindow;
	protected $_objNavigationMenuWindow;

	public function __construct(){
		$this->_objCharacterInfo = new DisplayCharacterInfo();
		$this->_objCharacterAppearance = new DisplayCharacterAppearance();
		$this->_objCharacterClasses = new DisplayCharacterClasses();
		$this->_objCharacterSocial = new DisplayCharacterSocial();
		$this->_objEventWindow = new DisplayEventWindow();
		$this->_objCombatWindow = new DisplayCombatWindow();
		$this->_objStatGainWindow = new DisplayStatGainWindow();
		$this->_objSkillViewWindow = new DisplaySkillViewWindow();
		$this->_objPartyViewWindow = new DisplayPartyViewWindow();
		$this->_objTownWindow = new DisplayTownWindow();
		$this->_objShopWindow = new DisplayShopWindow();
		$this->_objUseInventory = new DisplayUseInventory();
		$this->_objEquipInventory = new DisplayEquipInventory();
		$this->_objMiscInventory = new DisplayMiscInventory();
		$this->_objMapInventory = new DisplayMapInventory();
		$this->_objEventCommandsWindow = new DisplayEventCommandsWindow();
		$this->_objCombatCommandsWindow = new DisplayCombatCommandsWindow();
		$this->_objReturnCommandsWindow = new DisplayReturnCommandsWindow();
		$this->_objTownCommandsWindow = new DisplayTownCommandsWindow();
		$this->_objNavigationCompassWindow = new DisplayNavigationCompassWindow();
		$this->_objNavigationMenuWindow = new DisplayNavigationMenuWindow();
		parent::__construct();
	}
	
	public function toJavascript(){
		ob_start(); ?>
		
		<link rel="stylesheet" type="text/css" href="main.css" media="screen" />
		<script>
			$(document).ready(function(){
				jQuery.fn.preventDoubleSubmission = function() {
				  $(this).on('submit',function(e){
					var $form = $(this);

					if ($form.data('submitted') === true) {
					  // Previously submitted - don't submit again
					  e.preventDefault();
					} else {
					  // Mark it so that the next submit can be ignored
					  $form.data('submitted', true);
					}
				  });

				  // Keep chainability
				  return this;
				};
				
				$('form').preventDoubleSubmission();
				
				$('.invTable > tbody').contextmenu(function(){
					return false;
				});
				
				$("#inventoryTabHeading<?=$_SESSION['objUISettings']->getInventoryFrame()?>").addClass('currentTab');
				$("#inventoryDiv<?=$_SESSION['objUISettings']->getInventoryFrame()?>").removeClass('hidden');
				$("#characterTabHeading<?=$_SESSION['objUISettings']->getCharacterFrame()?>").addClass('currentTab');
				$("#characterDiv<?=$_SESSION['objUISettings']->getCharacterFrame()?>").removeClass('hidden');
			});

			function switchInventoryTab(strTabName){
				$('.inventoryTabHeading').each(function(){
					$(this).removeClass('currentTab');
				});
				$('.inventoryDiv').each(function(){
					$(this).addClass('hidden');
				});
				
				$.ajax({
						url: 'UISettingsAJAX.php',
						async: true,
						type: 'post',
						contentType: "application/x-www-form-urlencoded;charset=ISO-8859-15",
						data: {
							action: 'setInventoryFrame',
							strInventoryFrame: strTabName
						},
						error: function(textStatus, errorThrown){
							alert("Error processing ajax request; Please refresh page and try again.");
						}
				});
				
				$('#inventoryTabHeading' + strTabName).addClass('currentTab');
				$('#inventoryDiv' + strTabName).removeClass('hidden');
			}
			
			function switchCharacterTab(strTabName){
				$('.characterTabHeading').each(function(){
					$(this).removeClass('currentTab');
				});
				$('.characterDiv').each(function(){
					$(this).addClass('hidden');
				});
				
				$.ajax({
						url: 'UISettingsAJAX.php',
						async: true,
						type: 'post',
						contentType: "application/x-www-form-urlencoded;charset=ISO-8859-15",
						data: {
							action: 'setCharacterFrame',
							strCharacterFrame: strTabName
						},
						error: function(textStatus, errorThrown){
							alert("Error processing ajax request; Please refresh page and try again.");
						}
				});
				
				$('#characterTabHeading' + strTabName).addClass('currentTab');
				$('#characterDiv' + strTabName).removeClass('hidden');
			}

			function showItemDetails(strItemTab, intItemRow){
				hide = false;
				$("[id*='" + strItemTab + "ItemDetails']").each(function(){
					$(this).addClass('hidden');
				});
				if($('#' + strItemTab + 'Item' + intItemRow).hasClass('selectedRow')){
					hide = true;
				}
				$("[id*='" + strItemTab + "Item']").each(function(){
					$(this).removeClass('selectedRow');
				});
				if(hide == false){
					$('#' + strItemTab + 'ItemDetails' + intItemRow).removeClass('hidden');
					$('#' + strItemTab + 'Item' + intItemRow).addClass('selectedRow');
				}
			}
			
			function showQuestDetails(intItemRow){
				hide = false;
				$("[id*='questEntryDetails']").each(function(){
					$(this).addClass('hidden');
				});
				if($('#questEntry' + intItemRow).hasClass('selectedRow')){
					hide = true;
					intItemRow = -1;
				}
				$("[id*='questEntry']").each(function(){
					$(this).removeClass('selectedRow');
				});
				if(hide == false){
					$('#questEntryDetails' + intItemRow).removeClass('hidden');
					$('#questEntry' + intItemRow).addClass('selectedRow');
				}
				
				$.ajax({
						url: 'UISettingsAJAX.php',
						async: true,
						type: 'post',
						contentType: "application/x-www-form-urlencoded;charset=ISO-8859-15",
						data: {
							action: 'setQuestTab',
							intQuestTab: intItemRow
						},
						error: function(textStatus, errorThrown){
							alert("Error processing ajax request; Please refresh page and try again.");
						}
				});
			}
			
			function showClassDetails(intItemRow){
				hide = false;
				$("[id*='classEntryDetails']").each(function(){
					$(this).addClass('hidden');
				});
				if($('#classEntry' + intItemRow).hasClass('selectedRow')){
					hide = true;
					intItemRow = -1;
				}
				$("[id*='classEntry']").each(function(){
					$(this).removeClass('selectedRow');
				});
				if(hide == false){
					$('#classEntryDetails' + intItemRow).removeClass('hidden');
					$('#classEntry' + intItemRow).addClass('selectedRow');
				}
				
				$.ajax({
						url: 'UISettingsAJAX.php',
						async: true,
						type: 'post',
						contentType: "application/x-www-form-urlencoded;charset=ISO-8859-15",
						data: {
							action: 'setClassTab',
							intClassTab: intItemRow
						},
						error: function(textStatus, errorThrown){
							alert("Error processing ajax request; Please refresh page and try again.");
						}
				});
			}
			
		</script>

		<?php
		$strJS = ob_get_contents();
		ob_end_clean();
		
		echo $strJS;
	}
	
	public function toHTML(){
		ob_start(); ?>
		
		<?php
			if(!isset($_SESSION['objUser'])){
				echo "You do not have permission to view this page.";
				exit;
			}
		?>
		<div class='mainDiv'>
			
			<div class='navDiv'>
				<a href='index.php'>Main</a>
			</div>
			
			<div class='wrapDiv'>
			
				<fieldset class='leftFieldset'>
				<legend>Character</legend>
				
				<?php
				
				$arrCharTabHeadings = array("Info", "Appearance", "Classes", "Social");
				$arrCharTabObjects = array("_objCharacterInfo", "_objCharacterAppearance", "_objCharacterClasses", "_objCharacterSocial");
				
				foreach($arrCharTabHeadings as $intTabID => $strTabTitle){
					echo "<div class='characterTabHeading' id='characterTabHeading" . $strTabTitle . "' onclick=\"switchCharacterTab('" . $strTabTitle . "')\">" . $strTabTitle . "</div>";
				}
				
				foreach($arrCharTabObjects as $intTabID => $strObjectName){
					echo $this->$strObjectName->toHTML();
				}
				
				?>
					
				</fieldset>
					
				<fieldset class='middleFieldset'>
				<legend>Events</legend>
				<?php
				
				$strEventObject = "_obj" . $_SESSION['objUISettings']->getEventFrame() . "Window";
				$this->$strEventObject->toHTML();
				
				?>
				</fieldset>
				
			</div>
			
			<div class='containerDiv'>
				
				<fieldset class='rightFieldset'>
				<legend>Inventory</legend>
				
				<?php
				
				$arrInvTabHeadings = array("Equipment", "Consumable", "Misc", "Map");
				$arrInvTabObjects = array("_objEquipInventory", "_objUseInventory", "_objMiscInventory", "_objMapInventory");
				
				foreach($arrInvTabHeadings as $intTabID => $strTabTitle){
					echo "<div class='inventoryTabHeading' id='inventoryTabHeading" . $strTabTitle . "' onclick=\"switchInventoryTab('" . $strTabTitle . "')\">" . $strTabTitle . "</div>";
				}
				
				foreach($arrInvTabObjects as $intTabID => $strObjectName){
					echo $this->$strObjectName->toHTML();
				}
				
				?>
				
				<div class='goldLine'>Gold: <?=$_SESSION['objRPGCharacter']->getGold()?></div>
				
				</fieldset>
				
			</div>
			<div class='containerDiv'>
				
				<fieldset class='commandsFieldset'>
				<legend>Commands</legend>
				<?php
				
				$strCommandsObject = "_obj" . $_SESSION['objUISettings']->getCommandsFrame() . "CommandsWindow";
				$this->$strCommandsObject->toHTML();
				
				?>
				</fieldset>
				
				<fieldset class='compassFieldset'>
				<legend>Navigation</legend>
				<?php
				
				$strNavigationObject = "_objNavigation" . $_SESSION['objUISettings']->getNavigationFrame() . "Window";
				$this->$strNavigationObject->toHTML();
				
				?>
				</fieldset>
				
			</div>
			
		</div>
		
		<?php
		$strHTML = ob_get_contents();
		ob_end_clean();
		
		echo $strHTML;
	}
}

?>