<?php

require_once("redirection.php");

function isredir($line)
{
  $testab = array();
  if (preg_match("/>|>>/", $line, $testab) != NULL)
    return (1);
  else
    return (0);
}

function func_redir($line)
{
  $tabtest = array();
  preg_match("/([^>]*) >+ (.*)/", $line, $tabtest);
  if (count($tabtest) != 3)
    echo "Syntax is wrong\n";
  else
    {
      if (is_dir($tabtest[2]) || $tabtest[2][len($tabtest[2]) - 1] == '/')
        echo "content.php: {$tabtest[2]}: Is a directory\n";
      else if (file_exists($tabtest[2]) && !is_writable($tabtest[2]))
        echo "content.php: {$tabtest[2]}: Permission denied\n";
      else
        redirection($tabtest);
    }
}
