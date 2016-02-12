<?php

function show_movies($db, $argv)
{
	$show = array("year", "genre", "rate");
	if (sizeof($argv) == 2)
		show_movies_basic($db);
	else if (sizeof($argv) == 3 && $argv[2] == "desc")
		show_movies_desc($db);
	else if ((sizeof($argv) == 4) && in_array($argv[2], $show))
    {
    	$tmp = $argv[1] . "_" . $argv[2];
 		$tmp($db, $argv);
 	}
 	else
 	{
 		echo "\033[31mError: Invalid number of arguments.\n";
 		echo "Usage: ./etna_movies.php show_movies [desc].\n";
		echo "Usage: ./etna_movies.php show_movies [year | genre | rate] [argument].\033[0m\n";
 	}
}

function show_tab($tab)
{
	foreach ($tab as $toprint)
	{
		echo $toprint . " ";
	}
}

function verif_float($num)
{
	if ((strlen($num) > 1) && ($num != "10"))
		return (FALSE);
	else if ((intval($num) <= 10) && (intval($num) >= 0))
		return (TRUE);
	return (FALSE);
}

function echo_movie($film)
{
	echo "imdb_code : \033[1m" . $film['imdb_code'] . "\033[0m\n";
	echo "Name      : \033[1;34m" . $film['title'] . "\033[0m\n";
	echo "Year      : \033[32;1m" . $film['year'] . "\033[0m\n" . "Genre(s)  : ";
	echo show_tab($film['genres']) . "\n" . "Directors : ";
	echo show_tab($film['directors']) . "\n";
	echo "Stock     : " . $film['stock'] . "\n";
	echo "Rate      : \033[31;1m" . $film['rate'] . "\033[0m\n";
	echo "____________\n\n";
}