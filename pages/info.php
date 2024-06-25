<?php
include_once('infop.php');
if(isset($_POST['Istanbul'])) {
	$que="SELECT * FROM `information` WHERE pname='Istanbul'";
	$result = mysqli_query($db, $que);
}
if(isset($_POST['Almanya'])) {
	$que="SELECT * FROM `information` WHERE pname='Almanya'";
	$result = mysqli_query($db, $que);
}
if(isset($_POST['Amerika'])) {
	$que="SELECT * FROM `information` WHERE pname='Amerika'";
	$result = mysqli_query($db, $que);
}
if(isset($_POST['Çin'])) {
	$que="SELECT * FROM `information` WHERE pname='Çin'";
	$result = mysqli_query($db, $que);
}
if(isset($_POST['Hindistan'])) {
	$que="SELECT * FROM `information` WHERE pname='Hindistan'";
	$result = mysqli_query($db, $que);
}
if(isset($_POST['Kanada'])) {
	$que="SELECT * FROM `information` WHERE pname='Kanada'";
	$result = mysqli_query($db, $que);
}
if(isset($_POST['Kore'])) {
	$que="SELECT * FROM `information` WHERE pname='Kore'";
	$result = mysqli_query($db, $que);
}
if(isset($_POST['Özbekistan'])) {
	$que="SELECT * FROM `information` WHERE pname='Özbekistan'";
	$result = mysqli_query($db, $que);
}
if(isset($_POST['Polonya'])) {
	$que="SELECT * FROM `information` WHERE pname='Polonya'";
	$result = mysqli_query($db, $que);
}
if(isset($_POST['Portekiz'])) {
	$que="SELECT * FROM `information` WHERE pname='Portekiz'";
	$result = mysqli_query($db, $que);
}
if(isset($_POST['Rusya'])) {
	$que="SELECT * FROM `information` WHERE pname='Rusya'";
	$result = mysqli_query($db, $que);
}
if(isset($_POST['Şanlıurfa'])) {
	$que="SELECT * FROM `information` WHERE pname='Şanlıurfa'";
	$result = mysqli_query($db, $que);
}
if(isset($_POST['search_p'])) {
	$search = $_POST['search_p'];
	$que="SELECT * FROM `information` WHERE pname='$search'";
	$result = mysqli_query($db, $que);
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/info.css">
	<title>Kesif</title>
</head>
<body>
	<div class="main">
	    <ul>
	      <ul class="list">
	        
	        <div class="search">
                <form method="POST" action="info.php">
                  <input type="text" name="search_p" placeholder="Search.." size="50">
              
                  <input type="image" name="submit_p" src="images/search_icon.png" alt="Search image" style="width:22;height:22; margin-left: 35px;">
                </form>
            </div>
	      </ul>
	      <ul class="list2">
		    <li class="logo"><span>Traviola</span></li>
	        <li><a href="anasayfa.php">Anasayfa</a></li>
	        <li><a id="long" href="kesfet.html">Keşfet</a></li>
			<li><a href="blog.php">Blog</a></li>
			<li><a href="login.php">Giriş</a></li>
			<li><a href="users/user-post.php">Profil</a></li>
	      </ul>
	    </ul>
	</div>
	<div class="hedder">
		<h1>Gezi Önerisi</h1>
	</div>
	<div class="container">
		<div class="description-container" style="border: 1px solid black;">
			<div class="box1">
				<?php
					while($rows = mysqli_fetch_assoc($result))
					{
				?>
				<img src="<?php echo $rows['pi_main']; ?>" alt="Taj Mahal Image" style="width: auto;height: 302px;">
			</div>
			<div class="description">
				<h1><?php echo $rows['pname']; ?><h1>
				<p style="text-align: justify;"><?php echo $rows['pdescription']; ?></p>
			</div>
		</div>
		<div class="image-container" style="border: 1px solid black ;">
			<div class="box">
		        <div class="imgBox">
		          <img src="<?php echo $rows['pi1']; ?>" alt="Taj Mahal Image" style="width: auto;height: 270px;">
		        </div>
	        </div>
	      <div class="box">
	        <div class="imgBox">
	          <img src="<?php echo $rows['pi2']; ?>" alt="Taj Mahal Image" style="width: auto;height: 270px;">
	        </div>
	      </div>
	      <div class="box">
	        <div class="imgBox">
	          <img src="<?php echo $rows['pi3']; ?>" alt="Taj Mahal Image" style="width: auto;height: 270px;">
	        </div>
	        	<?php
					}
				?>
	      </div>
		</div>
	</div>
</body>
</html>