<?php

function rent_movie($db, $argv)
{
	$col_movies = $db->createCollection("movies");
	$col_students = $db->createCollection("students");
	$cursor_movie = $col_movies->find(array("imdb_code" => $argv[3]));
	$cursor_student = $col_students->find(array("login" => $argv[2]));

	if (is_student_movie($cursor_movie, $cursor_student))
	{
		$doc_movies = object_to_tab($cursor_movie);
		$doc_students = object_to_tab($cursor_student);
		if ($doc_movies["stock"] > 0)
		{
			$doc_movies["stock"] -= 1;
			$doc_movies["rented"] += 1;
			array_push($doc_students["rented_movies"], $doc_movies["_id"]); 
			array_push($doc_movies["renting_students"], $doc_students["_id"]); 
			$col_movies->update(array("imdb_code" => $argv[3]), $doc_movies);
			$col_students->update(array("login" => $argv[2]), $doc_students);
			echo "Rented !\n";
		}
		else
			echo "Stock-out !\n";
	}
}

function object_to_tab($cursor)
{
	$tmp = iterator_to_array($cursor);
	$key = array_keys($tmp);
	$tmp = $tmp[$key[0]];
	return ($tmp);
}

function is_student_movie($cursor_movie, $cursor_student)
{
	if ($cursor_movie->count() == 0)
		echo "Il n'y a pas de film avec cet imdb_code.\n";
	else if ($cursor_student->count() == 0)
		echo "Il n'y a pas d'etudiant avec ce login.\n";
	else
		return (TRUE);
	return (FALSE);
}

function return_movie($db, $argv)
{
	$col_movies = $db->createCollection("movies");
	$col_students = $db->createCollection("students");
	$cursor_movie = $col_movies->find(array("imdb_code" => $argv[3]));
	$cursor_student = $col_students->find(array("login" => $argv[2]));

	if (is_student_movie($cursor_movie, $cursor_student))
	{
		$doc_m = object_to_tab($cursor_movie);
		$doc_s = object_to_tab($cursor_student);
		if (is_rented($doc_m, $doc_s, $argv))
		{
			$doc_m["stock"] += 1;
			$key = array_search($doc_m["_id"], $doc_s["rented_movies"]);
	    	unset($doc_s["rented_movies"][$key]);
	    	$doc_s["rented_movies"] = array_values($doc_s["rented_movies"]);
			$key = array_search($doc_s["_id"], $doc_m["renting_students"]);
		    unset($doc_m["renting_students"][$key]);
			$doc_m["renting_students"] = array_values($doc_m["renting_students"]);
			$col_movies->update(array("imdb_code" => $argv[3]), $doc_m);
			$col_students->update(array("login" => $argv[2]), $doc_s);
			echo "Returned !\n";
		}
	}
}

function is_rented($doc_movies, $doc_students)
{
	if (in_array($doc_movies["_id"], $doc_students["rented_movies"]) 
		&& in_array($doc_students["_id"], $doc_movies["renting_students"]))
		return (TRUE);
	else
		echo "That movie is not rented by that student.\n";
	return (FALSE);
}
