<?php 
session_start();

if (isset($_SESSION['admin_id']) && isset($_SESSION['username']) ) {

    if(isset($_POST['cpass']) && 
       isset($_POST['new_pass']) &&
       isset($_POST['cnew_pass'])){

      include "../../db_conn.php";
      $cpass = $_POST['cpass'];
      $new_pass = $_POST['new_pass'];
      $cnew_pass = $_POST['cnew_pass'];
      $id = $_SESSION['admin_id'];

      if(empty($cpass)){
         $em = "Mevcut Şifre gerekli"; 
         header("Location: ../profile.php?perror=$em#cpassword");
         exit;
      }else if(empty($new_pass)){
         $em = "Yeni Şifre gerekli"; 
         header("Location: ../profile.php?perror=$em#cpassword");
         exit;
      }else if(empty($cnew_pass)){
         $em = "Şifreyi Onayla gerekli"; 
         header("Location: ../profile.php?perror=$em#cpassword");
         exit;
      }else if($cnew_pass != $new_pass){
         $em = "Yeni şifre ve onay şifresi eşleşmiyor"; 
         header("Location: ../profile.php?perror=$em#cpassword");
         exit;
      }
      
      $sql = "SELECT password FROM admin WHERE id=?";
       $stmt = $conn->prepare($sql);
       $stmt->execute([$id]);

       $data = $stmt->fetch();

      if(!password_verify($cpass, $data['password'])){
         $em = "Yanlış şifre"; 
         header("Location: ../profile.php?perror=$em#cpassword");
         exit;
      }else {
       
        $new_pass = password_hash($new_pass, PASSWORD_DEFAULT);

         $sql = "UPDATE admin SET password=?";
          $stmt = $conn->prepare($sql);
          $res = $stmt->execute([$new_pass]);
         if ($res) {
              $sm = "Şifre Başarıyla Değiştirildi!"; 
              header("Location: ../profile.php?psuccess=$sm#cpassword");
              exit;
          }else {
            $em = "Unknown error occurred"; 
            header("Location: ../profile.php?perror=$em#cpassword");
            exit;
          }

      }
    
     


    }else {
        header("Location: ../profile.php");
        exit;
    }


}else {
    header("Location: ../admin-login.php");
    exit;
} 