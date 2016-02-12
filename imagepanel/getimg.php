<?php

require_once("mypathinfo.php");
require_once("tri.php");
require_once("verif.php");
require_once("getimg_1.php");

function getImg($filename, $f = 0)
{
	$tab = array();
    $result = array();
    if ($f == 1)
		{
			// $contents = load_content($filename);
		$contents = '';
$handle = fopen($filename, "rb");
		while (!feof($handle)) {
		    $contents .= fread($handle, 8192);
		}
		fclose($handle);
	}
    else
   	{
   		$handle = fopen($filename, "r");
		$contents = fread($handle, filesize($filename));
   	}
   	if (preg_match_all("/<img[^>]*src=\"([^?\"]+)\"[^>]*>/", $contents, $tab) != FALSE)
   	{
   		$i = 0;
   		while (isset($tab[1][$i]))
   		{
   			$tmp = verifimg($f, $tab[1][$i], $filename);
   			if ($tmp != "0")
			{
				$size = getimagesize($tmp);
				if ($size[0] != "")
				{
					$result[$i]['path'] = $tmp;
		   			$result[$i]['w'] = $size[0];
		   			$result[$i]['h'] = $size[1];
		   			preg_match("/[^\/]+$/", $size["mime"], $minitmp);
		   			$result[$i]['ext'] = $minitmp[0];
		   			$result[$i]['filename'] = my_pathinfo($tab[1][$i])["filename"];
		   			$result[$i]['basename'] = my_pathinfo($tab[1][$i])["basename"];
		   		}
			}
	   		$i++;
   		}
   	}
	echo $filename . " : Il y a " . count($result) . " image(s) trouvées.\n";
    return ($result);
}


function panel($tab, $e = 0, $l = 12, $tri = FALSE)
{
    if ($tri)
    	sort_array($tab);
    $tabpanel = array();
    $i = 0;
    $nb = 0;
    while ($nb < (count($tab) / $l))
    {
	    echo "Veuillez patienter pendant la création des panels...\n";
	    $width = my_getwidth($l, $tab, $i) + 40;
	    $height = my_getheight($l, $e, $tab, $i) + 40;
    	$panel = imagecreatetruecolor($width, $height);
    	imagefilledrectangle($panel, 0, 0, $width, $height, 0xFFFFFF);
    	$dst_x = 40;
    	$dst_y = 40;
    	$counter = 0;
		$nm = 0;
    	while (($counter < $l) && isset($tab[$i]))
    	{
			$im = redim(myimagecreate($tab[$i]), $tab[$i], $e);
			if ($im != 0)
			{
				$nm++;
				imagecopy($panel, $im , $dst_x , $dst_y ,  0 ,  0 ,  imagesx($im) , imagesy($im));
				$dst_x += return_max_width($tab , $i, $i + 3) + 40;
				if ((($nm % 3) == 0) && ($nm > 0))
				{
					$dst_y += return_max_height($tab , $i, $i + 3) + 40;
					$dst_x = 40;
				}
			}
			$counter++;
			$i++;
		}
    	array_push($tabpanel,$panel);
    	$nb++;
    }
    return ($tabpanel);
}

function createtextbox($width, $txt){
	$height = 20;
	$image = imagecreate($width, $height);
	$background = imagecolorallocate($image, 40,71,82);
	$couleurTxt = imagecolorallocate($image, 255, 255, 255);
	$font = 3;
	$widthCaractere = ImageFontWidth($font);
	$heightCaractere = ImageFontHeight($font);
	$widthTxt = $widthCaractere * strlen($txt);
	$positionCentreHor = ceil(($width - $widthTxt) / 2);
	$positionCentreVer = ceil(($height - $heightCaractere) / 2);
	$image_string = ImageString($image, $font, $positionCentreHor, $positionCentreVer, $txt, $couleurTxt);
	return ($image);
}

function appendtextbox($img, $width, $height, $e = 0, $tab)
{
	if ($e == 0)
		return ($img);
	else if ($e == 1)
	{
		$textbox = createtextbox($width, $tab["filename"]);
		$im = imagecreatetruecolor($width, $height + 20);
		imagecopy($im, $img, 0, 0, 0, 0, $width, $height);
		imagecopy($im, $textbox, 0, $height, 0, 0, $width, 20);
		return ($im);
	}
	else if ($e == 2)
	{
		$textbox = createtextbox($width, $tab["basename"]);
		$im = imagecreatetruecolor($width, $height + 20);
		imagecopy($im, $img, 0, 0, 0, 0, $width, $height);
		imagecopy($im, $textbox, 0, $height, 0, 0, $width, 20);
		return ($im);
	}
}

function redim($src, $tab, $e)
{
	$ratio = 200;

	if ($src != 0)
	{
		if ($tab["w"] > $tab["h"]) {
			$width = $ratio;
			$height = round(($ratio/$tab["w"])*$tab["h"]);
		}
		else if ($tab["w"] < $tab["h"])
		{
			$width = round(($ratio/$tab["h"])*$tab["w"]);
			$height = $ratio;
		}
		else
		{
			$width = $ratio;
			$height = $ratio;
		}
		$im = imagecreatetruecolor(200, 200);
    	imagefilledrectangle($im, 0, 0, 200, 200, 0xFFFFFF);
		imagecopyresampled($im, $src, 0, 0, 0, 0, $width, $height, $tab["w"], $tab["h"]);
		return (appendtextbox($im, $width, $height, $e, $tab));
	}
	else
		return (0);
}

