<?php

function getcommand($line)
{
  $tab = array();
  if (preg_match_all("/^\s*?([a-z]+)\s?/", $line, $tab) != FALSE)
    return ($tab[1][0]);
}