<?php

function    my_strcmp($s1, $s2)
{
    $i = 0;
    while ($i < count($s1))
    {
        if ($s1[$i] < $s2[$i])
            return (-1);
        else if ($s1[$i] > $s2[$i])
            return (1);
        $i++;
    }
    if ($s2[$i] > $s1[$i])
        return (-1);
    else if ($s2[$i] < $s1[$i])
        return (1);
    return (0);
}

function return_indice_min($array, $offset)
{
    $min = $offset++;
    for ($i = $offset; $i < sizeof($array); $i++)
        if(my_strcmp($array[$min]['filename'], $array[$i]['filename']) > 0)
            $min = $i;
    return $min;
}

function permute(&$val1, &$val2)
{
    $inter = $val1;
    $val1 = $val2;
    $val2 = $inter;
}

function sort_array(&$array)
{
    for ($i = 0; $i < sizeof($array); $i++)
    {
        $min =  return_indice_min($array, $i);
        permute($array[$i], $array[$min]);
    }
}

function return_max_width($array, $offset, $end)
{
    // $i = $offset;
    // $max = $array[$i]["w"];
    // while (isset($array[$i]) && ($i < $end))
    // {
    //     if ($array[$i]["w"] > $max)
    //         $max = $array[$i]["w"];
    //     $i++;
    // }
    // return ($max);
    return (200);
}
function return_max_height($array, $offset, $end)
{
    // $ratio = 200;
    // $i = $offset;
    // $max = round(($ratio/$array[$i]["w"])*$array[$i]["h"]);
    // while (isset($array[$i]) && ($i < $end))
    // {
    //     if (round(($ratio/$array[$i]["w"])*$array[$i]["h"]) > $max)
    //         $max = round(($ratio/$array[$i]["w"])*$array[$i]["h"]);
    //     $i++;
    // }
    // return ($max);
    return (200);
}

?>