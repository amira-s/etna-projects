<?php

require_once("getimg.php");
require_once("saveimg.php");
require_once("verif.php");

if (($argc >= 3) || (($argc > 3) && ($argv[1][0] == "-")))
{
    $allimg = array();
    $tri = FALSE;
    $l = 12;
    if (($argv[1][0] == "-") && (preg_match("/^-[gjlnNps]+$/", $argv[1], $tab) == FALSE))
        echo "Une des options choisies n'existe pas.\nUsage:php imagepanel.php [gjlnNps] lien1 [lien2 [...]] base\n";//createhelpmenu
    else if (preg_match("/^[\w-_.]+$/", $argv[$argc - 1], $dump) == FALSE)
        echo "Base incorrecte.\nUsage:php imagepanel.php [gjlnNps] lien1 [lien2 [...]] base\n";
    else if (preg_match("/^-[gjlnNps]+$/", $argv[1], $tab) != FALSE)
    {
        $e = 0;
        $d = 2;
        if (preg_match("/l/", $argv[1], $dump) != FALSE)
        {
            if ((preg_match("/^\d+$/", $argv[2], $dump) == FALSE) || ($argv[2] == "0"))
            {
                echo "Le nombre d'image doit être précisé après les options et supérieur à 0.\n";
               return (0);
            }
            else if ($argc < 5)
            {
                echo "Nombre d'arguments insuffisant.\nUsage:php imagepanel.php [gjlnNps] lien1 [lien2 [...]] base\n";
                return (0);
            }
            else
            {
                $l = (int)$argv[2];
                $d = 3;
            }
        }
        $e = Err_Nn($argc, $argv, $dump, $e);

        if (preg_match("/s/", $argv[1], $dump) != FALSE)
             $tri = TRUE;
        $allimg = getAllImg($argv, $d);
        if (preg_match("/p/", $argv[1], $dump) != FALSE)
            png(panel($allimg, $e, $l, $tri), $argv[$argc - 1]);
        if (preg_match("/g/", $argv[1], $dump) != FALSE)
            gif(panel($allimg, $e, $l, $tri), $argv[$argc - 1]);
        if ((preg_match("/j/", $argv[1], $dump) != FALSE) || (preg_match_all("/[jpg]+/", $argv[1], $dump) == FALSE))
            jpeg(panel($allimg, $e, $l, $tri), $argv[$argc - 1]);
    }
    else if ($argv[1][0] != "-")
    {
        $allimg = getAllImg($argv, 1);
        jpeg(panel($allimg), $argv[$argc - 1]);
    }
}
else
    echo "Nombre d'arguments insuffisant.\nUsage:php imagepanel.php [gjlnNps] lien1 [lien2 [...]] base\n";


function getAllImg($argv, $c)
{
    $tmp = array();
    $allimgtmp = array();
    $j = 0;
    while ($c < (count($argv) - 1))
    {
        if (preg_match("/^https?:\/\//", $argv[$c], $k) == FALSE)
        {
            if (!file_exists($argv[$c]))
                echo "imagepanel: {$argv[$c]} No such file or directory\n";
            else if (is_dir($argv[$c]))
                echo "imagepanel: {$argv[$c]}: Is a directory\n";
            else if (!is_readable($argv[$c]))
                echo "imagepanel: {$argv[$c]}: Permission denied\n";
            else if (($file = fopen($argv[$c], "r")) === FALSE)
                echo "imagepanel: {$argv[$c]}: Cannot open file\n";
            else
                $tmp = getImg($argv[$c], 0);
                $i = 0;
                while (isset($tmp[$i]))
                {
                    $allimgtmp[$j] = $tmp[$i];
                    $j++;
                    $i++;
                }
        }
        else
        {
            if (verif_url($argv[$c]) == false)
                echo "imagepanel: {$argv[$c]}: An error occured.\n";
            else
            {
                $tmp = getImg($argv[$c], 1);
                $i = 0;
                while (isset($tmp[$i]))
                {
                    $allimgtmp[$j] = $tmp[$i];
                    $j++;
                    $i++;
                }
            }
        }
        $c++;
    }
    return ($allimgtmp);
}

function Err_Nn($argc, $argv, $dump, $e)
{
    if (preg_match("/n/", $argv[1], $dump) != FALSE)
    {
        if ($e == 0)
            $e = 1;
        else
        {
            $e = 0;
            echo "Vous avez entré des options contradictoires. Elles vont donc être ignorées.(N ou n)\n";
            return($e);
        }
    }

    if (preg_match("/N/", $argv[1], $dump) != FALSE)
    {
        if ($e == 0)
            $e = 2;
        else
        {
            $e = 0;
            echo "Vous avez entré des options contradictoires. Elles vont donc être ignorées.(N ou n)\n";
            return($e);
        }
    }
    return ($e);

}