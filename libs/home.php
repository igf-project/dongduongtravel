<?php
ini_set('display_errors',1);
ini_set('zlib_output_compression','On');
if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) 
	ob_start("ob_gzhandler"); 
else ob_start();

if(!isset($_SESSION['CUR_MENU']))
	$_SESSION['CUR_MENU']='';
if(isset($_GET['cur_menu']))
	$_SESSION['CUR_MENU']=(int)$_GET['cur_menu'];
$conf = new CLS_CONFIG();
$conf->load_config();
?>
<!DOCTYPE html>
<html lang='vi' xml:lang='vi'>
<head>
	<meta name="google" content="notranslate" />
	<meta http-equiv="Content-Language" content="vi" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="robots" content="index, follow" />
	<title><?php echo $conf->Title;?></title>
	<meta name="description" content="<?php echo $conf->Meta_desc;?>">
	<meta name="author" content="IGF TEAM">
	<meta property="og:author" content='IGF JSC' />
	<meta property="og:locale" content='vi_VN'/>
	<meta property="og:type" content='website,article'/>
	<meta property="og:title" content="<?php echo $conf->Title;?>"/>
	<meta property="og:keywords" content='<?php echo $conf->Meta_key;?>' />
	<meta property='og:description' content='<?php echo $conf->Meta_desc;?>' />
	<meta property="og:image" content="<?php echo ROOTHOST;?>"/>
	<meta property="og:url" content="http://<?php $this->getFullURL();?>"/>
	<meta property="fb:admins" content="1577282985"/>
	
	<meta name="twitter:card" content="summary">
	<meta name="twitter:title" content="<?php echo $conf->Title;?>">
	<meta name="twitter:image" content="<?php echo ROOTHOST;?>">
	<meta name="twitter:url" content="<?php $this->getFullURL();?>">
	<meta name="twitter:description" content="<?php echo $conf->Meta_desc;?>">
	
	<meta name="google-site-verification" content="qbtSe3W5I_gouZs-jxnNilTk5AsInG4OIGwl4TO_w8M" />
	<link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic">
	<link rel="canonical" href="http://<?php $this->getFullURL();?>" />
	<link rel="author" href="https://plus.google.com/104758870709524265415"/>
	<link rel="publisher" href="https://plus.google.com/104758870709524265415"/>
	<link rel="shortcut icon" href="images/igf_logo.ico" type="image/x-icon">
	<link rel="apple-touch-icon" href="images/igf_logo.ico" type="image/x-icon">
	<link rel="apple-touch-icon" sizes="72x72" href="images/igf_logo.ico" type="image/x-icon">
	<link rel="apple-touch-icon" sizes="114x114" href="images/igf_logo.ico" type="image/x-icon">
	
	<link rel="stylesheet" href='<?php echo ROOTHOST.THIS_TEM_PATH;?>css/style.css'/>
	<link rel="stylesheet" href='<?php echo ROOTHOST.THIS_TEM_PATH;?>css/ei.css'/>
	<script src="http://code.jquery.com/jquery-latest.min.js"></script>
	<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
	<script type="text/javascript" src='<?php echo ROOTHOST.THIS_TEM_PATH;?>js/jquery.easing.1.3.php'></script>
	<script type="text/javascript" src='<?php echo ROOTHOST.THIS_TEM_PATH;?>js/jquery.eislideshow.php'></script>
	<script type="text/javascript">
	$(document).ready(function(){
		$(this).find(".submenu").hide();
		$("#nav ul li").hover(function(){
			var popup= $(this).find(".submenu");
				if(popup){popup.show('slow');}
			},function(){ 
				var popup= $(this).find(".submenu");
				if(popup) popup.hide('slow');
			}
		);
	});
	</script>
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-29898555-1', 'igf.com.vn');
		ga('send', 'pageview');

	</script>
