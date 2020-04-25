<?php ob_start();

$connection = mysqli_connect('localhost', 'root', '','cms');


// if($connection){
//     echo 'connected';
// };


// if(!$connection){
//     die('not connected man for that case'. mysqli_error($connection));
// }


$query = "SET NAMES utf8";
mysqli_query($connection,$query);

?>