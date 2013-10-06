<?php
    $bioTitle = "About Me";
    $bioContent = $user['bio']; 
    if(isset($_POST['RohitNewBio']))
    {
    	rohit("rohit");
    	rohit($user['RohitNewBio']);
    	$user['bio'] = $_POST['RohitNewBio'];
    	database_update('user',$user['id'],$user);
    }
    //Notice: Undefined index: bio in C:\Users\David\Dropbox\CollabHub\profile_parts\profile_bio.php on line 6
    //UPDATE user SET `id` = '9' , `FBID` = '' , `email` = 'vikas942@gmail.com' , `password` = 'DavidQuesadaishot' , `first_name` = 'Vikas' , `last_name` = 'Kumar' , `bio` = '' WHERE `id` = '9' LIMIT 1;
    //fuck shit here
?>
<script>
function swapTextForForm(){
	var placeholderText = "<?php echo $bioContent; ?>";
	var HTMLusedToMakeForm = '<input type="text" class="form-control" id="newBio" value="' + placeholderText + ' " autofocus   name="bio" />'+
	'<button class="btn btn-lg btn-primary btn-block" type="submit" style = "margin-top: 7%" onclick=editBio()>Submit</button>';
	document.getElementById("midCol").innerHTML = HTMLusedToMakeForm;
}
function editBio()
{

	//alert("editBio Starts");
	var newBioString = document.getElementById('newBio').value.toString();
	alert(newBioString);
	if (window.XMLHttpRequest){
	    xmlhttp=new XMLHttpRequest();
	}
	else{
	    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	var senddata = "RohitNewBio=" + newBioString;
	xmlhttp.open("POST","profile_parts/editbio.php",false);
	xmlhttp.send(senddata);
	
}
</script>

<div class="col-lg-4" style="width: 54%;" id="midCol">
<h2 style="color: #9E2342;" id="midColHead"><?php echo $bioTitle; ?></h2>
<p id="contentInfoForm"><?php echo $bioContent; ?></p>
<!-- <p id="BAKA" style="DISPLAY: none">
	<form class="form-signin"> 
	<input type="text" class="form-control" id="newBio" placeholder="qasdlkfjhasd;kfjghlaskdjfhlakvnsdhjflcnaksjdf \n laksdjlhafknsdjfhalksdjfhmc/n laksjdhfcnaklsdjfhn" autofocus   name="bio"/>
	<button class="btn btn-lg btn-primary btn-block" type="submit" style = "margin-top: 7%" onclick=editBio()>Submit</button>' -->
<?php if ($isMe) { ?>
<button type=submit onclick="swapTextForForm()" id="MakeThisHideWhenEnteringData">Edit</button>
<?php } ?>
<!-- <script>document.getElementById("MakeThisHideWhenEnteringData").style.display='none';</script> -->

</div>