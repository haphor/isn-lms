<?php
/**
 * Template Name: Tangerine Life
 * Description: A page template for Tangerine Life Page
 *
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package neconde
 *
 */
// get_header();
?>
<!DOCTYPE html>
<html lang="en" class="full-screen">

<head>
 	<meta charset="UTF-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Tangerine Life - I-Invest</title>
<!-- 	<link rel="stylesheet" href="http://localhost/i-invest/wp-content/themes/invest/_css/bootstrap.min.css"> -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<?php wp_head(); ?>
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-98099603-7"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-98099603-7');
	</script>

</head>
<body id="tangerine-life">
	<div class="container">
		
	</div>
	<div class="wrapper">
		<div class="page-one" style="background: #792b85;">
			<nav class="navbar navbar-expand-lg navbar-light bg-light" id="navbar">
				<a class="navbar-brand" href="<?php echo home_url(); ?>">
					<img src="https://i-investng.com/wp-content/uploads/2018/09/i-invest-logo.png" alt="<?php bloginfo('name'); ?>">
				</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div id="navbarSupportedContent" class="collapse navbar-collapse pull-right">
					<ul class="navbar-nav mr-auto">
						<li class="nav-item">
							<a class="nav-link" href="<?php echo home_url(); ?>#home">Home</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?php echo home_url(); ?>#about">About</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?php echo home_url(); ?>#faq">FAQs</a>
						</li>
					</ul>
					<a href="<?php echo home_url(); ?>#download" class="btn btn-primary nav-download">Download the App</a>
					<a href="https://client.i-investng.com/" class="btn btn-primary" target="_blank" style="margin-left:10px;">Invest Now</a>
				</div>
			</nav>
			<div class="banner-container" style="background-image: url('https://i-investng.com/wp-content/uploads/2020/08/tangerine-banner.png');">
				<div class="banner-content">
					<div class="banner-image show-mobile">
						<img src="https://i-investng.com/wp-content/uploads/2020/08/tangerine-life-logo-white.png" alt="Tangerine Life Logo White" style="max-width: 230px; margin-top: -20px; margin-bottom: 30px;">
						<img src="https://i-investng.com/wp-content/uploads/2020/08/tangerine-banner.png" alt="Tangerine Banner">
					</div>
					<div class="banner-text">
						<img class="show-desktop" src="https://i-investng.com/wp-content/uploads/2020/08/tangerine-life-logo-white.png" alt="Tangerine Life Logo White">
						<h5 class="banner-main">You can now get Tangerine life insurance on the i-invest App</h5>
						<div class="download">
							<a href="#">Start today</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="page-two">
			<div class="page-content d-sm-flex flex-row-reverse">
				<div class="one">
					<div class="media">
						<!-- <img src="https://i-investng.com/wp-content/uploads/2020/08/finance-banner.png" alt="Personal Finance Banner"> -->
						<img src="https://i-investng.com/wp-content/uploads/2020/08/Create-1@2x.png" alt="Personal Finance Banner">
					</div>
				</div>
				<div class="one">
					<div class="media-text">
						<h4>Your All-in-one Personal Finance App</h4>
						<p>We are developing new ways to deliver seamless financial services to our customers.</p>
					</div>
				</div>
			</div>
		</div>
		<div class="page-three" style="background: rgba(132, 74, 152, 0.05); color: #1e1147; padding: 30px 0px;">
			<div class="container d-sm-flex flex-row">
				<div class="col-12 col-sm-4">
					<h5 class="pt-5 pb-4">Why choose Tangerine Life for Insurance</h5>
				</div>
				<div class="col-12 col-sm-8 choose-tangerine d-flex flex-wrap">
					<div class="col-12 col-sm-6 pt-5 pb-4">
						<img src="https://i-investng.com/wp-content/uploads/2020/08/insurance.png" alt="Icon">
						<h6>Instant Life Insurance</h6>
						<p>
							Life is uncertain, we know this, but in times like these the uncertainty heightens. One thing we 
							guarantee - <strong>you can get your life insurance cover with us in just a few clicks.</strong>
						</p>
					</div>
					<div class="col-12 col-sm-6 pt-5 pb-4">
						<img src="https://i-investng.com/wp-content/uploads/2020/08/life-cover.png" alt="Icon">
						<h6>Life Cover up to ₦5,000,0000 </h6>
						<p>
							You can ensure your loved ones are securely provided for with our guaranteed pay out worth up to 
							₦5,000,000 to take care of life's essentials when you can't.
						</p>
					</div>
					<div class="col-12 col-sm-6 pt-5 pb-4">
						<img src="https://i-investng.com/wp-content/uploads/2020/08/period.png" alt="Icon">
						<h6>For a 12 month Period</h6>
						<p>
							Times like these don't last forever, our 12 month plan ensures that you can weather the storm with 
							confidence with an affordable one-off premium payment.
						</p>
					</div>
					<div class="col-12 col-sm-6 pt-5 pb-4">
						<img src="https://i-investng.com/wp-content/uploads/2020/08/affordable.png" alt="Icon">
						<h6>Affordable One-off Payment</h6>
						<p>
							Our premium pricing is simple and straight forward. Your family and loved ones could be safe and 
							secure with as little as ₦26,250.
						</p>
					</div>
				</div>
			</div>
		</div>
		<!-- <div class="page-four" style="background: #792b85; color: #fff; padding: 50px 0px 75px;">
			<div class="container">
				<div class="media-text">
					<h4>More features coming to you soon</h4>
				</div>
				<div class="coming-features d-flex flex-wrap justify-content-sm-between">
						<div class="coming-feature d-flex flex-column">
							<div class="d-flex flex-nowrap">
								<img src="https://i-investng.com/wp-content/uploads/2020/08/Icon.png" alt="Icon">
								<span>Coming Soon!</span>
							</div>
							<p>Flexible savings</p>
						</div>
						<div class="coming-feature d-flex flex-column">
							<div class="d-flex flex-nowrap">
								<img src="https://i-investng.com/wp-content/uploads/2020/08/Icon.png" alt="Icon">
								<span>Coming Soon!</span>
							</div>
							<p>Track your spending</p>
						</div>
						<div class="coming-feature d-flex flex-column">
							<div class="d-flex flex-nowrap">
								<img src="https://i-investng.com/wp-content/uploads/2020/08/Icon.png" alt="Icon">
								<span>Coming Soon!</span>
							</div>
							<p>Bill payments</p>
						</div>
						<div class="coming-feature d-flex flex-column">
							<div class="d-flex flex-nowrap">
								<img src="https://i-investng.com/wp-content/uploads/2020/08/Icon.png" alt="Icon">
								<span>Coming Soon!</span>
							</div>
							<p>Amazing Deals</p>
						</div>
				</div>
			</div>
		</div> -->
		<div id="multiplatform" class="page-two" style="background-image: url('https://i-investng.com/wp-content/uploads/2020/08/Create-2@2x.png'); color: #1e1147;">
			<div class="page-content d-sm-flex flex-row-reverse">
				<div class="one visible-mobile">
					<div class="media">
						<img src="https://i-investng.com/wp-content/uploads/2020/08/Create-2@2x.png" alt="Multi Platform Banner">
					</div>
				</div>
				<div class="one">
					<div class="media-text">
						<span>MULTI PLATFORM</span>
						<!-- <h4>Join the Tangerine Life today</h4> -->
						<h4>Join i-invest today</h4>
						<p>Start your journey to a financially secure future on iOS, Android, Web</p>
						<!-- <div id="multiplatform-download" class="d-flex flex-wrap justify-content-between">
							<a id="multiplatform-IOS" href="#"><img src="https://i-investng.com/wp-content/uploads/2020/08/platform-iso.png" alt="Platform Icon"></a>
							<a id="multiplatform-Android" href="#"><img src="https://i-investng.com/wp-content/uploads/2020/08/platform-android.png" alt="Platform Icon"></a>
							<a id="multiplatform-Desktop" href="#"><img src="https://i-investng.com/wp-content/uploads/2020/08/platform-mac.png" alt="Platform Icon"></a>
							<a id="multiplatform-IOS" href="#"><i class="fa fa-apple fa-3" aria-hidden="true"></i></a>
							<a id="multiplatform-Android" href="#"><i class="fa fa-android fa-3" aria-hidden="true"></i></a>
							<a id="multiplatform-Desktop" href="#"><i class="fa fa-desktop fa-3" aria-hidden="true"></i></a>
						</div> -->
						<div class="download">
							<!-- <a class="d-flex flex-nowrap align-items-center justify-content-between" href="#">Start today  <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a> -->
							<a href="https://play.google.com/store/apps/details?id=com.cousant.naijainvest" target="_blank"><img src="https://i-investng.com/wp-content/uploads/2018/09/google-play.png" alt="Google Play Store Download Link"></a>
							<a href="https://itunes.apple.com/ng/app/i-invest/id1381126486?mt=8" target="_blank"><img src="https://i-investng.com/wp-content/uploads/2018/09/apple-store.png" alt="App Store Download Link"></a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="page-five">
			<div class="container">
				<div class="col-12 d-md-flex flex-nowrap align-items-center" style="background-image: url('https://i-investng.com/wp-content/uploads/2020/08/base.png'); color: #fff; padding: 75px 10% 75px">
					<div class="col-md-7">
						<div class="media-text">
							<h4>Sign up for free.</h4>
							<!-- <p>Download the Tangerine Life app and experience true financial security</p> -->
							<p>Download the i-invest App and experience true financial security</p>
						</div>
					</div>
					<div class="col-md-5">
						<div class="download">
							<a href="#">Sign Up, Start today</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="page-seven">
			<div class="content">
				<div class="contact">
					<div class="contact-icon"><i class="fa fa-phone"></i></div>
					<p>PHONE</p>
					<p><a href="tel:+23419037095">+ (234)1 903 7095</a></p>
					<p><a href="tel:+2348075290008">+ (234) 807 529 0008</a></p>
				</div>
				<div class="contact">
					<div class="contact-icon"><i class="fa fa-envelope"></i></div>
					<p>EMAIL</p>
					<p><a href="mailto:info@i-invest.com.ng">info@i-investng.com</a></p>
					<p><a href="mailto:enquiries@i-invest.com.ng">enquiries@i-investng.com</a></p>
				</div>
				<div class="contact">
					<div class="contact-icon"><i class="fa fa-map-marker"></i></div>
					<p>LOCATION</p>
					<p>22a Udi Street, Osborne Foreshore, Ikoyi, Lagos</p>
				</div>
			</div>
		</div>
		<div class="footer">
			<div class="copyright">
				&copy; 2018 <a href="http://parthianpartnersng.com">Parthian Partners</a>. All Rights Reserved | <a href="https://i-investng.com/privacy">Privacy Policy</a>
			</div>
			<div class="socials">
				<ul class="socials-list">
					<li><a href="https://www.instagram.com/i.investng/" target="_blank"><img src="https://i-investng.com/wp-content/uploads/2018/09/insta_icons.png" alt="Instagram"></a></li>
					<li><a href="https://twitter.com/IInvestng" target="_blank"><img src="https://i-investng.com/wp-content/uploads/2018/09/twitter_icons.png" alt="Twitter"></a></li>
					<li><a href="https://www.facebook.com/I-Invest-1321521617979729/?ref=settings" target="_blank"><img src="https://i-investng.com/wp-content/uploads/2018/09/facebook.png" alt="Facebook"></a></li>
					<li><a href="https://www.youtube.com/channel/UC4m0ERt2R33ncJsxdGzJFpw?view_as=subscriber" target="_blank"><img src="https://i-investng.com/wp-content/uploads/2018/09/youtube.png" alt="Youtube"></a></li>
				</ul>
			</div>
		</div>
	</div>
	<?php wp_footer(); ?>
	<script>
		$("a.btn, .nav-link").on('click', function(event) {

		  if (this.hash !== "") {
		    event.preventDefault();
		    var hash = this.hash;


		    $('html, body').animate({
		      scrollTop: $(hash).offset().top
		    }, 800, function(){
		      window.location.hash = hash;
		    });
		  }
		});

		$(".btn.btn-link").on('click', function(e){
			const $target = $(e.currentTarget)
			$('.plus-minus').text('+')
			if ($target.hasClass('collapsed')) {
				$target.find('.plus-minus').text('-')
			}
		})
		
		window.onscroll = function() {myFunction()};

		// Get the navbar
		var navbar = document.getElementById("navbar");

		// Get the offset position of the navbar
		var sticky = navbar.offsetTop;

		// Add the sticky class to the navbar when you reach its scroll position. Remove "sticky" when you leave the scroll position
		function myFunction() {
		  if (window.pageYOffset > sticky) {
		    navbar.classList.add("sticky")
		  } else {
		    navbar.classList.remove("sticky");
		  }
		}
	</script>
</body>
</html>