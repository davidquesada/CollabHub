<?php
require_once (dirname(__FILE__) . "/../tags.php");

tags_post($_REQUEST);
echo $database->error;
?>
<!--
<html>
    <body>
        <script type="application/x-javascript"><![CDATA[
        location.reload();
        //]]>
        </script>
    </body>
</html> -->