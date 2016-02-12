<?php

function add_student($db, $argv)
{
	if (sizeof($argv) == 3)
	{
		$login = $argv[2];
		if (preg_match("/^[a-zA-Z]{2,6}_[a-zA-Z0-9]$/", $login) == 1)
		{
			$collection = $db->createCollection("students");
			$document = array(
			  "login" => $login,
			  "name" => get_name(),
			  "age" => intval(get_age()),
			  "email" => get_email(),
			  "phone" => get_number(),
			  "rented_movies" => array()
			);

			$collection->insert($document);
			echo "User registered !\n";
		}
		else
			echo "Login invalide.\n";
	}
	else
		echo "Error !\nUsage: ./etna_movies.php login.\n";
}

function del_student($db, $argv)
{
	if (sizeof($argv) == 3)
	{
		$login = $argv[2];
		if (confirm())
		{
			$collection = $db->createCollection("students");
			if ($collection->find(array("login" => $login))->count() > 0)
			{
				$cursor = $collection->remove(array("login" => $login));
				echo "User deleted !\n";
			}
			else
				echo "No student found!\n";
		}
	}
	else
	{
		echo "Error: Invalid number of arguments.\n";
		echo "Usage: ./etna_movies.php del_student login.\n";
	}
}

function update_student($db, $argv)
{
	$collection = $db->createCollection("students");
	if (sizeof($argv) == 3)
	{
		if ($collection->find(array("login" => $argv[2]))->count() > 0)
		{
			$field = modif_field();
			$tmp = "get_" . $field;
			$val = $tmp(1);
			$collection->update(array("login"=>$argv[2]),
		      array('$set'=>array($field=>$val)));
			echo "User informations modified !\n";
		}
		else
			echo "No user found !\n";
	}
	else
	{
		echo "Error: Invalid number of arguments.\n";
		echo "Usage: ./etna_movies.php update_student login.\n";
	}
}

function show_student($db, $argv)
{
	$collection = $db->createCollection("students");
	if (sizeof($argv) == 2)
	{
		$cursor = $collection->find();
		$i = 0;
		foreach ($cursor as $document)
		{
		   	echo "\033[1m" . $document["login"] . "\033[0m \t| ";
		    echo $document["name"] . " \t| " . $document["age"] . " \t| ";
		    echo $document["email"] . " \t| " . $document["phone"] . "\n";
		    $i++;
		}
		echo "*" . $i . "*\n";
	}
	else if (sizeof($argv) == 3)
	{
		$cursor = $collection->find(array("login" => $argv[2]));
		if (verif_login($argv[2], $cursor))
		{
			foreach ($cursor as $document)
				show_details($document);
		}
	}
	else
		echo "Usage: ./etna_movies.php show_student [login].\n";
}

function show_details($document)
{
	echo "login : " . $document["login"] . "\n";
	echo "name  : " . $document["name"] . "\n";
	echo "age   : " . $document["age"] . "\n";
	echo "email : " . $document["email"] . "\n";
	echo "phone : " . $document["phone"] . "\n";
}