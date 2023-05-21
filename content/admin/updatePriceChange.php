<?php  
    include("../../conf/conn.php");
    include("../../conf/function.php");
    include("session.php");

    if (isset($_POST['optType'])) {

        $optType = words($_POST['optType']);
        $optValue = words($_POST['optValue']);

        $request = updateOptionPriceChange($optType, $optValue);

        if ($request == true) {
            my_notify("Price Change Option has been updated", $user_info);
            echo "success";
        } else {
            my_notify("Price Change Option has been updated", $user_info);
            echo "failed";
        }

    }else{
        echo "failed";
    }
?>