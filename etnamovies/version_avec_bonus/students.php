<?php

function add_student($db, $argv)
{
	if (sizeof($argv) == 3)
	{			$login = $argv[2];
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
			echo "\033[32mUser registered !\033[0m\n";
		}
		else
			echo "\033[31mError: Login invalide.\n\033[0m";
	}
	else
		echo "\033[31mInvalid arg number!\nUsage: ./etna_movies.php login.\033[0m\n";
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
		echo "\033[31mError: Invalid number of arguments.\n";
		echo "Usage: ./etna_movies.php del_student login.\033[0m\n";
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
			echo "\033[32mUser informations modified !\033[0m\n";
		}
		else
			echo "\033[33mNo user found !\033[0m\n";
	}
	else
	{
		echo "\033[31mError: Invalid number of arguments.\n";
		echo "Usage: ./etna_movies.php update_student login.\033[0m\n";
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
				show_details($document, $db);
		}
	}
	else
		echo "Usage: ./etna_movies.php show_student [login].\n";
}

function show_details($document, $db)
{
	echo "Login \t\033[1;32m: " . $document["login"] . "\033[0m\n";
	echo "Name  \t: " . $document["name"] . "\n";
	echo "Age   \t: " . $document["age"] . "\n";
	echo "Email \t\033[1;34m: " . $document["email"] . "\033[0m\n";
	echo "Phone \t: " . $document["phone"] . "\nRenting : \033[1m";
	show_tab(find_movies($document["rented_movies"], $db));
	echo "\033[0m\n";
}