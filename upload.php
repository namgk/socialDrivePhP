<?php 
if (isset($_FILES["LogFile"]["name"]) && $_FILES["LogFile"]["name"] != ""){ 

$uploadlog = $_FILES["LogFile"]["name"];

$headers = apache_request_headers();

foreach ($headers as $header => $value) {
  if ($header ==  "id") $uploadid = $value;

}
$md5hash_dir = md5($uploadid . $uploadid . $uploadid);

$root_dir = 'logs/';
$uploads_dir = $root_dir . $md5hash_dir . '/';

if ( ! is_dir($uploads_dir)) {
    mkdir($uploads_dir);
}

move_uploaded_file($_FILES['LogFile']['tmp_name'], $uploads_dir.'trackLog.csv');

//$md5hash_id = md5($uploadid . $uploadid);

$md5hash_id = bin2hex(mhash(MHASH_SHA256, $uploadid . $uploadid ));

file_put_contents($uploads_dir.'info.txt', print_r($md5hash_id, true));

echo $md5hash_id;




    }else{ 
        echo "Could not complete query. Missing parameter";  
    } 

?>