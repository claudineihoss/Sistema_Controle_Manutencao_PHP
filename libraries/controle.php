<?php

public function controlar(){

$CI=&get_instance();

$nivel=$CI->session->userdata("nivel");
$empresa=$CI->session->userdata("empresa");
$usuario=$CI->session->userdata("usuario");

if(empty($empresa)){

redirect('primeiro/index');

}

}

?>
