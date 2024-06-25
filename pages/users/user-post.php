<?php 
session_start();

if (isset($_SESSION['fname'])) {
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Dashboard - Posts</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
	<link rel="stylesheet" href="../side-bar.css">
	<link rel="stylesheet" href="../style.css">
</head>
<body>
	<?php 
      $key = "hhdsfs1263z";
	  include "inc/side-nav.php"; 
      include_once("data/Post.php");
      include_once("data/Comment.php");
      include_once("../db_conn.php");
      $posts = getAllDeep($conn);
	?>
               
	 <div class="main-table">
	 	<h3 class="mb-3">Tüm Yazılar 
	 		<a href="post-add.php" class="btn btn-success">Yeni Ekle</a></h3>
	 	<?php if (isset($_GET['error'])) { ?>	
	 	<div class="alert alert-warning">
			<?=htmlspecialchars($_GET['error'])?>
		</div>
	    <?php } ?>

        <?php if (isset($_GET['success'])) { ?>	
	 	<div class="alert alert-success">
			<?=htmlspecialchars($_GET['success'])?>
		</div>
	    <?php } ?>

	 	<?php if ($posts != 0) { ?>
	 	<table class="table t1 table-bordered">
		  <thead>
		    <tr>
		      <th scope="col">#</th>
		      <th>Başlık</th>
		      <th>Yorumlar</th>
		      <th>Beğeniler</th>
		      <th>Düzenle</th>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php foreach ($posts as $post) {
		  	$category = getCategoryById($conn, $post['category']); 
		  	?>
		    <tr>
		      <th scope="row"><?=$post['post_id'] ?></th>
		      <td><a href="single_post.php?post_id=<?=$post['post_id'] ?>"><?=$post['post_title'] ?></a></td>
		     
		      <td>
		      	<i class="fa fa-comment" aria-hidden="true"></i> 
		        
		        <?php 
                    echo CountByPostID($conn, $post['post_id']);
		         ?>
		      </td>
		      <td>
		      	<i class="fa fa-thumbs-up" aria-hidden="true"></i> 
		        <?php 
                    echo likeCountByPostID($conn, $post['post_id']);
		         ?>
		     </td>
		      <td>
		      	<a href="post-delete.php?post_id=<?=$post['post_id'] ?>" class="btn btn-danger">Sil</a>
		      	<a href="post-edit.php?post_id=<?=$post['post_id'] ?>" class="btn btn-warning">Düzenle</a>
		      </td>
		    </tr>
		    <?php } ?>
		    
		  </tbody>
		</table>
	<?php }else{ ?>
		<div class="alert alert-warning">
			Boş!
		</div>
	<?php } ?>
	 </div>
	</section>
	</div>

	 <script>
	 	var navList = document.getElementById('navList').children;
	 	navList.item(1).classList.add("active");
	 </script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>

<?php }else {
	header("Location: ../login.php");
	exit;
} ?>