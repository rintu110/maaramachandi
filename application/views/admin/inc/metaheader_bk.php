<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title><?=(isset($User_Type) && $User_Type!='')?$User_Type:''?> :: <?=(isset($Meta_title) && $Meta_title!='')?$Meta_title:''?></title>

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="<?=base_url()?>assets/dist/img/ico/favicon.png" type="image/x-icon">
        <link rel="apple-touch-icon" type="image/x-icon" href="<?=base_url()?>assets/dist/img/ico/apple-touch-icon-57-precomposed.png">
        <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="<?=base_url()?>assets/dist/img/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="<?=base_url()?>assets/dist/img/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="<?=base_url()?>assets/dist/img/ico/apple-touch-icon-144-precomposed.png">

        <!-- Start Global Mandatory Style
        =====================================================================-->
        <!-- jquery-ui css -->
        <link href="<?=base_url()?>assets/plugins/jquery-ui-1.12.1/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
        <!-- Bootstrap -->
        <link href="<?=base_url()?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <!-- Bootstrap rtl -->
        <!--<link href="assets/bootstrap-rtl/bootstrap-rtl.min.css" rel="stylesheet" type="text/css"/>-->
        <!-- Lobipanel css -->
        <!-- <link href="<?=base_url()?>assets/plugins/lobipanel/lobipanel.min.css" rel="stylesheet" type="text/css"/> -->
        <!-- Pace css -->
       <!--  <link href="<?=base_url()?>assets/plugins/pace/flash.css" rel="stylesheet" type="text/css"/> -->
        <!-- Font Awesome -->
        <link href="<?=base_url()?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <!-- Pe-icon -->
        <link href="<?=base_url()?>assets/pe-icon-7-stroke/css/pe-icon-7-stroke.css" rel="stylesheet" type="text/css"/>
        <!-- Themify icons -->
        <link href="<?=base_url()?>assets/themify-icons/themify-icons.css" rel="stylesheet" type="text/css"/>
        <!-- End Global Mandatory Style
        =====================================================================-->
       
        <!-- Start page Label Plugins 
        =====================================================================-->
        <!-- dataTables css -->
        <link href="<?=base_url()?>assets/plugins/datatables/dataTables.min.css" rel="stylesheet" type="text/css"/>
        <!-- End page Label Plugins 
        =====================================================================-->
        <!-- Start page Label Plugins 
        =====================================================================-->
        <!-- Toastr css -->
        <link href="<?=base_url()?>assets/plugins/toastr/toastr.css" rel="stylesheet" type="text/css"/>
        <!-- Emojionearea -->
        <link href="<?=base_url()?>assets/plugins/emojionearea/emojionearea.min.css" rel="stylesheet" type="text/css"/>
        <!-- Monthly css -->
        <link href="<?=base_url()?>assets/plugins/monthly/monthly.css" rel="stylesheet" type="text/css"/>
        <!-- End page Label Plugins 
        =====================================================================-->
        <!-- Start Theme Layout Style
        =====================================================================-->
        <!-- Theme style -->
        <link href="<?=base_url()?>assets/dist/css/styleBD.css" rel="stylesheet" type="text/css"/>
        <!-- Theme style rtl -->
        <!--<link href="assets/dist/css/styleBD-rtl.css" rel="stylesheet" type="text/css"/>-->
        <!-- jQuery -->
        <script src="<?=base_url()?>assets/plugins/jQuery/jquery-1.12.4.min.js" type="text/javascript"></script>
        <!-- End Theme Layout Style
        =====================================================================-->
        <style type="text/css">
            .loader {
                  position:fixed;
                  top:0px;
                  right:0px;
                  width:100%;
                  height:100%;
                  background-color:#efefef;
                  background-image:url('https://www.mvwebsolutions.com/project/loader1.gif');
                  background-repeat:no-repeat;
                  background-position:center;
                  z-index:100000;
                  opacity: 0.7;  
             }
        </style>
        <script type="text/javascript">
            $(window).on('load', function(){
              setTimeout(removeLoader, 2000); //wait for page load PLUS two seconds.
            });
            function removeLoader(){
                $( ".loader" ).fadeOut(500, function() {
                  // fadeOut complete. Remove the loading div
                  $( ".loader" ).remove(); //makes page more lightweight 
              });  
            }
    </script>
    </head>
    <body class="hold-transition sidebar-mini">
         <div class="loader">Loading...</div>
        <div class="pace  pace-inactive">
            <div class="pace-progress" data-progress-text="100%" data-progress="99" style="transform: translate3d(100%, 0px, 0px);">
              <div class="pace-progress-inner"></div>
           </div>
            <div class="pace-activity"></div>
        </div> 
         <!-- Site wrapper -->
        <div class="wrapper">