<?php

function mycp($file, $argv)
{
  $str = "";
  while (($c = fread($file, 1)) != FALSE)
    $str .= $c;
  fclose($file);
  chdir($argv[1][2]);
  if (($newfile = fopen($argv[1][1], "w")) == NULL)
    echo "cp: {$argv[1]}: Cannot open file\n";
  else
    {
      fwrite($newfile, $str);
      fclose($newfile);
    }
}
function func_cp($argv, $fd)
{
  $argv = parse($argv);
  if (!file_exists($argv[1][1]))
    echo "cp: {$argv[1][1]} No such file or directory\n";
  else if (is_dir($argv[1][1]))
    echo "cp: {$argv[1][1]}: Is a directory\n";
  else if (!is_readable($argv[1][1]))
    echo "cp: {$argv[1][1]}: Permission denied\n";
  else if (($file = fopen($argv[1][1], "r")) === FALSE)
    echo "cp: {$argv[1][1]}: Cannot open file\n";
  else if (!file_exists($argv[1][2]))
    echo "cp: {$argv[1][2]} No such file or directory\n";
  else if (!is_dir($argv[1][2]) && file_exists($argv[2]))
    echo "cp: {$argv[1][2]}: Not a directory\n";
  else if ((!opendir($argv[1][2])))
    echo "cp: {$argv[1][2]}: Permission denied\n";
  else
    mycp($file, $argv);
}