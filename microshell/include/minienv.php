<?php

function my_getenv($name)
{
  global $MYENV;
  return ($MYENV[$name]);
}

function majenv($name, $value)
{
  global $MYENV;
  $MYENV[$name] = $value;
}