<?php

function get_line()
{
	$line = "";
	$fd = fopen("php://stdin", "r");
	if ($fd !== FALSE)
	{
		while (($char = fgetc($fd)) != "\n")
			$line .= $char;
	}
	fclose($fd);
	return ($line);
}

function get_name($new = 0)
{
	if ($new == 1)
		$phrase = "New name ?\n> ";
	else
		$phrase = "Name ?\n> ";
	echo $phrase;
	$name = get_line();
	while (strlen($name) == 0)
	{
		echo "Erreur: Le nom ne peut pas etre vide.\n";
		echo $phrase;
		$name = get_line();
	}
	return ($name);
}

function get_age($new = 0)
{
	if ($new == 1)
		$phrase = "New age ?\n> ";
	else
		$phrase = "Age ?\n> ";
	echo $phrase;
	$age = get_line();
	while (preg_match("/^[1-9][0-9]?$/i", $age) != 1)
	{
		echo "Erreur: L'age doit etre compris entre 1 et 99.\n";
		echo $phrase;
		$age = get_line();
	}
	return ($age);
}

function get_email($new = 0)
{
	if ($new == 1)
		$phrase = "New email ?\n> ";
	else
		$phrase = "Email ?\n> ";
	echo $phrase;
	$email = get_line();
	while (!preg_match("/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/i", $email))
	{
		echo "Erreur: Email invalide.\n";
		echo $phrase;
		$email = get_line();
	}
	return ($email);
}

function get_number($new = 0)
{
	if ($new == 1)
		$phrase = "New phone number ?\n> ";
	else
		$phrase = "Phone number ?\n> ";
	echo $phrase;
	$number = get_line();
	while (preg_match("/^[0-9]{10}$/i", $number) !== 1)
	{
		echo "Erreur: Numéro invalide.\n";
		echo $phrase;
		$number = get_line();
	}
	return ($number);
}