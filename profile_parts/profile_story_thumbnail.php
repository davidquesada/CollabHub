<hr />

<a style="text-decoration:none;" class="thumbnail media" href="#">
    
<?php if ($showLeftArea) { ?>
    <div class="pull-left">
    <?php if ($story['sourceType'] == "youtube") {
        
        $videoId = $story['sourceIdentifier'];
        ?>
        
        <img width=120  src="http://img.youtube.com/vi/<?php echo $videoId; ?>/0.jpg" />
    
	<?php } ?>
    </div>
<?php } ?>
    <div class="media-body">
            <h4 class="unstyled">
            <strong><?php echo $story['title']; ?></strong>
            </h4>
        
		
		<?php if ($story['sourceType'] == "github") { ?>
		<div class="github-widget" data-repo="<?php echo $story['sourceIdentifier']; ?>"></div>
		
		
		<?php } else if ($story['sourceType'] == "soundcloud") { 
				$url = "http://www.soundcloud.com/".$story['sourceIdentifier'];
				$divID = "soundCloudWidget" . $story['id'];
				?>
				<div id="<?php echo $divID; ?>">WD</div>
				<script type="text/javascript">
					SC.initialize({
					client_id: "ce76e68b3624ea3ded07c851938b5e8b",
					});
					var track_url = "<?php echo $url; ?>";
					
					//ask David for help
					// var div = $('<div class=\"widget\"></div>');
					// $('.widget')
					// //var div = $('<div id=\"widget1\"></div>');
					// SC.oEmbed(track_url, $('#widget1').get(0));

					SC.oEmbed(track_url, { auto_play: false}, document.getElementById('<?php echo $divID; ?>'));
				</script>
		<?php } ?>
		
		
        <h5><?php echo $story['description']; ?></h5>
    </div>
</a>

