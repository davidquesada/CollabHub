<!-- New song/video form-->

<button type="button" class="btn btn-lg btn-primary" onclick="newMediaBtnClick()">Add New Media</button>
<script src="//connect.soundcloud.com/sdk.js"></script>
<!-- Should be hidden unless the above button is clicked-->

<form class="form-signin" id="newMediaForm" style="display: none;" method="post" action="scripts/actions/addStory.php">
  <h3 class="form-signin-heading">Add New Media</h3>
  <input id="title" type="text" class="form-control" placeholder="Title" autofocus name="title" />
  
  
    <div>
        <span class="pull-left">Media Type: </span>
  <select name="sourceType" class="form-control pull-right" id="blah">
    <option name="" value="">Plain</option>
    <optgroup label="Video Services">
        <option name="youtube" value="youtube">YouTube</option>
        <option name="vimeo" value="vimeo">Vimeo</option>
    </optgroup>
    <optgroup label="Sound Sharing Services">
        <option name="soundcloud" value="soundcloud">SoundCloud</option>
    </optgroup>
    <optgroup label="Photo Sharing Services">
        <option name="flickr" value="flickr">Flickr</option>
    </optgroup>
    <optgroup label="Software Repository Services">
        <option name="github" value="github">GitHub</option>
        <option name="bitbucket" value="bitbucket">BitBucket</option>
    </optgroup>
  </select>
    </div>
  
  <input type="text" class="form-control" placeholder="URL" name="sourceIdentifier" />
  <input type="text" class="form-control" placeholder="Short Description" name="description" />
  <input type="submit" class="btn btn-default btn-primary" type="button" onclick="addMediaBtnClick()">Add Media</button>
  <input type="hidden" name="talent_id" value="<?php echo $talent['id']; ?>" />
  
  <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>" />
</form>
