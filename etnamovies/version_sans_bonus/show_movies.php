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
		echo "\033[0m | Name : " . $film['title'];
		echo " | Year : " . $film['year'] . " | Genres : ";
		echo show_tab($film['genres']);
		echo " | Stock : " . $film['stock'] . "\n";
		echo "________" . "\n\n";
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
		echo "imdb_code \033[1m: " . $film['imdb_code'];
		echo "\033[0m | Name : " . $film['title'];
		echo " | Year : " . $film['year'] . " | Genres : ";
		echo show_tab($film['genres']);
		echo " | Stock : " . $film['stock'] . "\n";
		echo "________" . "\n\n";
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
			echo "imdb_code : " . $film['imdb_code'] . "\n";
			echo "Name      : " . $film['title'] . "\n";
			echo "Year      : " . $film['year'] . "\n" . "Directors : ";
			echo show_tab($film['directors']) . "\n";
			echo "Rate      : " . $film['rate'] . "\n";
			echo "Link      : " . $film['link'] . "\n";
			echo "Stock     : " . $film['stock'] . "\n";
			echo "____________\n\n";
			$i++;
		}
	}
	if ($i == 0)
		echo "Sorry, there's no movie according to your research.\n";
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
			echo "Sorry, there is no film according to your research.\n";
		else
			echo "*" . $i . "*\n";
	}
	else
		echo "You have to enter a year. Ex: 1992\n";
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
			echo "Sorry, there is no film according to your research.\n";
		else
			echo "*" . $i . "*\n";
	}
	else
		echo "Error: Must be an int between 0 and 10.\n";
}