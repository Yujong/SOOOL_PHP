<?php
include "../DBconnection/DBconnection.php";

//필수입력 사항 - 제목

//제목  qnaTitle
//tag  qnaTag
//작성자(닉네임) accountNick
//내용 qnaContent
//이미지파일 qnaImage null가능


//세션(회원번호값)으로 작성자 닉네임 select? -> 닉네임도 세션값으로 가지고 있다.
//게시글 작성할 떄에 뭔가 더 생각할게 있을거다/2019/03/21
$qnaTag = $_POST['qnaTag'];
$qnaTitle = $_POST['qnaTitle'];
$accountNick  = $_POST['accountNick'];
$qnaContent = $_POST['qnaContent'];

$qnaImage = $_FILES['qnaImage']['name'];
$tmp_name = $_FILES['qnaImage']['tmp_name'];

$posts_writer_select = "SELECT * FROM account WHERE accountNick = '".$accountNick."'";
$posts_writer_select_result = mysqli_query($connect,$posts_writer_select);
$posts_writer_select_result_array = mysqli_fetch_array($posts_writer_select_result);
$accountNo = $posts_writer_select_result_array['accountNo'];




if ($qnaImage != "")
{
//multipart
    $image_dir = "../qnaImage";

    $image_save_name = $qnaTitle . "@" . $qnaImage;
    $image_save_fath = $image_dir ."/".$image_save_name;
    $tmp_name = $_FILES['qnaImage']['tmp_name'];

    move_uploaded_file("$tmp_name", "$image_save_fath");

    $postimagePath = "../postImage".$qnaImage;

//    $posts_insert = "INSERT INTO post (postTag,postWriterNo,postWriter,postTitle,postContent,postImage,postGood,postBad,postCc,postVc,postDc)
//VALUES ('".$qnaTag."','".$accountNo."','".$accountNick."','".$qnaTitle."','".$qnaContent."','".$image_save_fath."',0,0,0,0,0)";

    $posts_insert = "INSERT INTO post (postTag,postWriterNo,postWriter,postTitle,postContent,postImage,postGood,postBad,postCc,postVc,postDc)
VALUES ('".$qnaTag."',9,'".$accountNick."','".$qnaTitle."','".$qnaContent."','".$image_save_fath."',0,0,0,0,0)";

    $posts_insert_result = mysqli_query($connect,$posts_insert);

    if ($posts_insert_result)
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
//    $posts_insert = "INSERT INTO post (postTag,postWriterNo,postWriter,postTitle,postContent,postImage,postGood,postBad,postCc,postVc,postDc)
//VALUES ('".$qnaTag."','".$accountNo."','".$accountNick."','".$qnaTitle."','".$qnaContent."',null,0,0,0,0,0)";


    $posts_insert = "INSERT INTO post (postTag,postWriterNo,postWriter,postTitle,postContent,postImage,postGood,postBad,postCc,postVc,postDc)
VALUES ('".$qnaTag."',9,'".$accountNick."','".$qnaTitle."','".$qnaContent."','".$image_save_fath."',0,0,0,0,0)";

    $posts_insert_result = mysqli_query($connect,$posts_insert);

    if ($posts_insert_result)
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
?>