</head>
<?php flush(); ?>
<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/vi_VN/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class='wapper'>
	<div id="header">
		<a class='logo' href='<?php echo ROOTHOST;?>' title='Logo IGF.COM.VN' rel="nofollow,noindex"></a>
		<div id='nav'><?php $this->loadModule("navitor");?></div>
	</div>
	<div id="slide">
	<div id="ei-slider" class="ei-slider">
	<ul class="ei-slider-large">
		<li>
			<img src="<?php echo ROOTHOST;?>/images/slides/slide_plan_website.png" alt="image01" />
			<div class="ei-title">
				<h2>Creative</h2>
				<h3>Geek</h3>
			</div>
		</li>
		<li>
			<img src="<?php echo ROOTHOST;?>/images/slides/slide_plan_template.png" alt="image01" />
			<div class="ei-title">
				<h2>Creative</h2>
				<h3>Geek</h3>
			</div>
		</li>
		<li>
			<img src="<?php echo ROOTHOST;?>/images/slides/slide_plan_registry.png" alt="image01" />
		</li>
		<li>
			<img src="<?php echo ROOTHOST;?>/images/slides/slide_plan_success.png" alt="image01" />
		</li>
	</ul>
	<ul class="ei-slider-thumbs">
		<li class="ei-slider-element">Current</li>
		<li><div class='box-thumb'><a class='thumb t1'>Lập kế hoạch</a></div></li>
		<li><div class='box-thumb'><a class='thumb t2'>Chọn thiết kế</a></div></li>
		<li><div class='box-thumb'><a class='thumb t3'>Đăng ký</a></div></li>
		<li><div class='box-thumb'><a class='thumb t4'>Đón nhận</a></div></li>
	</ul>
	</div>
	<script type="text/javascript">
	$(function() {$('#ei-slider').eislideshow({animation: 'center',	autoplay: true,	titlesFactor: 0});});
	</script>
	</div>
	<div id="body">
	<?php if($this->isFrontpage()){?>
		<div id='featured-news'>
			<span class='person'>&nbsp;</span>
			<article id='intro'><?php $this->loadModule('user1');?></article>
			<article id='about'><?php $this->loadModule('user2');?></article>
		</div>
		<div class="border-bottom"></div>
		<div id='main'>
			<article id='service'>
				<header>
					<h2 class='title' title='Dịch vụ chúng tôi cung cấp'>Dịch vụ chúng tôi cung cấp</h2>
					<div class='slogan'>Phát triển dịch vụ để đem lại ứng dụng tốt nhất cho con người Việt Nam</div>
				</header>
				<section>
					<div class='box'>
						<div class='content-inner'>
							<img src='<?php echo ROOTHOST;?>images/web-design.png' height='135' title='Web design' alt='web-design.png'/>
							<?php $this->loadModule('user3');?>
						</div>
					</div>
					<div class='box'>
						<div class='content-inner'>
							<img src='<?php echo ROOTHOST;?>images/web-hosting.png' height='135' title='Web hosting' alt='web-hosting'/>
							<?php $this->loadModule('user4');?>
						</div>
					</div>
					
					<div class='box'>
						<div class='content-inner'>
							<img src='<?php echo ROOTHOST;?>images/dich_vu_theo_yeu_cau.jpg' height='135' title='Giải pháp doanh nghiệp' alt='gai_phap'/>
							<?php $this->loadModule('user6');?>
						</div>
					</div>
				</section>
			</article>
			<?php $this->loadModule("user7");?>
		</div>
	<?php }else{?>
	<div id='col_main'>
	<?php $this->loadComponent();?>
	</div>
	<div id='col_right'>
	<?php $this->loadModule("right");?>
	</div>
	<?php }?>
	<div id='banner' style='text-align:center;'><?php $this->loadModule("user8");?></div>
	</div>
	<div id="footer">
		<div style='float:left;'><?php echo $conf->Footer;?></div>
		<div style='float:right;'>
		<a href="http://pagerank.chromefans.org" target=_blank title="Online PageRank Checker, PageRank Checker for Chrome"><img src="http://pr.chromefans.org/?u=e0781395b364f33010e85f66c6f2d4ff&amp;style=1" ALT="PageRank Checker" STYLE="border:0px"></A>
		<script  type='text/javascript' language='javascript'  src='http://xslt.Alexa.com/site_stats/js/t/a?url=igf.com.vn'></script>				
		</div>
	</div>
</div>
</body>
</html>