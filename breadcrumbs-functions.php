<?php

include 'url_to_absolute.php';

register_nav_menu( 'glowne', __( 'Menu główne', 'teatrbaza' ) );

class My_Main_Menu extends Walker {
	var $tree_type = array( 'post_type', 'taxonomy', 'custom' );
	var $db_fields = array( 'parent' => 'menu_item_parent', 'id' => 'db_id' );
	private $wereBefore = false;

	function start_lvl(&$output, $depth) {
		$indent = str_repeat("\t", $depth);
		//$output .= "\n$indent<ul class=\"sub-menu\">\n";
		$output .= "\n$indent<ul>\n";
		if ($depth==0)
			$output .= "$indent\t<li><div class=\"topItem\"></div></li> \n";
	}

	function end_lvl(&$output, $depth) {
		$indent = str_repeat("\t", $depth);
		if ($depth==0)
			$output .= "$indent\t<li><div class=\"footerItem\"></div></li> \n";
		$output .= "$indent</ul>\n";
	}

	function start_el(&$output, $item, $depth, $args) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		
		//zeby nie dalo sie klikac (kursor z palcem) w przyciski odnoszace sie do "#"...
		if ($item->url=='#')
			$item->url='';
		
		if ( ($depth==0) && ($item->url=='') ){
			$id=$item->ID;
			$item->url="?bread=$id";
		}
		
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';		

		//zeby przed pierwszym przyciskiem w menu nie byl dodawany separator...
		if ($depth==0 && $this->wereBefore){
				$output .= '<div class="ButtonSeparator"></div>';
		}
		$this->wereBefore = true;
			
		$output .= $indent . '<li>';
		if ($depth==0){
			$attributes .= ' class="MainButton"'; //element jest glownym przyciskiem na menu.
		}
		
		$item_output  = '<a class="test"'. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}


	function end_el(&$output, $item, $depth) {
		$output .= "</li>\n";
		//if ($depth==0)
		//	$output .= '<div class="ButtonSeparator"></div>';
	}
} //My_Main_Menu
/******************************************************************************************************************************************************/

class My_Bottom_Menu extends Walker {
	var $tree_type = array( 'post_type', 'taxonomy', 'custom' );
	var $db_fields = array( 'parent' => 'menu_item_parent', 'id' => 'db_id' );

	function start_lvl(&$output, $depth) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<div>\n";
	}

	function end_lvl(&$output, $depth) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</div>\n";
	}

	function start_el(&$output, $item, $depth, $args) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		
		//zeby nie dalo sie klikac (kursor z palcem) w przyciski odnoszace sie do "#"...
		if ($item->url=='#')
			$item->url='';
		
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';		

			
		if ($depth==0)
			$output .= $indent . '<div class="bottomMenuHeader">';
		else
			$output .= $indent . '<div>';
		
		$item_output  = '<a'. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}


	function end_el(&$output, $item, $depth) {
		$output .= "</div>\n";
	}
} //My_BOTTOM_Menu





function get_current_archive_link( $paged = true ) { 
        $link = false; 
        if ( is_front_page() ) { 
                $link = home_url( '/' ); 
        } else if ( is_home() && "page" == get_option('show_on_front') ) { 
                $link = get_permalink( get_option( 'page_for_posts' ) ); 
        } else if ( is_tax() || is_tag() || is_category() ) { 
                $term = get_queried_object(); 
                $link = get_term_link( $term, $term->taxonomy ); 
        } else if ( is_post_type_archive() ) { 
                $link = get_post_type_archive_link( get_post_type() ); 
        } else if ( is_author() ) { 
                $link = get_author_posts_url( get_query_var('author'), get_query_var('author_name') ); 
        } else if ( is_archive() ) { 
                if ( is_date() ) { 
                        if ( is_day() ) { 
                                $link = get_day_link( get_query_var('year'), get_query_var('monthnum'), get_query_var('day') ); 
                        } else if ( is_month() ) { 
                                $link = get_month_link( get_query_var('year'), get_query_var('monthnum') ); 
                        } else if ( is_year() ) { 
                                $link = get_year_link( get_query_var('year') ); 
                        }                                                
                } 
        } 
        if ( $paged && $link && get_query_var('paged') > 1 ) { 
                global $wp_rewrite; 
                if ( !$wp_rewrite->using_permalinks() ) { 
                        $link = add_query_arg( 'paged', get_query_var('paged'), $link ); 
                } else { 
                        $link = user_trailingslashit( trailingslashit( $link ) . trailingslashit( $wp_rewrite->pagination_base ) . get_query_var('paged'), 'archive' ); 
                } 
        } 
        return $link; 
}



