<?php

function gif($panels, $name)
{
	if (count($panels) > 0)
		echo "Les images générées vont être enregistrées au format GIF.\n";
	$i = 0;
	while (isset($panels[$i]))
	{
		ImageGif($panels[$i], $name . $i . ".gif");
		$i++;
	}
}

function jpeg($panels, $name)
{
	if (count($panels) > 0)
		echo "Les images générées vont être enregistrées au format JPEG.\n";
	$i = 0;
	while (isset($panels[$i]))
	{
		ImageJpeg($panels[$i], $name . $i . ".jpeg");
		$i++;
	}
}

function png($panels, $name)
{
    if (count($panels) > 0)
		echo "Les images générées vont être enregistrées au format PNG.\n";
	$i = 0;
	while (isset($panels[$i]))
	{
		ImagePng($panels[$i], $name . $i . ".png");
		$i++;
	}
}