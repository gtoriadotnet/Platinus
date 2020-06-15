<?php
include_once(dirname($_SERVER["DOCUMENT_ROOT"]) . "/include.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Platinus</title>
<?php echo file_get_contents(dirname($_SERVER["DOCUMENT_ROOT"]) . "/header.php");?>
</head>
<body>
<?php echo file_get_contents(dirname($_SERVER["DOCUMENT_ROOT"]) . "/navbar.php");?>
<div class="main">
<section class="section">
<div class="container">
<?php
echo getUserIpAddr();
?>
</div>
</section>
</div>
<?php echo file_get_contents(dirname($_SERVER["DOCUMENT_ROOT"]) . "/footer.php");?>
</body>
</html>