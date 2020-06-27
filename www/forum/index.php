<?php
include_once(dirname($_SERVER["DOCUMENT_ROOT"]) . "/include.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Platinus Forum</title>
<?php include_once(dirname($_SERVER["DOCUMENT_ROOT"]) . "/header.php");?>
</head>
<body>
<?php include_once(dirname($_SERVER["DOCUMENT_ROOT"]) . "/navbar.php");?>
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
<div class="navbar border-bottom border-gray" style="
    padding: 0;
">
    

<ul class="navbar-nav mr-auto" style="
    flex-direction: row;
">




<li class="nav-item">
<h6 class="pb-1">{FORUM_TOPIC_NAME}</h6>
</li>

</ul>

<ul class="navbar-nav" style="
    flex-direction: row;
">




<li class="nav-item"><h6 class="pb-1" style="
    padding-left: 20px;
    min-width: 100px;
    text-align: center;
">Threads</h6>


</li>
<li class="nav-item"><h6 class="pb-1" style="
    min-width: 100px;
    padding-left: 20px;
    text-align: center;
">Posts</h6>


</li>
<li class="nav-item"><h6 class="pb-1" style="
    padding-left: 20px;
    min-width: 100px;
    text-align: center;
">Last Post</h6>


</li>

</ul>

</div>
EOT;

$sectionTemplate = <<<'EOT'
<a href="{FORUM_SECTION_LINK}" class="media text-muted pt-3 border-bottom border-gray">
<div class="navbar" style="
    padding: 0;
    width: 100%;
">
    

<ul class="navbar-nav mr-auto" style="
    flex-direction: row;
">




<li class="nav-item">
<p class="media-body pb-3 mb-0 small lh-125" style="max-width: 700px;">
<strong class="d-block text-gray-dark">{FORUM_SECTION_NAME}</strong>
{FORUM_SECTION_DESCRIPTION}
</p>
</li>

</ul>

<ul class="navbar-nav" style="
    flex-direction: row;
">




<li class="nav-item"><p class="pb-1" style="
    padding-left: 20px;
    min-width: 100px;
    text-align: center;
">{FORUM_THREAD_COUNT}</p>


</li>
<li class="nav-item"><p class="pb-1" style="
    min-width: 100px;
    padding-left: 20px;
    text-align: center;
">{FORUM_POST_COUNT}</p>


</li>
<li class="nav-item" style="
    margin-top: -9px;
">
<p class="pb-1" style="
    padding-left: 20px;
    min-width: 100px;
    text-align: center;
    margin: 0;
    padding-bottom: 0;
"><strong class="d-block text-gray-dark">{FORUM_LAST_POSTTIME}</strong></p><p class="pb-1" style="
    padding-left: 20px;
    min-width: 100px;
    text-align: center;
    margin: 0;
    margin-top: -5px;
">{FORUM_LAST_POST}</p>


</li>

</ul>

</div>
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
			$newSection = str_replace("{FORUM_THREAD_COUNT}",$section["Threads"],$newSection);
			$newSection = str_replace("{FORUM_POST_COUNT}",$section["Posts"],$newSection);
			$newSection = str_replace("{FORUM_LAST_POST}",$section["LastPost"],$newSection);
			$newSection = str_replace("{FORUM_LAST_POSTTIME}",$section["LastPostTime"],$newSection);
			echo $newSection;
		}
	}
	echo "</div>";
}
?>
</div>
</section>
</div>
<?php include_once(dirname($_SERVER["DOCUMENT_ROOT"]) . "/footer.php");?>
</body>
</html>