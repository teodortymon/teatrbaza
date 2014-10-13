<?php

add_action('admin_menu', 'galcat_create_menu');  
  
function galcat_create_menu() {  
    add_menu_page('Kategorie galerii zdjęć', 'Kategorie galerii zdjęć', 'administrator', __FILE__, 'galcat_settings_page', 'favicon.ico');  
    add_action( 'admin_init', 'register_mysettings' );  
}  

function register_mysettings() {  
    //register our settings  
    register_setting( 'galcat-settings-group', 'galcatObrazekSpektakle' );  
	register_setting( 'galcat-settings-group', 'galcatOpisSpektakle' );  
	
    register_setting( 'galcat-settings-group', 'galcatObrazekProjekty' );  
	register_setting( 'galcat-settings-group', 'galcatOpisProjekty' ); 
	
    register_setting( 'galcat-settings-group', 'galcatObrazekWarsztaty' );  
	register_setting( 'galcat-settings-group', 'galcatOpisWarsztaty' ); 
	
    register_setting( 'galcat-settings-group', 'galcatObrazekInne' );  
	register_setting( 'galcat-settings-group', 'galcatOpisInne' ); 
} 

function galcat_settings_page() {  
	?>
		<script>	
			var formfield = null;
			function selectImage(e){
				formfield = e;
				tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
				return false;
			};
				
			jQuery(document).ready(function() {
				window.send_to_editor = function(html) {
					imgurl = jQuery('img',html).attr('src');
					jQuery(formfield).val(imgurl);
					tb_remove();
				}
			});
		</script>
	
		<div class="wrap">  
		<h2>Kategorie galerii zdjęć - ustawienia</h2>  
		<form method="post" action="options.php">  
		  
		    <?php settings_fields('galcat-settings-group'); ?>  
		    <table class="form-table">  
		   
		        <h3>Spektakle</h3>
				Obrazek:</br>
				<input id="obrazekSpektakle" type="text" size="36" name="galcatObrazekSpektakle" value="<?php echo get_option('galcatObrazekSpektakle'); ?>"/>
				<input id="upload_image_button" type="button" value="Wybierz..." onClick="selectImage('#obrazekSpektakle');"/>
				</br>
				Opis:</br>
		        <textarea cols=50 rows=5 name="galcatOpisSpektakle"><?php echo get_option('galcatOpisSpektakle'); ?></textarea>
				</br></br></br>
				
				
				<h3>Projekty</h3>
				Obrazek:</br>
				<input id="obrazekProjekty" type="text" size="36" name="galcatObrazekProjekty" value="<?php echo get_option('galcatObrazekProjekty'); ?>"/>
				<input id="upload_image_button" type="button" value="Wybierz..." onClick="selectImage('#obrazekProjekty');"/>
				</br>
				Opis:</br>
		        <textarea cols=50 rows=5 name="galcatOpisProjekty"><?php echo get_option('galcatOpisProjekty'); ?></textarea>
				</br></br></br>
				
				
				<h3>Warsztaty</h3>
				Obrazek:</br>
				<input id="obrazekWarsztaty" type="text" size="36" name="galcatObrazekWarsztaty" value="<?php echo get_option('galcatObrazekWarsztaty'); ?>"/>
				<input id="upload_image_button" type="button" value="Wybierz..." onClick="selectImage('#obrazekWarsztaty');"/>
				</br>
				Opis:</br>
		        <textarea cols=50 rows=5 name="galcatOpisWarsztaty"><?php echo get_option('galcatOpisWarsztaty'); ?></textarea>
				</br></br></br>
				
				
				<h3>Inne</h3>
				Obrazek:</br>
				<input id="obrazekInne" type="text" size="36" name="galcatObrazekInne" value="<?php echo get_option('galcatObrazekInne'); ?>"/>
				<input id="upload_image_button" type="button" value="Wybierz..." onClick="selectImage('#obrazekInne');"/>
				</br>
				Opis:</br>
		        <textarea cols=50 rows=5 name="galcatOpisInne"><?php echo get_option('galcatOpisInne'); ?></textarea>
				</br></br></br>
		  
		    </table>  
		  
		    <p class="submit">  
		    <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />  
		    </p>  
		  
		</form>  
		</div>
	<?php
}


?>