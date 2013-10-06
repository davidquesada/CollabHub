// Change the label to the selected type
function mediaTypeSelected(e) {
	// FIrst find the caller and replace the label
	var sender = (e && e.target) || (window.event && window.event.srcElement);
	document.getElementById("newMediaType").innerHTML = sender.text.toString() + ' <b class="caret"></b>';
}

// Show the options for adding new media
function newMediaBtnClick(){
	document.getElementById("newMediaForm").style.display='inline';
	document.getElementById("newMediaBtn").style.display='none';
}

// Hide the options for adding new media
function addMediaBtnClick(){
	document.getElementById("newMediaForm").style.display='none';
	document.getElementById("newMediaBtn").style.display='inline';
}