<?php

include "../DBconnection/DBconnection.php";



$accountEmail = $_POST['accountEmail'];
$accountPW = $_POST['accountPW'];

$email_select = "SELECT * FROM account WHERE accountEmail ='".$accountEmail."'";

$email_select_result = mysqli_query($connect,$email_select);

$email_select_result_row = mysqli_num_rows($email_select_result);

if ($email_select_result_row = 0)
{

    $pw_select = "SELECT * FROM account WHERE accountEmail ='".$email."'";

    $pw_select_result = mysqli_query($connect,$pw_select);

    $pw_select_result_array = mysqli_fetch_array($pw_select_result);

    $enc = $pw_select_result_array['accountPW'];


    if (password_verify($accountPW,$enc))
    {
        //회원번호,닉네임,프로필이미지,포인트수,게시물수,댓글수


        $account_selct = "SELECT * FROM account INNER JOIN point ON account.accountNo = point.accountNo  WHERE account.accountEmail='".$accountEmail."'";

        $account_selct_result = mysqli_query($connect,$account_selct);

        $account_selct_result_array = mysqli_fetch_array($account_selct_result);
        $result = array
        (
            "result" => "true",
            "accountNo" => $account_selct_result_array['accountNo'],
            "accountNick" => $account_selct_result_array['accountNick'],
            "accountImage" => $account_selct_result_array['accountImage'],
            "accountPoint" => $account_selct_result_array['accountPoint'],
            "accountBc" => $account_selct_result_array['accountBc'],
            "accountCc" => $account_selct_result_array['accountCc']
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
    $result = array
    (
        "result" => "false"
    );
}

//function emailSelect($email,$connect)
//{
//    $email_select = "SELECT * FROM account WHERE accountEmail ='".$email."'";
//
//    $email_select_result = mysqli_query($connect,$email_select);
//
//    $email_select_result_row = mysqli_num_rows($email_select_result);
//
//    if ($email_select_result_row == 0)
//    {
//        $return = false;
//    }
//    else
//    {
//        $return = true;
//    }
//
//    return $return;
//}
//function comparePW($email,$pw,$connect)
//{
//    $pw_select = "SELECT * FROM account WHERE accountEmail ='".$email."'";
//
//    $pw_select_result = mysqli_query($connect,$pw_select);
//
//    $pw_select_result_array = mysqli_fetch_array($pw_select_result);
//
//    $enc = $pw_select_result_array['accountPW'];
//
//    if(password_verify($pw,$enc))
//    {
//        $return = true;
//    }
//    else
//    {
//        $return = false;
//    }
//    return $return;
//}
////global 변수 test필요
//function accountSelect($email,$connect)
//{
//    $account_selct = "SELECT * FROM account INNER JOIN point ON account.accountNo = point.accountNo  WHERE account.accountEmail='".$email."'";
//
//    $account_selct_result = mysqli_query($connect,$account_selct);
//
//    $account_selct_result_array = mysqli_fetch_array($account_selct_result);
//
//    $accountNo = $account_selct_result_array['accountNo'];
//    $accountNick = $account_selct_result_array['accountNick'];
//    $accountImage = $account_selct_result_array['accountImage'];
//    $accountPoint = $account_selct_result_array['accountPoint'];
//    $accountBc = $account_selct_result_array['accountBc'];
//    $accountCc = $account_selct_result_array['accountCc'];
//
//}


header('Content-Type: application/json');
echo json_encode(array($result));
?>