<?php

function modif_field()
{
	echo "What do you want to update?\n> ";
	$arr = array("age", "name", "email", "phone");
	$field = get_line();
	while (!in_array($field, $arr))
	{
		echo "Erreur: age/name/email/phone.\n";
		echo "What do you want to update?\n> ";
		$field = get_line();	
	}
	return ($field);	
}

function usage()
{
	echo "Usage: ./etna_movies.php add_student login.\n";
	echo "Usage: ./etna_movies.php del_student login.\n";
	echo "Usage: ./etna_movies.php show_student [login].\n";
	echo "Usage: ./etna_movies.php update_student login.\n";
	echo "Usage: ./etna_movies.php show_movies [desc].\n";
	echo "Usage: ./etna_movies.php show_movies [year | genre | rate] [argument].\n";
	echo "Usage: ./etna_movies.php movies_storing.\n";
	echo "Usage: ./etna_movies.php show_movies_rented.\n";
	echo "Usage: ./etna_movies.php rent_movie login imdb_code.\n";
	echo "Usage: ./etna_movies.php return_movie login imdb_code.\n";
	echo "Usage: ./etna_movies.php help.\n";
}

function verif_login($login, $cursor)
{
	if (preg_match("/^[a-zA-Z]{2,6}_[a-zA-Z0-9]$/", $login) == 1)
	{
		if ($cursor->count() > 0)
			return (TRUE);
		else
			{
				echo "Il n'y a pas d'etudiant avec ce login.\n";
				return (FALSE);
			}
	}
	else
	{
		echo "Login invalide.\n";	
		return (FALSE);
	}
}