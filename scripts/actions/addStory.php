<?php
require_once("../stories.php");

$array = $_REQUEST;
if (isset($array['user_id']))
{
	$user_id = $array['user_id'];
	$talent_id = @$array['talent_id'];
}


$array['date'] = date("Y-m-d");

if ($array['sourceType'] == "youtube")
{
	$match = youtube_id_from_url(@$array['sourceIdentifier']);
	if ($match !== FALSE)
		$array['sourceIdentifier'] = $match;
} else if ($array['sourceType'] == "github")
{
	$repo = $array['sourceIdentifier'];
	$repo = getGithubRepoName($repo);
	$array['sourceIdentifier'] = $repo;
} else if ($array['sourceType'] == "soundcloud")
{
	$array['sourceIdentifier'] = getSoundcloudID($array['sourceIdentifier']);
}

//print_r($_REQUEST);
stories_post($array);

header("Location: ../../profile.php?userid=$user_id&talent=$talent_id");


///// Utility Functions

function youtube_id_from_url($url) {
    $pattern = 
        '%^# Match any youtube URL
        (?:https?://)?  # Optional scheme. Either http or https
        (?:www\.)?      # Optional www subdomain
        (?:             # Group host alternatives
          youtu\.be/    # Either youtu.be,
        | youtube\.com  # or youtube.com
          (?:           # Group path alternatives
            /embed/     # Either /embed/
          | /v/         # or /v/
          | /watch\?v=  # or /watch\?v=
          )             # End path alternatives.
        )               # End host alternatives.
        ([\w-]{10,12})  # Allow 10-12 for 11 char youtube id.
        $%x'
        ;
    $result = preg_match($pattern, $url, $matches);
    if (false !== $result) {
        return $matches[1];
    }
    return false;
}

function getGithubRepoName($url)
{
	$repo = basename($url);
	if (($gitpos = strrpos($repo, ".git")) !== FALSE)
		$repo = substr($repo, 0, $gitpos);
	$url = substr($url, 0, strrpos($url, $repo));
	
	$user = basename($url);	
	return $user .'/'. $repo;
}

function getSoundcloudID($url)
{
	// Hack: this also works for both.
	return getGithubRepoName($url);
}


?>