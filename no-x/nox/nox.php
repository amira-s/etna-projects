<?php

$time_start = microtime(true);

require_once("traduct.php");
require_once("sort.php");
require_once("nox1.php");

if (($argc >= 3) && (($argc >= 4) && ($argv[1][0] == "-")))
{
	print chr(27) . "[2J" . chr(27) . "[;H";
	print("\x1b[32;1;4mBienvenue agent N°X\x1b[0m\n\x1b[1mNous allons vous aider à decrypter votre message.\nVerification du dictionnaire...\n");
	if (!verif($argv[$argc - 1]))
	{
		print("\x1b[31;1mnox.php: Usage: php nox.php message [message2[...]] dictionnaire\n\x1b[0m");
		return (0);
	}
	else
	{
		print("Dictionnaire valide.\n\x1b[0m");
		if (($argv[1][0] == "-") && (preg_match("/^-[bslpti]+$/", $argv[1], $tab) == FALSE))
			echo  "\x1b[31;1mUne des options choisies n'existe pas.\x1b[0m\nb: Binary Search\nl: Linear Search with in_array()\ns: Search using strpos()\np: Search using regular expressions\nt: Activate traduction\ni: Search using isset()\n";
		else if (preg_match("/^-[blspti]+$/", $argv[1], $tab) != FALSE)
 		{
			for ($c = 2; $c <= ($argc - 2); $c++)
			{
				if (verif($argv[$c]))
				{
					if (preg_match("/^-t$/", $argv[1], $dump) != FALSE)
						nox_arr($argv[$c], $argv[$argc - 1], 1);					
					else 
					{
						if (preg_match("/t/", $argv[1], $dump) != FALSE)
							$t = 1;
						if (preg_match("/b/", $argv[1], $dump) != FALSE)
							nox_binary($argv[$c], $argv[$argc - 1], $t);
						if (preg_match("/i/", $argv[1], $dump) != FALSE)
							nox_arr($argv[$c], $argv[$argc - 1], $t);
						if (preg_match("/p/", $argv[1], $dump) != FALSE)
							nox_match($argv[$c], $argv[$argc - 1], $t);
						if (preg_match("/l/", $argv[1], $dump) != FALSE)
							nox_linear($argv[$c], $argv[$argc - 1], $t);
						if (preg_match("/s/", $argv[1], $dump) != FALSE)
							nox_strpos($argv[$c], $argv[$argc - 1], $t);
					}
				}
			}
		}
		else
		{
			for ($c = 1; $c <= ($argc - 2); $c++)
			{
				if (verif($argv[$c]))
				{
					nox_arr($argv[$c], $argv[$argc - 1]);
				}
			}
		}
	}
	$time_end = microtime(true);
	$time = $time_end - $time_start;
	print "\x1b[1mExecution du programme en \x1b[32;1m" . round($time, 5) . "\x1b[0m\x1b[1m sec.\n\x1b[0m";
}
else {
		print("\x1b[31;1mnox.php: Usage: php nox.php message [message2[...]] dictionnaire\n\x1b[0m");
}

function verif($filename)
{
	if (!file_exists($filename))
	{
		print("\x1b[31;1mnox.php: {$filename} Fichier ou dossier introuvable\n\x1b[0m");
		return (false);
	}
	else if (is_dir($filename))
	{
	    print("\x1b[31;1mnox.php: {$filename}: est un dossier\n\x1b[0m");
		return (false);
	}
	else if (!is_readable($filename))
	{
		print("\x1b[31;1mnox.php: {$filename}: Accès interdit\n\x1b[0m");
		return (false);
	}
	else if (($file = fopen($filename, "r")) === FALSE)
	{
	    print("\x1b[31;1mnox.php: {$filename}: Impossible d'ouvrir le fichier\n\x1b[0m");
		return (false);
	}
	else
		return (true);
}

