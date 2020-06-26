<?php
include_once(dirname($_SERVER["DOCUMENT_ROOT"]) . "/include.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>ip banned</title>
<?php echo file_get_contents(dirname($_SERVER["DOCUMENT_ROOT"]) . "/header.php");?>
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
<h2 style="margin-top:30px;">you've been ip banned</h2>
<h5 style="margin-top:10px;" class="text-muted">If you believe this is a mistake please DM a staff member immediately.</h5>
<iframe style="margin-top:20px;" width="1140" height="700" src="https://www.youtube-nocookie.com/embed/ImKL2uwBYWE?controls=0&autoplay=1" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
</div>
</section>
</div>
<?php echo file_get_contents(dirname($_SERVER["DOCUMENT_ROOT"]) . "/footer.php");?>
</body>
</html>