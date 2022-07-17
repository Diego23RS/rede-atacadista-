<?php
require('bd/config.php');
// new filename
$filename = 'paciente_'.date('YmdHis') . '.jpg';

$url = '';
if(move_uploaded_file($_FILES['webcam']['tmp_name'],$imagem_pacientes.$filename) ){
 $url = $site.'/'.$imagem_pacientes.$filename;
}

// Return image url
echo $url;

?>