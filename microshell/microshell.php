<?php

require_once("include/func_command/pwd_echo_cat.php");
require_once("include/allenv.php");
require_once("include/getcommand.php");
require_once("include/func_command/redirection/func_redir.php");
require_once("include/func_command/subfunc.php");
require_once("include/func_command/bonusfunc.php");

function my_exit($ptr)
{
  echo "\033c";
  echo "Good bye !\n";
  return (0);
}

function func_alias($param, $fd)
{
  global $alias;
  $array = parse($param);
  $ptr = "func_".$array[1][1];
  if (function_exists($ptr))
    {
      $alias[$array[1][2]] = $array[1][1];
      echo $array[1][1], " -> ", $array[1][2], ".\n";
    }
  else
    echo "Usage : command_name alias_name\n";
}

function checkalias($command)
{
  global $alias;
  if (array_key_exists($command, $alias))
    return ($alias[$command]);
  else
    return $command;
}

function func_clear($param, $fd)
{
  echo "\033c";
}

echo "\033c";
$alias = array();
myinitenv();
if (!key_exists("HOME", $MYENV))
  {
    echo "There is no env.\nMicroshell can't work properly.\n";
    echo "Try again.\n";
    return (0);
  }
$fd = fopen("php://stdin", "r");
if ($fd !== FALSE)
  {
    $pwd= "PWD";
    echo "\033[1m\033[32m<\033[34m{$MYENV[$pwd]}\033[32m>$\033[0m ";
    while (($line = fgets($fd)) !== FALSE)
      {
	$command = parse($line);
	$command = checkalias($command[1][0]);
	$ptr = "func_".$command;
	if ($ptr == "func_exit" || !isset($MYENV))
	  my_exit($ptr);
	else if (isredir($line) == 1)
	  func_redir($line);
	else if (function_exists($ptr))
	  $ptr($line, $fd);
        else if ($command != "")
	  echo "{$command}: command not found\n";
	echo "\033[1m\033[32m<\033[34m{$MYENV[$pwd]}\033[32m>$\033[0m ";
      }
    fclose($fd);
  }