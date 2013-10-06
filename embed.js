function youtube_parser(url){
    var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
    var match = url.match(regExp);
    if (match&&match[7].length==11){
        return match[7];
    }else{
        alert("Invalid URL");
        //Don't produce vid ID
    }
}
function GenerateIDs(e){
  var inputType = document.getElementById("newMediaType");
  var URL = document.getElementById("InputURL");
  return URL.value.toString();
}
function GenerateEmbedCode(URL){
	//var inputType = document.getElementById("newMediaType");
	var EmbedCode = "";
	if(URL.text.toString().indexOf('Youtu')!== -1 && URL.text.toString().indexOf('be')!== -1 && URL.text.toString().indexOf('SoundCloud.com')== -1){
    var vidID = youtube_parser(URL.value.toString());
    EmbedCode = "player = new YT.Player('player', {height: '292',
          width: '480', videoId: " + vidID + ", events: {
            'onReady': onPlayerReady,
            'onStateChange': onPlayerStateChange
          }
        });"
    //videoId: 'M7lc1UVf-VE', vidID,
    return EmbedCode;  
	}
	// if(inputType.text.toString() == "SoundCloud"){
	if(URL.text.toString().indexOf('SoundCloud.com')!== -1){	
        EmbedCode = "
        SC.initialize({
        client_id: \"ce76e68b3624ea3ded07c851938b5e8b\",
        });
        var track_url = \"" + URL.value.toString() +"\";
        
        //ask David for help
        // var div = $('<div class=\"widget\"></div>');
        // $('.widget')
        // //var div = $('<div id=\"widget1\"></div>');
       	// SC.oEmbed(track_url, $('#widget1').get(0));

        SC.oEmbed(track_url, { auto_play: false}, document.getElementById('widgets'));"
	   return EmbedCode; 
  }
	if(inputType.text.toString().indexOf('GitHub')!== -1){
		 EmbedCode = "FUCK GITHUB CRACKER-ASS PIECES OF SHIT";
	}
}
