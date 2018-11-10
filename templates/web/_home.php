<?php
/*
ini_set('display_errors',1);
ini_set('zlib_output_compression','On');
*/
$isMobile = (bool)preg_match('#\b(ip(hone|od|ad)|android|opera m(ob|in)i|windows (phone|ce)|blackberry|tablet'.
                    '|s(ymbian|eries60|amsung)|p(laybook|alm|rofile/midp|laystation portable)|nokia|fennec|htc[\-_]'.
                    '|mobile|up\.browser|[1-4][0-9]{2}x[1-4][0-9]{2})\b#i', $_SERVER['HTTP_USER_AGENT'] );

if(!isset($_SESSION['CUR_MENU']))
	$_SESSION['CUR_MENU']='';
if(isset($_GET['cur_menu']))
	$_SESSION['CUR_MENU']=(int)$_GET['cur_menu'];
$conf = new CLS_CONFIG();
$conf->load_config();
$MEMBER_LOGIN=new CLS_MEMBER;
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="vi">
<!--<![endif]-->
<!-- Head BEGIN -->
<head>
	<title><?php echo $conf->Title;?></title>
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
	<meta property="og:image" content='<?php echo ROOTHOST;?>'/>
	<meta property="og:url" content='http://<?php $this->getFullURL();?>'/>
	<meta property="fb:admins" content="626030237421108"/>
	<link rel="author" href="https://plus.google.com/+ThuyNguyen2607"/>
	<link rel="publisher" href="https://plus.google.com/+ThuyNguyen2607"/>
	<meta name="google-site-verification" content="qbtSe3W5I_gouZs-jxnNilTk5AsInG4OIGwl4TO_w8M" />
	<link rel="shortcut icon" href="favicon.ico">
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|Pathway+Gothic+One|PT+Sans+Narrow:400+700|Source+Sans+Pro:200,300,400,600,700,900&amp;subset=all" rel="stylesheet" type="text/css"> 

	<link href="<?php echo ROOTHOST.THIS_TEM_PATH;?>css/style.css?v=13" rel="stylesheet">
	<link href="<?php echo ROOTHOST.THIS_TEM_PATH;?>css/style-responsive.css" rel="stylesheet">
	<link href="<?php echo ROOTHOST.THIS_TEM_PATH;?>css/custom.css" rel="stylesheet">
	<link href="<?php echo ROOTHOST.THIS_TEM_PATH;?>css/font-awesome.css" rel="stylesheet">
	<link href="<?php echo ROOTHOST.THIS_TEM_PATH;?>css/swiper.min.css" rel="stylesheet">
	<link href="<?php echo ROOTHOST.THIS_TEM_PATH;?>css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo ROOTHOST.THIS_TEM_PATH;?>css/style-travel.css?v=1" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo ROOTHOST.THIS_TEM_PATH;?>css/menu-left/style-menuleft.css">
    <link rel="stylesheet" href="<?php echo ROOTHOST.THIS_TEM_PATH;?>css/menu-left/slidebars.css">
