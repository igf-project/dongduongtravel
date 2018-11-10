<?php
// var_dump($_GET);
/*
ini_set('display_errors',1);
ini_set('zlib_output_compression','On');
*/
global $AR_EXPEDIENCY;
global $AR_HOTEL_STAR;
$isMobile = (bool)preg_match('#\b(ip(hone|od|ad)|android|opera m(ob|in)i|windows (phone|ce)|blackberry|tablet'.
    '|s(ymbian|eries60|amsung)|p(laybook|alm|rofile/midp|laystation portable)|nokia|fennec|htc[\-_]'.
    '|mobile|up\.browser|[1-4][0-9]{2}x[1-4][0-9]{2})\b#i', $_SERVER['HTTP_USER_AGENT'] );
if(!isset($_SESSION['CUR_MENU']))
    $_SESSION['CUR_MENU']='';
if(isset($_GET['cur_menu']))
    $_SESSION['CUR_MENU']=(int)$_GET['cur_menu'];
$conf = new CLS_CONFIG();
$conf->load_config();
$MEMBER_LOGIN=new CLS_MEMBER();

// function Compression($cssFiles){
//     $buffer = "";
//     foreach ($cssFiles as $cssFile) {
//       $buffer .= file_get_contents($cssFile);
//     }
//     $buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
//     $buffer = str_replace(': ', ':', $buffer);
//     $buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
//     echo($buffer);
// }
?>
<!DOCTYPE html>
<html lang="vi">
<!-- Head BEGIN -->
<head>
    <meta charset="utf-8">
    <meta name="google" content="notranslate" />
    <meta name="robots" content="index, follow" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="vi" />
    <meta http-equiv="cleartype" content="on">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="<?php echo $conf->Meta_desc;?>" name="description">
    <meta content="IGF" name="IGF JSC">
    <meta property="og:site_name" content="igf.com.vn">
    <meta property="og:author" content='IGF JSC' />
    <meta property="og:locale" content='vi_VN'/>
    <meta property="og:type" content='website,article'/>
    <meta property="og:title" content='<?php echo $conf->Title;?>'/>
    <meta property='og:description' content='<?php echo $conf->Meta_desc;?>' />
    <meta property="og:image" content='<?php echo $conf->Img;?>'/>
    <meta property="og:url" content='http://<?php $this->getFullURL();?>'/>
    <meta property="fb:admins" content="148121649058473"/>
    <link rel="author" href="https://plus.google.com/+ThuyNguyen2607"/>
    <link rel="publisher" href="https://plus.google.com/+ThuyNguyen2607"/>
    <meta name="google-site-verification" content="qbtSe3W5I_gouZs-jxnNilTk5AsInG4OIGwl4TO_w8M" />

    <link href="<?php echo ROOTHOST.THIS_TEM_PATH;?>css/font-googleapis.css" rel="stylesheet">
    <link href="<?php echo ROOTHOST.THIS_TEM_PATH;?>css/custom.css" rel="stylesheet">
    <link href="<?php echo ROOTHOST.THIS_TEM_PATH;?>css/style.css?v=5" rel="stylesheet">
    <link href="<?php echo ROOTHOST.THIS_TEM_PATH;?>css/style-responsive.css?v=5" rel="stylesheet">
    <link href="<?php echo ROOTHOST.THIS_TEM_PATH;?>css/style-thumb.css?v=5" rel="stylesheet">
    <link href="<?php echo ROOTHOST.THIS_TEM_PATH;?>css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo ROOTHOST.THIS_TEM_PATH;?>css/style-travel.css?v=5" rel="stylesheet">
    <link href="<?php echo ROOTHOST.THIS_TEM_PATH;?>css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo ROOTHOST.THIS_TEM_PATH;?>css/swiper.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo ROOTHOST.THIS_TEM_PATH;?>css/menu-left/style-menuleft.css">
    <style>
    <?php
