<?php
    include("../../conf/conn.php");
    include("../../conf/function.php");
    include("../../conf/my_project.php");
    include("session.php");

    // $string = "1234567890_KOPI";

    // $string = removeCharThatStarts($string, "_KOPI");

    $string = "1234567890";

    $string = addCharsAfter($string, "_KOPI");
    
    echo $string;
?>