<?php
function traduct($csv)
{
	$handle = fopen($csv, "r");
	$csv_content = fread($handle, filesize($csv));

	$result = preg_split("/\n/", $csv_content);
	$traduct = array();
	foreach ($result as $value) {
		$tmp = preg_split("/,/", $value);
		$traduct[$tmp[1]] = $tmp[0];
	}
	return($traduct);
}