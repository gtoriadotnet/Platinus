<?php
include_once(dirname($_SERVER["DOCUMENT_ROOT"]) . "/include.php");
if(isset($_GET["group"])){
	if(!@(int)$_GET["group"]){
		http_response_code(404);
		include_once($_SERVER["DOCUMENT_ROOT"] . "/error.php");
		exit();
	}
	$topic = $GLOBALS["sql"]->prepare("SELECT * FROM `forum-topics` WHERE id = ?");
	$topic->execute([$_GET["group"]]);
	$result = $topic->fetch(PDO::FETCH_ASSOC);
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
<title>Platinus Forum - <?php echo $result["Name"]; ?></title>
<?php include_once(dirname($_SERVER["DOCUMENT_ROOT"]) . "/header.php");?>
</head>
<body>
<?php include_once(dirname($_SERVER["DOCUMENT_ROOT"]) . "/navbar.php");?>
<div class="main">
<section class="section">
<div class="container">
<br>
<h2>Forum - <?php echo $result["Name"]; ?></h2>
<h6><a href="/forum">Platinus Forum</a> &raquo; <?php echo "<a href=\"/forum/ShowForumGroup/?group=" . $result["id"] . "\">" . $result["Name"] . "</a>";?></h6>
<div class="my-3 p-3 bg-white rounded shadow-sm">
<h6 class="border-bottom border-gray pb-2 mb-0"><?php echo $result["Name"]; ?></h6>
<?php
$sectionTemplate = <<<'EOT'
<a href="{FORUM_SECTION_LINK}" class="media text-muted pt-3">
<p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
<strong class="d-block text-gray-dark">{FORUM_SECTION_NAME}</strong>
{FORUM_SECTION_DESCRIPTION}
</p>
</a>
EOT;

$sections = $GLOBALS["sql"]->prepare("SELECT * FROM `forum-sections`");
$sections->execute();

foreach($sections as $section){
	if($section["TopicId"] == $_GET["group"]){
		$newSection = str_replace("{FORUM_SECTION_NAME}",$section["Name"],$sectionTemplate);
		$newSection = str_replace("{FORUM_SECTION_DESCRIPTION}",$section["Description"],$newSection);
		$newSection = str_replace("{FORUM_SECTION_LINK}","https://" . $_SERVER["HTTP_HOST"] . "/forum/ShowForum?topic=" . $section["id"],$newSection);
		echo $newSection;
	}
}

?>
</div>
</div>
</section>
</div>
<?php include_once(dirname($_SERVER["DOCUMENT_ROOT"]) . "/footer.php");?>
</body>
</html>