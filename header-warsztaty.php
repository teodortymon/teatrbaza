<!DOCTYPE html>
	
<html <?php language_attributes(); ?>>
<head>
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<?php if (is_search()) { ?>
	   <meta name="robots" content="noindex, nofollow" /> 
	<?php } ?>

	<title>
		   <?php
		      if (is_search()) {
		         echo 'Wyniki wyszukiwania dla &quot;'.wp_specialchars($s).'&quot; - '; }
		      elseif (!(is_404()) && (is_single()) || (is_page())) {
		         wp_title(''); echo ' - '; }
		      elseif (is_404()) {
		         echo 'Nie znaleziono - '; }
		      if (is_home()) {
		         bloginfo('name'); echo ' - '; bloginfo('description'); }
		      else {
		          bloginfo('name'); }
		      if ($paged>1) {
		         echo ' - strona '. $paged; }
		   ?>
	</title>
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/MyFontsWebfontsOrderM3156695.css" type="text/css" /> 
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" />
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/menustyle.css" type="text/css" /> 
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/bottommenustyle.css" type="text/css" /> 
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/orbit-1.2.3.css">
	
	
	<?php //wp_enqueue_script('jquery'); ?>
	
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
	<?php wp_head(); ?>
	
<!--	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/jquery-1.6.4.min.js"></script>-->
<!--	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/jquery.orbit-1.2.3.wilq.js"></script>-->
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/cookies.js"></script>
	
</head>

<body <?php body_class(); ?>>


<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) {return;}
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=230700646982128";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div id="fb-root"></div>


<div class="container_12">
	<div class="dm_header col-md-12">
		<a href="<?= site_url(); ?>" class="dm_logo">
			<img src="<? bloginfo('template_url'); ?>/img/tb_logo.png" alt="Teatr Baza">
		</a>
		<div class="dm_cytat dm_center">
	
			
		</div>
		<div>	<?php get_search_form(); ?></div>
	</div>
	<div class="dm_menu col-md-12">
			<?php			
				wp_nav_menu( array( 'theme_location' => 'glowne',
									'menu_id' => 'nav',
									'menu_class' => 'nav',
									'container' => false
									//'walker' => new My_Main_Menu() 
									) ); //  klasa jest w functions.php
			?>
			
			<script type="text/javascript">
				$(document).ready(
						function () {
							//*********** ustawienie wielkosci i odleglosci wszystkich menu *******************//							
							$('#nav>li').mouseenter(
										function(){
											if ( $(this).data('done') ){return;}
											var width = $(this).width()+ ( $(this).width() / 2)- 10;
											var left =  (width/2 )-15;
											
										
										//	$('ul li', this).css({'width': width+'px', 'margin-left': ((width / 2)* -1)+'px' });
										
										var pwidth = $(this).width();
										
										
											$('ul', this).css({marginLeft: (pwidth - width) /2});
											
											$('ul li', this).css({'width': width+'px' });
											
											$('ul li ul', this).parent().children('a').addClass('hassub');
											$('ul li ul', this).css('left', (pwidth - width)+'px');
											
											$(this).data('done', true);
										}
										);
																				
							//*********** reakcje glownych  przyciskow menu *******************//
							$('#nav>li').mouseenter( //tylko na glowne przyciski menu
								function(){
									clearTimeout($('ul:first', this).data('timeout'));
									if ( $('ul:first', this).hasClass('visible') ){
										return;
									}

									$('#nav li ul').filter('.visible').slideUp(150);
									$('#nav li ul').filter('.visible').removeClass('visible');	
									
									$('.topItem', this).fadeIn(500);
									$('ul:first', this).addClass('visible');
									$('ul:first', this).slideDown(150);
								}
							);
							
							$('#nav>li').mouseleave( //tylko na glowne przyciski menu
								function(){
									var e= $('ul:first', this);
									var t = setTimeout( function(){
															e.slideUp(150, function(){
																				e.removeClass('visible');
																			}
																	);
														},
														500);
									e.data('timeout', t);
								}
							);	

							$('#nav li').not($('#nav>li')).hover(
									function () {
										$('>ul', this).slideDown(150);
									}, 		
									function () {
										$('>ul', this).slideUp(150);
									}
							);							
				});
			</script>	
			
	</div>
	<div class="clear"></div>
