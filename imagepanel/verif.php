<?php
	function verifimg($f, $tab, $filename)
	{
		if (($f == 1) && ($tab[0] == "/" && $tab[1] !== "/"))
		{
			$tmp = $filename . $tab;
		}
		else if (($f == 1) && ($tab[0] == "/" && $tab[1] == "/"))
		{
			$tmp = "http:" . $tab;
		}
		else if (($f == 0) && (preg_match("/^https?:/", $tab, $dump) == FALSE))
		{
			$tmpfilepath = preg_replace("/[^\/]+\/?$/", $tab, $filename);
			$tmp = $tmpfilepath;
		}
		else if (preg_match("/^data:/", $tab, $dump) != FALSE)
			return ("0");
		else
			$tmp = $tab;

		if (($f == 1) && (checkRemoteUrl($tmp) != 1))
		{
			echo 'image : ' .  $tmp . " non fonctionelle.\n";
			return ("0");
		}
		else
			return ($tmp);
	}

	function checkRemoteUrl($url)
	{
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL,$url);
	    curl_setopt($ch, CURLOPT_NOBODY, 1);
	    curl_setopt($ch, CURLOPT_FAILONERROR, 1);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    if(curl_exec($ch)!== FALSE)
	    {
	        return 1;
	    }
	    else
	    {
	        return 0;
	    }
	}

	function verif_url($url)
	{
	    $curl = curl_init($url);
	    curl_setopt($curl, CURLOPT_NOBODY, true);
	    $result = curl_exec($curl);
	    if ($result !== false)
	        {
	            $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
	            if (($statusCode == 404) || ($statusCode == 403))
	                return (false);
	            else
	                return (true);
	        }
	    else
	        return (false);
	}

	function load_content($url)
	{
		$ch = curl_init();
		$timeout = 0;
		curl_setopt ($ch, CURLOPT_URL, $url);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
		curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		$file_contents = curl_exec($ch);
		curl_close($ch);
		return($file_contents);
	}