//         $cssFiles=array(THIS_TEM_PATH."css/font-googleapis.css",
//             THIS_TEM_PATH."css/custom.css",
//             THIS_TEM_PATH."css/style.css",
//             THIS_TEM_PATH."css/style-responsive.css",
//             THIS_TEM_PATH."css/style-thumb.css",
//             THIS_TEM_PATH."css/bootstrap.min.css",
//             THIS_TEM_PATH."css/style-travel.css",
//             THIS_TEM_PATH."css/font-awesome.css",
//             THIS_TEM_PATH."css/swiper.css",
//             THIS_TEM_PATH."css/menu-left/style-menuleft.css"
//         );

//         Compression($cssFiles);
    ?>
    </style>

    <?php if($isMobile==true){?>
        <link rel="stylesheet" href="<?php echo ROOTHOST.THIS_TEM_PATH;?>css/menu-left/slidebars.css">
    <?php } ?>
    <script src="<?php echo ROOTHOST.THIS_TEM_PATH;?>scripts/jquery-1.11.2.min.js"></script>
    <script src="<?php echo ROOTHOST.THIS_TEM_PATH;?>scripts/swiper.min.js" defer></script>
    <script src="<?php echo ROOTHOST.THIS_TEM_PATH;?>scripts/function.js" defer></script>
    <script src="<?php echo ROOTHOST.THIS_TEM_PATH;?>scripts/bootstrap.min.js" defer></script>