</head>
<body>
<div class="wrapper page">
    <div id="sb-site" class="site">
        <div class="box-inner"></div>
        <div id="banner1">
            <!--menu này hiển thị cho mobile-->
            <div class="m-nav">
                <a href=""><img class="logo" src="img/logo.png" alt=""/> </a>
                <div class="sb-toggle-right icon-menu"></div>
            </div>

            <div id="slide-main">

                <div id="slider-main" class="swiper-container">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide" style="background: url('<?php echo ROOTHOST.THIS_TEM_PATH;?>images/banner.jpg') no-repeat; background-size: cover">

                        </div>
                        <div class="swiper-slide" style="background: url('<?php echo ROOTHOST.THIS_TEM_PATH;?>images/banner.jpg') no-repeat; background-size: cover">

                        </div>
                        <div class="swiper-slide" style="background: url('<?php echo ROOTHOST.THIS_TEM_PATH;?>images/banner.jpg') no-repeat; background-size: cover">

                        </div>
                    </div>

                    <!-- <div class="swiper-slide">
                        <img src="<?php /*echo ROOTHOST.THIS_TEM_PATH;*/?>images/banner.jpg" title=""/>
                    </div>
                    <div class="swiper-slide">
                        <img src="<?php /*echo ROOTHOST.THIS_TEM_PATH;*/?>images/banner.jpg" title=""/>
                    </div>
                    <div class="swiper-slide">
                        <img src="<?php /*echo ROOTHOST.THIS_TEM_PATH;*/?>images/banner.jpg" title=""/>
                    </div>-->
                    <!-- Add Pagination -->
                    <div class="swiper-pagination"></div>
                    <!-- Add Arrows -->
                    <div class="swiper-button-next btn-next"></div>
                    <div class="swiper-button-prev btn-prev"></div>
                </div>
            </div>
            <div class="container">
                <!--
                <div class="box-intro pull-left">
                    <div class="position">Quảng Trị</div>
                    <div class="country">Vietnam</div>
                    <div class="link"><a href="#">Khám phá ngay <span></span></a></div>
                </div>

                <div class="box-search pull-right">
                    <form name="frmsearch" id="frmsearch" method="POST" action="#">
                    <input type="text" placeholder="Tìm kiếm địa điểm để khám phá" name="txtsearch"/>
                    <div class="btnsearch pull-right"><i class="fa fa-search"></i></div>
                    </form>
                </div>
                <div class="scroll-down text-center"><i class="fa fa-chevron-down"></i></div>
                 -->
            </div>
        </div>
        <div class="header header-mobi-ext">
            <div class="container">
                <div class="row">
                    <!-- Navigation BEGIN -->
                    <div class="col-md-5 col-sm-5 col-xs-4 pull-left padtop menuleft">
                        <ul class="navi-left">
                            <li class="current"><a href="<?php echo ROOTHOST;?>">Trang Chủ</a></li>
                            <li><a href="#">Tour</a></li>
                            <li><a href="#">Shop quà tặng</a></li>
                        </ul>
                    </div>
                    <!-- Navigation END -->
                    <!-- Logo BEGIN -->
                    <div class="col-md-2 col-sm-2 col-xs-4 box-logo">
                        <a class="scroll site-logo img-height" href="#igf"><img src="<?php echo ROOTHOST.THIS_TEM_PATH;?>images/logo1.png" alt="Đông Dương Travel" class="img-responsive"></a>
                    </div>
                    <!-- Logo END -->
                    <a href="javascript:void(0);" class="mobi-toggler"><i class="fa fa-bars"></i></a>
                    <!-- Navigation BEGIN -->
                    <div class="col-md-5 col-sm-5 col-xs-4 pull-right padtop menuright">
                        <ul class="navi-left navi-right pull-left">
                            <?php if(!$MEMBER_LOGIN->isLogin()){?>
							<li><a class="dang-nhap" data-toggle="modal" data-target="#ModalAdd" >ĐĂNG NHẬP</a></li>
							<?php }else{
								$user_login=$MEMBER_LOGIN->getUserLogin();
							?>
							<li>Thuy Nguyen <img src="https://graph.facebook.com/894479910619616/picture?type=large" class="user_avar" width="50"></li>
							<li><span class="glyphicon glyphicon-comment"><span>186</span></span></li>
							<?php } ?>
                        </ul>
                        <div class="pull-right">
                            <i class="fa fa-map-marker"></i>
                            <select name="cbocountry" id="cbocountry">
                                <option value="hanoi">Hà Nội</option>
                            </select>
                        </div>
                    </div>
                    <!-- Navigation END -->
                </div>
            </div>
        </div>
        <!-- Partners block END -->
        <div id="body"><?php  $this->loadComponent();  ?></div>
        <!-- BEGIN FOOTER -->
        <div class="footer">
            <div class="logo-footer"></div>
            <div class="container mn-footer">
                <div class="row">
                    <div class="col-md-2 col-xs-6 col-item">
                        <span class="title">Danh mục</span>
                        <ul>
                            <li><a href="">Trang chủ</a></li>
                            <li><a href="">Tour</a></li>
                            <li><a href="">Dịch vụ</a></li>
                            <li><a href="">Cẩm nang</a></li>
                            <li><a href="">Tin tức</a></li>
                            <li><a href="">Liên hệ</a></li>
                        </ul>
                    </div>
                    <div class="col-md-2 col-xs-6 col-item">
                        <span class="title">Về chúng tôi</span>
                        <ul>
                            <li><a href="">Về chúng tôi</a></li>
                            <li><a href="">Chinh sách bảo mật</a></li>
                            <li><a href="">Điều khoản sử dụng</a></li>
                            <li><a href="">Cẩm nang</a></li>
                            <li><a href="">Khách sạn</a></li>
                            <li><a href="">Liên hệ</a></li>
                        </ul>
                    </div>

                    <div class="col-md-2 col-xs-6 col-item">
                        <span class="title">Dành cho bạn</span>
                        <ul>
                            <li><a href="">Đối tác khách sạn</a></li>
                            <li><a href="">Tour</a></li>
                            <li><a href="">Dịch vụ</a></li>
                            <li><a href="">Cẩm nang</a></li>
                            <li><a href="">Tin tức</a></li>
                            <li><a href="">Liên hệ</a></li>
                        </ul>
                    </div>
                    <div class="col-md-2 col-xs-6 col-item">
                        <span class="title">Thư mục</span>
                        <ul>
                            <li><a href="">Trang chủ</a></li>
                            <li><a href="">Tour</a></li>
                            <li><a href="">Dịch vụ</a></li>
                            <li><a href="">Cẩm nang</a></li>
                            <li><a href="">Tin tức</a></li>
                            <li><a href="">Liên hệ</a></li>
                        </ul>
                    </div>

                    <div class="col-md-2 col-xs-6 col-item">
                        <span class="title">Liên kết</span>
                        <ul>
                            <li><a href="">Dantri.com.vn</a></li>
                            <li><a href="">Hendabong.vn</a></li>
                            <li><a href="">Dịch vụ</a></li>
                        </ul>
                    </div>

                    <div class="col-md-2 col-xs-6 col-item">
                        <span class="title">Tài khoản</span>
                        <ul>
                            <li><a href="">Trang chủ</a></li>
                            <li><a href="">Tour</a></li>
                            <li><a href="">Dịch vụ</a></li>
                            <li><a href="">Cẩm nang</a></li>
                            <li><a href="">Tin tức</a></li>
                            <li><a href="">Liên hệ</a></li>
                        </ul>
                    </div>
                </div>




            </div>
            <div class="copyright">© 2015 Bản quyền thuộc về Đông Dương Travel</div>
            <div class="mn-list">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-xs-6">
                            <h4 class="title">Top địa điểm du lịch lý tưởng</h4>
                            <div class="row">
                                <div class="col-md-4">
                                    <ul>
                                        <li><a href="">Trang chủ</a></li>
                                        <li><a href="">Tour</a></li>
                                        <li><a href="">Dịch vụ</a></li>
                                        <li><a href="">Cẩm nang</a></li>
                                        <li><a href="">Tin tức</a></li>
                                        <li><a href="">Liên hệ</a></li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <ul>
                                        <li><a href="">Về chúng tôi</a></li>
                                        <li><a href="">Chinh sách bảo mật</a></li>
                                        <li><a href="">Điều khoản sử dụng</a></li>
                                        <li><a href="">Cẩm nang</a></li>
                                        <li><a href="">Khách sạn</a></li>
                                        <li><a href="">Liên hệ</a></li>
                                    </ul>
                                </div>

                                <div class="col-md-4">
                                    <ul>
                                        <li><a href="">Đối tác khách sạn</a></li>
                                        <li><a href="">Tour</a></li>
                                        <li><a href="">Dịch vụ</a></li>
                                        <li><a href="">Cẩm nang</a></li>
                                        <li><a href="">Tin tức</a></li>
                                        <li><a href="">Liên hệ</a></li>
                                    </ul>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-6 col-xs-6">
                            <h4 class="title">Khách sạn hàng đầu</h4>
                            <div class="row">
                                <div class="col-md-4">
                                    <ul>
                                        <li><a href="">Trang chủ</a></li>
                                        <li><a href="">Tour</a></li>
                                        <li><a href="">Dịch vụ</a></li>
                                        <li><a href="">Cẩm nang</a></li>
                                        <li><a href="">Tin tức</a></li>
                                        <li><a href="">Liên hệ</a></li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <ul>
                                        <li><a href="">Về chúng tôi</a></li>
                                        <li><a href="">Chinh sách bảo mật</a></li>
                                        <li><a href="">Điều khoản sử dụng</a></li>
                                        <li><a href="">Cẩm nang</a></li>
                                        <li><a href="">Khách sạn</a></li>
                                        <li><a href="">Liên hệ</a></li>
                                    </ul>
                                </div>

                                <div class="col-md-4">
                                    <ul>
                                        <li><a href="">Đối tác khách sạn</a></li>
                                        <li><a href="">Tour</a></li>
                                        <li><a href="">Dịch vụ</a></li>
                                        <li><a href="">Cẩm nang</a></li>
                                        <li><a href="">Tin tức</a></li>
                                        <li><a href="">Liên hệ</a></li>
                                    </ul>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="sb-slidebar sb-right">
        <!-- Your left Slidebar content. -->
        <div class="content-mn">
            <div class="bg-search">
                <form class="frm-mn">
                    <div class="input-search">
                        <input class="" type="text" placeholder="Từ khóa tìm kiếm">
                    </div>
                    <input class="btn-sub" type="submit" value="Tìm">
                </form>

            </div>

            <div class="box-category">
                <div class="item">
                    <span class="title">Menu</span>
                    <ul class="content info-detail">
                        <li><a href="">Trang chủ</a></li>
                        <li><a href="">Đặt Tour</a></li>
                        <li><a href="">Dịch vụ</a></li>
                        <li><a href="">Cẩm lang du lịch</a></li>
                        <li><a href="">Liên hệ</a></li>
                    </ul>
                </div>

                <div class="item">
                    <span class="title">Dành cho bạn</span>
                    <ul class="content info-detail">
                        <li><a href="">Check Tour</a></li>
                        <li><a href="">Đặt phòng khách sạn</a></li>
                        <li><a href="">Check in</a></li>
                        <li><a href="">Hỏi đáp</a></li>
                    </ul>
                </div>
            </div>
            <div class="menu account-mn">
                <ul class="">
                    <li><a href="">Thiết lập tài khoản</a></li>
                    <li><a href="">Đăng xuất</a></li>
                </ul>
            </div>
        </div>


    <!-- END FOOTER -->
    <a href="#igf" class="go2top scroll"><i class="fa fa-arrow-up"></i></a>

