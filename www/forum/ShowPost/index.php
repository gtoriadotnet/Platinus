<?php
include_once(dirname($_SERVER["DOCUMENT_ROOT"]) . "/include.php");
if(isset($_GET["id"])){
	if(!@(int)$_GET["id"]){
		http_response_code(404);
		include_once($_SERVER["DOCUMENT_ROOT"] . "/error.php");
		exit();
	}
	$post = $GLOBALS["sql"]->prepare("SELECT * FROM `forum-posts` WHERE id = ?");
	$post->execute([$_GET["id"]]);
	$result = $post->fetch(PDO::FETCH_ASSOC);
	if($result["Hidden"]==true){
		http_response_code(404);
		include_once($_SERVER["DOCUMENT_ROOT"] . "/error.php");
		exit();		
	}
	if(!$result){
		http_response_code(404);
		include_once($_SERVER["DOCUMENT_ROOT"] . "/error.php");
		exit();
	}
}else{
	http_response_code(404);
	include_once($_SERVER["DOCUMENT_ROOT"] . "/error.php");
	exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Platinus Forum - <?php echo htmlspecialchars($result["Subject"],ENT_QUOTES,'UTF-8'); ?></title>
<?php include_once(dirname($_SERVER["DOCUMENT_ROOT"]) . "/header.php");?>
</head>
<body>
<?php include_once(dirname($_SERVER["DOCUMENT_ROOT"]) . "/navbar.php");?>
<div class="main">
<section class="section">
<div class="container">
<br>
<?php
$section = $GLOBALS["sql"]->prepare("SELECT * FROM `forum-sections` WHERE id = ?");
$section->execute([$result["Forum"]]);
$sectionResult = $section->fetch(PDO::FETCH_ASSOC);
$group = $GLOBALS["sql"]->prepare("SELECT * FROM `forum-topics` WHERE id = ?");
$group->execute([$sectionResult["TopicId"]]);
$groupResult = $group->fetch(PDO::FETCH_ASSOC);
?>
<h2>Forum - <?php echo $sectionResult["Name"] ?></h2>
<h6><a href="/forum">Platinus Forum</a> &raquo; <?php echo "<a href=\"/forum/ShowForumGroup/?group=" . $groupResult["id"] . "\">" . $groupResult["Name"] . "</a>";?> &raquo; <?php echo "<a href=\"/forum/ShowForum/?topic=" . $sectionResult["id"] . "\">" . $sectionResult["Name"] . "</a>"; ?></h6>
<div class="my-3 p-3 bg-white rounded shadow-sm">
<h6 class="border-bottom border-gray pb-2 mb-0"><?php echo htmlspecialchars($result["Subject"],ENT_QUOTES,'UTF-8'); ?></h6>
<div class="media text-muted pt-3">
<svg class="bd-placeholder-img mr-2 rounded" width="50" height="50" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32"><title>Placeholder</title><rect width="100%" height="100%" fill="#007bff"></rect></svg>
<p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
<strong class="d-block mb-1 text-gray-dark">Username <i style="font-size:8px"><?php echo $result["Posted"];?></i></strong>
<?php echo htmlspecialchars($result["Text"],ENT_QUOTES,'UTF-8'); ?>
</p>
</div>
</div>
</div>
</section>
</div>
<?php include_once(dirname($_SERVER["DOCUMENT_ROOT"]) . "/footer.php");?>
</body>
</html>