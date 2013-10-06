<?php

$url = "https://github.com/JoelSutherland/GitHub-jQuery-Repo-Widget.git";
$url = "https://github.com/sendgrid/sendgrid-php";
$url = "https://github.com/rethinkdb/rethinkdb";


function getGithubRepoName($url)
{
	$repo = basename($url);
	if (($gitpos = strrpos($repo, ".git")) !== FALSE)
		$repo = substr($repo, 0, $gitpos);
		
	$url = substr($url, 0, strrpos($url, $repo));
	
	$user = basename($url);	
	return $user .'/'. $repo;
}

echo getGithubRepoName($url);

?>

<div id="putItHere"></div>
<script type="text/javascript" src="https://w.soundcloud.com/player/api.js"></script>
<script type="text/javascript">
EmbedCode = "
        SC.initialize({
        client_id: \"ce76e68b3624ea3ded07c851938b5e8b\",
        });
        var track_url = "andrewrayel/andrew-rayel-alexandre";
        
        //ask David for help
        // var div = $('<div class=\"widget\"></div>');
        // $('.widget')
        // //var div = $('<div id=\"widget1\"></div>');
       	// SC.oEmbed(track_url, $('#widget1').get(0));

        //SC.oEmbed(track_url, { auto_play: false}, document.getElementById('widgets'));"
		SC.oEmbed("https://soundcloud.com/andrewrayel/andrew-rayel-alexandre", {color: "ff0066"}, document.getElementById("putTheWidgetHere"));
	   return EmbedCode; 
</script>