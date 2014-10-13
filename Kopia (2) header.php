<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
	
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<?php if (is_search()) { ?>
	   <meta name="robots" content="noindex, nofollow" /> 
	<?php } ?>

	<title>
		   <?php
		      if (function_exists('is_tag') && is_tag()) {
		         single_tag_title("Tag Archive for &quot;"); echo '&quot; - '; }
		      elseif (is_archive()) {
		         wp_title(''); echo ' Archive - '; }
		      elseif (is_search()) {
		         echo 'Search for &quot;'.wp_specialchars($s).'&quot; - '; }
		      elseif (!(is_404()) && (is_single()) || (is_page())) {
		         wp_title(''); echo ' - '; }
		      elseif (is_404()) {
		         echo 'Not Found - '; }
		      if (is_home()) {
		         bloginfo('name'); echo ' - '; bloginfo('description'); }
		      else {
		          bloginfo('name'); }
		      if ($paged>1) {
		         echo ' - page '. $paged; }
		   ?>
	</title>
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/MyFontsWebfontsOrderM3156695.css" type="text/css" /> 
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" />
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/menustyle.css" type="text/css" /> 
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/bottommenustyle.css" type="text/css" /> 
	
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/orbit-1.2.3.css">
	
			<!--[if IE]>
			     <style type="text/css">
			         .timer { display: none !important; }
			         div.caption { background:transparent; filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000,endColorstr=#99000000);zoom: 1; }
			    </style>
			<![endif]-->
	
	
	
	
	<?php //wp_enqueue_script('jquery'); ?>
	
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
	<?php wp_head(); ?>
	
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/jquery-1.6.4.min.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/jquery.orbit-1.2.3.min.js"></script>
	
				<script type="text/javascript">
				//var menu=new menu.dd("menu");
				//menu.init("menu","menuhover");
				///jQuery(function(){
				//	jQuery('ul.sf-menu').superfish({animation:   {opacity:'show',height:'show'}});
				//});
			</script>	
</head>

<body <?php body_class(); ?>>
	
	<div id="header"></div>
	
	<div id="navbar">
			<?php			
				wp_nav_menu( array( 'theme_location' => 'glowne',
									'menu_id' => 'nav',
									'menu_class' => 'nav',
									'container' => false,
									'walker' => new My_Main_Menu() ) ); //  klasa jest w functions.php
			?>
			<div style="clear: both;"></div> 
			<script type="text/javascript">
				var elements = [];
				$(document).ready(
						function () {

							$('#nav>li').hover(
								function(){
									var left =  ($(this).width()/2 )-15;
									$('.topItem', this).css("background-position", left+'px 0px');
									$(this).css('z-index', '99'); //dziala? ;/
								}
							,
							null
							);
						
							$('#nav li').hover(
							function () {
								clearTimeout($(this).data('timeout'));
								$('>ul', this).slideDown(150);
								
								for(var i=0; i<elements.length; i++) {
									var val = elements.shift();
									if (val!=this){
										$('>ul', val).slideUp(100);
										clearTimeout($(val).data('timeout'));
									}
								}
								elements.length=0;
								
						}, 
						function () {//hide its submenu $('>ul', this).slideUp(150);
							var e = this;
						    var t = setTimeout( function(){
													$('>ul', e).slideUp(200);
												}, 550);
							$(this).data('timeout', t);
							
							elements.push(this);
						}
					);
					
				});
			</script>					
	</div><!--  navbar -->
	<div id="navbarFooter"></div> 

	
<div id="page">	
		<?php get_sidebar(); ?>
	<div id="content">
