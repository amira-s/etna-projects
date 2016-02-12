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
			echo "\033[1;34m" . $film['title'] . "\033[0m    ";
			echo $film['year'] . "\n";
			echo "~~~~~~~~~~~~~~\n";
			echo "imbd_code : \033[1m" . $film['imdb_code'] . "\n";
			echo "\033[0mStock     : " . $film['stock'] . "\n";
			echo "Rented by : \033[1;32m";
			echo show_tab(find_students($film["renting_students"], $db)) ."\n";
			echo "\033[0m____________\n\n";
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
	if (!isset($tmp[0]))
	{
		$tmp[0] = "no one at the moment.";
	}
	return ($tmp);
}

function find_movies($movies_id, $db)
{
	$collection_movies = $db->createCollection("movies");
	$cursor_movies = $collection_movies->find();
	$tmp = array();

	foreach ($cursor_movies as $movie)
	{
		if (in_array($movie["_id"], $movies_id))
			array_push($tmp, $movie["imdb_code"]);
	}
	if (!isset($tmp[0]))
	{
		$tmp[0] = "nothing at the moment.";
	}
	return ($tmp);
}

function show_renting_students($db)
{
	$collection_students = $db->createCollection("students");
	$cursor_student = $collection_students->find();
	$i = 0;

	foreach ($cursor_student as $student)
	{
		if (isset($student["rented_movies"][0]))
		{
			echo "\033[1;32m" . $student['login'] . "\n~~~~~~~~~~~~~~~~~~~\n";
			echo "\033[0mName    : " . $student['name'] . "\n";
			echo "Email   : " . $student['email'] . "\n";
			echo "Phone   : " . $student['phone'] . "\n";
			echo "Renting : \033[1m";
			show_tab(find_movies($student["rented_movies"], $db));
			echo  "\033[0m\n";
			echo "____________\n\n";
			$i++;
		}
	}
	echo "*" . $i . "*\n";
}