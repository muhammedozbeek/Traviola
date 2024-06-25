<?php 

if(isset($_POST['fname']) && 
   isset($_POST['uname']) && 
   isset($_POST['pass'])){

    include "../db_conn.php";

    $fname = $_POST['fname'];
    $uname = $_POST['uname'];
    $pass = $_POST['pass'];

    $data = "fname=".$fname."&uname=".$uname;
    
    if (empty($fname)) {
    	$em = "Tam ad gerekli";
    	header("Location: ../signup.php?error=$em&$data");
	    exit;
    }else if(empty($uname)){
    	$em = "Kullanıcı adı gerekli";
    	header("Location: ../signup.php?error=$em&$data");
	    exit;
    }else if(empty($pass)){
    	$em = "Şifre gereklidir";
    	header("Location: ../signup.php?error=$em&$data");
	    exit;
    }else {
    	$pass = password_hash($pass, PASSWORD_DEFAULT);

    	$sql = "INSERT INTO users(fname, username, password) 
    	        VALUES(?,?,?)";
    	$stmt = $conn->prepare($sql);
    	$stmt->execute([$fname, $uname, $pass]);

    	header("Location: ../signup.php?success=Your account has been created successfully");
	    exit;
    }


}else {
	header("Location: ../signup.php?error=error");
	exit;
}
