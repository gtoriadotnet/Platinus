<?php
include_once(dirname($_SERVER["DOCUMENT_ROOT"]) . "/include.php");

$response = http_response_code();
$errorcodes = $GLOBALS["sql"]->prepare("SELECT * FROM `errordocs` WHERE code = :code");
$errorcodes->bindParam(':code', $response, PDO::PARAM_INT);
$errorcodes->execute();
$errorcodes=$errorcodes->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Platinus - Error</title>
<?php include_once(dirname($_SERVER["DOCUMENT_ROOT"]) . "/header.php");?>
</head>
<body>
<?php include_once(dirname($_SERVER["DOCUMENT_ROOT"]) . "/navbar.php");?>
<div class="main">
<section class="section">
<div class="container" style="max-width:25rem;">
<div class="card bg-light mb-3" style="max-width: 25rem;margin-top:10vh;">
<div class="card-header">Error</div>
<div class="card-body">
<h5 class="card-title"><?php echo $errorcodes["code"]; ?></h5>
<p class="card-text"><?php echo $errorcodes["body"]; ?></p>
<a href="/home" class="btn btn-primary">Home</a>
<a href="/forum" class="btn btn-secondary">Forum</a>
</div>
</div>
</div>
</section>
</div>
<?php include_once(dirname($_SERVER["DOCUMENT_ROOT"]) . "/footer.php");?>
</body>
</html>