<div id="ModalAdd" class="modal fade" role="dialog" >
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<div class="modal-body">
				<form class="col-md-6 book-frm frm-login">
					<h3>ĐĂNG NHẬP</h3>
					<p class="notic">Tài khoản đăng nhập của bạn</p>
					<div class="form-group">
						<input type="email" class="form-control" placeholder="Email hoặc tên đăng nhập">
					</div>
					<div class="form-group">
						<input type="password" class="form-control" placeholder="Mật khẩu">
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-success btn-login">Đăng nhập</button>
						<div class="checkbox">
							<label>
								<input type="checkbox"> Lưu mật khẩu -
							</label>
							<a href="" class="link">Quên mật khẩu</a>
						</div>
					</div>
					<div class="form-group">
						<div class="pull-left"><a href="" class="btn-social btn-facebook" onClick="testAPI();"></a></div>
						<div class="pull-right"><a href="" class="btn-social btn-google"></a></div>
					</div>
				</form>
				<form class="col-md-6 book-frm frm-register">
					<h3>ĐĂNG KÝ THÀNH VIÊN</h3>
					<p class="notic">Nếu bạn chưa có tài khoản, hãy đăng ký</p>
					<div class="form-group">
						<input type="email" class="form-control" placeholder="Email hoặc tên đăng nhập">
					</div>
					<div class="form-group">
						<input type="password" class="form-control" placeholder="Mật khẩu">
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-success btn-register">Đăng ký</button>
					</div>
				</form>
			</div>
			<div class="modal-footer"></div>
		</div>
	</div>
