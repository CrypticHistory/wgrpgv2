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
	// is the maze solved?
	private $_blnDone = false;
	
	public function Maze($intDim){
		$this->_intDim = $intDim;
		$this->init();
		$this->generate(1, 1);
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
	}
	
	public function generate($intX, $intY){
		$this->_arrVisited[$intX][$intY] = true;
		
		// while there is an unvisited neighbor
		while(!$this->_arrVisited[$intX][$intY + 1] || !$this->_arrVisited[$intX + 1][$intY] || !$this->_arrVisited[$intX][$intY - 1] || !$this->_arrVisited[$intX - 1][$intY]){
			
			while(true){
				$dblRandom = mt_rand(0, 3);
				if($dblRandom == 0 && !$this->_arrVisited[$intX][$intY + 1]){
					$this->_arrNorth[$intX][$intY + 1] = false;
					$this->_arrSouth[$intX][$intY] = false;
					$this->generate($intX, $intY + 1);
					break;
				}
				else if($dblRandom == 1 && !$this->_arrVisited[$intX + 1][$intY]){
					$this->_arrEast[$intX][$intY] = false;
					$this->_arrWest[$intX + 1][$intY] = false;
					$this->generate($intX + 1, $intY);
					break;
				}
				else if($dblRandom == 2 && !$this->_arrVisited[$intX][$intY - 1]){
					$this->_arrSouth[$intX][$intY - 1] = false;
					$this->_arrNorth[$intX][$intY] = false;
					$this->generate($intX, $intY - 1);
					break;
				}
				else if($dblRandom == 3 && !$this->_arrVisited[$intX - 1][$intY]){
					$this->_arrWest[$intX][$intY] = false;
					$this->_arrEast[$intX - 1][$intY] = false;
					$this->generate($intX - 1, $intY);
					break;
				}
			}
		}
	}
	
	public function draw(){
		// function to output the html ASCII maze
		$strHTML = "";
		$strHTML .= "<table class='maze'>";
		for($y=1; $y<=$this->_intDim; $y++){
			$strHTML .= "<tr>";
			for($x=1; $x<=$this->_intDim; $x++){
				$strWallClass = "";
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
				$strHTML .= "<td class='" . $strWallClass . "'> </td>";
			}
		}
		$strHTML .= "</table>";
		return $strHTML;
	}
}

?>