<?php
function getname($uname){
  $park = ucwords(preg_replace("/[^A-Za-z ]/", '', $uname));
  $park = trim(preg_replace('!\s+!', ' ', $park));
  return $park;

}

function getnamedb($uname){
  $parkdb= preg_replace('/\s+/', '', strtolower($uname)).'db';
  return $parkdb;

}





 ?>
