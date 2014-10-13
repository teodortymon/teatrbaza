<?php






function dm_more($in,$len=160, $end){
    if(strlen($in)>$len){
        return preg_replace('/[\s\.,][^\s\.,]*$/u', '', substr($in, 0, $len)).$end;
    }else{
        return $in;
    }
}

function dm_relative($content) {

$content = str_replace(get_bloginfo('url'), "", $content);
return $content;
}
	
	include 'breadcrumbs-functions.php';
//	include 'gal-options.php';
	
	
	add_filter( 'get_media_item_args', 'force_send' );
	function force_send($args){
		$args['send'] = true;
		return $args;
	}
	
	// Add RSS links to <head> section
	automatic_feed_links();
	
	// Load jQuery
//	if ( !is_admin() ) {
//	   wp_deregister_script('jquery');
//	   wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"), false);
//	   wp_enqueue_script('jquery');
//	}
	
	// Clean up the <head>
	function removeHeadLinks() {
    	remove_action('wp_head', 'rsd_link');
    	remove_action('wp_head', 'wlwmanifest_link');
    }
    add_action('init', 'removeHeadLinks');
    remove_action('wp_head', 'wp_generator');
    
    if (function_exists('register_sidebar')) {
    	register_sidebar(array(
    		'name' => 'Sidebar Widgets',
    		'id'   => 'sidebar-widgets',
    		'description'   => 'These are widgets for the sidebar.',
    		'before_widget' => '<div id="%1$s" class="widget %2$s">',
    		'after_widget'  => '</div>',
    		'before_title'  => '<h2>',
    		'after_title'   => '</h2>'
    	));
    }
	
	
	

function neat_trim($str, $n, $delim='...') {
   $len = strlen($str);
   if ($len > $n) {
       preg_match('/(.{' . $n . '}.*?) /', $str, $matches); // "\b" zamiast spacji, zeby nie ucinalo stringow w htmlu, typu ";raquo".  bylo:  preg_match('/(.{' . $n . '}.*?)\b/', $str, $matches);
       return rtrim($matches[1]) . $delim;
   }
   else {
       return $str;
   }
}




add_filter('enter_title_here','custom_enter_title');

function custom_enter_title( $input ) {
    global $post_type;
    if( is_admin() )
		switch ($post_type){
			case 'pedagodzy': 	return 'Imię i nazwisko';
			case 'przedmiot': 	return 'Nazwa przedmiotu';
			case 'galeria-wideo':
			case 'galeria-zdjec':	return 'Tytuł galerii';
			case 'cytaty': 	return 'Treść cytatu';
			case 'spektakle': 	return 'Tytuł spektaklu';		
		}
    return $input;
}



