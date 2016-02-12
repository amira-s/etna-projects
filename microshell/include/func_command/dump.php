<?php

  /*	  $home = my_getenv("HOME");
	  $home = preg_replace("/\//", "\/", $home);
	  $home = "/" . $home . "/";
	  if ((preg_match_all("/(\.\.)/", $nextdir[1][1], $osef) > 0) || preg_match($home, $nextdir[1][1], $osef) == 1)
	    {
	      if (preg_match_all("/(\.\.)/", $nextdir[1][1], $osef))
		dotdot($nextdir[1][1]);
	      else
		majenv("PWD", $nextdir[1][1]);
	    }
	    else
	    majenv("PWD", my_getenv("PWD") . "/" . $nextdir[1][1]);*/

/*function dotdot($line)
{
  $nb = preg_match_all("/(\.\.)/", $line, $osef);
  $i = 0;
  while ($i < $nb)
    {
      $tmp = my_getenv("PWD");
      majenv("PWD", preg_replace("/\/?([^\/]+\/?)$/", "", $tmp));
      $i++;
    }
    }*/