
<?php 
session_start();
$logged = false;
if (isset($_SESSION['fname'])) {
	 $logged = true;
	 $user_id = $_SESSION['fname'];
    }
  $notFound = 0;
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>
		<?php 
		if(isset($_GET['search'])){ 
			  echo "search '".htmlspecialchars($_GET['search'])."'"; 
		}else{
			echo "Blog Page";
		} ?>
	</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="style.css">
</head>
<body style="background: linear-gradient(to bottom right, #00cc00, #3399ff);">
	<?php 
      include 'inc/NavBar.php';
      include_once("admin/data/Post.php");
      include_once("admin/data/Comment.php");
      include_once("db_conn.php");
      if(isset($_GET['search'])){
      	 $key = $_GET['search'];
         $posts = serach($conn, $key);
         if ($posts == 0) {
         	  $notFound = 1;
         }
      }else {
         $posts = getAll($conn);
      }
      $categories = get5Categoies($conn); 
	 ?>
    
    <div class="container mt-5">
    <section class="d-flex" style="justify-content: center;">
    	 
  	   <?php if ($posts != 0) { ?>
  	   <main class="main-blog" >
  	   	<h1 class="display-4 mb-4 fs-3">
  	   	<?php 
				if(isset($_GET['search'])){ 
					  echo "Search <b>'".htmlspecialchars($_GET['search'])."'</b>"; 
				}?></h1>
  	   	<?php foreach ($posts as $post) { ?>
  	   	   <div class="card main-blog-card mb-5" style="background: transparent;">
			  <img src="upload/blog/<?=$post['cover_url']?>" class="card-img-top" alt="...">
			  <div class="card-body">
			    <h5 class="card-title"><?=$post['post_title']?></h5>
			    <?php 
                    $p = strip_tags($post['post_text']); 
                    $p = substr($p, 0, 200);               
			     ?>
			    <p class="card-text"><?=$p?>...</p>
			    <a href="blog-view.php?post_id=<?=$post['post_id']?>" class="btn btn-primary">Daha fazlası</a>
			    <hr>
                <div class="d-flex justify-content-between">
                	<div class="react-btns">
            		<?php 
            		$post_id = $post['post_id'];
            		if ($logged) {
            			$liked = isLikedByUserID($conn, $post_id, $user_id);
            		
                    
                    if($liked){
            		 ?>
                	<i class="fa fa-thumbs-up liked like-btn" 
				   	   post-id="<?=$post_id?>"
				   	   liked="1"
				   	   aria-hidden="true"></i>
				       <?php }else{ ?>
				    <i class="fa fa-thumbs-up like like-btn"
				        post-id="<?=$post_id?>"
				   	    liked="0"
				        aria-hidden="true"></i>
				    <?php } } else{ ?>
				    <i class="fa fa-thumbs-up" aria-hidden="true"></i>
				    <?php } ?>
				   Beğeni (
	        <span><?php 
           echo likeCountByPostID($conn, $post['post_id']);
	         ?></span> )
				    <a href="blog-view.php?post_id=<?=$post['post_id']?>#comments">    
                	<i class="fa fa-comment" aria-hidden="true"></i> Yorum (
				        <?php 
		                    echo CountByPostID($conn, $post['post_id']);
				         ?>
				        )
				    </a>	
				    </div>	
				    <small class="text-body-secondary"><?=$post['crated_at']?></small>
                </div>	
			    
			  </div>
			</div>
		<?php } ?>
  	   </main>
  	   <?php }else { ?>
  	   	<main class="main-blog p-2">
  	   		<?php if($notFound){ ?>
  	   			<div class="alert alert-warning"> 
  	   				Aradığınız kelime bulunamadı 
  	   				<?php echo " - <b>key = '".htmlspecialchars($_GET['search'])."'</b>" ?>
  	   			</div>
  	   		<?php }else{ ?>
  	   			<div class="alert alert-warning"> 
  	   				Böyle bir yazı yok .
  	   			</div>
  	   		<?php } ?>
  	   	</main>
  	   <?php } ?>
  </section>
    </div>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  
   <script>
   	 $(document).ready(function(){
			  $(".like-btn").click(function(){
			     var post_id = $(this).attr('post-id');
			     var liked = $(this).attr('liked');

			     if (liked == 1) {
                 $(this).attr('liked', '0');
                 $(this).removeClass('liked');
			     }else {
                 $(this).attr('liked', '1');
                 $(this).addClass('liked');
			     }
			     $(this).next().load("ajax/like-unlike.php",
			     	{
			     		post_id: post_id
			     	});
			  });
		  });
   </script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>