function video_image($url){
		    $image_url = parse_url($url);
		    if($image_url['host'] == 'www.youtube.com' || $image_url['host'] == 'youtube.com'){
		        $array = explode("&", $image_url['query']);
		        return "http://img.youtube.com/vi/".substr($array[0], 2)."/0.jpg";
		    } else if($image_url['host'] == 'www.vimeo.com' || $image_url['host'] == 'vimeo.com'){
		        $hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/".substr($image_url['path'], 1).".php"));
		        return $hash[0]["thumbnail_large"];
		    }
		}
		
		
		



	function get_thumb(){
		global $post;
		// glowne zdjecie
		$thumb = get_field('zdjecie');
		if (!empty($thumb))
			return $thumb;
		
		//"okladka" galerii zdjec
		$thumb = '';
		while(the_repeater_field('zdjecia')){
			if (!empty($thumb)){continue;};
			$thumb = get_sub_field('zdjecie_galerii');
		}
		if (!empty($thumb))
			return $thumb;
			
			
		//"okladka" galerii VIDEO
		$video = '';
		while(the_repeater_field('linki_do_filmow')){
			if (!empty($video)){ continue; };
			$video = get_sub_field('link');
		}
		$thumb = video_image($video);		
		if (!empty($thumb))
			return $thumb;
		//powinno sie dodac jeszcze wyciaganie pierwszego zdjecia z contentu :)
		//brak zdjecia - domysle teatr baza
		return get_bloginfo('template_directory')."/images/null.gif";	
	}
	
	
	
	
	function html2text($s){
		$search = array ("'<script[^>]*?>.*?</script>'si",  // Strip out javascript 
	                 "'<[/!]*?[^<>]*?>'si",          // Strip out HTML tags 
	                 "'([rn])[s]+'",                // Strip out white space 
	                 "'&(quot|#34);'i",                // Replace HTML entities 
	                 "'&(amp|#38);'i", 
	                 "'&(lt|#60);'i", 
	                 "'&(gt|#62);'i", 
	                 "'&(nbsp|#160);'i", 
	                 "'&(iexcl|#161);'i", 
	                 "'&(cent|#162);'i", 
	                 "'&(pound|#163);'i", 
	                 "'&(copy|#169);'i", 
	                 "'&#(d+);'e");                    // evaluate as php 
		$replace = array ("", 
		                 "", 
		                 "\1", 
		                 "\"", 
		                 "&", 
		                 "<", 
		                 ">", 
		                 " ", 
		                 chr(161), 
		                 chr(162), 
		                 chr(163), 
		                 chr(169), 
		                 "chr(\1)"); 
		return preg_replace($search, $replace, $s);
}
	
	
	
	function short_opis($len = -1){
		$opis = get_field("opis");
		if (empty($opis))
			$opis = get_the_content();
			
		$opis = strip_tags($opis);
		//$opis = htmlentities( $opis, ENT_QUOTES ,"UTF-8" );
		//$opis = html2text($opis);
		if ($len >0)
			$opis = neat_trim($opis, $len, '...');
		
		return $opis;
	}

	
	



	function the_4col_item($thumb, $tytul, $data,  $catUrl, $cat, $opis, $link   ){
		?>
		<div class="aktualnosci-item">
		<a href="<?php echo $link; ?>">
			<img src="<?php echo $thumb; ?>" />
		</a>
			<a class="aktualnosci-tytul"><?php echo $tytul; ?></a>
		
		<div class="aktualnosci-data">
			<div style="float: left;">
				<?php echo $data; ?>
			</div>
			
			<div style="float: right;">
				<a style="font-size: 10px" href="?post_type=aktualnosci">Aktualności</a>
				<a>/</a>
				<a style="font-size: 10px" href="<?php echo $catUrl; ?>"><?php echo $cat; ?></a>
			</div>
			
			<div style="display:block; clear: both;"></div>
		</div>
		
		<a class="aktualnosci-opis">
			<?php echo $opis; ?>
		</a>
		<a href="<?php echo $link; ?>" style="display: block; text-align: right; border-top: 1px solid #b1b1b1;  ">dowiedz się więcej</a>
		</div><?php	
	}
	
	
	
date_default_timezone_set('Europe/Warsaw');
	
function datePL($format,$timestamp=null){
	$to_convert = array(
		'l'=>array('dat'=>'N','str'=>array('Poniedziałek','Wtorek','Środa','Czwartek','Piątek','Sobota','Niedziela')),
		'F'=>array('dat'=>'n','str'=>array('styczeń','luty','marzec','kwiecień','maj','czerwiec','lipiec','sierpień','wrzesień','październik','listopad','grudzień')),
		'f'=>array('dat'=>'n','str'=>array('stycznia','lutego','marca','kwietnia','maja','czerwca','lipca','sierpnia','września','października','listopada','grudnia'))
	);
	if ($pieces = preg_split('#[:/.\-, ]#', $format)){
		if ($timestamp === null) { $timestamp = time(); }
		foreach ($pieces as $datepart){
			if (array_key_exists($datepart,$to_convert)){
				$replace[] = $to_convert[$datepart]['str'][(date($to_convert[$datepart]['dat'],$timestamp)-1)];
			}else{
				$replace[] = date($datepart,$timestamp);
			}
		}
		$result = strtr($format,array_combine($pieces,$replace));
		return $result;
	}
}
	
	
	
	
	
	
	
	
?>