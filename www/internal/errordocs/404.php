<?php
include_once(dirname($_SERVER["DOCUMENT_ROOT"]) . "/include.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Platinus - Error</title>
<?php echo file_get_contents(dirname($_SERVER["DOCUMENT_ROOT"]) . "/header.php");?>
</head>
<body>
<?php echo file_get_contents(dirname($_SERVER["DOCUMENT_ROOT"]) . "/navbar.php");?>
<div class="main">
<section class="section">
<div class="container" style="max-width:25rem;">
<div class="card bg-light mb-3" style="max-width: 25rem;margin-top:10vh;">
<div class="card-header">Error</div>
<div class="card-body">
<h5 class="card-title">404</h5>
<p class="card-text">We don't know what you're looking for but it's not here.</p>
</div>
</div>
</div>
</section>
</div>
<?php echo file_get_contents(dirname($_SERVER["DOCUMENT_ROOT"]) . "/footer.php");?>
</body>
</html>