function get_menu_item($items , $id){
	foreach($items as $item) {
		if($item->ID == $id )
			return $item;
	}
}

function find_menu_item($items , $url){
	foreach($items as $item) {
		if($item->url == $url )
			return true;
	}
	return false;
}


function hasChildren($items, $id){
	foreach($items as $item) {
		if($item->menu_item_parent == $id )
			return true;
	}
	return false;
}

function empty_link($link){
	return (empty($link) || ($link=='#'));
}






function breadcrumbs($forcedUrl='', $noBold=false){
	global $post;
	$menuItems = wp_get_nav_menu_items('glowne');
		
	$url = "http://".$_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
	
	//if (is_paged()){
	//	$url = preg_replace('#&paged=\d*#', '', $url);
	//}

	
	if (  is_single() || is_search()  ){
		$url=get_permalink();		
		
		$bold_suffix = false;
		if (!find_menu_item($menuItems, get_permalink())){
			$url=get_post_type_archive_link( get_post_type($post) );
			$suffix = get_the_title();
			$bold_suffix=true;
		}			
				
	}
	
	if (!empty($forcedUrl)){
		$url=$forcedUrl;
		$suffix='';
		$bold_suffix=false;		
	}

	
	
	$s='';
	$baseUrl = "http://".$_SERVER["HTTP_HOST"]."/";
	foreach($menuItems as $menuItem) {
		$absoluteUrl = url_to_absolute( $baseUrl, $menuItem->url); // bo w menu link moze byc zapisany jako samo "?post_type=xxx";
		if($absoluteUrl == $url ) {
			$id=$menuItem->ID;		
			
			for ($x=0; $x<50; $x++){
			

			
				if (empty($id))
					break;
				$item = get_menu_item($menuItems, $id);
				$parentId = $item->menu_item_parent;
				$title = $item->title;
				$title = htmlentities( $title, ENT_QUOTES ,"UTF-8" );
				
				//if (!empty_link($item->url)){
				//	$title='<a href="'.$item->url.'">'.$title.'</a>';
				//}
				$href=$item->url;
				
				if ( ($href=='') || ($href=='#') )
					//$href='?bread='.$item->ID;
					$href = "#";
				
				if ( ($x==0) && (!$bold_suffix) && (!$noBold)){
					$s = '<span class="breadcrumbs first">'.dm_more($title, 50, '…').'</span>'. $s;
				}else{
				
					if($x != 1){
						$separator = '<span class="breadcrumbs sep"> &gt; </span>';
					}else{
						$separator = '';
					}
				
					
					$s = ' <a href="'.$href.'" class="breadcrumbs">'. dm_more($title, 50, '…').' </a>'.$separator. $s;
				}
				
				
				$id = $parentId;
				

				
			}
			if (!$noBold)
				$s.= '<span class="breadcrumbsBold last">'. dm_more($suffix, 50, '…').'</span>'; //dokladamy tytul postu
			//echo $s;			
			break;
		}
	}

if ( (empty($s)) && (empty($forcedUrl)) && (!$noBold) )
	$s='<span class="breadcrumbsBold single">'. dm_more(get_the_title(), 50, '…') .'</span>';
echo $s;
	
}


	
	
add_action( 'init', 'bread_init_internal' );
function bread_init_internal(){
    add_rewrite_rule( 'bread.php', '?bread=', 'top' );
}

add_filter( 'query_vars', 'bread_query_vars' );
function bread_query_vars( $query_vars ){
    $query_vars[] = 'bread';
    return $query_vars;
}
	
	
add_action( 'parse_request', 'bread_parse_request' );
function bread_parse_request( &$wp ){
    if ( array_key_exists( 'bread', $wp->query_vars ) ){
        include 'bread.php';
        exit();
    }
    return;
}
	
	
?>