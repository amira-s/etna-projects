<?php

function show_rented_movies($db)
{
	$collection_movies = $db->createCollection("movies");
	$cursor_movie = $collection_movies->find();
	$i = 0;

	foreach ($cursor_movie as $film)
	{
		if (isset($film["renting_students"][0]))
		{
			echo "imbd_code \033[1m: " . $film['imdb_code'] . "\n";
			echo "\033[0mName      : " . $film['title'] . "\n";
			echo "Year      : " . $film['year'] . "\n" . "Genre(s)  : ";
			echo show_tab($film['genres']) . "\n" . "Directors : ";
			echo show_tab($film['directors']) . "\n";
			echo "Link      : " . $film['link'] . "\n";
			echo "Stock     : " . $film['stock'] . "\n";
			echo "Rate      : " . $film['rate'] . "\nRented by : ";
			echo  show_tab(find_students($film["renting_students"], $db)) . "\n";
			echo "____________\n\n";
			$i++;
		}
	}
	echo "*" . $i . "*\n";
}

function find_students($students_id, $db)
{
	$collection_students = $db->createCollection("students");
	$cursor_student = $collection_students->find();
	$tmp = array();

	foreach ($cursor_student as $student)
	{
		if (in_array($student["_id"], $students_id))
			array_push($tmp, $student["login"]);
	}
	return ($tmp);
}