function constructURL(person,tag,location)
{
	var url = "http://158.130.157.168/scripts/actions/partnersearch.php?";
	url = url + "person="+person+"&tag="+tag+"&location=" + location;
	url = encodeURI(url);
	return url;
}

function get_request(person,tag,location)
{
	cleanURL = constructURL(person,tag,location);
	var xmlHttp = null;
    xmlHttp = new XMLHttpRequest();
    xmlHttp.open( "GET", cleanURL, false );
    xmlHttp.send( null );
    return xmlHttp.responseText;
}