</head>
<body>
    <style type="text/css">
        .hisella-messages { position: fixed; bottom: 0; right: 0; z-index: 999999; }
        .hisella-messages-outer { position: relative; }
        #hisella-minimize { background: #3b5998; font-size: 14px; color: #fff; padding: 3px 10px; position: absolute; top: -34px; left: -1px; border: 1px solid #E9EAED; cursor: pointer; }
        @media screen and (max-width:768px){ #hisella-facebook { opacity:0; } .hisella-messages { bottom: -300px; right: -135px; } }
    </style>
    <!-- fanpage fb --> 
    <div id="fb-root"></div>
    <script>
    // jquery ẩn/hiện nút facebook
    $(document).ready(function(){ 
        $( '#hisella-minimize' ).click( function() { 
            if( $( '#hisella-facebook' ).css( 'opacity' ) == 0 ) 
            { 
                $( '#hisella-facebook' ).css( 'opacity', 1 ); 
                $( '.hisella-messages' ).animate( { right: '0' } ).animate( { bottom: '0' } ); 
            } 
            else 
            { 
                $( '.hisella-messages' ).animate( { bottom: '-300px' } ).animate( { right: '-135px' }, 400, function(){ $( '#hisella-facebook' ).css( 'opacity', 0 ) } ); 
            } 
        } ) 
    }); 

    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.8&appId=295672827483033";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>

<!-- fanpage fb -->

<div class="hisella-messages">
    <div class="hisella-messages-outer">
        <div id="hisella-minimize">Facebook chat</div>
        <div id="hisella-facebook" class='fb-page' 
        data-adapt-container-width='true' 
        data-height='300' 
        data-hide-cover='false' 
        data-href='https://www.facebook.com/tsthagiang/?fref=ts'
        data-show-facepile='true' 
        data-show-posts='false' 
        data-small-header='false' 
        data-tabs='messages' 
        data-width='250'>
    </div>
</div>
</div>
<!--end chat fb -->
<div class="wrapper page">
<?php if($isMobile==false):?>
    <div id="ctrl-scoll"></div>
    <div class="box-action-location discovery" id="box-ctrl">
        <ul>
            <li><a class="ic ic-1" href=""><span></span></a></li>
            <li><a class="ic ic-2" href=""><span></span></a></li>
            <li><a class="ic ic-3" href=""><span></span></a></li>
            <li><a class="ic ic-4" href=""><span></span></a></li>
        </ul>
    </div>
<?php endif;?>
<div id="sb-site" class="site">
<div class="box-inner"></div>
<!--menu này hiển thị cho mobile-->
<div class="m-nav">
    <a href="<?php echo ROOTHOST."trang-chu";?>"><img class="m-logo" src="<?php echo ROOTHOST;?>templates/web/images/logo1.png" alt="Hà Giang Travel"> </a>
    <div class="sb-toggle-right icon-menu"></div>
</div>
<!--END MENU-->
<div class="header header-mobi-ext">
    <div class="nav-top">
        <div class="container">

            <div class="content">
                <div class="pull-right">
                    <ul class="navi-left pull-left">
                        <li class="current"><a href="<?php echo ROOTHOST;?>">Trang Chủ</a></li>
                        <li><a href="<?php echo ROOTHOST."tour";?>">Tour</a></li>
                        <li><a href="<?php echo ROOTHOST."qua-tang";?>">Quà tặng</a></li>
                    </ul>
                    <?php
                    if(isset($_POST['cbocountry'])){
                        $location_code=$_POST['cbocountry'];
                        echo "<script language=\"javascript\">window.location.href='".ROOTHOST.$location_code."'</script>";
                    }
                    ?>

                    <form action ="" method="POST" class="frm-select pull-right">
                        <i class="fa fa-map-marker"></i>
                        <?php
                        if(isset($_POST['cbocountry'])){
                            $location_code=$_POST['cbocountry'];
                            ob_get_clean();
                            setcookie('location_cookie', $location_code ,time()+3600);
                            echo "<script language=\"javascript\">window.location.href='".ROOTHOST.$location_code."'</script>";
                        }
                        $cki_location=isset($_COOKIE["location_cookie"])? $_COOKIE["location_cookie"]: '';
                        include_once(LIB_PATH.'cls.location.php');
                        $objLo=new CLS_LOCATION();
                        ?>
                        <select name="cbocountry" id="frm-location" onchange="this.form.submit()">
                            <?php $objLo->getListCbLocationHome($cki_location);?>
                        </select>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="content">
            <div class="row d-menu">
                <a href="<?php echo ROOTHOST;?>" class="logo"><img src="<?php echo ROOTHOST;?>templates/web/images/travel-ha-giang.png" alt="Hà Giang Travel"></a>

                <div class="box-right box-rela">
                    <form class="box-search" method="post" action="tim-kiem">
                        <div class="input-group">
                            <img src="<?php echo ROOTHOST;?>images/loading_icon_comment.gif" id="img-loading">
                            <input type="text" class="form-control" name ="txtsearch" id='inputSeach' onkeyup="doSearch(this.value)" placeholder="Tìm kiếm tour, điểm du lịch,..">
                            <span class="input-group-btn">
                                <button class="btn btn-success" type="submit">Tìm kiếm</button>
                            </span>
                            <div id="suggestion"></div>
                        </div>
                        <ul class="list-inline list-seach">
                            <li onclick="myBookTour()">Đặt tour theo yêu cầu</li>
                            <li id="btn-advance">Tìm kiếm nâng cao</li>
                        </ul>
                    </form>
                    <span class="drop-top"></span>
                    <div class="box-advance" id="box-advance">
                        <form action="<?php echo ROOTHOST."tim-kiem"?>" method="POST">
                            <div class="list-path">
                                <span>Tìm Tour:</span>
                                <span id="search-where">Đà Lạt<input  name="name_location" type="hidden" value="Đà Lạt"></span> &gt;
                                <span id="search-day">2 ngày <input  name="name_day" type="hidden" value="2 ngày"></span> &gt;
                                <span id="search-ex">Ô tô<input  name="name_ex" type="hidden" value="Ô tô"></span> &gt;
                                <span id="search-hotel">Tiêu chuẩn<input  name="name_hotel" type="hidden" value="Tiêu chuẩn"></span>
                                <input class="myButton" id="searchsubmit" type="submit" name="submit-form" value="Tìm kiếm"/>
                            </div>
                            <div class="filter-name clearfix"></div>
                            <ul class="list">
                                <li id="filtermanu">
                                    <h3>Điểm đến</h3>
                                    <div class="scroll mCustomScrollbar" id="check-where">
                                        <?php
                                        $objLo->getListFrmSearch();
                                        ?>
                                    </div>
                                </li>
                                <li id="filtermanu">
                                    <h3>Thời gian</h3>
                                    <div class="scroll mCustomScrollbar" id="check-day">

                                        <label><input class="chonthoigian" name="chonthoigian" type="radio" val_name="2 ngày" value="2" checked="checked">2 ngày</label>
                                        <label><input class="chonthoigian" name="chonthoigian" type="radio" val_name="3 ngày" value="3">3 ngày</label>
                                        <label><input class="chonthoigian" name="chonthoigian" type="radio" val_name="4 ngày" value="4">4 ngày</label>
                                        <label><input class="chonthoigian" name="chonthoigian" type="radio" val_name="5 ngày" value="5">5 ngày</label>
                                        <label><input class="chonthoigian" name="chonthoigian" type="radio" val_name="6 ngày" value="6">6 ngày</label>
                                        <label><input class="chonthoigian" name="chonthoigian" type="radio" val_name="7 ngày" value="7">7 ngày</label>
                                        <label><input class="chonthoigian" name="chonthoigian" type="radio" val_name="8 ngày" value="8">8 ngày</label>
                                        <label><input class="chonthoigian" name="chonthoigian" type="radio" val_name="9 ngày" value="9">9 ngày</label>
                                        <label><input class="chonthoigian" name="chonthoigian" type="radio" val_name="10 ngày" value="10">10 ngày</label>
                                        <label><input class="chonthoigian" name="chonthoigian" type="radio" val_name="11 ngày" value="11">11 ngày</label>
                                        <label><input class="chonthoigian" name="chonthoigian" type="radio" val_name="12 ngày" value="12">12 ngày</label>
                                    </div>
                                </li>
                                <li id="check-ex">
                                    <h3>Phương tiện</h3>
                                    <?php
                                    $number = count($AR_EXPEDIENCY);
                                    for ($i=0; $i < $number; $i++) { 
                                        $id = $AR_EXPEDIENCY[$i]['id'];
                                        $name = $AR_EXPEDIENCY[$i]['name'];
                                        $code = $AR_EXPEDIENCY[$i]['code'];
                                        if($i==0) $checked='checked';
                                        else $checked='';
                                        echo '<label><input class="chonphuongtien" name="chonphuongtien" '.$checked.' type="radio" val_name="'.$name.'" value="'.$code.'">'.$name.'</label>';
                                    }
                                    ?>
                                </li>
                                <li id="check-hotel">
                                    <h3>Khách sạn</h3>
                                    <?php
                                    $number = count($AR_HOTEL_STAR);
                                    for ($i=0; $i < $number; $i++) { 
                                        $id = $AR_HOTEL_STAR[$i]['id'];
                                        $name = $AR_HOTEL_STAR[$i]['name'];
                                        if($i==0) $checked='checked';
                                        else $checked='';
                                        echo '<label><input class="chonkhachsan" name="chonkhachsan" '.$checked.' type="radio" val_name="'.$name.'" value="'.$id.'">'.$name.'</label>';
                                    }
                                    ?>
                                </li>
                            </ul>

                            <script>
                                $('#check-where input[type="radio"]').click(function(){
                                    var value=$(this).attr('val_name');
                                    $('#search-where').html(value+ '<input type="hidden" name="name_location" value="'+ value +'">');
                                });
                                $('#check-day input[type="radio"]').click(function(){
                                    var value=$(this).attr('val_name');
                                    $('#search-day').html(value+ '<input type="hidden" name="name_day" value="'+ value +'">');
                                });
                                $('#check-ex input[type="radio"]').click(function(){
                                    var value=$(this).attr('val_name');
                                    $('#search-ex').html(value+ '<input type="hidden" name="name_ex" value="'+ value +'">');
                                });
                                $('#check-hotel input[type="radio"]').click(function(){
                                    var value=$(this).attr('val_name');
                                    $('#search-hotel').html(value+ '<input type="hidden" name="name_hotel" value="'+ value +'">');
                                });
                            </script>
                        </form>
                    </div>
                    <div class="box-info-content">
                        <div class="act-tour">
                            <h3 class="h3-tour"><span>Chọn</span> tour</h3>
                            <ul class="list type-tour">
                                <li>Tour trong nước
                                    <ul class="list-child">
                                        <?php
                                        $objLo->getListMenuCategory();
                                        ?>
                                    </ul>
                                </li>
                                <li>Team building</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- slider -->
<?php include_once(COM_PATH.'com_slider/layout.php');?>
<div id="body">
    <?php 
    // var_dump($_GET);
    $this->loadComponent();
    ?>
</div>
<!-- BEGIN FOOTER -->
<?php include_once(COM_PATH.'com_footer/layout.php');?>
<?php 
    if($isMobile==false)
    include_once(MOD_PATH.'mod_support/layout.php');
?>

</div>


<!--menu mobile-->
<?php include_once(MOD_PATH.'mod_menu/layout.php');?>
<!-- Modal -->
<div class="book-tour modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content" id="data-myBookTour">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Thêm mới</h4>
            </div>
            <div class="modal-body" id="data-frm">
                <!-- show -->
            </div>
        </div>
    </div>
</div>



<script src='<?php echo ROOTHOST.THIS_TEM_PATH;?>scripts/bootstrap-modal.js' defer></script>
<script src="<?php echo ROOTHOST.THIS_TEM_PATH;?>scripts/menu-left/slidebars.min.js" defer></script>
<script src="<?php echo ROOTHOST.THIS_TEM_PATH;?>scripts/main.js" defer></script>
<link rel="stylesheet" href="<?php echo ROOTHOST.THIS_TEM_PATH;?>css/jquery.mCustomScrollbar.css">
<script src="<?php echo ROOTHOST.THIS_TEM_PATH;?>scripts/jquery.mCustomScrollbar.concat.min.js" defer></script>
<script>
    var delayTimer;
    function doSearch(txt) {
        if(txt.length >=3){
            $('#img-loading').show();
            $('#suggestion').show();
            clearTimeout(delayTimer);
            delayTimer = setTimeout(function() {
                $.get('<?php echo ROOTHOST;?>ajaxs/search/result.php',{txt},function(req){
                    $('#suggestion').html(req);
                    $('#img-loading').hide();
                });
            }, 500);
        }
        else{
            $('#suggestion').hide();
        }
    }
    function myBookTour(){
        var url=$(this).attr('action');
        $.post("<?php echo ROOTHOST;?>ajaxs/tour/myBookTour.php", function(response_data){
            $('#myModal').modal('show');
            $('#myModalLabel').html('Đặt tour theo yêu cầu');
            $('#data-myBookTour').html(response_data);
        });
    }
    $(document).ready(function(){
        $('.nav_login').click(function(){
            $('#myModal').modal('show');
            $('#myModal .modal-footer').hide();
            $('#myModal .modal-body').html('Loadding');
            $('#myModal .modal-header h3').html('Đăng nhập');
            $.get('<?php echo ROOTHOST;?>ajaxs/mem/frm_login.php',function(req){
                $('#myModal .modal-body').html(req);
            });
            return false;
        });

        $('.btn-support').click(function(){
            $(this).toggleClass('active');
            $('#toggle-box').slideToggle("slow");
        });
        $('#btn-advance').click(function(){
            $(this).toggleClass('active');
            $('.drop-top').show();
           /* $.get('<?php echo ROOTHOST;?>ajaxs/search/formSearch.php',function(req){
                $('#box-advance').html(req);
            });*/
            $('#box-advance').toggle();
        });
        $('.h3-tour').hover(function(){
            $('#box-advance').hide();
            $('.drop-top').hide();
        })
        $(document).mouseup(function (e) {
            var container = $("#suggestion");
            var btn = $('#inputSeach');
            var container1 = $("#box-advance");
            var btn1 = $('.list-search input[type="radio"]');
            if (!container.is(e.target) && container.has(e.target).length === 0
                && !btn.is(e.target) && btn.has(e.target).length === 0){
                container.hide();
            }
            if (!container1.is(e.target) && container1.has(e.target).length === 0
                && !btn1.is(e.target) && btn1.has(e.target).length === 0){
                container1.hide();
                $('#btn-advance').removeClass('active');
                $('.drop-top').hide();
            }
        });



    });
</script>
</div>
</body>
</html>