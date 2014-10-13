<?php get_header();
	$parentId = $_GET['bread'];
	$menuItems = wp_get_nav_menu_items('glowne');
	
	$parent = get_menu_item($menuItems , $parentId);
?>

	
	<div class="dbline"></br></div>
	<h1><?php echo $parent->title; ?></h1>
	<div class="dbline"></br></div>
	<div style="display: block; height: 20px;"></div>
	<div class="text">
		<?php
					
			foreach($menuItems as $item) {
				$id=$item->menu_item_parent;
				if ($id!=$parentId)
					continue;

				$title = $item->title;
				$url  = $item->url;
				
				if ( ($url=='') || ($url=='#'))
					if (hasChildren($menuItems, $item->ID))
						$url="?bread=".$item->ID;

				echo "<a href='$url'>$title</a>";
				echo '</br>';
			}
	
			
			
			echo '<div style="clear:both; display:block; height:48px;"></div>';
		?>
	</div>

<?php get_footer(); ?>