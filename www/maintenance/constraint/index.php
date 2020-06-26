<?php
include_once(dirname($_SERVER["DOCUMENT_ROOT"]) . "/include.php");
if(file_get_contents(dirname($_SERVER["DOCUMENT_ROOT"]) . "/offline.txt")=="0"){
	$loc = "https://" . $_SERVER['HTTP_HOST'];
	if(isset($_GET["return"])){
		$loc = urldecode($_GET["return"]);
	}
	header("Location: " . $loc);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Platinus - Maintenance</title>
<?php include_once(dirname($_SERVER["DOCUMENT_ROOT"]) . "/header.php");?>
<script>
setInterval(function(){
window.location.reload();
},60000);
</script>
</head>
<body>
<nav class="navbar sticky-top navbar-expand-lg navbar-dark" style="box-shadow: 0 0px 5px rgb(10,10,50); background: linear-gradient(90deg,rgb(70,140,255),rgb(140,60,200));">
<div class="container">
<div class="navbar-brand">
<img src="/img/nav.png" width="30" height="30" class="d-inline-block align-top" alt="">
Platinus
</div>
</div>
</nav>
<div class="main">
<section class="section">
<div class="container">
<div style="position:absolute;left:50%;margin-left:-253px;top:50%;margin-top:-120px;">
<center><b style="font-size:40px;">Platinus is currently offline</b></center>
<center><text style="font-size:40px;">We'll be back soon!</text></center>
</div>
</div>
</section>
</div>
<?php include_once(dirname($_SERVER["DOCUMENT_ROOT"]) . "/footer.php");?>
</body>
</html>