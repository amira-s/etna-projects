<?php

function show_movies_basic($db)
{
	$collection = $db->createCollection("movies");
	$cursor = $collection->find();
	$cursor = $cursor->sort(array("title" => 1));
	$i = 0;

	foreach ($cursor as $film)
	{
		echo "imdb_code : \033[1m" . $film['imdb_code'];
		echo "\033[0m | Name : \033[1;34m" . $film['title'];
		echo "\033[0m | Year :\033[1;32m " . $film['year'] . " | ";
		echo "\033[0m";
		show_tab($film['genres']);
		echo " | Stock : \033[1m" . $film['stock'] . "\n";
		echo "\033[0m________" . "\n\n";
		$i++;
	}
	echo "*" . $i . "*\n";
}

function show_movies_desc($db)
{
	$collection = $db->createCollection("movies");
	$cursor = $collection->find();
	$cursor = $cursor->sort(array("title" => -1));
	$i = 0;

	foreach ($cursor as $film)
	{
		echo "imdb_code : \033[1m" . $film['imdb_code'];
		echo "\033[0m | Name : \033[1;34m" . $film['title'];
		echo "\033[0m | Year :\033[1;32m " . $film['year'] . " | ";
		echo "\033[0m";
		show_tab($film['genres']);
		echo " | Stock : \033[1m" . $film['stock'] . "\n";
		echo "\033[0m________" . "\n\n";
		$i++;
	}
	echo "*" . $i . "*\n";
}

function show_movies_genre($db, $argv)
{
	$collection = $db->createCollection("movies");
	$cursor = $collection->find();
	$i = 0;

	foreach($cursor as $film)
	{
		if (in_array(strtolower($argv[3]), $film["genres"]))
		{
			echo "imdb_code : \033[1m" . $film['imdb_code'] . "\033[0m\n";
			echo "Name      : \033[1;34m" . $film['title'] . "\033[0m\n";
			echo "Year      : " . $film['year'] . "\n" . "Genre(s)  : \033[32;1m";
			echo show_tab($film['genres']) . "\033[0m\n" . "Directors : ";
			echo show_tab($film['directors']) . "\n";
			echo "Stock     : " . $film['stock'] . "\n";
			echo "Rate      : \033[35m" . $film['rate'] . "\033[0m\n";
			echo "____________\n\n";
			$i++;
		}
	}
	if ($i == 0)
		echo "\033[33mSorry, no movie found.\033[0m\n";
	else
		echo "*" . $i . "*\n";
}

function show_movies_year($db, $argv)
{
	$collection = $db->createCollection("movies");
	$cursor = $collection->find(array("year" => (int)$argv[3]));
	if (preg_match("/^[0-9]{4}$/", $argv[3]))
	{
		$i = 0;

		foreach($cursor as $film)
		{
			echo_movie($film);
			$i++;
		}
		if ($i == 0)
			echo "\033[33mSorry, no movie found.\033[0m\n";
		else
			echo "*" . $i . "*\n";
	}
	else
		echo "\033[31mYou have to enter a year. Ex: 1992\033[0m\n";
}

function show_movies_rate($db, $argv)
{
	if (verif_float($argv[3]))
	{
		$num = intval($argv[3]);
		$collection = $db->createCollection("movies");
		$range = array( '$gte' => (float)$argv[3], '$lte' => (float)$argv[3] + 0.9 );
		$cursor = $collection->find(array('rate' => $range));
		$i = 0;

		foreach($cursor as $film)
		{
			echo_movie($film);
			$i++;
		}
		if ($i == 0)
			echo "\033[33mSorry, no movie found.\033[0m\n";
		else
			echo "*" . $i . "*\n";
	}
	else
		echo "\033[31mError: Must be an int between 0 and 10.\033[0m\n";
}