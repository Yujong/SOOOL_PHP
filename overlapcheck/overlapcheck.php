<?php
include "../DBconnection/DBconnection.php";

$separator = $_POST['separator'];

$accountEmail = $_POST['accountEmail'];
$accountNick = $_POST['accountNick'];


if ($separator == 0)
{

    $email_check = "SELECT * FROM account WHERE accountEmail ='".$accountEmail."'";
    $email_check_result = mysqli_query($connect,$email_check);
    $email_check_result_row = mysqli_num_rows($email_check_result);


    if($email_check_result_row == 0 )
    {
        $result = array
        (
            "result" => "true"
        );
    }
    else
    {
        $result = array
        (
            "result" => "false"
        );
    }
}
else
{
    $nick_check = "SELECT * FROM account WHERE accountNick ='".$nick."'";
    $nick_check_result = mysqli_query($connect,$nick_check);
    $nick_check_result_row = mysqli_num_rows($nick_check_result);


    if($nick_check_result_row == 0)
    {
        $result = array
        (
            "result" => "true"
        );
    }
    else
    {
        $result = array
        (
            "result" => "false"
        );
    }
}



header('Content-Type: application/json');
echo json_encode(array($result));

//
//function Emailcheck($email,$connect)
//{
//    $email_check = "SELECT * FROM account WHERE accountEmail ='".$email."'";
//    $email_check_result = mysqli_query($connect,$email_check);
//    $email_check_result_row = mysqli_num_rows($email_check_result);
//
//    if ($email_check_result_row == 0)
//    {
//        $return = true;
//    }
//    else
//    {
//        $return = false;
//    }
//
//    return $return;
//}
//function Nickcheck($nick,$connect)
//{
//    $nick_check = "SELECT * FROM account WHERE accountNick ='".$nick."'";
//    $nick_check_result = mysqli_query($connect,$nick_check);
//    $nick_check_result_row = mysqli_num_rows($nick_check_result);
//
//    if ($nick_check_result_row == 0)
//    {
//        $return = true;
//    }
//    else
//    {
//        $return = false;
//    }
//
//    return $return;
//}

?>


