<?php

require_once("include/func_command/subfunc.php");
require_once("minienv.php");

function myinitenv()
{
  global $MYENV;
  if (!isset($MYENV))
    $MYENV= array();
  $MYENV = $_SERVER;
  if (!key_exists("HOME", $MYENV))
    return (0);
  else if (!key_exists("PWD", $MYENV))
    {
      majenv("PWD", $MYENV["HOME"]);
      chdir($MYENV["HOME"]);
    }
}

function func_env($param, $fd)
{
  global $MYENV;
  $var = array_keys($MYENV);
  $i = 0;
  while (isset($var[$i]))
    {
      if (!is_array($MYENV[$var[$i]]))
	{
	  fwrite($fd, $var[$i]);
	  fwrite($fd, "=");
	  fwrite($fd, $MYENV[$var[$i]]);
	  fwrite($fd, "\n");
	}
      $i++;
    }
}

function func_setenv($line, $fd)
{
  global $MYENV;
  if (preg_match_all("/([\S]+)\s?/", $line, $array) < 3)
    fwrite($fd, "setenv: Invalid arguments\n");
  else
    $MYENV[$array[1][1]] = $array[1][2];
}

function func_unsetenv($line, $fd)
{
  global $MYENV;
  if (preg_match_all("/([\S]+)\s?/", $line, $array) > 2)
    fwrite($fd, "setenv: Invalid arguments\n");
  else if (($array[1][1] == "PWD") || ($array[1][1] == "OLDPWD") || ($array[1][1] == "HOME"))
      echo "You can't delete {$array[1][1]}\n";
  else
    unset($MYENV[$array[1][1]]);
    
}