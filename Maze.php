<?php

class Maze{
	
	// dimensions of the maze
	private $_intDim;
	// array of walls
	private $_arrNorth = array();
	private $_arrSouth = array();
	private $_arrWest = array();
	private $_arrEast = array();
	// array of visited cells
	private $_arrVisited = array();
	// array of events
	private $_arrEvents = array();
	// for traversing the maze
	private $_intCurrentX;
	private $_intCurrentY;
	// for fog of war
	private $_arrExplored = array();
	
	public function __construct($intDim, $arrEventIDs, $objStartEvent = null, $objEndEvent = null){
		$this->_intDim = $intDim;
		$this->_intCurrentX = 1;
		$this->_intCurrentY = 1;
		$this->init();
		$this->generate(1, 1);
		$this->placeEvents($arrEventIDs, $objStartEvent, $objEndEvent);
	}
	
	public function init(){
		// initialize visited array to all false
		for($x=0; $x<=$this->_intDim + 1; $x++){
			for($y=0; $y<=$this->_intDim + 1; $y++){
				$this->_arrVisited[$x][$y] = false;
			}
		}
		
		// initialize border cells as already visited
		for($x=0; $x<=$this->_intDim + 1; $x++){
			$this->_arrVisited[$x][0] = true;
			$this->_arrVisited[$x][$this->_intDim + 1] = true;
		}
		for($y=0; $y<=$this->_intDim + 1; $y++){
			$this->_arrVisited[0][$y] = true;
			$this->_arrVisited[$this->_intDim + 1][$y] = true;
		}
		
		// initialize all walls as present
		for($x=0; $x<=$this->_intDim + 1; $x++){
			for($y=0; $y<=$this->_intDim + 1; $y++){
				$this->_arrNorth[$x][$y] = true;
				$this->_arrEast[$x][$y] = true;
				$this->_arrSouth[$x][$y] = true;
				$this->_arrWest[$x][$y] = true;
			}
		}
		
		// initialize all events as standstill
		for($x=1; $x<=$this->_intDim; $x++){
			for($y=1; $y<=$this->_intDim; $y++){
				$this->_arrEvents[$x][$y] = "S";
			}
		}
		
		// initialize all squares as unexplored
		for($x=1; $x<=$this->_intDim; $x++){
			for($y=1; $y<=$this->_intDim; $y++){
				$this->_arrExplored[$x][$y] = 0;
			}
		}
		
		// starting square area explored
		$this->setCurrentAreaExplored();
	}
	
	public function generate($intX, $intY){
		$this->_arrVisited[$intX][$intY] = true;
		
		// roll to see what type of event this square will contain
		$dblEventRoll = mt_rand(1, 100);
		
		if($dblEventRoll <= 75){
			$this->_arrEvents[$intX][$intY] = "S"; // standstill (no event) - 75%
		}
		else{
			$this->_arrEvents[$intX][$intY] = "C"; // combat - 25%
		}
		
		// while there is an unvisited neighbor
		while(!$this->_arrVisited[$intX][$intY + 1] || !$this->_arrVisited[$intX + 1][$intY] || !$this->_arrVisited[$intX][$intY - 1] || !$this->_arrVisited[$intX - 1][$intY]){
			
			while(true){
				$intRandom = mt_rand(0, 3);
				if($intRandom == 0 && !$this->_arrVisited[$intX][$intY + 1]){
					$this->_arrNorth[$intX][$intY + 1] = false;
					$this->_arrSouth[$intX][$intY] = false;
					$this->generate($intX, $intY + 1);
					break;
				}
				else if($intRandom == 1 && !$this->_arrVisited[$intX + 1][$intY]){
					$this->_arrEast[$intX][$intY] = false;
					$this->_arrWest[$intX + 1][$intY] = false;
					$this->generate($intX + 1, $intY);
					break;
				}
				else if($intRandom == 2 && !$this->_arrVisited[$intX][$intY - 1]){
					$this->_arrSouth[$intX][$intY - 1] = false;
					$this->_arrNorth[$intX][$intY] = false;
					$this->generate($intX, $intY - 1);
					break;
				}
				else if($intRandom == 3 && !$this->_arrVisited[$intX - 1][$intY]){
					$this->_arrWest[$intX][$intY] = false;
					$this->_arrEast[$intX - 1][$intY] = false;
					$this->generate($intX - 1, $intY);
					break;
				}
			}
		}
	}
	
