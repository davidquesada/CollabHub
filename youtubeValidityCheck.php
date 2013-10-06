<?php

function isValidYoutubeURL($url) {

    // Let's check the host first
    $parse = parse_url($url);
    $host = $parse['host'];
    if (!in_array($host, array('youtube.com', 'www.youtube.com'))) {
        return false;
    }

    $ch = curl_init();
    $oembedURL = 'www.youtube.com/oembed?url=' . urlencode($url).'&format=json';
    curl_setopt($ch, CURLOPT_URL, $oembedURL);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    // Silent CURL execution
    $output = curl_exec($ch);
    unset($output);

    $info = curl_getinfo($ch);
    curl_close($ch);

    if ($info['http_code'] !== 404)
        return true;
    else 
        return false;
}

function isEmbeddableYoutubeURL($url) {

    // Let's check the host first
    $parse = parse_url($url);
    $host = $parse['host'];
    if (!in_array($host, array('youtube.com', 'www.youtube.com'))) {
        return false;
    }

    $ch = curl_init();
    $oembedURL = 'www.youtube.com/oembed?url=' . urlencode($url).'&format=json';
    curl_setopt($ch, CURLOPT_URL, $oembedURL);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($output);

    if (!$data) return false; // Either 404 or 401 (Unauthorized)
    if (!$data->{'html'}) return false; // Embeddable video MUST have 'html' provided 

    return true;
}

$url = 'http://www.youtube.com/watch?v=QH2-TGUlwu4';
echo isValidYoutubeURL($url) ? 'Valid, ': 'Not Valid, ';
echo isEmbeddableYoutubeURL($url) ? 'Embeddable ': 'Not Embeddable ';

?>