</div>
<div id="ModalMess" class="modal fade" tabindex="-1" role="dialog" >
<div class="modal-dialog">
    <div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 id="myModalLabel">Thông báo</h3>
		</div>
		<div class="modal-body">
			<p>One fine body…</p>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" aria-hidden="true">Đóng</button>
		</div>
	</div>
	</div>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="<?php echo ROOTHOST.THIS_TEM_PATH;?>scripts/login.js"></script>
<script src="http://connect.facebook.net/en_US/all.js"></script>
<script src="<?php echo ROOTHOST.THIS_TEM_PATH;?>scripts/login_fb.js"></script>
<script src="<?php echo ROOTHOST.THIS_TEM_PATH;?>scripts/swiper.min.js"></script>
<script src="<?php echo ROOTHOST.THIS_TEM_PATH;?>scripts/menu-left/slidebars.min.js"></script>
<script>
function slider_item(index){
	var mySwiper=[];
	var elem = document.getElementById('slider-item' + index);
	mySwiper[index] = new Swiper(elem, {
       // pagination: '.swiper-pagination'+ index,
        nextButton: '.swiper-button-next'+ index,
        prevButton: '.swiper-button-prev'+ index,
		loop: true,
		speed: 600,
		autoplay: false
    });
}
$(document).ready(function(){
    /* call menu */
    try{
        $.slidebars({
            disableOver: 768,
            hideControlClasses: true
        });
    }
    catch (e){
    }

	slider_item(1);
	slider_item(2);
	slider_item(3);
	slider_item(4);
	var elem_main = document.getElementById('slider-main');
     var swiper = new Swiper(elem_main, {
        pagination: '.swiper-pagination',
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
        paginationClickable: true,
        spaceBetween: 0,
        centeredSlides: true,
		speed: 600,
        autoplay: 4000,
		loop: true,
        autoplayDisableOnInteraction: false
		/*onSlideChangeStart: function (s) {
		  var activeSlideHeight = s.slides.eq(s.activeIndex).height();
		  $(elem_main).css({height: activeSlideHeight+'px'});
	   }	*/
    });
    });
</script>
</body>
</html>