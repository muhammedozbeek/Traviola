<?php 
session_start();

if (isset($_SESSION['fname']) 
    && $_GET['post_id']) {

  $post_id = $_GET['post_id'];

  include_once("data/Post.php");
  include_once("data/Comment.php");
  include_once("../db_conn.php");
  $res = deleteById($conn, $post_id);
  $res2 = deleteCommentByPostId($conn, $post_id);
  $res3 = deleteLikeByPostId($conn, $post_id);
  if ($res) {
      $sm = "Silme İşlemi Başarılı!"; 
      header("Location: user-post.php?success=$sm");
      exit;
  }else {
    $em = "Unknown error occurred"; 
    header("Location: user-post.php?error=$em");
    exit;
  }

}else {
    header("Location: ../admin-login.php");
    exit;
}