	public function placeEvents($arrEventIDs, $objStartEvent, $objEndEvent){
		foreach($arrEventIDs as $objEvent){
			$intLocationX = mt_rand(1, $this->_intDim);
			$intLocationY = mt_rand(1, $this->_intDim);
			// prevent events from landing on start or end squares
			if($intLocationX == 1 && $intLocationY == 1){
				$intLocationX++;
			}
			if($intLocationX == $this->_intDim && $intLocationY == $this->_intDim){
				$intLocationY--;
			}
			$this->_arrEvents[$intLocationX][$intLocationY] = $objEvent;
		}
		// make start/end events stairway events if none exist (ie. already viewed once)
		$this->_arrEvents[1][1] = (isset($objStartEvent)) ? $objStartEvent : "B";
		$this->_arrEvents[$this->_intDim][$this->_intDim] = isset($objEndEvent) ? $objEndEvent : "E";
	}
	
	public function draw(){
		// function to output the html ASCII maze
		$strHTML = "";
		$strHTML .= "<table class='maze tableCenter'>";
		for($y=1; $y<=$this->_intDim; $y++){
			$strHTML .= "<tr>";
			for($x=1; $x<=$this->_intDim; $x++){
				$strWallClass = "";
				// place fog
				if($this->_arrExplored[$x][$y]){
					$strExploredClass = "";
					// place walls
					if($this->_arrSouth[$x][$y]){
						$strWallClass .= " wallSouth ";
					}
					if($this->_arrNorth[$x][$y]){
						$strWallClass .= " wallNorth ";
					}
					if($this->_arrWest[$x][$y]){
						$strWallClass .= " wallWest ";					
					}
					if($this->_arrEast[$x][$y]){
						$strWallClass .= " wallEast ";
					}
				}
				else{
					$strExploredClass = " fog ";
				}
				// place current square market
				if($x == $this->_intCurrentX && $y == $this->_intCurrentY){
					$strCurrentSquareMarker = "X";
				}
				else{
					$strCurrentSquareMarker = "";
				}
				$strHTML .= "<td class='textCenter " . $strWallClass . $strExploredClass . "'> " . $strCurrentSquareMarker . "</td>";
			}
		}
		$strHTML .= "</table>";
		return $strHTML;
	}
	
	public function getCurrentX(){
		return $this->_intCurrentX;
	}
	
	public function getCurrentY(){
		return $this->_intCurrentY;
	}
	
	public function setCurrentX($intCurrentX){
		$this->_intCurrentX = $intCurrentX;
	}
	
	public function setCurrentY($intCurrentY){
		$this->_intCurrentY = $intCurrentY;
	}
	
	public function moveNorth(){
		$this->_intCurrentY--;
		$this->setCurrentAreaExplored();
	}
	
	public function moveEast(){
		$this->_intCurrentX++;
		$this->setCurrentAreaExplored();
	}
	
	public function moveSouth(){
		$this->_intCurrentY++;
		$this->setCurrentAreaExplored();
	}
	
	public function moveWest(){
		$this->_intCurrentX--;
		$this->setCurrentAreaExplored();
	}
	
	public function getEventAtCurrentLocation(){
		return $this->_arrEvents[$this->_intCurrentX][$this->_intCurrentY];
	}
	
	public function setEventAtCurrentLocation($strEventType){
		$this->_arrEvents[$this->_intCurrentX][$this->_intCurrentY] = $strEventType;
	}
	
	public function isValidMove($strMove){
		if($strMove == 'North'){
			if($this->_arrNorth[$this->_intCurrentX][$this->_intCurrentY]){
				return false;
			}
			else{
				return true;
			}
		}
		else if($strMove == 'East'){
			if($this->_arrEast[$this->_intCurrentX][$this->_intCurrentY]){
				return false;
			}
			else{
				return true;
			}
		}
		else if($strMove == 'South'){
			if($this->_arrSouth[$this->_intCurrentX][$this->_intCurrentY]){
				return false;
			}
			else{
				return true;
			}
		}
		else if($strMove == 'West'){
			if($this->_arrWest[$this->_intCurrentX][$this->_intCurrentY]){
				return false;
			}
			else{
				return true;
			}
		}
	}
	
	public function setCurrentAreaExplored(){
		$this->_arrExplored[$this->_intCurrentX][$this->_intCurrentY] = 1;
	}
	
	public function isEntrance(){
		if($this->_intCurrentX == 1 && $this->_intCurrentY == 1){
			return true;
		}
		else{
			return false;
		}
	}
	
	public function isExit(){
		if($this->_intCurrentX == $this->_intDim && $this->_intCurrentY == $this->_intDim){
			return true;
		}
		else{
			return false;
		}
	}
}

?>