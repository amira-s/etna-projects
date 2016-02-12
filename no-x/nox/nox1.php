<?php

//Binary search
function nox_binary($message, $dico, $t = 0)
{
	print "\x1b[34;1mBinary Search\x1b[0m\x1b[1m\nDecryptage de " . $message . "\n\x1b[0m";
	$handle = fopen($message, "r");
	$message_content = fread($handle, filesize($message));

	$handle = fopen($dico, "r");
	$dico_content = fread($handle, filesize($dico));

	$dico_arr = preg_split("/\n/", $dico_content);
	preg_match_all("/[^\s\d,;.!?\-\(\)]+[-']?[^\s\d;,.?!\-\(\)]+[-]?[^\s\d;,.?!\-\(\)]+|[^\s\d;.?,!\-\(\)]+/i", $message_content, $message_arr);
	$dico_arr = quick_sort($dico_arr);
	// shell_sort($dico_arr);
	$i = 0;
	$j = 0;
	$time_start = microtime(true);
	if ($t == 0) 
	{
		foreach ($message_arr[0] as $word)
		{
			$j += binary_search_rec($dico_arr, $word, 0, count($dico_arr) - 1);
		}
	}
	else
	{
		foreach ($message_arr[0] as $word)
		{
			$j += binary_search_rec_trad($dico_arr, $word, 0, count($dico_arr) - 1);
		}		
	}
	$time_end = microtime(true);
	$time = $time_end - $time_start;
	print "\x1b[1m" . $j . " Mots du dictionnaire ont été trouvé dans le message.\n\n\x1b[0m";
	print "\x1b[1mRecherche terminée en \x1b[32;1m" . round($time, 5) . "\x1b[0m\x1b[1m sec.\n\x1b[0m";
}

function binary_search_rec_trad($arr, $key, $imin, $imax)
{
	$traduct = traduct("traduct.csv");
	if ($imax < $imin)
		return (0);
	else
	{
		$imid = round(($imin + $imax) / 2) ;
		if ($arr[$imid] > $key)
        	return binary_search_rec_trad($arr, $key, $imin, $imid - 1);
		else if ($arr[$imid] < $key)
			return binary_search_rec_trad($arr, $key, $imid + 1, $imax);
		else
		{			
			if (isset($traduct[$key]))
				print($key . "\t\t<=>\t\t" . $traduct[$key] . "\n");
			else
				print($key . "\n");
			return (1);
		}
	}
}

function binary_search_rec($arr, $key, $imin, $imax)
{
	if ($imax < $imin)
		return (0);
	else
	{
		$imid = round(($imin + $imax) / 2) ;
		if ($arr[$imid] > $key)
        	return binary_search_rec($arr, $key, $imin, $imid - 1);
		else if ($arr[$imid] < $key)
			return binary_search_rec($arr, $key, $imid + 1, $imax);
		else
		{
			print $key . "\n";
			return (1);
		}
	}
}

//search algo with in_array func
function nox_linear($message, $dico, $t = 0)
{
	print "\x1b[34;1mLinar search with in_array()\x1b[0m\x1b[1m\nDecryptage de " . $message . "\n\x1b[0m";
	$handle = fopen($message, "r");
	$message_content = fread($handle, filesize($message));

	$handle = fopen($dico, "r");
	$dico_content = fread($handle, filesize($dico));

	// preg_match_all("/\w+/", $dico_content, $dico_arr);
	// preg_match_all("/\w+/", $message_content, $message_arr);

	preg_match_all("/[^\s\d,;.!?\-\(\)]+[-']?[^\s\d;,.?!\-\(\)]+[-]?[^\s\d;,.?!\-\(\)]+|[^\s\d;.?,!\-\(\)]+/i", $message_content, $message_arr);
	$dico_arr = preg_split("/\n/", $dico_content);

	$j = 0;
	$time_start = microtime(true);
	if ($t == 0)
	{
		foreach($message_arr[0] as $word)
		{
			if (in_array($word, $dico_arr))
			{
				print $word . "\n";
				$j++;
			}
		}
	}
	else
	{
		$traduct = traduct("traduct.csv");
		foreach($message_arr[0] as $word)
		{
			if (in_array($word, $dico_arr))
			{
				if (isset($traduct[$word]))
					print($word . "\t\t<=>\t\t" . $traduct[$word] . "\n");
				else
					print($word . "\n");
				$j++;
			}
		}
	}
	$time_end = microtime(true);
	$time = $time_end - $time_start;
	print "\x1b[1m" . $j . " Mots du dictionnaire ont été trouvé dans le message.\n\n\x1b[0m";
	print "\x1b[1mRecherche terminée en \x1b[32;1m" . round($time, 5) . "\x1b[0m\x1b[1m sec.\n\x1b[0m";
}


//interpolation search
function nox_interpol($message, $dico)
{
	print "Decryptage de " . $message . "\n";
	$handle = fopen($message, "r");
	$message_content = fread($handle, filesize($message));

	$handle = fopen($dico, "r");
	$dico_content = fread($handle, filesize($dico));

	preg_match_all("/\w+/", $dico_content, $dico_arr);
	preg_match_all("/\w+/", $message_content, $message_arr);
	shell_sort($dico_arr[0]);
	$i = 0;
	$time_start = microtime(true);
	while (isset($message_arr[0][$i]))
	{
		interpol_search($dico_arr[0], count($dico_arr[0]), $message_arr[0][$i]);
		$i++;
	}
	$time_end = microtime(true);
	$time = $time_end - $time_start;
	print "Recherche terminée en " . round($time, 5) . " sec.\n";
}

function interpol_search($arr, $size, $key)
{
	$low = 0;
	$high = $size - 1;

	while (($arr[$high] != $arr[$low]) && (($key >= $arr[$low]) && ($arr[$high] >= $key)))
	{
		$mid = $low + ($key - $arr[$low]) * (($high - $low) / ($arr[$high] - $arr[$low]));
		if ($arr[$mid] < $key)
			$low = $mid + 1;
		else if ($key < $arr[$mid])
			$high = $mid - 1;
		else
			print $mid . "\n";
	}
		if ($key == $arr[$low])
			print $low . "\n";
}
