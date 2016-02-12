<?php

function show_stat($db, $argv)
{
	$i = 0;
	if (sizeof($argv) == 2)
	{
		$collection = $db->createCollection("movies");
		$cursor = $collection->find(array('rented' => array( '$gt' => 0)));
		$cursor = $cursor->sort(array("rented" => -1));
		$cursor = $cursor->limit(20);
		foreach ($cursor as $film)
		{
			echo $film['title'] . "\t";
			echo $film['year'] . "\n";
			echo "~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\n";
			echo "Rented    : \033[1;34m" . $film['rented'] . "\033[0m times\n";
			echo "Genre      : " . show_tab($film['genre']) . "\n";
			echo "Rate      : " . $film['rate'] . "\n";
			echo "imbd_code : " . $film['imdb_code'] . "\n";
			echo "____________\n\n";
			$i++;
		}
		echo "*" . $i . "*\n";
	}
	else
		echo "Invalid number of arguments\n";
}
