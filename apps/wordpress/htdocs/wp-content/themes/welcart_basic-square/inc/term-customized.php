<?php
/***********************************************************
* Category Custom Fields
***********************************************************/
/* admin_enqueue_scripts of category edit page 
------------------------------------------------------*/
add_action( 'admin_enqueue_scripts', 'wcct_cat_admin_enqueue' );
function wcct_cat_admin_enqueue( $hook ){
	if( ( 'term.php' == $hook || 'edit-tags.php' == $hook ) && 'category' == get_current_screen()->taxonomy ){
		wp_enqueue_media();
		wp_enqueue_style( 'wcct_admin_style', get_stylesheet_directory_uri() . '/css/admin.css', array() );
	}
}

/* Add field to category list page
------------------------------------------------------*/
add_action( 'category_add_form_fields', 'wcct_cat_add_form_fields' );
function wcct_cat_add_form_fields( $taxonomy ) {
?>
<div class="form-field wcct-image-uploader new-form-field">
	<label for="wcct-tag-thumbnail"><?php _e( 'Category image', 'welcart_basic_square' ); ?></label>
	<p class="thumbnail-form">
		<input name="wcct-tag-thumbnail-url" id="wcct-tag-thumbnail-url" type="text" value="">
		<button type="button" class="button upload-button" id="wcct-tag-thumbnail-action"><?php _e( 'Select Image' ); ?></button>
	</p>
	<p id="wcct-tag-thumbnail-preview"  class="wcct-tag-thumbnail-preview"></p>
	<input name="wcct-tag-thumbnail-id" id="wcct-tag-thumbnail-id" type="hidden" value="">
</div>
<?php
}

/* Add field to category edit page
------------------------------------------------------*/
add_action( 'category_edit_form_fields', 'wcct_cat_edit_form_fields' );
function wcct_cat_edit_form_fields( $tag, $taxonomy = null ) {
	$url	= get_term_meta( $tag->term_id, 'wcct-tag-thumbnail-url', true );
	$id		= get_term_meta( $tag->term_id, 'wcct-tag-thumbnail-id', true );
?>
<tr class="form-field wcct-image-uploader edit-form-field">
	<th scope="row" valign="top"><label for="wcct-tag-thumbnail"><?php _e( 'Category image', 'welcart_basic_square' ); ?></label></th>
	<td>
		<p class="thumbnail-form">
			<input name="wcct-tag-thumbnail-url" id="wcct-tag-thumbnail-url" type="text" value="<?php echo $url; ?>">
			<button type="button" class="button upload-button" id="wcct-tag-thumbnail-action"><?php _e( 'Select Image' ); ?></button>
		</p>
		<p id="wcct-tag-thumbnail-preview" class="wcct-tag-thumbnail-preview"><?php if( ! empty( $url ) ) echo '<img src="' . $url . '" />'; ?></p>
		<input name="wcct-tag-thumbnail-id" id="wcct-tag-thumbnail-id" type="hidden" value="<?php echo $id; ?>">
	</td>
</tr>
<?php
}

/* Save Term meta
------------------------------------------------------*/
add_action( 'created_category', 'wcct_cat_update_term_meta' );
add_action( 'edited_category', 'wcct_cat_update_term_meta' );
function wcct_cat_update_term_meta( $term_id ) {
	if ( isset( $_POST[ 'wcct-tag-thumbnail-url' ] ) ) {
		 $url = trim($_POST[ 'wcct-tag-thumbnail-url' ]);
		 $id = (int)$_POST[ 'wcct-tag-thumbnail-id' ];
		 if( empty($url) )
		 	$id = '';
		 	
		 update_term_meta( $term_id, 'wcct-tag-thumbnail-url', esc_url($url) );
		 update_term_meta( $term_id, 'wcct-tag-thumbnail-id', $id );
	}
}
/* Media Libray
------------------------------------------------------*/
add_action('admin_footer-term.php', 'wcct_cat_admin_footer');
add_action('admin_footer-edit-tags.php', 'wcct_cat_admin_footer');
function wcct_cat_admin_footer() {
	?>
<script type="text/javascript">
jQuery(function($) {
	
	var file_frame;
	
	$('#wcct-tag-thumbnail-action').live('click', function(e){
		e.preventDefault();
		
		if ( file_frame ) {
			file_frame.open();
			return;
		}
		
		file_frame = wp.media.frames.file_frame = wp.media({
			title: '<?php _e( 'Category image', 'welcart_basic_square' ); ?>',
			library: {
				type: 'image',
				author: userSettings.uid
			},
			button: {
				text: '<?php _e( 'Set the category image', 'welcart_basic_square' ); ?>',
				close: true
			},
			multiple: false
		});
		
		file_frame.on( 'select', function() {
			var attachment = file_frame.state().get('selection').first().toJSON();
			$("#wcct-tag-thumbnail-url").val(attachment.url);
			$("#wcct-tag-thumbnail-id").val(attachment.id);
			$('#wcct-tag-thumbnail-preview').html('<img src="'+attachment.url+'" />');
		});
		
		file_frame.open();
	});
	
});
</script>
	<?php
}