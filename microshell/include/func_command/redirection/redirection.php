<?php

function len($str)
{
  $l = 0;
  while (isset($str[$l]))
    $l++;
  return ($l);
}

function istxt($str)
{
  $i = 0;
  $str1 = "";
  while ($i < 4)
    $str1 .= $str[len($str) - $i];
  if ($str1 != "txt.")
    return (0);
  else
    return (1);
}

function redirection($argv)
{
  $chevron = array();
  preg_match("/>+/", $argv[0], $chevron);
  if ($chevron[0] == ">")
    {
      if (($file = fopen($argv[2], "w")) === FALSE)
	echo "content.php: {$argv[2]}: Cannot open file\n";
      else
	{
	  $command = getcommand($argv[1]);
	  $command = checkalias($command);
	  $ptr = "func_".$command;
	  if (function_exists($ptr))
	    $ptr($argv[1], $file);
	  fclose($file);
	}
    }
  else if ($chevron[0] == ">>")
    {
      if (($file = fopen($argv[2], "a")) === FALSE)
	echo "content.php: {$argv[2]}: Cannot open file\n";
      else
	{
	  $command = getcommand($argv[1]);
	  $ptr = "func_".$command;
	  if (function_exists($ptr))
	    $ptr($argv[1], $file);
	  fclose($file);
	}
    }
}
