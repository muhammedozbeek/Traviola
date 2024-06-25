<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Traviola</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    />
    <link rel="stylesheet" href="./style1.css">
    <link
      rel="stylesheet"
      href="https://unicons.iconscout.com/release/v2.1.6/css/unicons.css"
    />
  </head>
  <body>
  <?php 
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
            
    shuffle($posts);

      }
      $categories = get5Categoies($conn); 
	 ?>
    <header class="header">
      <a href="anasayfa.php" class="logo">Traviola</a>
      <nav class="navbar">
        <div id="nav-close" class="fas fa-times"></div>
        <a href="anasayfa.php">Ana Sayfa</a>
        <a href="kesfet.html">Keşfet</a>
        <a href="blog.php">Blog</a>
        <a href="login.php">Giriş</a>
        <a href="users/user-post.php">Profil</a>
      </nav>
    </header>

    <section class="home" id="home">
      <div>
        <div class="box" style="background: url(../images/anaresim.jpg) no-repeat">
          <div class="content">
            <span>Yeni Yerler Keşfet</span>

            <p>
              Yeryüzünün sonsuz güzeliklerini keşfe çıkmak, bir yolculuğun
              başlangıcı değil, ruhun derinliklerinde uyanan bir arzudur. Her
              adım, bilinmeyenin cesur kollarına açılan bir kapıdır. Yıldızlarla
              süslenmiş gökyüzünü izlerken, içimizdeki macera ateşi hiç sönmez.
              Seyahat, sadece yeni yerler görmek değil, yeni bir bakış açısı
              kazanmaktır. Farklı kültürleri keşfetiğin o eşsiz anda, insanları
              daha da iyi tanırsın. Yollarda kaybolmak, aslında kendi iç
              dünyamızı keşfetmek demektir. Bu dünya, keşfedilmeyi bekleyen
              sonsuz bir hazinedir onun sırlarını keşfetmek için hemen bir
              yolculuk planla.
            </p>
            <a href="kesfet.html" class="btn">Keşfetmeye Başla</a>
          </div>
        </div>
      </div>
    </section>
    <section class="packages" id="packages" style="background: linear-gradient(to bottom right, #00cc00, #3399ff);">
      <h1 class="heading" style="margin-right: 10rem;">Populer Yazılar</h1>

      <div class="box-container">
      
        <div class="box" style="background: transparent; width:80%">
        <?php foreach ($posts as $post) $posts = array_slice($posts, 0,1);{?>
          <div class="image">
          <img src="upload/blog/<?=$post['cover_url']?>" class="card-img-top" alt="...">
          </div>
          <div class="content">
          <h5 class="card-title"><?=$post['post_title']?></h5>
          <?php 
                    $p = strip_tags($post['post_text']); 
                    $p = substr($p, 0, 200);               
			     ?>
           <p class="card-text"><?=$p?>...</p>
           <a href="blog-view.php?post_id=<?=$post['post_id']?>" class="btn btn-primary">Daha fazlası</a>
           <?php  } ?>
          </div>
        
        </div>

        <div class="box" style="background: transparent; width:80%">
        <?php foreach ($posts as $post){?>
          <div class="image">
          <img src="upload/blog/<?=$post['cover_url']?>" class="card-img-top" alt="...">
          </div>
          <div class="content">
          <h5 class="card-title"><?=$post['post_title']?></h5>
          <?php 
                    $p = strip_tags($post['post_text']); 
                    $p = substr($p, 0, 200);               
			     ?>
           <p class="card-text"><?=$p?>...</p>
           <a href="blog-view.php?post_id=<?=$post['post_id']?>" class="btn btn-primary">Read more</a>
           <?php  } ?>
          </div>
        
        </div>
        
    </section>

    <section class="footer" style="background: linear-gradient(to bottom right, #00cc00, #3399ff);">
      <div class="box-container">
        <div class="box">
          <h3>Linkler</h3>
          <a href="anasayfa.php">Anasayfa</a>
          <a href="kesfet.html">Keşfet</a>
          <a href="blog.php">Blog</a>
        </div>

        <div class="box">
          <h3>İletişim</h3>
          <a href="tel:+905555555555">
            <i class="fas fa-phone"></i> +90 555 555 55 55
          </a>
          <a href="mailto: muhammedozbek22@gmail.com">
            <i class="fas fa-envelope"></i> muhammedozbek22@gmail.com
          </a>
        </div>

        <div class="box">
          <h3>Takip Edin</h3>
          <a href="https://www.facebook.com/hulk8686/?locale=tr_TR">
            <i class="fab fa-facebook-f"></i> facebook
          </a>
          <a href="https://www.instagram.com/muhammedozbeek/">
            <i class="fab fa-instagram"></i> instagram
          </a>
          <a href="https://www.linkedin.com/in/muhammedozbeek/">
            <i class="fab fa-linkedin"></i> linkedin
          </a>
          <a href="https://github.com/muhammedozbeek">
            <i class="fab fa-github"></i> github
          </a>
        </div>
      </div>
    </section>
    <script src="js/script.js"></script>
  </body>
</html>
