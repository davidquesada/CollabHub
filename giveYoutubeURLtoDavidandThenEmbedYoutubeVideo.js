      // 2. This code loads the IFrame Player API code asynchronously.
      function FuckYou(){
      alert("FUCK YOU");
      var tag = document.createElement('script');

      tag.src = "https://www.youtube.com/iframe_api";
      var firstScriptTag = document.getElementsByTagName('script')[0];
      firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

      // 3. This function creates an <iframe> (and YouTube player)
      //    after the API code downloads.
      var player;
      }
      function onYouTubeIframeAPIReady() {
        //make this
        // var daURL=prompt("Please enter a URL","M7lc1UVf-VE");
        //Insert code to check if daURL is a valid URL
        //alert(daURL);
        // if(daURL==null){
        //   break;
        // }
        
        //New data entry needs to be created here
      }

      // 4. The API will call this function when the video player is ready.
      function onPlayerReady(event) {
        //event.target.playVideo();
      }

      // 5. The API calls this function when the player's state changes.
      //    The function indicates that when playing a video (state=1),
      //    the player should play for six seconds and then stop.
      var done = false;
      function onPlayerStateChange(event) {
        // if (event.data == YT.PlayerState.PLAYING && !done) {
        //   setTimeout(stopVideo, 6000);
        //   done = true;
        // }
      }
      function stopVideo() {
        player.stopVideo();
      }
var theURL = document.getElementbyId("InputURL");
player = new YT.Player('player', {
          height: '292',
          width: '480',

          //videoId: 'M7lc1UVf-VE',
          videoId: theURL,
          events: {
            'onReady': onPlayerReady,
            'onStateChange': onPlayerStateChange
          }
        });