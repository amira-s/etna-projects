<?php

function movies_storing($db, $filename="movies.csv")
{
	if (check_file($filename))
	{
		$collection = $db->createCollection("movies");
		$i = parse_file($collection, get_data($filename));
		echo $i . " movies successfully stored !\n";
	}
}

function get_data($file)
{
	$fd = fopen($file, "r");
	$content = fread($fd, filesize($file));
	fclose($fd);
	return ($content);
}

function parse_file($collection, $content)
{
	$i = 16;
	preg_match_all("/\"(.*?)\"/", $content, $array);
	while ($i < sizeof($array[1]))
	{
		$document = array();
		$document["imdb_code"] = $array[1][$i + 1];
		$document["title"] = $array[1][$i + 5];
		$document["year"] = intval($array[1][$i + 11]);
		$document["genres"] = genre_directors($array[1][$i + 12]);
		$document["directors"] = genre_directors($array[1][$i + 7]);
		$document["rate"] = floatval($array[1][$i + 9]);
		$document["link"] = $array[1][$i + 15];
		$document["stock"] = rand(0, 5);
		$document["renting_students"] = (object)array();
		$collection->insert($document);
		$i += 16;
	}
	return ((sizeof($array[1]) / 16) - 1);
}

function genre_directors($arr)
{
	$tmp = array();
	preg_match_all("/[^,]+/", $arr, $output);
	foreach ($output[0] as $name){
		array_push($tmp, trim($name));
	}
	return ($tmp);
}
