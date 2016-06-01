<?php

include_once "Maze.php";

echo "<html>";
echo "<head>";
echo "<link rel='stylesheet' href='main.css'/>";
echo "</head>";
echo "<body>";

$objMaze = new Maze(10);

$strHTMLMaze = $objMaze->draw();
echo $strHTMLMaze;

echo "</body>";
echo "</html>";

?>