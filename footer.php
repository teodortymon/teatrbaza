

	
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/autohide.js"></script>
<div class="clear"></div>
		<div class="col-md-9 footer dm_sponsors">
			<div class="row"><h2>Sponsorzy</h2>
				<?php
					global $post;

					$sponsors = 5;

//					$tw = 116;
//					$th = 82;
					$tw = 90;
					$th = 90;

					$args = array( 'post_type' => 'sponsorzy' );
					$myposts = get_posts($args);


					foreach( $myposts as $post ){
						$title = get_the_title();
						$imgpath = dm_relative(get_field('logo'));
						$thumb = site_url().'/resize/'.$tw.'x'.$tw.'x3/r/'. $imgpath;
						$url   = get_field('url');

						if(!$imgpath){
							echo '<a href="'.$url.'" target="_blank" class="dm_no-logos">';
							echo $title;
							echo '</a>';				
						}else{
							echo '<a href="'.$url.'" target="_blank">';
							echo '<img src="'.$thumb.'" alt="'.$title.'" title="'.$title.'"/>';
							echo '</a>';

						}

					}



					for($i = count($myposts) ; $i < $sponsors; $i++){
						print '<div class="dm_spon_placeholder"><a href="'. site_url() .'/?page_id=91"></a></div>';
					}

				?>
		</div>
            <div class="row">
					<h2>Współpraca</h2>
			<?php
				$args = array( 'post_type' => 'wspolpracownicy' );
				$myposts = get_posts($args);
				foreach( $myposts as $post ){
					$title = get_the_title();
					$imgpath = dm_relative(get_field('logo'));
					$thumb = site_url().'/resize/'.$tw.'x'.$tw.'x3/r/'. $imgpath;
					$url   = get_field('url');

					if(!$imgpath){
						echo '<a href="'.$url.'" target="_blank" class="dm_no-logos">';
						echo $title;
						echo '</a>';				
					}else{
						echo '<a href="'.$url.'" target="_blank">';
						echo '<img src="'.$thumb.'" alt="'.$title.'" title="'.$title.'"/>';
						echo '</a>';

					}
				}
			?>
		</div>
			
		<div class="row">
				<h2>Przyjaciele</h2>
			<?php
				$args = array( 'post_type' => 'przyjaciele' );
				$myposts = get_posts($args);
				foreach( $myposts as $post ){
					$title = get_the_title();

					$imgpath = dm_relative(get_field('logo'));
					$thumb = site_url().'/resize/'.$tw.'x'.$tw.'x3/r/'. $imgpath;
					$url   = get_field('url');



					if(!$imgpath){
						echo '<a href="'.$url.'" target="_blank" class="dm_no-logos">';
						echo $title;
						echo '</a>';				
					}else{
						echo '<a href="'.$url.'" target="_blank">';
						echo '<img src="'.$thumb.'" alt="'.$title.'" title="'.$title.'"/>';
						echo '</a>';

					}
				}
			?>
			</div>
           </div>
				<div class="alpha col-md-3 sponsor-fb footer">

									<div class="fb-like-box" data-href="http://www.facebook.com/TeatrBaza" data-width="150" data-height="95" data-show-faces="false" data-border-color="#fff" data-stream="false" data-header="false"></div>

						<p>
				Teatr Baza<br />
				ul. Podchorążych 39<br/>
				00-722 Warszawa<br/>
				Tel/Faks: 510-053-140<br/>
				e-mail: biuro@teatrbaza.pl<br/>
				</p>
		</div>
                
			<?php
				//echo '&copy;'.date("Y"); echo " "; bloginfo('name');
				$menu = wp_nav_menu( array( 'theme_location' => 'glowne',
						'menu_id' => 'bottomMenu',
						'menu_class' => 'dm_bottom_menu',
						'container' => false,
						'echo' => false
					//	'walker' => new My_Bottom_Menu() 
						
						) ); //  klasa jest w functions.php	
			/*	
				$menu = preg_replace('/<.*?ul*.?>/', '<div class="bottomMenu">', $menu);
				$menu = preg_replace('#</ul>#', '</div>', $menu);
			*/	
				
				echo $menu;
			?>
			
			
		
		<div class="clear"></div>
		<div class="col-md-12 dm_otr">
			<span>zaprojektowane przez:</span>
			<a href="http://www.ontherocks.pl/" target="_blank"><img src="<? bloginfo('template_url'); ?>/img/otr.png" alt="ontherocks"></a>
		</div>




	<?php wp_footer(); ?>

	
	

	  <script type="text/javascript">
		  $(".navbar-header").autoHidingNavbar(); 

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-6406998-20']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
  
  

   
  $(document).ready(function(){
	  
  	
  	var emptyLink = $('a[href="#"]');
	  // $('#posts').fullpage();
  
  	emptyLink.click(function(e){ 
  		e.preventDefault();
  		
  	 });
  	 
  
  	//var where = $('.dm_breadcrumbs').children()[0].innerHTML;
  	
  	//console.log( where.toLowerCase() );
  	
  	
  	$('#nav > li > a').each(function(i,e){
  	
  	console.log( e.innerHTML.toLowerCase() );
  	
//  		if($.trim( e.innerHTML.toLowerCase()) == $.trim(where.toLowerCase()) ){
//  			$(e).addClass('current');
//  		}else{
//  	
//  		}

  	});
  	
  });

</script>
</body>

</html>
