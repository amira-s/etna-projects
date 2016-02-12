#!/usr/bin/php
<?php

require_once("get_info.php");
require_once("students.php");
require_once("complement.php");
require_once("movies_storing.php");
require_once("rent.php");
require_once("show_rented.php");
require_once("show_movies.php");
require_once("show_movies2.php");
require_once("stat.php");

main($argv, $argc);

function main($argv, $argc)
{
	if (($argc >= 2) && ($argc <= 4))
	{
	    $students = array("add_student", "del_student", "update_student", "show_student",
	    				  "show_movies", "movies_storing", "show_stat");
	    $options_w = array("show_rented_movies", "show_renting_students");
	    $rent = array("rent_movie", "return_movie");
		$m = new MongoClient();
		$db = $m->db_etna;
	    if (in_array($argv[1], $students))
			$argv[1]($db, $argv);
		else if (in_array($argv[1], $options_w) && $argc == 2)
			$argv[1]($db);
		else if (in_array($argv[1], $rent) && $argc == 4)
			$argv[1]($db, $argv);
		else
		{
		   	echo "Error: Commande non definie.\n";
		   	return (0);
		}
	}
	else
	{
	    echo "\033[31mError: Nombre d'arguments incorrect.\033[0m\n";
	 	usage();
	}
}

function check_file($file)
{
	if (!file_exists($file))
	    echo "etna_movies: {$file} No such file or directory\n";
	else if (is_dir($file))
	    echo "etna_movies: {$file}: Is a directory\n";
	else if (!is_readable($file))
	    echo "etna_movies: {$file}: Permission denied\n";
	else if (($file = fopen($file, "r")) === FALSE)
	    echo "etna_movies: {$file}: Cannot open file\n";
	else
		return (1);
}

function confirm()
{
	echo "Are you sure ?\n> ";
	$conf = get_line();
	while (preg_match_all("/^oui|yes|no|non$/i", $conf) != 1)
	{
		echo "Erreur: Oui / Yes / Non / No.\n";
		echo "Are you sure ?\n> ";
		$conf = get_line();
	}
	if (preg_match_all("/^oui|yes$/i", $conf) == 1)
		return (TRUE);
	else
		return (FALSE);
}
