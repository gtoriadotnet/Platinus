<?php
include_once(dirname($_SERVER["DOCUMENT_ROOT"]) . "/include.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Platinus Forum</title>
<?php echo file_get_contents(dirname($_SERVER["DOCUMENT_ROOT"]) . "/header.php");?>
</head>
<body>
<?php echo file_get_contents(dirname($_SERVER["DOCUMENT_ROOT"]) . "/navbar.php");?>
<div class="main">
<section class="section">
<div class="container">
<br>
<h2>Forum</h2>
<?php
$topics = $GLOBALS["sql"]->prepare("SELECT * FROM `forum-topics`");
$sections = $GLOBALS["sql"]->prepare("SELECT * FROM `forum-sections`");
$topics->execute();

$topicStart = <<<'EOT'
<div class="my-3 p-3 bg-white rounded shadow-sm">
<h6 class="border-bottom border-gray pb-2 mb-0">{FORUM_TOPIC_NAME}</h6>
EOT;

$sectionTemplate = <<<'EOT'
<a href="{FORUM_SECTION_LINK}" class="media text-muted pt-3">
<p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
<strong class="d-block text-gray-dark">{FORUM_SECTION_NAME}</strong>
{FORUM_SECTION_DESCRIPTION}
</p>
</a>
EOT;

foreach ($topics as $topic){
	$sections->execute();
	echo str_replace("{FORUM_TOPIC_NAME}",$topic["Name"],$topicStart);
	foreach($sections as $section){
		if($section["TopicId"] == $topic["id"]){
			$newSection = str_replace("{FORUM_SECTION_NAME}",$section["Name"],$sectionTemplate);
			$newSection = str_replace("{FORUM_SECTION_DESCRIPTION}",$section["Description"],$newSection);
			$newSection = str_replace("{FORUM_SECTION_LINK}","https://" . $_SERVER["HTTP_HOST"] . "/forum/ShowForum?topic=" . $section["id"],$newSection);
			echo $newSection;
		}
	}
	echo "</div>";
}
?>
</div>
</section>
</div>
<?php echo file_get_contents(dirname($_SERVER["DOCUMENT_ROOT"]) . "/footer.php");?>
</body>
</html>