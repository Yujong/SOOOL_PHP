<?php
//
//$result = array
//(
//    "result" => "true",
//    "accountNo" => "123"
//);

error_reporting(E_ALL);
ini_set('display_errors', '1');
//
//
//$image_array = array($_FILES['accountImage']['name']);
//$image_array_count = count($image_array);



$image_save_dir = "../qnaImage";

$image_save_name = $_FILES['upload']['name'];

$name = $_POST['name'];

$accountNick = $_POST['accountNick'];

$image_save_path = $image_save_dir ."/".$name.$accountNick.$image_save_name;

$image_tmp_name = $_FILES['upload']['tmp_name'];

//name

//accountNick

move_uploaded_file("$image_tmp_name","$image_save_path");





//for ($i = 0;$i < $image_array_count;$i++)
//{
//    $image_tmp_name = $_FILES['accountImage']['tmp_name'][$i];
//
//    if($image_tmp_name != "")
//    {
//        $image_save_dir = "../qnaImage";
//
//        $image_save_name = $_FILES['accountImage']['name'][$i];
//
//        $image_save_path = $image_save_dir ."/". $image_save_name;
//
//        if (move_uploaded_file("$image_tmp_name","$image_save_path"))
//        {
//            echo "ok";
//        }
//        else
//        {
//            echo $_FILES['accountImage']['error'];
//        }
//
//    }
//
//}



//
//header('Content-Type: application/json');
//echo json_encode(array($result));

?>