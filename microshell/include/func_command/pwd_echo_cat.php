<?php

require_once("include/allenv.php");
require_once("subfunc.php");
require_once("include/minienv.php");

function func_echo($param, $fd)
{
  $toprint = parse($param);
  $i = 1;
  while (isset($toprint[1][$i + 1]))
    {
      fwrite($fd, $toprint[1][$i++]);
      fwrite($fd, " ");
    }
  fwrite($fd, $toprint[1][$i]);
  fwrite($fd, "\n");
}


function func_pwd($param, $fd)
{
  fwrite($fd, my_getenv("PWD"));
  fwrite($fd, "\n");
}

function func_cat($param, $fd)
{
  $toprint = parse($param);
  $i = 1;
  while (isset($toprint[1][$i]))
    {
      if (!file_exists($toprint[1][$i]))
	echo "cat: {$toprint[1][$i]} No such file or directory\n";
      else if (is_dir($toprint[1][$i]))
	echo "cat: {$toprint[1][$i]}: Is a directory\n";
      else if (!is_readable($toprint[1][$i]))
	echo "cat: {$toprint[1][$i]}: Permission denied\n";
      else if (($file = fopen($toprint[1][$i], "r")) === FALSE)
	echo "cat: {$toprint[1][$i]}: Cannot open file\n";
      else
	{
	  while (($c = fread($file, 1)) != NULL)
	    fwrite($fd, $c);
	  fclose($file);
	}
      $i++;
    }
}

function func_ls($param, $fd)
{
  $current = my_getenv("PWD");
  if (preg_match_all("/([^\s]+)\s?/", $param, $toprint) === 1)
    {
      $toprint[1][1] = '.';
      myls($toprint, $fd);
    }
  else
    {
      $i = 1;
      while (isset($toprint[1][$i]))
	{
	  if ($toprint[1][$i][0] == "~")
	    $toprint[1][$i] = preg_replace("/~/", my_getenv("HOME"), $toprint[1][$i]);
	  if (!file_exists($toprint[1][$i]))
	    fwrite($fd, "ls: {$toprint[1][$i]} No such file or directory\n");
	  else if (!is_readable($toprint[1][$i]))
	    fwrite($fd, "ls: {$toprint[1][$i]}: Permission denied\n");
	    else
	      {
		myls($toprint, $fd, $i);
		chdir($current);
	      }
	  $i++;
	}
    }
}

function func_cd($param, $fd)
{
  static $prev;
  $nextdir = parse($param);
  if (isset($nextdir[1][1]))
    {
      if ($nextdir[1][1][0] == "~")
	$nextdir[1][1] = preg_replace("/~/", my_getenv("HOME"), $nextdir[1][1]);
      if ($nextdir[1][1] == "-")
	cdmoin($prev, $fd);
      else if (!file_exists($nextdir[1][1]))
	echo "cd: {$nextdir[1][1]} No such file or directory\n";
      else if (!is_readable($nextdir[1][1]))
	echo "cd: {$nextdirt[1][1]}: Permission denied\n";
      else
	{
	  $prev = my_getenv("PWD");
	  majenv("OLDPWD", my_getenv("PWD"));
	  chdir($nextdir[1][1]);
	  majenv("PWD", getcwd());
	}
    }
  else
    func_cd("cd ~", $fd);
}