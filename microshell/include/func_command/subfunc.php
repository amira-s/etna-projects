<?php

require_once("include/minienv.php");

function affgvar($array)
{
  global $MYENV;
  $gvar = array();
  $i = 0;
  while (isset($array[1][$i]) &&
	 (preg_match_all("/[.*]?([$][\w]+)[.*]?/", $array[1][$i], $gvar) >= 1))
    {
      $j = 0;
      while (isset($gvar[1][$j]))
	{
	  if (key_exists(substr($gvar[1][$j], 1), $MYENV))
	    {
	      $array[1][$i] = str_replace($gvar[1][$j], $MYENV[substr($gvar[1][$j], 1)], $array[1][$i]);
	    }
	  $j++;
	}
      $i++;
    }
  return ($array);
}

function parse($param)
{
  $array = array();  
  if (preg_match_all("/([^\s]+)\s?/", $param, $array) != FALSE)
    {
      $array = affgvar($array);
      return ($array);
    }
  else 
    return (NULL);
}

function myls($toprint, $fd, $i = 1)
{
  $j = 0;
  $myls = scandir($toprint[1][$i]);
  chdir($toprint[1][$i]);
  while (isset($myls[$j]))
    {
      if ($myls[$j][0] != ".")
	{
	  if (is_dir($myls[$j]) === TRUE)
	    fwrite($fd, ($myls[$j] . "/"));
	  else if (is_link($myls[$j]) === TRUE)
	    fwrite($fd, ($myls[$j] . "@"));
	  else if (is_executable($myls[$j]) === TRUE)
	    fwrite($fd, ($myls[$j] . "*"));
	    else
	      fwrite($fd, $myls[$j]);
	  fwrite($fd, "\n");
	}
      $j++;
    }
}

function cdmoin(&$prev, $fd)
{
  if (!isset($prev))
    $prev = my_getenv("PWD");
  chdir($prev);
  $temp = my_getenv("PWD");
  majenv("PWD", $prev);
  $prev = $temp;
  majenv("OLDPWD", $temp);
  func_pwd("incase", $fd);
}

