<?php
require_once("getimg.php");

function my_getheight($l, $n = 0, $tab, $i)
{
	if ($n == 0)
	{
		if ($l <= 3)
			return ((return_max_height($tab, $i, $l + $i)) + 40);
		else
			return (((return_max_height($tab, $i, $l + $i) + 40) * (round($l / 3) + 1)));
	}
	else
	{
		if ($l <= 3)
			return ((return_max_height($tab, $i, $l + $i) + 60));
		else
			return (((return_max_height($tab, $i, $l + $i) + 40) * (round($l / 3) + 1)) + 20);

	}
}

function my_getwidth($l, $tab, $i)
{
	if ($l <= 3)
		return ($l * (return_max_width($tab, $i, $l + $i) + 40));
	else
		return ((return_max_width($tab , $i, $l + $i) + 40) * 3);
}

function myimagecreate($img)
{

	if (strtolower($img["ext"]) == "jpeg")
		return (imagecreatefromjpeg($img["path"]));
	else if (strtolower($img["ext"]) == "gif")
		return (imagecreatefromgif($img["path"]));
	else if (strtolower($img["ext"]) == "png")
		return (imagecreatefrompng($img["path"]));
	else if (strtolower($img["ext"]) == "wbmp")
		return (imagecreatefromwbmp($img["path"]));
	else
		{
			echo "Le format de l'image : " . $img["basename"] .  " n'est pas supporté.\n";
			return (0);
		}
}