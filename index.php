<?php

    include 'conf/conn.php';
    include 'conf/my_project.php';

    session_start();

	if (isset($_SESSION['ascu_online_user_id'])) {
        if($_SESSION['ascu_online_user_type'] == "0"){
            header("location: content/admin/");
        }else{
            session_destroy();
        }
	}else{
        session_destroy();
    }

    $uname = @$_GET['uname'];

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title><?php echo $my_project_name; ?></title>
	<link rel = "shortcut icon" href = "img/logo.png">
	<link href="login/css/kent.css" rel="stylesheet" />
    <link href="login/css/bootstrap.css" rel="stylesheet" />
    <link href="login/css/font-awesome.min.css" rel="stylesheet" />
    <link href="login/css/style.css" rel="stylesheet" />
    <link href='login/css/fonts.css' rel='stylesheet' type='text/css' />

    <script type="text/javascript">
        function contact(){
            window.alert("Ask your admin for password update, Thank you!");
        }
    </script>

    <style>
    .no-js #loader { display: none;  }
    .js #loader { display: block; position: absolute; left: 100px; top: 0; }
    .se-pre-con {
        position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background: url(loader/images/loader-128x/Preloader_3.gif) center no-repeat #fff;
    }
    </style>

    <script src="loader/js/jquery.min.js"></script>
    <script src="loader/js/modernizr.js"></script>
    <script>
        //paste this code under head tag or in a seperate js file.
        // Wait for window load
        $(window).load(function() {
            // Animate loader off screen
            $(".se-pre-con").fadeOut("slow");;
        });
    </script>

</head>
<body>

    <!-- <div class="se-pre-con"></div> -->

    <div class="container">
        <div class="row text-center pad-top ">
            <div class="col-md-12">
                <h2 class = "blabla" style="color: #fff;"><?php echo $my_project_name; ?></h2>
                <h3 class = "blabla" style="color: #fff;"><?php echo $my_project_title; ?></h3>
            </div>
        </div>
        <div class="row  pad-top">
               
            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                <div class="panel addadd panel-default">
                    <div class="panel-heading">
                        <center><strong>Enter Account Information</strong></center>
                    </div>
                    <div class="panel-body">
                        <form method="post" enctype="multipart/form-data" action="conf/login_conf.php">
                            <br />
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                                <input type="text" class="form-control" name="username" placeholder="Your Username" value="<?= $uname; ?>" autocomplete="off" autofocus required onfocus="this.selectionStart = this.selectionEnd = this.value.length;"/>
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="password" class="form-control" name="password"  placeholder="Your Password" required/>
                            </div>
                            <input type="submit" value="Login Now" name="login" class="btn btn-primary ">
                            <br>
                            <br>
                            <label class = "whity"> Forgot Password?</label> <a href="#" onclick="contact()" style="color: #3fc9ef; font-size:12px;">click here ... </a>
                            <br>
                            <br>
                            <a href="select_category_download" target="_new">
                                <button 
                                type="button" 
                                class="btn btn-info btn-block">
                                    <i class="fa fa-download"></i> Download Update
                                </button>
                            </a>
                        </form>
                    </div>
                </div>
            </div>
                
                
        </div>
        
        <b><center>
        <span id="tick2" style="color: #bdbdbd;">   

        <script>
                        function show2(){
                        if (!document.all&&!document.getElementById)
                        return
                        thelement=document.getElementById? document.getElementById("tick2"): document.all.tick2
                        var Digital=new Date()
                        var hours=Digital.getHours()
                        var minutes=Digital.getMinutes()
                        var seconds=Digital.getSeconds()
                        var dn="PM"
                        if (hours<12)
                        dn="AM"
                        if (hours>12)
                        hours=hours-12
                        if (hours==0)
                        hours=12
                        if (minutes<=9)
                        minutes="0"+minutes
                        if (seconds<=9)
                        seconds="0"+seconds
                        var ctime=hours+":"+minutes+":"+seconds+" "+dn
                        thelement.innerHTML=ctime
                        setTimeout("show2()",1000)
                        }
                        window.onload=show2
                        //-->

        </script>
        </span>
        &nbsp;|&nbsp;<span style="color: #bdbdbd;">Today is <?php $date = new DateTime();
                    echo $date->format('l, F jS, Y'); ?></span>
        </b>
        <br><br><br><br><br>
        <p style="font-size: 20px; font-family: 'Century Gothic'; color: #fff;">Powered By | <a href="https://www.facebook.com/krazyappsph" target="_NEW" style="color: #fff;">KrazyApps PH</a></p>
        <p style="color: #fff;">ver. 3.1</p>

        </center>
    </div>

    <script src="login/plugins/jquery-1.10.2.js"></script>
    <script src="login/plugins/bootstrap.js"></script>
   
</body>
</html>
