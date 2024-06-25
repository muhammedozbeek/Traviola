<?php 

session_start();

if (isset($_SESSION['fname'])){

	if (isset($_POST['comment']) && isset($_POST['post_id'])) {
        $comment = $_POST['comment'];
        $post_id = $_POST['post_id'];
        $user_id = $_SESSION['fname'];
         include "../db_conn.php";

        if (empty($comment)) {
	    	$em = "Yorum yapıldı";
	    	header("Location: ../blog-view.php?error=$em&post_id=$post_id#comments");
		    exit;
        }else {
        	$sql = "INSERT INTO comment(comment, user_id, post_id) 
    	        VALUES(?,?,?)";
	    	$stmt = $conn->prepare($sql);
	    	$stmt->execute([$comment, $user_id, $post_id]);

	    	header("Location: ../blog-view.php?success=Yorum yapıldı &post_id=$post_id#comments");
		    exit;
        }
		
	}else {
		header("Location: ../blog.php");
	    exit;
	}
 
}else {
	header("Location: ../blog.php");
	exit;
}