<?php

class Lottery {

	private $_entries;
	private $_lotsTotal;
	
	public function Lottery(){
		$this->_entries = array();
		$this->_lotsTotal = 0;
	}
	
	public function addEntry($participant, $lots = 1) {
		$this->_entries[] = array(
			'participant' => $participant,
			'lots' => $lots,
		);
		$this->_lotsTotal += $lots;
	}

	public function getWinner() {
		if($this->_lotsTotal == 0) { return false; }
		 
		$rand = mt_rand(0, $this->_lotsTotal);
		 
		$currentLot = 0;
		foreach($this->_entries as $entry) {
			$currentLot += $entry['lots'];
			if($currentLot >= $rand) {
				return $entry['participant'];
			}
		}
		return false;
	}
}

?>