<?php
require_once("scripts/talents.php");
require_once("scripts/stories.php");
$talent = talent_get($selectedTalentId);
$talent['stories'] = stories_get_for_talent($talent['id']);
?>
<div class="col-lg-4" style="width: 54%; id="midCol">
<h2 style="color: #9E2342;" id="midColHead"><?php echo $talent['title']; ?>

</h2>
<p><?php echo $talent['description']; ?></p>

<div>

<?php
foreach ($talent['stories'] as $story)
{
    $showLeftArea = @($story['sourceType'] == "youtube");
    include "profile_story_thumbnail.php";
}
?>

</div>

<?php
if ($isMe)
{
    echo "<hr />";
    require "profile_talent_add_media.php";
}
?>

</div>