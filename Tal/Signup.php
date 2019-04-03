<?php

include "../DBconnect/DBconnection.php";

$accountEmail = $_POST['accountEmail'];
$accountPW = $_POST['accountPW'];
$accountNick = $_POST['accountNick'];
$accountBirthday = $_POST['accountBirthday'];
//$accountImage = $_POST['$accountImage'];

$accountImage = $_FILES['accountImage']['name'];
$accountGender = $_POST['accountGender'];
$accountAddress = $_POST['accountAddress'];
$accountToa = $_POST['accountToa'];
$accountLiquor = $_POST['accountLiquor'];
$accountRtd = $_POST['accountRtd'];

$accountNo_return;
$image_dir = "profilImage/";


if ($accountImage == "")
{
    $Default_image = $image_dir . "/defaultimage.png";


    if(SingupInsert($accountEmail,$accountPW,$accountNick,$accountBirthday,$Default_image,$accountGender,$accountAddress,$accountToa,$accountLiquor,$accountRtd,$connect) == true)
    {

        if (accountNoSelect($accountEmail,$connect)== true)
        {
            if (PointInset($accountNo_return,$connect)== true)
            {
                $result = array
                (
                    "result" => "false",
                    "accountNo" => $accountNo_return
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
    //$accountImage_tmp_name = $_FILES['accountImage']['tmp_name'];

    $image_save_name = $accountEmail . "@" . $accountImage;

    $image_save_fath = $image_dir . $image_save_name;

    if (move_uploaded_file($image_save_name, $image_dir))
    {

        if(SingupInsert($accountEmail,$accountPW,$accountNick,$accountBirthday,$image_save_fath,$accountGender,$accountAddress,$accountToa,$accountLiquor,$accountRtd,$connect)== true)
        {

            if (accountNoSelect($accountEmail,$connect)== true)
            {
                if (PointInset($accountNo_return,$connect)== true)
                {
                    $result = array
                    (
                        "result" => "false",
                        "accountNo" => $accountNo_return
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

}

function SingupInsert($email,$pw,$nick,$birthday,$image,$gender,$address,$toa,$liquor,$rtd,$connect)
{
    $account_Inset = "INSERT INTO account (accountEmail,accountPW,accountNick,accountBirthday,accountImage,accountGender,accountAddress,accountToa,accountLiquor,accountRtd)
                     VALUES ($email,$pw,$nick,$birthday,$image,$gender,$address,$toa,$liquor,$rtd)";

    $account_Inset_result = mysqli_query($connect,$account_Inset);

    if ($account_Inset_result)
    {
        $return = true;
    }
    else
    {
        $return = false ;
    }

    return $return;
}

//global 변수 test필요
function accountNoSelect($email,$connect)
{
    global $accountNo_return;

    $accountNo_select = "SELECT * FROM account WHERE accountEmail = '".$email."'";

    $accountNo_select_result = mysqli_query($connect,$accountNo_select);

    $accountNo_select_result_array = mysqli_fetch_array($accountNo_select_result);

    $accountNo_return = $accountNo_select_result_array['accountNo'];

    return $accountNo_return;
}

function PointInset($accountNo,$connect)
{
    $point_Inset = "INSERT INTO point (accountNo,accountPoint,accountBc,accountCc) VALUES ($accountNo,50,0,0)";
    $point_Inset_result = mysqli_query($connect,$point_Inset);

    if($point_Inset_result)
    {
        $return = true;
    }
    else
    {
        $return = false;
    }

    return $return;
}


echo json_encode($result);

?>