function nox_arr($message, $dico, $t = 0)
{
	print "\x1b[34;1mRecherche avec tableau associatif\x1b[0m\x1b[1m\nDecryptage de " . $message . "\n\x1b[0m";
	$handle = fopen($message, "r");
	$message_content = fread($handle, filesize($message));

	$handle = fopen($dico, "r");
	$dico_content = fread($handle, filesize($dico));

	preg_match_all("/[^\s\d,;.!?\-\(\)]+[-']?[^\s\d;,.?!\-\(\)]+[-]?[^\s\d;,.?!\-\(\)]+|[^\s\d;.?,!\-\(\)]+/i", $message_content, $message_arr);
	$dico_arr = preg_split("/\n/", $dico_content);

	//revert tab manually so we're able to lower the case.
	//$dic = array_flip($dico_arr);
	foreach ($dico_arr as $word)
		$dic[strtolower($word)] = 1;

	$j = 0;
	$time_start = microtime(true);
	if ($t == 0)
	{
		foreach ($message_arr[0] as $tofind)
		{
			if (isset($dic[strtolower($tofind)]) !== FALSE)
			{
				print($tofind . "\n");
				$j++;
			}
		}
	}
	else
	{
		$traduct = traduct("traduct.csv");
		foreach ($message_arr[0] as $tofind)
		{
			if (isset($dic[strtolower($tofind)]) !== FALSE)
			{
				if (isset($traduct[$tofind]))
					print($tofind . "\t\t<=>\t\t" . $traduct[$tofind] . "\n");
				else
					print($tofind . "\n");
				$j++;
			}
		}
	}
	$time_end = microtime(true);
	$time = $time_end - $time_start;
	print "\x1b[1m" . $j . " Mots du dictionnaire ont été trouvé dans le message.\n\n\x1b[0m";
	print "\x1b[1mRecherche terminée en \x1b[32;1m" . round($time, 5) . "\x1b[0m\x1b[1m sec.\n\x1b[0m";

}

//search with strpos function
function nox_strpos($message, $dico, $t = 0)
{
	print "\x1b[34;1mSearch using strpos()\x1b[0m\x1b[1m\nDecryptage de " . $message . "\n\x1b[0m";
	$handle = fopen($message, "r");
	$message_content = fread($handle, filesize($message));

	$handle = fopen($dico, "r");
	$dico_content = fread($handle, filesize($dico)) . "\n";

	preg_match_all("/[^\s\d,;.!?\-\(\)]+[-']?[^\s\d;,.?!\-\(\)]+[-]?[^\s\d;,.?!\-\(\)]+|[^\s\d;.?,!\-\(\)]+/i", $message_content, $words);
	$j = 0;
	$time_start = microtime(true);
	if ($t == 0)
	{
		for ($i = 0; isset($words[0][$i]); $i++)
		{
			$str = 	"\n" . $words[0][$i] . "\n";
			if (strpos($dico_content , $str))
			{
				print($words[0][$i] . "\n");
				$j++;
			}
		}
	}
	else
	{
		$traduct = traduct("traduct.csv");
		for ($i = 0; isset($words[0][$i]); $i++)
		{
			$str = 	"\n" . $words[0][$i] . "\n";
			if (strpos($dico_content , $str))
			{
				if (isset($traduct[$words[0][$i]]))
					print($words[0][$i] . " <=> " . $traduct[$words[0][$i]] . "\n");
				else
					print($words[0][$i] . "\n");
				$j++;
			}
		}	
	}
	$time_end = microtime(true);
	$time = $time_end - $time_start;
	print "\x1b[1m" . $j . " Mots du dictionnaire ont été trouvé dans le message.\n\n\x1b[0m";
	print "\x1b[1mRecherche terminée en \x1b[32;1m" . round($time, 5) . "\x1b[0m\x1b[1m sec.\n\x1b[0m";

}

//preg search
function nox_match($message, $dico, $t = 0)
{
	print "\x1b[34;1mSearch for words with regex\x1b[0m\x1b[1m\nDecryptage de " . $message . "\n\x1b[0m";
	$handle = fopen($message, "r");
	$message_content = fread($handle, filesize($message));

	$handle = fopen($dico, "r");
	$dico_content = fread($handle, filesize($dico));

	$words_to_find = preg_split("/\n/", $dico_content);
	
	$regex = "/";
	for ($i = 0; isset($words_to_find[$i]); $i++)
	{
		if ($i === 0)
			$regex .= "\b" . $words_to_find[$i] . "\b";
		else
			$regex .= "|\b" . $words_to_find[$i] . "\b";
	}
	$regex .= "/i";
	print "\x1b[1m" . $i . " Mots dans le dictionnaire.\n\x1b[0m";
	$time_start = microtime(true);
	preg_match_all($regex, $message_content, $result);
	if ($t == 0)
	{
		for ($i = 0; isset($result[0][$i]); $i++)
			print($result[0][$i] . "\n");
	}
	else
	{
		$traduct = traduct("traduct.csv");
		for ($i = 0; isset($result[0][$i]); $i++)
		{
			if (isset($traduct[$result[0][$i]]))
				print($result[0][$i] . " <=> " . $traduct[$result[0][$i]] . "\n");
			else
				print($result[0][$i] . "\n");

		}
	}
	$time_end = microtime(true);
	$time = $time_end - $time_start;
	print "\x1b[1m" . $i . " Mots du dictionnaire ont été trouvé dans le message.\n\n\x1b[0m";
	print "\x1b[1mRecherche terminée en \x1b[32;1m" . round($time, 5) . "\x1b[0m\x1b[1m sec.\n\x1b[0m";
}