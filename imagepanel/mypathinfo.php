<?php

function removeslash(&$param, $k)
{
  $str = "";
  if ($k = 0)
    {
      $l = 0;
      while (isset($param[$l]))
	$l++;
      if ($param[$l - 1] === "/")
	$param[$l - 1] = NULL;
    }
  else
    {
      if ($param[0] === "/")
	{
	  $j = 1;
	  while (isset($param[$j]))
	    $str .= $param[$j++];
	  $param = $str;
	}
    }
}

function addslash(&$param)
{
  if ($param[0] != "/")
    {
      $str = "/";
      $j = 0;
      while (isset($param[$j]))
	$str .= $param[$j++];
      $param = $str;
    }
}

function dotordot($param, &$tab)
{
  if ($param === "..")
    {
      $tab["extension"] = "";
      $tab["filename"] = ".";
    }
  else if ($param === ".")
    {
      $tab["extension"] = "";
      $tab["filename"] = "";
    }
}

function my_pathinfo($param = NULL)
{
  removeslash($param, 0);
  $tab["dirname"] = preg_match("/(^.+)\//", $param, $dump) ? $dump[1] : ".";
  if (preg_match("/.*\/(.*)$/", $param, $dump))
    $tab["basename"] = $dump[1];
  else
    {
      removeslash($param, 1);
      preg_match("/(.*)/", $param, $dump);
      $tab["basename"] = $dump[1];
    }
  if ($param === ".." || $param === ".")
    dotordot($param, $tab);
  else if (preg_match("/[.]([^.\/]*)$/", $param, $dump))
    {
      $tab["extension"] = $dump[1];
      addslash($param);
      preg_match("/\/([^\/]*)\.[^\/]*$/", $param, $dump);
      $tab["filename"] = $dump[1];
    }
  else
    {
      preg_match("/\/?([^\/]+)[.\/]?$/", $param, $dump);
      $tab["filename"] = $dump[1];
    }
  return ($tab);
}