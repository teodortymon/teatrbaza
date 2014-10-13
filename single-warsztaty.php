<? include_once('warsztaty/w-header.php'); ?>






	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<h1 style="margin:20px 10px 10px 0px"><? the_title(); ?></h1>
		
		<?= get_field('before_banner_text') ?>
		
		<div style="clear:both"></div>
		
		<img src="<?= get_field('banner'); ?>" alt="<? the_title(); ?>" /><br /><br />
		
		<i><?= get_field('after_banner_text') ?></i>

<div style="clear:both"></div>

<div id="left_col">
	<? the_content(); ?>
</div>

<div id="right_col">
	<?= get_field('prawa_kolumna'); ?>
</div>


	<?php endwhile; endif; ?>



<? include_once('warsztaty/w-footer.php'); ?>