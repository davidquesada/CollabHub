<script>
	Fb.logout();
</script>

<?php
require_once "../user.php";
user_logout();
header("Location: ../../index.php");
?>