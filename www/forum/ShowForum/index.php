<?php
include_once(dirname($_SERVER["DOCUMENT_ROOT"]) . "/include.php");
if(isset($_GET["topic"])){
	if(!@(int)$_GET["topic"]){
		http_response_code(404);
		include_once($_SERVER["DOCUMENT_ROOT"] . "/error.php");
		exit();
	}
	$section = $GLOBALS["sql"]->prepare("SELECT * FROM `forum-sections` WHERE id = ?");
	$section->execute([$_GET["topic"]]);
	$result = $section->fetch(PDO::FETCH_ASSOC);
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
<?php
$group = $GLOBALS["sql"]->prepare("SELECT * FROM `forum-topics` WHERE id = ?");
$group->execute([$result["TopicId"]]);
$groupResult = $group->fetch(PDO::FETCH_ASSOC);
?>
<h2>Forum - <?php echo $result["Name"]; ?></h2>
<h6><a href="/forum">Platinus Forum</a> &raquo; <?php echo "<a href=\"/forum/ShowForumGroup/?group=" . $groupResult["id"] . "\">" . $groupResult["Name"] . "</a>";?> &raquo; <?php echo "<a href=\"/forum/ShowForum/?topic=" . $result["id"] . "\">" . $result["Name"] . "</a>"; ?></h6>
<div class="my-3 p-3 bg-white rounded shadow-sm">
<h6 class="border-bottom border-gray pb-2 mb-0">Subject</h6>
<?php
$posts = $GLOBALS["sql"]->prepare("SELECT * FROM `forum-posts`");
$posts->execute();

$sectionTemplate = <<<'EOT'
<a href="{FORUM_SECTION_LINK}" class="media text-muted pt-3">
<p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
<strong class="d-block text-gray-dark">{FORUM_SECTION_NAME}</strong>
{FORUM_SECTION_DESCRIPTION}
</p>
</a>
EOT;

$isEmpty = true;
foreach($posts as $post){
	if($post["Forum"]==$result["id"] and $post["Hidden"] == false){
		$isEmpty = false;
		$text = substr($post["Text"],0,60);
		if(strlen($text)==60){
			$text = $text . "...";
		}
		$newSection = str_replace("{FORUM_SECTION_NAME}",htmlspecialchars($post["Subject"],ENT_QUOTES,'UTF-8'),$sectionTemplate);
		$newSection = str_replace("{FORUM_SECTION_DESCRIPTION}",htmlspecialchars($text,ENT_QUOTES,'UTF-8'),$newSection);
		$newSection = str_replace("{FORUM_SECTION_LINK}","https://" . $_SERVER["HTTP_HOST"] . "/forum/ShowPost?id=" . $post["id"],$newSection);
		echo $newSection;
	}
}
if($isEmpty){
	echo "<div class=\"media text-muted pt-3\"><p class=\"media-body pb-3 mb-0 small lh-125 border-bottom border-gray\">This topic is empty. Be the first to post!</p></div>";
}
?>
</div>
<div style="display: table; margin: auto; flex-flow: row wrap; align-items: center;">
<ul class="pagination">
<li class="page-item disabled">
<a class="page-link" href="#">&laquo;</a>
</li>
<li class="page-item disabled">
<div class="page-link">1</div>
</li>
<li class="page-item disabled">
<a class="page-link" href="#">&raquo;</a>
</li>
</ul>
</div>
</div>
</section>
</div>
<?php echo file_get_contents(dirname($_SERVER["DOCUMENT_ROOT"]) . "/footer.php");?>
</body>
</html>