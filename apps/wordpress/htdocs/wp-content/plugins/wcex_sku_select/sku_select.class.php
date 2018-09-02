<?php
/*
System extentions SKU Select 
Author: Collne Inc.
*/

class WCEX_SKU_SELECT
{
	public static $opts;
	protected static $instance = null;

	public function __construct(){
	
		if( is_admin() ){
			add_action( 'usces_action_item_dupricate', array($this, 'item_dupricate'), 10, 2);
			add_action( 'usces_after_item_master_second_section', array( $this, 'selecrt_form') );
			add_filter( 'usces_item_master_first_section', array( $this, 'sku_select_switch'), 10, 2 );
			add_action( 'usces_after_item_master_sku_section', array( $this, 'sku_form') );
			add_filter( 'usces_filter_item_save_sku_metadata', array( $this, 'item_save_sku_metadata'), 12, 2 );
			add_action( 'admin_print_footer_scripts', array( $this, 'item_edit_scripts') );
			add_action( 'admin_enqueue_scripts', array( $this, 'sku_select_admin_scripts') );
			add_action( 'usces_action_save_product', array( $this, 'save_item_meta'), 10, 2 );
			add_action( 'wp_ajax_welcart_sku_select_admin', array( $this, 'sku_select_admin_ajax') );
			add_filter( 'usces_filter_admin_cart_item_name', array( $this, 'admin_cart_item_name'), 10, 2 );

			if( defined('WCEX_DLSELLER') ) {
				add_filter( 'dlseller_filter_uploadcsv_item_field_num', array( $this, 'uploadcsv_item_field_num' ) );
				add_filter( 'dlseller_filter_uploadcsv_min_field_num', array( $this, 'uploadcsv_min_field_num' ) );
				add_filter( 'dlseller_filter_uploadcsv_delete_postmeta', array( $this, 'uploadcsv_delete_postmeta' ) );
				add_action( 'dlseller_action_uploadcsv_itemvalue', array( $this, 'uploadcsv_itemvalue' ), 10, 2 );
				add_filter( 'dlseller_filter_uploadcsv_skuvalue', array( $this, 'uploadcsv_skuvalue' ), 10, 2 );
				add_filter( 'dlseller_filter_downloadcsv_itemheader', array( $this, 'downloadcsv_itemheader' ) );
				add_filter( 'dlseller_filter_downloadcsv_header', array( $this, 'downloadcsv_header' ) );
				add_filter( 'dlseller_filter_downloadcsv_itemvalue', array( $this, 'downloadcsv_itemvalue' ), 10, 2 );
				add_filter( 'dlseller_filter_downloadcsv_skuvalue', array( $this, 'downloadcsv_skuvalue' ), 10, 2 );

			} elseif( defined('WCEX_AUTO_DELIVERY') ) {
				add_filter( 'wcad_filter_uploadcsv_item_field_num', array( $this, 'uploadcsv_item_field_num' ) );
				add_filter( 'wcad_filter_uploadcsv_min_field_num', array( $this, 'uploadcsv_min_field_num' ) );
				add_filter( 'wcad_filter_uploadcsv_delete_postmeta', array( $this, 'uploadcsv_delete_postmeta' ) );
				add_action( 'wcad_action_uploadcsv_itemvalue', array( $this, 'uploadcsv_itemvalue' ), 10, 2 );
				add_filter( 'wcad_filter_uploadcsv_skuvalue', array( $this, 'uploadcsv_skuvalue' ), 10, 2 );
				add_filter( 'wcad_filter_downloadcsv_itemheader', array( $this, 'downloadcsv_itemheader' ) );
				add_filter( 'wcad_filter_downloadcsv_header', array( $this, 'downloadcsv_header' ) );
				add_filter( 'wcad_filter_downloadcsv_itemvalue', array( $this, 'downloadcsv_itemvalue' ), 10, 2 );
				add_filter( 'wcad_filter_downloadcsv_skuvalue', array( $this, 'downloadcsv_skuvalue' ), 10, 2 );

			} else {
				add_filter( 'usces_filter_uploadcsv_item_field_num', array( $this, 'uploadcsv_item_field_num' ) );
				add_filter( 'usces_filter_uploadcsv_min_field_num', array( $this, 'uploadcsv_min_field_num' ) );
				add_filter( 'usces_filter_uploadcsv_delete_postmeta', array( $this, 'uploadcsv_delete_postmeta' ) );
				add_action( 'usces_action_uploadcsv_itemvalue', array( $this, 'uploadcsv_itemvalue' ), 10, 2 );
				add_filter( 'usces_filter_uploadcsv_skuvalue', array( $this, 'uploadcsv_skuvalue' ), 10, 2 );
				add_filter( 'usces_filter_downloadcsv_itemheader', array( $this, 'downloadcsv_itemheader' ) );
				add_filter( 'usces_filter_downloadcsv_header', array( $this, 'downloadcsv_header' ) );
				add_filter( 'usces_filter_downloadcsv_itemvalue', array( $this, 'downloadcsv_itemvalue' ), 10, 2 );
				add_filter( 'usces_filter_downloadcsv_skuvalue', array( $this, 'downloadcsv_skuvalue' ), 10, 2 );
			}

		}else{
			add_filter( 'the_post', array($this, 'skuselect_item_init'), 11  );
			add_filter( 'usces_filter_template_redirect', array( $this, 'template_redirect'), 1 );
			add_filter( 'usces_filter_shop_foot_js', array( $this, 'item_single_js') );
			add_action( 'wp_enqueue_scripts', array( $this, 'front_enqueue_scripts') );
			add_filter( 'usces_filter_cart_item_name', array( $this, 'cart_item_name'), 10, 2 );
		}
		add_filter( 'usces_filter_get_skus', array($this, 'get_skus'), 10, 3 );
		add_filter( 'usces_filter_cart_item_name_nl', array($this, 'cart_item_name_nl'), 10, 2 );
		add_action( 'wp_ajax_wcex_sku_select', array( $this, 'sku_select_ajax') );
		add_action( 'wp_ajax_nopriv_wcex_sku_select', array( $this, 'sku_select_ajax') );
	}

	public static function load_textdomain(){
		load_plugin_textdomain('sku_select', WCEX_SKU_SELECT_DIR.'/'.plugin_basename(dirname(__FILE__)).'/languages', plugin_basename(dirname(__FILE__)).'/languages');
	}
	

	/**********************************************
	* Duplicate item data
	* Modified:15 July.2016
	***********************************************/
	public function item_dupricate($post_id, $newpost_id){
		$_select_sku = get_post_meta($post_id, '_select_sku', true);
		if( !empty($_select_sku) ){
			update_post_meta($newpost_id, '_select_sku', $_select_sku);
		}

		$_select_sku_switch = get_post_meta( $post_id, '_select_sku_switch', true );
		if( strlen($_select_sku_switch) > 0 ){
			update_post_meta($newpost_id, '_select_sku_switch', $_select_sku_switch);
		}

		$_select_sku_display = get_post_meta( $post_id, '_select_sku_display', true );
		if( strlen($_select_sku_display) > 0 ){
			update_post_meta($newpost_id, '_select_sku_display', $_select_sku_display);
		}
	}

	/*************************************
	 * usces_filter_item_save_sku_metadata 
	 * Modified:27 May.2017
	 ************************************/
	public function item_save_sku_metadata( $skus, $meta_id ){
		$paternkey = isset($_POST['itemsku'][$meta_id]['paternkey']) ? $_POST['itemsku'][$meta_id]['paternkey']: 0;
		$skus['paternkey'] = $paternkey;
		return $skus;
	}
	/*************************************
	 * usces_filter_get_skus 
	 * Modified:27 May.2017
	 ************************************/
	public function get_skus( $skus, $post_id, $keyflag ){
		foreach( $skus as $key => $sku ){
			$key = isset($sku[$keyflag]) ? $sku[$keyflag] : $sku['sort'];
			$meta_obj = get_metadata_by_mid( 'post', $sku['meta_id'] );
			$paternkey = ( isset($meta_obj->meta_value['paternkey']) && '' != $meta_obj->meta_value['paternkey'] ) ? $meta_obj->meta_value['paternkey'] : $sku['code'];
			$newskus[$key] = array(
								'meta_id' => $sku['meta_id'],
								'code' => $sku['code'],
								'name' => $sku['name'],
								'cprice' => $sku['cprice'],
								'price' => $sku['price'],
								'unit' => $sku['unit'],
								'stocknum' => $sku['stocknum'],
								'stock' => $sku['stock'],
								'gp' => $sku['gp'],
								'sort' => $sku['sort'],
								'advance' => isset($sku['advance']) ? $sku['advance'] : '',
								'paternkey' => $paternkey
							);
		}
		return $newskus;
	}
	/*************************************
	 * usces_after_item_master_sku_section 
	 * Modified:8 Apl.2016
	 ************************************/
	public function sku_form( $post_id ){
		global $usces, $post;
?>
		<div id="sku_select" class="postbox">
		<h3 class="hndle"><span>SKU <?php _e('Price', 'usces'); ?></span></h3>
		<div class="inside">
			<div id="postskucustomstuff" class="skustuff">
				<div id="create_sku_loading"></div>
				<div id="sku_select_field">
<?php
		$skus = $usces->get_skus($post_id);

		echo $this->select_sku_list($skus);
?>
				</div>
			</div>
		</div>
		</div>
<?php
	}
	
	public function make_patern( $patern, $lines ){
	
		if( is_array($patern) ){
			foreach($patern as $key => $value){
				if(is_array($value)){
					$patern[$key] = $this->make_patern( $value, $lines );
				}else{
					foreach($lines as $line){
						$newkey = $key . ':' . $line;
						$patern[$key][$newkey] = NULL;
					}
				}
			}
		}else{
			foreach($lines as $line){
				$patern[$line] = NULL;
			}
		}
		return $patern;
		
	}
	public function make_patern_code( $patern_code, $lines ){
	
		if( is_array($patern_code) ){
			foreach($patern_code as $key => $value){
				if(is_array($value)){
					$patern_code[$key] = $this->make_patern_code( $value, $lines );
				}else{
					foreach($lines as $l => $line){
						$newkey = $key . ':' . $l;
						$patern_code[$key][$newkey] = NULL;
					}
				}
			}
		}else{
			foreach($lines as $l => $line){
				$patern_code[$l] = NULL;
			}
		}
		return $patern_code;
		
	}
	public function make_select_options( $patern, $select_options ){
		
		if( is_array($patern) ){
			foreach($patern as $key => $value){
				if(is_array($value)){
					$select_options = $this->make_select_options( $value, $select_options );
				}else{
					
					$select_options[] = $key;
				}
			}
		}
		return $select_options;
		
	}
	/*************************************
	 * usces_item_master_first_section 
	 * Modified:8 Apl.2016
	 ************************************/
	public function sku_select_switch( $nouse, $post_id ){
		$select_sku_switch = get_post_meta( $post_id, '_select_sku_switch', true );
		$select_sku_display = get_post_meta( $post_id, '_select_sku_display', true );
?>
		<tr>
			<th><?php _e('Use SKU Select', 'sku_select'); ?></th>
			<td>
				<label for="select_sku_switch">
				<input name="select_sku_switch" id="select_sku_switch" type="checkbox" value="1"<?php echo($select_sku_switch ? ' checked="checked"' : ''); ?> />
				<?php _e('To create SKU from the SKU Select', 'sku_select'); ?></label>
			</td>
		</tr>
		<tr id="select_sku_display_row">
			<th><?php _e('SKU Select Display', 'sku_select'); ?></th>
			<td>
				<label for="select_sku_display0">
				<input type="radio" name="select_sku_display" id="select_sku_display0" value="0"<?php echo((!$select_sku_display) ? ' checked="checked"' : ''); ?> />
				<?php _e('Displayed in the pull-down select', 'sku_select'); ?></label>
				<br />
				<label for="select_sku_display1">
				<input type="radio" name="select_sku_display" id="select_sku_display1" value="1"<?php echo($select_sku_display ? ' checked="checked"' : ''); ?> />
				<?php _e('Display on the radio button (SKU Select is up to two)', 'sku_select'); ?></label>
			</td>
		</tr>
<?php
	}
	
	/*************************************
	 * usces_after_item_master_second_section
	 * Modified:8 Apl.2016
	 ************************************/
	public function selecrt_form( $post_id ){
?>
		<div id="meta_box_sku_select_box" class="postbox">
		<h3 class="hndle"><span><?php _e( 'SKU Select', 'sku_select' ); ?></span></h3>
		<div class="inside">
			<div id="select_sku_new"><a href="javascript:void(0);" id="new_select_sku_action" class="page-title-action"><?php _e('New addition', 'usces'); ?></a><span id="select_sku_loading"></span></div>
			
			<div id="select_sku_display_attention"></div>

			<div class="skustuff">
			<table class="select_sku_table">
			<thead>
			<tr>
				<th class="left"><?php _e( 'Select name', 'sku_select' ); ?></th>
				<th><?php _e( 'Choices', 'sku_select' ); ?></th>
			</tr>
			</thead>
			<tbody>
			<tr>
				<td class="left">
					<div id="select_sku_name"></div>
					<div id="select_sku_name2"></div>
					<div id="select_sku_button"></div>
					<div id="select_sku_sort"><a href="javascript:void(0);" id="moveup_action"><span class="dashicons dashicons-arrow-up"></span><?php _e( 'Raise the priority', 'usces' ); ?></a><br /><a href="javascript:void(0);" id="movedown_action"><span class="dashicons dashicons-arrow-down"></span><?php _e( 'Lower the priority', 'usces' ); ?></a></div>
				</td>
				<td>
					<div><textarea name="select_sku_choices" id="select_sku_choices"></textarea></div>
				</td>
			</tr>
			</tbody>
			</table>
			</div>
		</div>
		<div id="major-publishing-actions">
			<div id="publishing-action"><input name="create_sku" id="create_sku" class="button-primary" type="button" value="<?php _e( 'To generate SKU', 'sku_select' ); ?>" /></div>
			<div id="select_sku_attention"><?php _e( "If an option is renewed or added, please push \"SKU is generated\".", 'sku_select' ); ?></div>
			<div class="clear"></div>
		</div>
		</div>
<?php
	}
	
	/*************************************
	 * admin_print_footer_scripts
	 * Modified:8 Apl.2016
	 ************************************/
	public function item_edit_scripts(){
		global $hook_suffix, $post;
		
		if( 'welcart-shop_page_usces_itemedit' != $hook_suffix && 'welcart-shop_page_usces_itemnew' != $hook_suffix ){
			return;
		}

		if( !isset($post->ID) || empty($post->ID) ){
			return;
		}

		$_select_sku = get_post_meta($post->ID, '_select_sku', true);
		$_select_sku = empty($_select_sku) ? array() : $_select_sku;

?>
	<script type="text/javascript">
		(function($) {
			var select_sku = [];
<?php
		foreach( $_select_sku as $i => $select_sku ){ 
			$choices = usces_change_line_break( $select_sku['choices'] );
			$lines = explode("\n", $choices);
?>
			select_sku[<?php echo $i; ?>] = [];
			select_sku[<?php echo $i; ?>]['id'] = <?php echo (int)$select_sku['id']; ?>;
			select_sku[<?php echo $i; ?>]['name'] = '<?php echo esc_js($select_sku['name']); ?>';
			sttr = '';
<?php
			foreach((array)$lines as $line){
				if(trim($line) != ''){
?>
			sttr += '<?php echo esc_js($line); ?>'+"\n";
<?php
				}
			}
?>
			select_sku[<?php echo $i; ?>]['choices'] = sttr;
<?php
		}
?>
			var selected_select_sku = 0;

			$("#new_select_sku_action").click(function () {
				if(select_sku.length === 0) return false;
				$("#select_sku_new").css('display','none');
				$("#select_sku_sort").css('display','none');
				$("#select_sku_name").html('<input name="select_sku_name" type="text" value="" />');
				$("#select_sku_name2").html('');
				$("#select_sku_choices").val('');
				$("#select_sku_button").html('<input name="cancel_select_sku" id="cancel_select_sku" type="button" class="button button-small" value="<?php _e('Cancel', 'usces'); ?>" onclick="operation.disp_select_sku(0);" /><input name="add_select_sku" id="add_select_sku" type="button" class="button button-small" value="<?php _e('Add', 'usces'); ?>" onclick="operation.add_select_sku();" />');
				$("input[name='select_sku_name']").focus().select();
			});
			
			$("#moveup_action").click(function () {
				var id = $("#select_sku_name_select option:selected").val()-0;
				operation.moveup_select_sku(id);
		//		operation.disp_select_sku(id);
			});
			
			$("#movedown_action").click(function () {
				var id = $("#select_sku_name_select option:selected").val()-0;
				operation.movedown_select_sku(id);
		//		operation.disp_select_sku(id);
			});

			$("#create_sku").click(function () {
				operation.create_sku();
			});
			
			operation = {
				disp_select_sku :function (id){
					var selected_index = 0;
					for(var i=0; i<select_sku.length; i++){
						if(id === select_sku[i]['id']){
							selected_index = i;
						}
					}
					
					if(select_sku.length === 0) {
						$("#select_sku_new").css('display','none');
						$("#select_sku_sort").css('display','none');
						$("#select_sku_name").html('<input name="select_sku_name" type="text" value="" />');
						$("#select_sku_name2").html('');
						$("#select_sku_choices").val('');
						$("#select_sku_button").html('<input name="add_select_sku" id="add_select_sku" type="button" class="button button-small" value="<?php _e('Add', 'usces'); ?>" onclick="operation.add_select_sku();" />');
					}else{
						var name_select = '<select name="select_sku_name_select" id="select_sku_name_select" onchange="operation.onchange_sku_select(this.selectedIndex);">'+"\n";
						for(var i=0; i<select_sku.length; i++){
							if(selected_index === i){
								name_select += '<option value="'+select_sku[i]['id']+'" selected="selected">'+select_sku[i]['id']+' : '+select_sku[i]['name']+'</option>'+"\n";
							}else{
								name_select += '<option value="'+select_sku[i]['id']+'">'+select_sku[i]['id']+' : '+select_sku[i]['name']+'</option>'+"\n";
							}
						}
						name_select += "</select>\n";
						$("#select_sku_new").css('display','block');
						if(select_sku.length === 1) {
							$("#select_sku_sort").css('display','none');
						}else{
							$("#select_sku_sort").css('display','block');
						}
						$("#select_sku_name").html(name_select);
						$("#select_sku_name2").html('<input name="select_sku_name" type="text" value="'+select_sku[selected_index]['name']+'" />');
						$("#select_sku_choices").val(select_sku[selected_index]['choices']);
						$("#select_sku_button").html("<input name='delete_select_sku' id='delete_select_sku' type='button' class='button button-small' value='<?php _e('Delete', 'usces'); ?>' onclick='operation.delete_select_sku();' /><input name='update_select_sku' id='update_select_sku' type='button' class='button button-small' value='<?php _e('update', 'usces'); ?>' onclick='operation.update_select_sku();' />");
					}
				},
				
				add_select_sku : function() {
					if($.trim($("input[name='select_sku_name']").val()) == ""){
						alert("<?php _e( 'Enter the select name.', 'sku_select' ); ?>");
						return;
					}
						
					if($.trim($("#select_sku_choices").val()) == ""){
						alert("<?php _e( 'Enter the choices.', 'sku_select' ); ?>");
						return;
					}
					
					$("#select_sku_loading").html('<img src="<?php echo USCES_PLUGIN_URL; ?>/images/loading-publish.gif" />');
					var name = encodeURIComponent($("input[name='select_sku_name']").val());
					var choices = encodeURIComponent($("#select_sku_choices").val());
					var post_id = $("#post_ID").val();

					var s = operation.settings;
					s.data = {
							'action' : 'welcart_sku_select_admin',
							'mode' : 'add_select_sku',
							'name' : name,
							'choices' : choices,
							'post_id' : post_id
					};
					s.success = function(data, dataType){
						if( data ){
							var index = select_sku.length;
							select_sku[index] = [];
							select_sku[index]['id'] = data['id'];
							select_sku[index]['name'] = data['name'].replace(/\\'/g, '\'');
							select_sku[index]['choices'] = data['choices'].replace(/\\'/g, '\'');
							operation.disp_select_sku(data['id']);
						}
						$("#select_sku_loading").html('');
					};
					$.ajax( s );
					return false;
				},
				
				update_select_sku : function() {
					if($.trim($("input[name='select_sku_name']").val()) == ""){
						alert("<?php _e( 'Enter the select name.', 'sku_select' );?>");
						return;
					}
						
					if($.trim($("#select_sku_choices").val()) == ""){
						alert("<?php _e( 'Enter the choices.', 'sku_select' );?>");
						return;
					}
					
					$("#select_sku_loading").html('<img src="<?php echo USCES_PLUGIN_URL; ?>/images/loading-publish.gif" />');
					var id = $("#select_sku_name_select option:selected").val();
					var name = encodeURIComponent($("input[name='select_sku_name']").val());
					var choices = encodeURIComponent($("#select_sku_choices").val());
					var post_id = $("#post_ID").val();
					var s = operation.settings;
					s.data = {
							'action' : 'welcart_sku_select_admin',
							'mode' : 'update_select_sku',
							'id' : id,
							'name' : name,
							'choices' : choices,
							'post_id' : post_id
					};
					s.success = function(data, dataType){
						if( data ){
							select_sku[data.index]['name'] = data.name.replace(/\\'/g, '\'');
							select_sku[data.index]['choices'] = data.choices.replace(/\\'/g, '\'');
							operation.disp_select_sku(data.id);
						}
						$("#select_sku_loading").html('');
					};
					$.ajax( s );
					return false;
				},
				
				delete_select_sku : function() {
					var delname = $("#select_sku_name_select option:selected").html();
					if(!confirm(<?php _e("'Are you sure you want to permanently delete \"' + delname + '\" ?'", 'sku_select'); ?>)) return false;
					
					$("#select_sku_loading").html('<img src="<?php echo USCES_PLUGIN_URL; ?>/images/loading-publish.gif" />');
					var id = $("#select_sku_name_select option:selected").val();
					var post_id = $("#post_ID").val();
					
					var s = operation.settings;
					s.data = "action=welcart_sku_select_admin&mode=delete_select_sku&id=" + id + "&post_id=" + post_id;
					s.success = function(data, dataType){
						select_sku = [];
						var ct = data.length;
						for(var i=0; i<ct; i++){
							select_sku[i] = [];
							select_sku[i]['id'] = data[i].id-0;
							select_sku[i]['name'] = data[i].name;
							select_sku[i]['choices'] = data[i].choices;
						}
						operation.disp_select_sku(0);
						$("#select_sku_loading").html('');
					};
					$.ajax( s );
					return false;
				},
				
				onchange_sku_select : function(index) {
					var id = $("#select_sku_name_select option:eq("+index+")").val()-0;
					operation.disp_select_sku(id);
				},
				
				moveup_select_sku : function(id) {
					var selected_index = 0;
					for(var i=0; i<select_sku.length; i++){
						if(id === select_sku[i]['id']){
							selected_index = i;
						}
					}
					if( 0 === selected_index ) return;
					
					$("#select_sku_loading").html('<img src="<?php echo USCES_PLUGIN_URL; ?>/images/loading-publish.gif" />');
					var post_id = $("#post_ID").val();
					
					var s = operation.settings;
					s.data = "action=welcart_sku_select_admin&mode=moveup_select_sku&id=" + id + "&post_id=" + post_id;
					s.success = function(data, dataType){
						var ct = data.length;
						for(var i=0; i<ct; i++){
							select_sku[i]['id'] = data[i].id-0;
							select_sku[i]['name'] = data[i].name;
							select_sku[i]['choices'] = data[i].choices;
						}
						operation.disp_select_sku(id);
						$("#select_sku_loading").html('');
					};
					$.ajax( s );
					return false;
				},
				
				movedown_select_sku : function(id) {
					var index = 0;
					var ct = select_sku.length;
					for(var i=0; i<ct; i++){
						if(id === select_sku[i]['id']){
							index = i;
						}
					}
					if( index >= ct-1 ) return;
					var post_id = $("#post_ID").val();
					
					$("#select_sku_loading").html('<img src="<?php echo USCES_PLUGIN_URL; ?>/images/loading-publish.gif" />');
					
					var s = operation.settings;
					s.data = "action=welcart_sku_select_admin&mode=movedown_select_sku&id=" + id + "&post_id=" + post_id;
					s.success = function(data, dataType){
						var ct = data.length;
						for(var i=0; i<ct; i++){
							select_sku[i]['id'] = data[i].id-0;
							select_sku[i]['name'] = data[i].name;
							select_sku[i]['choices'] = data[i].choices;
						}
						operation.disp_select_sku(id);
						$("#select_sku_loading").html('');
					};
					$.ajax( s );
					return false;
				},
				
				create_sku : function() {
				
					//if( index >= ct-1 ) return;
					var post_id = $("#post_ID").val();
					
					$("#create_sku_loading").html('<img src="<?php echo USCES_PLUGIN_URL; ?>/images/loading-publish.gif" />');
					
					var s = operation.settings;
					s.data = "action=welcart_sku_select_admin&mode=create_sku&post_id=" + post_id;
					s.success = function(data, dataType){
						$("#sku_select_field").html(data);
						$("#create_sku_loading").html('');
					};
					$.ajax( s );
					return false;
				},

				ShowSkuSelect: function(){
					$("#itemsku").hide();
					$("#select_sku_display_row").show();
					$("#sku_select").show();
					$("#sku_select .metastufftable").find("input, select").prop("disabled", false);
					$("#itemsku #skulist-table").find("input, select").prop("disabled", true);
					$("#meta_box_sku_select_box").show();
				},

				HideSkuSelect: function(){
					$("#itemsku").show();
					$("#select_sku_display_row").hide();
					$("#sku_select").hide();
					$("#sku_select .metastufftable").find("input, select").prop("disabled", true);
					$("#itemsku #skulist-table").find("input, select").prop("disabled", false);
					$("#meta_box_sku_select_box").hide();
				},

				settings: {
					url: uscesL10n.requestFile,
					type: 'POST',
					dataType: "json",
					cache: false,
					success: function(data, dataType){
						console.log(data);
						$("#select_sku_loading").html('');
					}, 
					error: function(msg){
						console.log(msg);
						//$("#ajax-response").html(msg);
						$("#select_sku_loading").html('');
					}
				}
			};
		
			operation.disp_select_sku(-1);

			//DLseller区分変更
			$('input[name="item_division"]').click(function(){
				if( 'data' == $(this).val() ){
					$("#select_sku_switch").prop("disabled", true);
					$("#select_sku_switch").closest("tr").hide();
					operation.HideSkuSelect();
				}else{
					$("#select_sku_switch").prop("disabled", false);
					$("#select_sku_switch").closest("tr").show();
					if ( $("#select_sku_switch").prop('checked') ){
						operation.ShowSkuSelect();
					}else{
						operation.HideSkuSelect();
					}
				}
			});

			$("#select_sku_switch").click(function(){
				if ( $("#select_sku_switch").prop('checked') && 'data' != $('input[name="item_division"]:checked').val() ){
					operation.ShowSkuSelect();
				}else{
					operation.HideSkuSelect();
				}
			});

			if( 'data' == $('input[name="item_division"]:checked').val() ){
				$("#select_sku_switch").prop("disabled", true);
				$("#select_sku_switch").closest("tr").hide();
				operation.HideSkuSelect();
			}else{
				$("#select_sku_switch").prop("disabled", false);
				$("#select_sku_switch").closest("tr").show();
				if ( $("#select_sku_switch").prop('checked') ){
					operation.ShowSkuSelect();
				}else{
					operation.HideSkuSelect();
				}
			}
		})(jQuery);
	</script>

<?php

	}

	/*************************************
	 * admin_enqueue_scripts
	 * Modified:8 Apl.2016
	 ************************************/
	public function sku_select_admin_scripts( $hook ) {
		if( 'welcart-shop_page_usces_itemedit' != $hook && 'welcart-shop_page_usces_itemnew' != $hook )
			return;
		
		wp_enqueue_style( 'wcex_sku_select_admin_css', plugin_dir_url( __FILE__ ) . 'css/admin-style.css', array(), '1.0' );
	}

	/*************************************
	 * wp_ajax_welcart_sku_select_admin
	 * Modified:8 Apl.2016
	 ************************************/
	public function sku_select_admin_ajax(){
		global $usces;

		if( $_POST['action'] != 'welcart_sku_select_admin' )
			die(0);
	
		switch ($_POST['mode']) {
			case 'add_select_sku':
				$res = $this->add_select_sku();
				break;
			case 'update_select_sku':
				$res = $this->update_select_sku();
				break;
			case 'delete_select_sku':
				$res = $this->delete_select_sku();
				break;
			case 'moveup_select_sku':
				$res = $this->moveup_select_sku();
				break;
			case 'movedown_select_sku':
				$res = $this->movedown_select_sku();
				break;
			case 'create_sku':
				$res = $this->create_sku();
				break;
		}

		die( $res );
	}
	
	public function add_select_sku() {
		$post_id = (int)$_POST['post_id'];
		$_select_sku = get_post_meta( $post_id, '_select_sku', true );
		$_select_sku = empty($_select_sku) ? array() : $_select_sku;
		$name = trim($_POST['name']);
		foreach($_select_sku as $select_sku){
			$ids[] = (int)$select_sku['id'];
		}
		if(isset($ids)){
			rsort($ids);
			$newid = $ids[0]+1;
		}else{
			$newid = 0;
		}
		
		$esc_choices = '';
		$choices = usces_change_line_break( urldecode($_POST['choices']) );
		$lines = explode("\n", $choices);
		foreach((array)$lines as $line){
			if(trim($line) != ''){
				$esc_choices .= esc_js($line) . "\n";
			}
		}
		
		$index = isset($_select_sku) ? count($_select_sku) : 0;
		$_select_sku[$index]['id'] = $newid;
		$_select_sku[$index]['name'] = esc_js(urldecode($name));
		$_select_sku[$index]['choices'] = $esc_choices;
		update_post_meta( $post_id, '_select_sku', $_select_sku);
		
		return json_encode($_select_sku[$index]);
	}

	function update_select_sku() {
		$post_id = (int)$_POST['post_id'];
		$_select_sku = get_post_meta( $post_id, '_select_sku', true );
		$_select_sku = empty($_select_sku) ? array() : $_select_sku;
		$name = trim($_POST['name']);
		$id = (int)$_POST['id'];
		$esc_choices = '';
		$choices = usces_change_line_break( urldecode($_POST['choices']) );
		$lines = explode("\n", $choices);
		foreach((array)$lines as $line){
			if(trim($line) != ''){
				$esc_choices .= esc_js($line) . "\n";
			}
		}
		for($i=0; $i<count($_select_sku); $i++){
			if($_select_sku[$i]['id'] === $id){
				$index = $i;
			}
		}
		$_select_sku[$index]['id'] = $id;
		$_select_sku[$index]['name'] = esc_js(urldecode($name));
		$_select_sku[$index]['choices'] = $esc_choices;
		update_post_meta( $post_id, '_select_sku', $_select_sku);
		$_select_sku[$index]['index'] = $index;
		return json_encode($_select_sku[$index]);
	}

	function delete_select_sku() {
		$post_id = (int)$_POST['post_id'];
		$_select_sku = get_post_meta( $post_id, '_select_sku', true );
		$_select_sku = empty($_select_sku) ? array() : $_select_sku;
		$id = (int)$_POST['id'];
		for($i=0; $i<count($_select_sku); $i++){
			if($_select_sku[$i]['id'] === $id){
				$index = $i;
			}
		}
		array_splice($_select_sku, $index, 1);
		update_post_meta( $post_id, '_select_sku', $_select_sku);
		
		return json_encode($_select_sku);
	}

	function moveup_select_sku() {
		$post_id = (int)$_POST['post_id'];
		$_select_sku = get_post_meta( $post_id, '_select_sku', true );
		$_select_sku = empty($_select_sku) ? array() : $_select_sku;
		$selected_id = (int)$_POST['id'];
		$ct = count($_select_sku);
		for($i=0; $i<$ct; $i++){
			if($_select_sku[$i]['id'] === $selected_id){
				$index = $i;
			}
		}
		if($index !== 0) {
			$from_index = $index;
			$to_index = $index - 1;
			$from_dm = $_select_sku[$from_index];
			$to_dm = $_select_sku[$to_index];
			for($i=0; $i<$ct; $i++){
				if($i === $to_index){
					$_select_sku[$i] = $from_dm;
				}else if($i === $from_index){
					$_select_sku[$i] = $to_dm;
				}
			}
			update_post_meta( $post_id, '_select_sku', $_select_sku);
		}
		
		return json_encode($_select_sku);
	}

	function movedown_select_sku() {
		$post_id = (int)$_POST['post_id'];
		$_select_sku = get_post_meta( $post_id, '_select_sku', true );
		$_select_sku = empty($_select_sku) ? array() : $_select_sku;
		$selected_id = (int)$_POST['id'];
		$ct = count($_select_sku);
		for($i=0; $i<$ct; $i++){
			if($_select_sku[$i]['id'] === $selected_id){
				$index = $i;
			}
		}
		if($index < $ct-1) {
			$from_index = $index;
			$to_index = $index + 1;
			$from_dm = $_select_sku[$from_index];
			$to_dm = $_select_sku[$to_index];
			for($i=0; $i<$ct; $i++){
				if($i === $to_index){
					$_select_sku[$i] = $from_dm;
				}else if($i === $from_index){
					$_select_sku[$i] = $to_dm;
				}
			}
			update_post_meta( $post_id, '_select_sku', $_select_sku);
		}
		
		return json_encode($_select_sku);
	}
	
	function select_sku_list($skus) {
		$zaikoselectarray = get_option('usces_zaiko_status');
		$res = '';

		ob_start();
?>
		<table class='metastufftable'>
			<tr>
				<th><?php _e('SKU code','usces') ?></th>
				<th><?php _e('SKU display name ','usces') ?></th>
				<th><?php echo apply_filters('usces_filter_listprice_label', __('normal price','usces'), NULL, NULL); ?>(<?php usces_crcode(); ?>)</th>
				<th><?php echo apply_filters('usces_filter_sellingprice_label', __('Sale price','usces'), NULL, NULL); ?>(<?php usces_crcode(); ?>)</th>
				<th><?php _e('stock','usces') ?></th>
				<th><?php _e('stock status','usces') ?></th>
				<th><?php _e('Apply business package','usces') ?></th>
				<?php echo apply_filters('usces_filter_sku_meta_form_advance_title', ''); ?>
			</tr>
<?php
		foreach( $skus as $sku ){
?>

			<tr>
				<td class='item-sku-key'>
					<input name='itemsku[<?php echo $sku['meta_id']; ?>][key]' id='itemsku[<?php echo $sku['meta_id']; ?>][key]' class='skucode metaboxfield' type='text' value='<?php echo $sku['code']; ?>' />
					<input name='itemsku[<?php echo $sku['meta_id']; ?>][paternkey]' id='itemsku[<?php echo $sku['meta_id']; ?>][paternkey]' type='hidden' value='<?php echo $sku['paternkey']; ?>' />
					<input name='itemsku[<?php echo $sku['meta_id']; ?>][sort]' id='itemsku[<?php echo $sku['meta_id']; ?>][sort]' type='hidden' value='<?php echo $sku['sort']; ?>' />
				</td>
				<td class='item-sku-key'>
					<input name='itemsku[<?php echo $sku['meta_id']; ?>][skudisp]' id='itemsku[<?php echo $sku['meta_id']; ?>][skudisp]' class='skudisp metaboxfield' type='text' value='<?php echo $sku['name']; ?>' />
				</td>
				<td class='item-sku-cprice'><input name='itemsku[<?php echo $sku['meta_id']; ?>][cprice]' id='itemsku[<?php echo $sku['meta_id']; ?>][cprice]' class='skuprice metaboxfield' type='text' value='<?php echo $sku['cprice']; ?>' /></td>
				<td class='item-sku-price'><input name='itemsku[<?php echo $sku['meta_id']; ?>][price]' id='itemsku[<?php echo $sku['meta_id']; ?>][price]' class='skuprice metaboxfield' type='text' value='<?php echo $sku['price']; ?>' /></td>
				<td class='item-sku-zaikonum'><input name='itemsku[<?php echo $sku['meta_id']; ?>][zaikonum]' id='itemsku[<?php echo $sku['meta_id']; ?>][zaikonum]' class='skuzaikonum metaboxfield' type='text' value='<?php echo $sku['stocknum']; ?>' /></td>
				<td class='item-sku-zaiko'>
					<select id='itemsku[<?php echo $sku['meta_id']; ?>][zaiko]' name='itemsku[<?php echo $sku['meta_id']; ?>][zaiko]' class='skuzaiko metaboxfield'>
					<?php 
					for ( $i=0; $i<count($zaikoselectarray); $i++ ) {
						$selected = ( $i == $sku['stock'] ) ? " selected='selected'" : '';
					?>
						<option value='<?php echo $i; ?>'<?php echo $selected; ?>><?php echo $zaikoselectarray[$i]; ?></option>
					<?php
					}
					?>
					</select>
				</td>
				<td class='item-sku-zaiko'>
					<select id='itemsku[<?php echo $sku['meta_id']; ?>][skugptekiyo]' name='itemsku[<?php echo $sku['meta_id']; ?>][skugptekiyo]' class='skugptekiyo metaboxfield'>
						<option value='0' <?php echo ( $sku['gp'] == 0 ? " selected='selected'" : ""); ?>><?php _e('Not apply','usces'); ?></option>
						<option value='1' <?php echo ($sku['gp'] == 1 ? " selected='selected'" : ""); ?>><?php _e('Apply','usces'); ?></option>
					</select>
				</td>
				<?php echo apply_filters('usces_filter_sku_meta_row_advance', '', $sku); ?>

			</tr>
<?php
		}
?>
		</table>
<?php
		$res = ob_get_contents();
		ob_end_clean();
        
        $res = apply_filters( 'wcex_sku_select_filter_select_sku_list', $res, $skus );
		return $res;

	}
	
	function create_sku() {
		global $usces;
		
		$post_id = (int)$_POST['post_id'];
		$_select_sku = get_post_meta( $post_id, '_select_sku', true );
		$_select_sku = empty($_select_sku) ? array() : $_select_sku;

		$skus_old = $usces->get_skus($post_id);
		
		$select_options = array();
		$select_codes = array();
		$patern = NULL;
		$patern_code = NULL;

		foreach($_select_sku as $select_sku){
			$choices = usces_change_line_break( urldecode($select_sku['choices']) );
			$lines = explode("\n", $choices);
			$patern = $this->make_patern( $patern, $lines );
			$patern_code = $this->make_patern_code( $patern_code, $lines );
		}
		
		$select_options = $this->make_select_options( $patern, $select_options );
		$select_codes = $this->make_select_options( $patern_code, $select_codes );

		delete_post_meta( $post_id, '_isku_' );

		foreach( $select_codes as $index => $paternkey ){
			$sku_name = $select_options[$index];
			$sku = $this->get_sku_by_paternkey( $skus_old, $paternkey );
			
			if( false === $sku || empty($sku) ){
				$sku = $skus_old[$sku_name];
			}
			
			if( 'key' == substr( $paternkey, 0, 3 ) ){
				$newcode = $paternkey;
			}else{
				$newcode = 'code'.$paternkey;
			}
			
			$value['code'] = ( isset($sku['code']) ) ? $sku['code']: $newcode;
			$value['name'] = $sku_name;
			$value['cprice'] = ( isset($sku['cprice']) ) ? $sku['cprice']: '';
			$value['price'] = ( isset($sku['price']) ) ? $sku['price']: '';
			$value['unit'] = ( isset($sku['unit']) ) ? $sku['unit']: '';
			$value['stocknum'] = ( isset($sku['stocknum']) ) ? $sku['stocknum']: '';
			$value['stock'] = ( isset($sku['stock']) ) ? $sku['stock']: 0;
			$value['gp'] = ( isset($sku['gp']) ) ? $sku['gp']: 0;
			$value['advance'] = ( isset($sku['advance']) ) ? $sku['advance']: '';
			$value['paternkey'] = $paternkey;

			$value = apply_filters('wcex_sku_select_filter_create_sku_meta_value', $value);
			//$value = apply_filters('usces_filter_add_item_sku_meta_value', $value);

			usces_add_sku($post_id, $value);
		}

		wp_cache_delete($post_id, 'post_meta');
		
		$skus = $usces->get_skus($post_id);

		$res = $this->select_sku_list($skus);

		return json_encode($res);
	}

	/*************************************
	 * usces_action_save_product
	 * Modified:8 Apl.2016
	 ************************************/
	public function save_item_meta( $post_id, $post){
		$select_sku_switch = isset($_POST['select_sku_switch']) ? 1 : 0;
		update_post_meta($post_id, '_select_sku_switch', $select_sku_switch);
		$select_sku_display = isset($_POST['select_sku_display']) ? (int)$_POST['select_sku_display'] : 0;
		update_post_meta($post_id, '_select_sku_display', $select_sku_display);
	}
	
	/**
	 * Return an instance of this class.
	 *
	 * @since     1.0.0
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Fired when the plugin is activated.
	 *
	 * @since    1.0.0
	 *
	 * @param    boolean    $network_wide    True if WPMU superadmin uses
	 *                                       "Network Activate" action, false if
	 *                                       WPMU is disabled or plugin is
	 *                                       activated on an individual blog.
	 */
	public static function activate( $network_wide ) {

		if ( function_exists( 'is_multisite' ) && is_multisite() ) {

			if ( $network_wide  ) {

				// Get all blog ids
				$blog_ids = self::get_blog_ids();

				foreach ( $blog_ids as $blog_id ) {

					switch_to_blog( $blog_id );
					self::single_activate();

					restore_current_blog();
				}

			} else {
				self::single_activate();
			}

		} else {
			self::single_activate();
		}
	}

	/**
	 * Fired when the plugin is deactivated.
	 *
	 * @since    1.0.0
	 *
	 * @param    boolean    $network_wide    True if WPMU superadmin uses
	 *                                       "Network Deactivate" action, false if
	 *                                       WPMU is disabled or plugin is
	 *                                       deactivated on an individual blog.
	 */
	public static function deactivate( $network_wide ) {

		if ( function_exists( 'is_multisite' ) && is_multisite() ) {

			if ( $network_wide ) {

				// Get all blog ids
				$blog_ids = self::get_blog_ids();

				foreach ( $blog_ids as $blog_id ) {

					switch_to_blog( $blog_id );
					self::single_deactivate();

					restore_current_blog();

				}

			} else {
				self::single_deactivate();
			}

		} else {
			self::single_deactivate();
		}

	}

	/**
	 * Fired when a new site is activated with a WPMU environment.
	 *
	 * @since    1.0.0
	 *
	 * @param    int    $blog_id    ID of the new blog.
	 */
	public function activate_new_site( $blog_id ) {

		if ( 1 !== did_action( 'wpmu_new_blog' ) ) {
			return;
		}

		switch_to_blog( $blog_id );
		self::single_activate();
		restore_current_blog();

	}

	/**
	 * Get all blog ids of blogs in the current network that are:
	 * - not archived
	 * - not spam
	 * - not deleted
	 *
	 * @since    1.0.0
	 *
	 * @return   array|false    The blog ids, false if no matches.
	 */
	private static function get_blog_ids() {

		global $wpdb;

		// get an array of blog ids
		$sql = "SELECT blog_id FROM $wpdb->blogs
			WHERE archived = '0' AND spam = '0'
			AND deleted = '0'";

		return $wpdb->get_col( $sql );

	}

	/**
	 * Fired for each blog when the plugin is activated.
	 *
	 * @since    1.0.0
	 */
	private static function single_activate() {
		// @TODO: Define activation functionality here
	}

	/**
	 * Fired for each blog when the plugin is deactivated.
	 *
	 * @since    1.0.0
	 */
	private static function single_deactivate() {
		// @TODO: Define deactivation functionality here
	}

	function skuselect_item_init(){
		global $post;

		if ( 'item' != $post->post_mime_type )
			return;

		$select_sku_switch = get_post_meta($post->ID, '_select_sku_switch', true);

		if( 1 != $select_sku_switch )
			return;

		//WCEX Auto Delivery
		if( defined('WCEX_AUTO_DELIVERY') ) {
			remove_action( 'usces_action_single_item_outform', 'wcad_action_single_item_outform' );
			add_action( 'usces_action_single_item_outform', array($this, 'single_item_outform') );

			remove_action( 'usces_action_single_item_outform_smart', 'wcad_action_single_item_outform_smart' );
			add_action( 'usces_action_single_item_outform_smart', array($this, 'single_item_outform_smart') );

			remove_action( 'usces_action_single_item_outform_garak', 'wcad_action_single_item_outform_garak' );
			add_action( 'usces_action_single_item_outform_garak', array($this, 'single_item_outform_garak') );
		}
	}

	//welcart default
	function single_item_outform(){
		global $post, $usces;

		ob_start();

		if( 'regular' == $usces->getItemChargingType( $post->ID ) ) : 
			$regular_unit = get_post_meta( $post->ID, '_wcad_regular_unit', true );
			if( 'day' == $regular_unit ) {
				$regular_unit_name = __('Daily','autodelivery');
			} elseif( 'month' == $regular_unit ) {
				$regular_unit_name = __('Monthly','autodelivery');
			} else {
				$regular_unit_name = '';
			}
			$regular_interval = get_post_meta( $post->ID, '_wcad_regular_interval', true );
			$regular_frequency = get_post_meta( $post->ID, '_wcad_regular_frequency', true );

			if( usces_have_zaiko_anyone( $post->ID ) ) : 
				usces_the_item();
	?>
	<div id="wc_regular">
		<p class="wcr_tlt"><?php _e('Regular Purchase', 'autodelivery') ?></p>
		<div class="inside">
			<table>
				<tr><th><?php echo apply_filters( 'wcad_filter_item_single_label_interval', __('Interval', 'autodelivery') ); ?></th><td><?php echo $regular_interval; ?><?php echo $regular_unit_name; ?></td></tr>
			<?php if( 1 < (int)$regular_frequency ) : ?>
				<tr><th><?php echo apply_filters( 'wcad_filter_item_single_label_frequency', __('Frequency', 'autodelivery') ); ?></th><td><?php echo $regular_frequency; ?><?php _e('times', 'autodelivery'); ?></td></tr>
			<?php else: ?>
				<tr><th><?php echo apply_filters( 'wcad_filter_item_single_label_frequency_free', '&nbsp;' ); ?></th><td><?php echo apply_filters( 'wcad_filter_item_single_value_frequency_free', '&nbsp;' ); ?></td></tr>
			<?php endif; ?>
			</table>

			<form action="<?php echo USCES_CART_URL; ?>" method="post">
			<?php //usces_the_itemGpExp(); ?>
			<div class="skuform" id="skuform_regular" align="right">

			<?php wcex_auto_delivery_sku_select_form(); ?>

			<?php if (usces_is_options()) : ?>
				<table class='item_option'>
					<caption><?php _e('Please appoint an option.', 'usces'); ?></caption>
				<?php while (usces_have_options()) : ?>
					<tr><th><?php usces_the_itemOptName(); ?></th><td><?php wcad_the_itemOption(usces_getItemOptName(),''); ?></td></tr>
				<?php endwhile; ?>
				</table>
			<?php endif; ?>
				<div class="field">
					<div class="field_name"><?php _e('regular purchase price', 'autodelivery'); ?><?php usces_guid_tax(); ?></div>
					<div class="field_price"><span class="ss_price_regular"><?php wcad_the_itemPriceCr(); ?></span></div>
				</div>
				<div class="zaiko_status itemsoldout"><span class="ss_stockstatus_regular"><?php echo apply_filters('usces_filters_single_sku_zaiko_message', esc_html(usces_get_itemZaiko( 'name' ))); ?></span></div>
				<div style="margin-top:10px" class="c-box"><?php _e('Quantity', 'usces'); ?><?php wcad_the_itemQuant(); ?><?php usces_the_itemSkuUnit(); ?><?php wcad_the_itemSkuButton(__('Apply for a regular purchase', 'autodelivery'), 0); ?></div>
				<div class="error_message"><?php usces_singleitem_error_message($post->ID, usces_the_itemSku('return')); ?></div>
				<div class="wcss_loading"></div>
			</div><!-- end of skuform -->
			<?php echo apply_filters( 'wcad_item_single_sku_after_field', NULL ); ?>
			<?php do_action( 'wcad_action_single_item_inform' ); ?>
			</form>
		</div>
	</div>
	<?php
			endif;
		endif;

		$html = ob_get_contents();
		ob_end_clean();

		$html = apply_filters( 'wcex_sku_select_filter_single_item_autodelivery', $html );

		echo $html;
	}

	function single_item_outform_smart(){
		global $post, $usces;
		ob_start();

		if( 'regular' == $usces->getItemChargingType( $post->ID ) ) : 
			$regular_unit = get_post_meta( $post->ID, '_wcad_regular_unit', true );
			if( 'day' == $regular_unit ) {
				$regular_unit_name = __('Daily','autodelivery');
			} elseif( 'month' == $regular_unit ) {
				$regular_unit_name = __('Monthly','autodelivery');
			} else {
				$regular_unit_name = '';
			}
			$regular_interval = get_post_meta( $post->ID, '_wcad_regular_interval', true );
			$regular_frequency = get_post_meta( $post->ID, '_wcad_regular_frequency', true );

			if( usces_have_zaiko_anyone( $post->ID ) ) : 
				usces_the_item();
?>
		<div id="wc_regular">
			<p class="wcr_tlt"><?php _e('Regular Purchase', 'autodelivery') ?></p>
			<div class="inside">

				<p class="regular_status"><span><?php echo apply_filters( 'wcad_filter_item_single_label_interval', __('Interval', 'autodelivery') ); ?></span><em><?php echo $regular_interval; ?><?php echo $regular_unit_name; ?></em></p>
			<?php if( 1 < (int)$regular_frequency ) : ?>
				<p class="regular_status"><span><?php echo apply_filters( 'wcad_filter_item_single_label_frequency', __('Frequency', 'autodelivery') ); ?></span><em><?php echo $regular_frequency; ?><?php _e('times', 'autodelivery'); ?></em></p>
			<?php else: ?>
				<p class="regular_status"><span><?php echo apply_filters( 'wcad_filter_item_single_label_frequency_free', '&nbsp;' ); ?></span><em><?php echo apply_filters( 'wcad_filter_item_single_value_frequency_free', '&nbsp;' ); ?></em></p>
			<?php endif; ?>

				<form action="<?php echo USCES_CART_URL; ?>" method="post">
					<div class="skuform" id="skuform_regular">

						<?php wcex_auto_delivery_sku_select_form(); ?>

						<?php //usces_the_itemGpExp(); ?>
						<?php if( usces_is_options() ) : ?>
						<p class="opt_ex"><?php _e('Please appoint an option.', 'usces'); ?></p>
						<dl class="item_option">
						<?php while( usces_have_options() ) : ?>
							<dt><?php usces_the_itemOptName(); ?></dt>
							<dd><?php wcad_the_itemOption(usces_getItemOptName(),''); ?></dd>
						<?php endwhile; ?>
						</dl>
						<?php endif; ?>
						<span class="field_name"><?php _e('regular purchase price', 'autodelivery'); ?><?php usces_guid_tax(); ?></span>
						<strong class="field_price"><span class="ss_price_regular"><?php wcad_the_itemPriceCr(); ?></span></strong>
						<p class="zaiko_status_cart itemsoldout"><span class="ss_stockstatus_regular"><?php echo apply_filters('usces_filters_single_sku_zaiko_message', esc_html(usces_get_itemZaiko( 'name' ))); ?></span></p>
						<p class="into_cart c-box"><span><?php _e('Quantity', 'usces'); ?></span><?php wcad_the_itemQuant(); ?><span><?php usces_the_itemSkuUnit(); ?></span><?php wcad_the_itemSkuButton(__('Apply for a regular purchase', 'autodelivery'), 0); ?></p>
						<div class="error_message"><?php usces_singleitem_error_message($post->ID, usces_the_itemSku('return')); ?></div>
						<div class="wcss_loading"></div>
					</div>
					<?php echo apply_filters( 'wcad_item_single_sku_after_field_smart', NULL ); ?>
					<?php do_action( 'wcad_action_single_item_inform_smart' ); ?>
				</form>
			</div>
		</div>
	<?php
			endif;
		endif;

		$html = ob_get_contents();
		ob_end_clean();
		$html = apply_filters( 'wcex_sku_select_filter_single_item_autodelivery_smart', $html );

		echo $html;
	}

	/**********************************************
	* Template redirect
	* Modified:8 Apl.2016
	***********************************************/
	public function template_redirect() {
		global $usces, $post, $usces_entries, $usces_carts, $usces_members, $usces_item, $usces_gp, $member_regmode, $wp_version;
		if( version_compare($wp_version, '4.4-beta', '>') && is_embed() )
			return;
	
		$parent_path = get_template_directory() . '/wc_templates';
		$child_path = get_stylesheet_directory() . '/wc_templates';
		$plugin_path = WCEX_SKU_SELECT_DIR . '/wc_templates';

		if( is_single() && 'item' == $post->post_mime_type ) {
			$select_sku_switch = get_post_meta($post->ID, '_select_sku_switch', true);

			if( 1 == $select_sku_switch  ){
				if( function_exists('dlseller_get_division') ){
					$division = dlseller_get_division( $post->ID );
				}else{
					$division = '';
				}
				$usces_item = $usces->get_item( $post->ID );
				if( 'data' == $division ){
				
					if( file_exists($child_path . '/wc_sku_select_data.php') ){
						if( !post_password_required($post) ){
							include($child_path . '/wc_sku_select_data.php');
							exit;
						}
					}elseif( file_exists($parent_path . '/wc_sku_select_data.php') && !defined('USCES_PARENT_LOAD') ){
						if( !post_password_required($post) ){
							include($parent_path . '/wc_sku_select_data.php');
							exit;
						}
					}elseif( file_exists($plugin_path . '/wc_sku_select_data.php') ){
						if( !post_password_required($post) ){
							include($plugin_path . '/wc_sku_select_data.php');
							exit;
						}
					}
				}elseif( 'service' == $division ){
				
					if( file_exists($child_path . '/wc_sku_select_service.php') ){
						if( !post_password_required($post) ){
							include($child_path . '/wc_sku_select_service.php');
							exit;
						}
					}elseif( file_exists($parent_path . '/wc_sku_select_service.php') && !defined('USCES_PARENT_LOAD') ){
						if( !post_password_required($post) ){
							include($parent_path . '/wc_sku_select_service.php');
							exit;
						}
					}elseif( file_exists($plugin_path . '/wc_sku_select_service.php') ){
						if( !post_password_required($post) ){
							include($plugin_path . '/wc_sku_select_service.php');
							exit;
						}
					}
					
				}else{
				
					if( file_exists($child_path . '/wc_sku_select.php') ){
						if( !post_password_required($post) ){
							include($child_path . '/wc_sku_select.php');
							exit;
						}
					}elseif( file_exists($parent_path . '/wc_sku_select.php') && !defined('USCES_PARENT_LOAD') ){
						if( !post_password_required($post) ){
							include($parent_path . '/wc_sku_select.php');
							exit;
						}
					}elseif( file_exists($plugin_path . '/wc_sku_select.php') ){
						if( !post_password_required($post) ){
							include($plugin_path . '/wc_sku_select.php');
							exit;
						}
					}
					
				}
				return true;
			}
		}
	}
	
	/**********************************************
	* item_single_js
	* Modified:8 Apl.2016
	***********************************************/
	public function item_single_js( $js ) {
		global $usces;
		$item = $usces->item;
		$post_id = $item->ID;
		$member = $usces->get_member();

		if ( !is_singular() || 'item' != $item->post_mime_type )
			return $js;
		
		$select_sku_switch = get_post_meta($post_id, '_select_sku_switch', true);
		if( 1 != $select_sku_switch )
			return $js;

		//$js ='';
		$select_sku_dispaly = get_post_meta( $post_id, '_select_sku_display', true );
		$_select_sku = get_post_meta( $post_id, '_select_sku', true );
		$_select_sku = empty($_select_sku) ? array() : $_select_sku;

		ob_start();
?>

	<script type='text/javascript'>
	jQuery(function($) {
		skuSelect = {
			change : function(sku_code) {
				$("#skuform .wcss_loading").html('<img src="<?php echo USCES_PLUGIN_URL; ?>/images/loading-publish.gif" />');
				
				var quant_type = 'text';
				if( $("#skuform select.skuquantity").length > 0 ){
					quant_type = 'select';
				}

				var s = skuSelect.settings;
				s.data = {
						'action' : 'wcex_sku_select',
						'mode' : 'change_sku',
						'sku' : sku_code,
						'post_id' : uscesL10n.post_id,
						'quant_type' : quant_type,
						'mem_id' : '<?php echo $member['ID']; ?>',
						'wc_nonce' : '<?php echo wp_create_nonce("sku_select"); ?>'
				};
				s.success = function(data, dataType){
					var passage = '[' + data['post_id'] + '][' + data['sku_enc'] + ']';

					$("#skuform input[name^='zaiko[']").attr( 'id','zaiko'+passage ).attr( 'name','zaiko'+passage ).attr( 'value',data['stock'] );
					$("#skuform input[name^=zaikonum]").attr( 'id','zaikonum'+passage ).attr( 'name','zaikonum'+passage ).attr( 'value',data['stocknum'] );
					$("#skuform input[name^=gptekiyo]").attr( 'id','gptekiyo'+passage ).attr( 'name','gptekiyo'+passage ).attr( 'value',data['gp'] );
					$("#skuform input[name^=skuPrice]").attr( 'id','skuPrice'+passage ).attr( 'name','skuPrice'+passage ).attr( 'value',data['price'] );
					if( $("#skuform input[name^=quant]").length ){
						$("#skuform input[name^=quant]").attr( 'id','quant'+passage ).attr( 'name','quant'+passage );
					}
					if( $("#skuform select[name^=quant]").length ){
						$("#skuform select[name^=quant]").attr( 'id','quant'+passage ).attr( 'name','quant'+passage );
					}
					$("#skuform input[name^=inCart]").attr( 'id','inCart'+passage ).attr( 'name','inCart'+passage );
					$("#skuform input[name^=inCart]").attr( 'onclick',"return uscesCart.intoCart('" + data['post_id'] + "','" + data['sku_enc'] + "')" );

					if( $("#skuform [id^='itemOption[']").length ){
						$("#skuform [id^='itemOption[']").each(function(){
							att_name = $(this).attr( 'name' );
							new_name = att_name.replace(/^itemOption\[[0-9]+\]\[[^\[]+\](.*)$/i, "itemOption"+passage+"$1");
							$(this).attr( 'name',new_name );
							att_id = $(this).attr( 'id' );
							new_id = att_id.replace(/^itemOption\[[0-9]+\]\[[^\[]+\](.*)$/i, "itemOption"+passage+"$1");
							$(this).attr( 'id',new_id );
						});
					}
					$(".ss_price").html(data['cr_price']);
					if( $(".ss_cprice").length ){
						$(".ss_cprice").html(data['cr_cprice']);
					}
					if( $(".ss_stockstatus").length ){
						$(".ss_stockstatus").html(data['stockstatus']);
					}

					if( data['select_quantity'] ){
						$("#skuform .skuquantity").html(data['select_quantity']);
					}

					if( !data['is_stock'] ){
						if( data['inquiry_link_button'] && $("#skuform .inquiry").length ){
							$("#skuform .inquiry").show();
							if( data['inquiry_link'] && $(".contact-item").length ){
								$('.contact-item a').attr('href', data['inquiry_link']);
							}
						}else{
							$("#skuform .itemsoldout").show();
						}
						$("#skuform .c-box").hide();
					}else{
						if( data['inquiry_link_button'] && $("#skuform .inquiry").length ){
							$("#skuform .inquiry").hide();
						}else{
							$("#skuform .itemsoldout").hide();
						}
						$("#skuform .c-box").show();
					}
					
					<?php do_action( 'wcex_sku_select_change_sku_success_js', $post_id ); ?>
					
					$("#skuform .wcss_loading").html('');
				};
				$.ajax( s );
				return false;
			},
			settings: {
				url: uscesL10n.ajaxurl,
				type: 'POST',
				dataType: "json",
				cache: false,
				success: function(data, dataType){
					$("#skuform .wcss_loading").html('');
				console.log(data);
				}, 
				error: function(msg){
					$("#skuform .wcss_loading").html('');
				console.log(msg);
				}
			},

			create_skucode: function(){
				var selected_sku = '';
				$('#skuform select[name^=sku_selct]').each(function(){
					selected_sku += $(this).val() + ':';
				});
				var sku_code = encodeURIComponent(selected_sku.substr( 0, selected_sku.length-1 ));
				return sku_code;
			}
		};

	<?php if( 0 == $select_sku_dispaly || 2 < count($_select_sku)) : ?>
		//Select
		//$('#skuform select[name^=sku_selct]').change(function(){
		$(document).on( "change", '#skuform select[name^=sku_selct]', function() {
			skuSelect.change(skuSelect.create_skucode());
		});
		//skuSelect.change(skuSelect.create_skucode());
		$('#skuform select[name^=sku_selct]').trigger( "change" );

	<?php else : ?>
		//Radio
		$('#skuform input[name=sku_selct]').change(function(){
			skuSelect.change( $(this).val() );
		});
		
		if( $('#skuform input[name=sku_selct]:checked').val() ){
			skuSelect.change( $('#skuform input[name=sku_selct]:checked').val() );
		}else{
			if( $("#skuform .inquiry").length ){
				$("#skuform .inquiry").hide();
			}
			$("#skuform .itemsoldout").hide();
			$("#skuform .c-box").hide();
		}
	<?php endif; ?>

	//Use Auto Delivery
	<?php if( defined('WCEX_AUTO_DELIVERY') && 'regular' == $usces->getItemChargingType( $post_id ) ) : ?>
		skuSelectRegular = {
			change : function(sku_code) {
				
				$("#skuform_regular .wcss_loading").html('<img src="<?php echo USCES_PLUGIN_URL; ?>/images/loading-publish.gif" />');
				
				var s = skuSelectRegular.settings;
				s.data = {
						'action' : 'wcex_sku_select',
						'mode' : 'change_sku',
						'sku' : sku_code,
						'post_id' : uscesL10n.post_id,
						'mem_id' : '<?php echo $member['ID']; ?>',
						'wc_nonce' : '<?php echo wp_create_nonce('sku_select'); ?>'
				};
				s.success = function(data, dataType){
				//console.log(data);
					var passage = '[' + data['post_id'] + '][' + data['sku_enc'] + ']';

					$("#skuform_regular input[name^='zaiko[']").attr( 'id','zaiko_regular'+passage ).attr( 'name','zaiko'+passage ).attr( 'value',data['stock'] );
					$("#skuform_regular input[name^=zaikonum]").attr( 'id','zaikonum_regular'+passage ).attr( 'name','zaikonum'+passage ).attr( 'value',data['stocknum'] );
					$("#skuform_regular input[name^=gptekiyo]").attr( 'id','gptekiyo_regular'+passage ).attr( 'name','gptekiyo'+passage ).attr( 'value',data['gp'] );
					$("#skuform_regular input[name^=skuPrice]").attr( 'id','skuPrice_regular'+passage ).attr( 'name','skuPrice'+passage ).attr( 'value',data['rprice'] );
					if( $("#skuform_regular input[name^=quant]").length ){
						$("#skuform_regular input[name^=quant]").attr( 'id','quant_regular'+passage ).attr( 'name','quant'+passage );
					}
					if( $("#skuform_regular select[name^=quant]").length ){
						$("#skuform_regular select[name^=quant]").attr( 'id','quant_regular'+passage ).attr( 'name','quant'+passage );
					}
					$("#skuform_regular input[name^=inCart]").attr( 'id','inCart_regular'+passage ).attr( 'name','inCart'+passage );
					$("#skuform_regular input[name^=inCart]").attr( "onclick", "return skuSelectRegular.intoCart_regular('" + data['post_id'] + "','" + data['sku_enc'] + "')" );

					if( $("#skuform_regular [id^='itemOption_regular[']").length ){
						$("#skuform_regular [id^='itemOption_regular[']").each(function(){
							att_name = $(this).attr( 'name' );
							new_name = att_name.replace(/^itemOption\[[0-9]+\]\[[^\[]+\](.*)$/i, "itemOption"+passage+"$1");
							$(this).attr( 'name',new_name );
							att_id = $(this).attr( 'id' );
							new_id = att_id.replace(/^itemOption_regular\[[0-9]+\]\[[^\[]+\](.*)$/i, "itemOption_regular"+passage+"$1");
							$(this).attr( 'id',new_id );
						});
					}

					$("#skuform_regular input[name$='[regular][unit]']").attr('id', 'advance_regular'+passage+'[regular][unit]').attr('name','advance'+passage+'[regular][unit]').attr( 'value',data['regular_unit'] );
					$("#skuform_regular input[name$='[regular][interval]']").attr('id', 'advance_regular'+passage+'[regular][interval]').attr('name','advance'+passage+'[regular][interval]').attr( 'value',data['regular_interval'] );
					$("#skuform_regular input[name$='[regular][frequency]']").attr('id', 'advance_regular'+passage+'[regular][frequency]').attr('name','advance'+passage+'[regular][frequency]').attr( 'value',data['regular_frequency'] );

					$(".ss_price_regular").html(data['cr_rprice']);
					if( $(".ss_cprice_regular").length ){
						$(".ss_cprice_regular").html(data['cr_cprice']);
					}
					if( $(".ss_stockstatus_regular").length ){
						$(".ss_stockstatus_regular").html(data['stockstatus']);
					}

					if( !data['is_stock'] ){
						if( data['inquiry_link_button'] && $("#skuform_regular .inquiry").length ){
							$("#skuform_regular .inquiry").show();
						}else{
							$("#skuform_regular .itemsoldout").show();
						}
						$("#skuform_regular .c-box").hide();
					}else{
						if( data['inquiry_link_button'] && $("#skuform_regular .inquiry").length ){
							$("#skuform_regular .inquiry").hide();
						}else{
							$("#skuform_regular .itemsoldout").hide();
						}
						$("#skuform_regular .c-box").show();
					}

					$("#skuform_regular .wcss_loading").html('');
				};
				$.ajax( s );
				return false;
			},
			settings: {
				url: uscesL10n.ajaxurl,
				type: 'POST',
				dataType: "json",
				cache: false,
				success: function(data, dataType){
					$("#skuform_regular .wcss_loading").html('');
				}, 
				error: function(msg){
					$("#skuform_regular .wcss_loading").html('');
				}
			},

			create_skucode: function(){
				var selected_sku = '';
				$('#skuform_regular select[name^=sku_selct]').each(function(){
					selected_sku += $(this).val() + ':';
				});
				var sku_code = encodeURIComponent(selected_sku.substr( 0, selected_sku.length-1 ));
				return sku_code;
			},

			intoCart_regular : function( post_id, sku ) {
				var zaikonum = $('#skuform_regular input[name="zaikonum['+post_id+']['+sku+']"]').val();
				var zaiko = $('#skuform_regular input[name="zaiko['+post_id+']['+sku+']"]').val();
				var itemOrderAcceptable = ( undefined != uscesL10n.itemOrderAcceptable ) ? uscesL10n.itemOrderAcceptable : "0";
				if( <?php echo apply_filters( 'wcex_sku_select_intoCart_regular_zaiko_check_js', "( itemOrderAcceptable != '1' && zaiko != '0' && zaiko != '1' ) || ( itemOrderAcceptable != '1' && parseInt(zaikonum) == 0 )" ); ?> ) {
					alert("<?php _e('temporaly out of stock now', 'usces'); ?>");
					return false;
				}
				var mes = "";
				if( $('#skuform_regular input[name="quant['+post_id+']['+sku+']"]') ) {
					var quant = $('#skuform_regular input[name="quant['+post_id+']['+sku+']"]').val();
					if( quant == "0" || quant == "" || !(uscesCart.isNum(quant)) ) {
						mes += "<?php _e('enter the correct amount', 'usces'); ?>";
					}
					var checknum = "";
					var checkmode = "";
					if( parseInt(uscesL10n.itemRestriction) <= parseInt(zaikonum) && uscesL10n.itemRestriction != "" && uscesL10n.itemRestriction != "0" && zaikonum != "" ) {
						checknum = uscesL10n.itemRestriction;
						checkmode = "rest";
					} else if( itemOrderAcceptable != "1" && parseInt(uscesL10n.itemRestriction) > parseInt(zaikonum) && uscesL10n.itemRestriction != "" && uscesL10n.itemRestriction != "0" && zaikonum != "" ) {
						checknum = zaikonum;
						checkmode = "zaiko";
					} else if( itemOrderAcceptable != "1" && (uscesL10n.itemRestriction == "" || uscesL10n.itemRestriction == "0") && zaikonum != "" ) {
						checknum = zaikonum;
						checkmode = "zaiko";
					} else if( uscesL10n.itemRestriction != "" && uscesL10n.itemRestriction != "0" && zaikonum == "" ) {
						checknum = uscesL10n.itemRestriction;
						checkmode = "rest";
					}
					if( parseInt(quant) > parseInt(checknum) && checknum != "" ) {
						if( checkmode == "rest" ) {
							mes += "<?php _e("'This article is limited by '+checknum+' at a time.'", 'usces'); ?>";
						} else {
							mes += "<?php _e("'Stock is remainder '+checknum+'.'", 'usces'); ?>";
						}
					}
				}

				for( i = 0; i<uscesL10n.key_opts.length; i++ ) {
					if( uscesL10n.opt_esse[i] == '1' ){
						var skuob = $('[id="itemOption_regular['+post_id+']['+sku+']['+uscesL10n.key_opts[i]+']"]');
						var itemOption = "itemOption_regular["+post_id+"]["+sku+"]["+uscesL10n.key_opts[i]+"]";
						var opt_obj_radio = $(":radio[name*='"+itemOption+"']");
						var opt_obj_checkbox = $(":checkbox[name*='"+itemOption+"']:checked");
				
						if( uscesL10n.opt_means[i] == '3' ){
							
							if( !opt_obj_radio.is(':checked') ){
								mes += uscesL10n.mes_opts[i]+"\n";
							}
						
						}else if( uscesL10n.opt_means[i] == '4' ){

							if( !opt_obj_checkbox.length ){
								mes += uscesL10n.mes_opts[i]+"\n";
							}
						
						}else{
							
							if( skuob.length ){
								if( uscesL10n.opt_means[i] < 2 && skuob.val() == '#NONE#' ){
									mes += uscesL10n.mes_opts[i]+"\n";
								}else if( uscesL10n.opt_means[i] >= 2 && skuob.val() == '' ){
									mes += uscesL10n.mes_opts[i]+"\n";
								}
							}
						}
					}
				}
				<?php do_action( 'wcex_sku_select_intoCart_regular_js_check', $post_id ); ?>

				if( mes != "" ) {
					alert( mes );
					return false;
				}
			}
		};

		<?php if( 0 == $select_sku_dispaly || 2 < count($_select_sku)) : ?>
			//Select
			$('#skuform_regular select[name^=sku_selct]').change(function(){
				skuSelectRegular.change(skuSelectRegular.create_skucode());
			});
			skuSelectRegular.change(skuSelectRegular.create_skucode());

		<?php else : ?>
			//Radio
			$('#skuform_regular input[name=sku_selct]').change(function(){
				skuSelectRegular.change( $(this).val() );
			});
			
			if( $('#skuform_regular input[name=sku_selct]:checked').val() ){
				skuSelectRegular.change( $('#skuform_regular input[name=sku_selct]:checked').val() );
			}else{
				if( $("#skuform_regular .inquiry").length ){
					$("#skuform_regular .inquiry").hide();
				}
				$("#skuform_regular .itemsoldout").hide();
				$("#skuform_regular .c-box").hide();
			}

		<?php endif; ?>
	<?php endif; ?>
});
</script>

<?php
		$res = ob_get_contents();
		ob_end_clean();
		return $js . $res;
	}

	/*************************************
	 * wp_ajax_welcart_sku_select
	 * Modified:8 Apl.2016
	 ************************************/
	public function sku_select_ajax(){
		global $usces;
		
		check_ajax_referer( 'sku_select', 'wc_nonce' );

		switch ($_POST['mode']) {
			case 'change_sku':
				$res = $this->change_sku();
				break;
		}
		die($res);
	}

	public function change_sku(){
		global $usces;

		$post_id = (int)$_POST['post_id'];
		$quant_type = isset($_POST['quant_type']) ? $_POST['quant_type']: 'text';
		
		$select_sku_display = get_post_meta( $post_id, '_select_sku_display', true );
		$skus = $usces->get_skus($post_id, 'code');

		if( 0 == $select_sku_display ){// case by select mode
		
			$paternkey = urldecode(trim($_POST['sku']));
			$sku = $this->get_sku_by_paternkey( $skus, $paternkey );
			$sku_code = $sku['code'];
			
		}else{// case by radio mode
		
			if( 1 == count($skus) ) {
				$paternkey = urldecode(trim($_POST['sku']));
				$sku = $this->get_sku_by_paternkey( $skus, $paternkey );
				$sku_code = $sku['code'];
			} else {
				$sku_code = urldecode(trim($_POST['sku']));
				//$sku = $skus[$sku_code];
				//$paternkey = urldecode(trim($_POST['sku']));
				$paternkey = ( isset($skus[$sku_code]['paternkey']) && '' != $skus[$sku_code]['paternkey'] ) ? $skus[$sku_code]['paternkey'] : $sku_code;
				$sku = $this->get_sku_by_paternkey( $skus, $paternkey );
				$sku_code = $sku['code'];
			}
		}
		
		$advance = isset($sku['advance']) ? maybe_unserialize($sku['advance']): '';
		
		$mem_id = isset($_POST['mem_id']) ? (int)$_POST['mem_id']: 0;
		$materials = compact( 'post_id', 'sku_code', 'quant_type', 'mem_id', 'select_sku_display' );

		$sku['sku_enc'] = urlencode($sku_code);
		$sku['is_stock'] = $usces->is_item_zaiko( $post_id, $sku_code );
		$sku['post_id'] = $post_id;
		$sku['cr_price'] = usces_crform($skus[$sku_code]['price'], true, false, 'return');
		$sku['cr_cprice'] = ( !empty($skus[$sku_code]['cprice']) ) ? usces_crform($skus[$sku_code]['cprice'], true, false, 'return') : '';
		//$sku['stockstatus'] = $usces->zaiko_status[$sku['stock']];
		$sku['stockstatus'] = usces_get_itemZaiko( 'name', $post_id, $sku_code );
		
		if( defined('WCEX_AUTO_DELIVERY') && 'regular' == $usces->getItemChargingType( $post_id ) ){
			$sku['regular_unit'] = get_post_meta( $post_id, '_wcad_regular_unit', true );
			$sku['regular_interval'] = get_post_meta( $post_id, '_wcad_regular_interval', true );
			$sku['regular_frequency'] = get_post_meta( $post_id, '_wcad_regular_frequency', true );
			$sku['rprice'] = ( isset($advance['rprice']) && $advance['rprice'] > 0 ) ? $advance['rprice']: $sku['price'];
			$sku['cr_rprice'] = usces_crform($sku['rprice'], true, false, 'return');
		}

		$theme_options = get_option( 'basic_type_options' );
		$sku['inquiry_link_button'] = isset($theme_options['inquiry_link_button']) ? $theme_options['inquiry_link_button'] : 0;

		if( 'select' == $quant_type ){
			$sku['select_quantity'] = $this->itemQuant_select($materials, 'return');
		}

		if( function_exists('wcct_get_inquiry_link_url') ){	//contact link
			if( defined('WPCF7_VERSION') ) {
				$item_id = $post_id;
				$sku_code = $sku['sku_enc'];
				$url = add_query_arg( array( 'from_item' => $item_id, 'from_sku' => $sku_code ), get_permalink( wcct_get_options( 'inquiry_link' ) ) );
			} else {
				$url = get_permalink( wcct_get_options( 'inquiry_link' ) );
			}

			$sku['inquiry_link'] = $url;
		}

		$sku = apply_filters( 'wcex_sku_select_filter_change_sku', $sku, $materials );

		return json_encode($sku);
	}

	/*************************************
		sku select quantity
	*************************************/
	public function itemQuant_select($materials = '', $out = ''){
		global $post, $usces;

		if( !empty($materials) )
			extract($materials);

		if( !isset($post_id) )
			$post_id = $post->ID;

		if( !isset($sku_code) )
			$sku_code = usces_the_itemSku('return');

		if( !isset($max) )
			$max = 50;

		$zaiko = $usces->getItemZaikoNum($post_id, $sku_code);

		$sku_enc = urlencode( $sku_code );
		$restriction = $usces->getItemRestriction($post_id);
		
		if( ('' != $zaiko && 0 < $zaiko && '' != $restriction && $zaiko > $restriction) || ( '' == $zaiko && '' != $restriction) ) {
			$max = $restriction;
		}elseif( ( '' != $zaiko && 0 < $zaiko && '' != $restriction && $zaiko < $restriction ) || ( '' != $zaiko && '' == $restriction) ) {
			$max = $zaiko;
		}
		
		$select = '<select name ="quant[' . $post_id . '][' . $sku_enc . ']" id ="quant[' . $post ->ID . '][' . $sku_enc . ']" class="skuquantity" onkeydown="if(event.keyCode == 13) {return false;}">' . "\n";
			for($i =1; $i<=$max; $i++) {
				$select .= '<option value="' . $i . '">' . $i . '</option>' . "\n";
			}
		$select .= '</select>';
		
		if($out){
			return $select;
		}else{
			echo $select;
		}
	}

	/*************************************
	 * wp_enqueue_scripts
	 * Modified:8 Apl.2016
	 ************************************/
	public function front_enqueue_scripts(){
		global $post;
		
		if ( !is_singular() || 'item' != $post->post_mime_type )
			return;

		$select_sku_switch = get_post_meta($post->ID, '_select_sku_switch', true);

		if( 1 != $select_sku_switch )
			return;

		$plugincss = WCEX_SKU_SELECT_URL.'/wcex_sku_select.css';
		wp_enqueue_style( 'sku_select_style', $plugincss, array(), WCEX_SKU_SELECT_VERSION, false );

		if( file_exists( get_stylesheet_directory() . '/wcex_sku_select.css' ) ){
			$css = get_stylesheet_directory_uri() . '/wcex_sku_select.css';
			wp_enqueue_style( 'sku_select_front_style', $css, array('sku_select_style'), WCEX_SKU_SELECT_VERSION, false );
		}
	}

	function get_SKU_Select_CartItemName($post_id){
		global $usces;

		$name_arr = array();
		$name_str = '';
		
		foreach($usces->options['indi_item_name'] as $key => $value){
			if($value){
				$pos = (int)$usces->options['pos_item_name'][$key];
				$ind = ($pos === 0) ? 'A' : $pos;
				switch($key){
					case 'item_name':
						$name_arr[$ind][$key] = $usces->getItemName($post_id);
						break;
					case 'item_code':
						$name_arr[$ind][$key] = $usces->getItemCode($post_id);
						break;
/*
					case 'sku_name':
						$name_arr[$ind][$key] = $usces->getItemSkuDisp($post_id, $sku);
						break;
					case 'sku_code':
						$name_arr[$ind][$key] = $sku;
						break;
*/
				}
			}
			
		}
		ksort($name_arr);
		foreach($name_arr as $vals){
			foreach($vals as $key => $value){
			
				$name_str .= $value . ' ';
			}
		}
		$name_str = apply_filters('wcex_sku_select_filter_get_cart_item_name', $name_str, $post_id);
		
		return trim($name_str);
	}
	
	/*************************************
	 * usces_filter_cart_item_name
	 * Modified:8 Apl.2016
	 ************************************/
	public function cart_item_name($name, $args){
		global $usces;

		//$args = compact('cart', 'i', 'cart_row', 'post_id', 'sku' );
		extract($args);

		$select_sku_switch = get_post_meta($post_id, '_select_sku_switch', true);
		if( 1 == $select_sku_switch ){
			if( isset($sku) ){
				$sku_code = urldecode($sku);
			}
			if( isset($sku_code) ){
				$skus = $usces->get_skus( $post_id, 'code' );
				if( !empty($skus) && isset($skus[$sku_code]) ){
					$sku_name = $skus[$sku_code]['name'];
					$paternkey = ( isset($skus[$sku_code]['paternkey']) && '' != $skus[$sku_code]['paternkey'] ) ? $skus[$sku_code]['paternkey'] : $sku_code;
					$select_value = explode( ':', $paternkey);
					$_select_sku = get_post_meta( $post_id, '_select_sku', true );
					$_select_sku = empty($_select_sku) ? array() : $_select_sku;

					$str = '';
					foreach( $_select_sku as $key => $select_sku ){
						$choices = usces_change_line_break( urldecode($select_sku['choices']) );
						$lines = explode("\n", $choices);
						if( isset($lines[$select_value[$key]]) ){
							$str .= "<br />" . esc_html( $select_sku['name'] . ' : ' . $lines[$select_value[$key]] );
						}
					}

					if( $str ){
						//$name = str_replace( array($sku_code, $sku_name), '', $name );
						//$name = $this->get_SKU_Select_CartItemName($post_id);
						$name = $name . $str;
					}
				}
			}
		}

		return $name;
	}
	
	/*************************************
	 * usces_filter_admin_cart_item_name
	 * Modified:8 Apl.2016
	 ************************************/
	public function admin_cart_item_name($name, $materials){
		global $usces;
		//$materials = compact( 'i', 'cart_row', 'post_id', 'sku', 'sku_code', 'quantity', 'options', 'advance', 
		//	'itemCode', 'itemName', 'cartItemName', 'skuPrice', 'stock', 'red', 'pictid', 'order_id' );

		extract($materials);

		$select_sku_switch = get_post_meta($post_id, '_select_sku_switch', true);
		if( 1 == $select_sku_switch ){
			if( isset($sku) ){
				$sku_code = urldecode($sku);
			}

			if( isset($sku_code) ){
				$skus = $usces->get_skus( $post_id, 'code' );
				if( !empty($skus) && isset($skus[$sku_code]) ){
					$sku_name = $skus[$sku_code]['name'];
					$paternkey = ( isset($skus[$sku_code]['paternkey']) && '' != $skus[$sku_code]['paternkey'] ) ? $skus[$sku_code]['paternkey'] : $sku_code;
					$select_value = explode( ':', $paternkey);
					$_select_sku = get_post_meta( $post_id, '_select_sku', true );
					$_select_sku = empty($_select_sku) ? array() : $_select_sku;

					$str = '';
					foreach( $_select_sku as $key => $select_sku ){
						$choices = usces_change_line_break( urldecode($select_sku['choices']) );
						$lines = explode("\n", $choices);
						if( isset($lines[$select_value[$key]]) ){
							$str .= "<br />" . esc_html( $select_sku['name'] . ' : ' . $lines[$select_value[$key]] );
						}
					}

					if( $str ){
						//$name = str_replace( array($sku_code, $sku_name), '', $name );
						//$name = $this->get_SKU_Select_CartItemName($post_id);
						$name = $name . $str;
					}
				}
			}
		}
		return $name;
	}

	/*************************************
	 * usces_filter_admin_cart_item_name
	 * Modified:30 July.2016
	 ************************************/
	public function cart_item_name_nl($name, $args){
		global $usces;

		//$args = compact('cart', 'i', 'cart_row', 'post_id', 'sku' );
		extract($args);

		$select_sku_switch = get_post_meta($post_id, '_select_sku_switch', true);
		if( 1 == $select_sku_switch ){
			if( isset($sku) ){
				$sku_code = urldecode($sku);
			}

			if( isset($sku_code) ){
				$skus = $usces->get_skus( $post_id, 'code' );
				if( !empty($skus) && isset($skus[$sku_code]) ){
					$sku_name = $skus[$sku_code]['name'];
					$paternkey = ( isset($skus[$sku_code]['paternkey']) && '' != $skus[$sku_code]['paternkey'] ) ? $skus[$sku_code]['paternkey'] : $sku_code;
					$select_value = explode( ':', $paternkey);
					$_select_sku = get_post_meta( $post_id, '_select_sku', true );
					$_select_sku = empty($_select_sku) ? array() : $_select_sku;

					$str = '';
					foreach( $_select_sku as $key => $select_sku ){
						$choices = usces_change_line_break( urldecode($select_sku['choices']) );
						$lines = explode("\n", $choices);
						if( isset($lines[$select_value[$key]]) ){
							$str .= "\n" . esc_html( $select_sku['name'] . ' : ' . $lines[$select_value[$key]] );
						}
					}

					if( $str ){
						//$name = str_replace( array($sku_code, $sku_name), '', $name );
						//$name = $this->get_SKU_Select_CartItemName($post_id);
						$name = $name . $str;
					}
				}
			}
		}

		return $name;
	}

	public function uploadcsv_item_field_num( $add_field_num ) {
		$add_field_num += 3;
		return $add_field_num;
	}

	public function uploadcsv_min_field_num( $min_field_num ) {
		$min_field_num += 1;
		return $min_field_num;
	}

	public function uploadcsv_delete_postmeta( $meta_key_table ) {
		array_push( $meta_key_table, '_select_sku_switch', '_select_sku_display', '_select_sku' );
		return $meta_key_table;
	}

	public function uploadcsv_itemvalue( $post_id, $datas ) {
		global $usces;

		if( defined('WCEX_DLSELLER') ) {
			$idx_select_sku_switch = 39;
			$idx_select_sku_display = 40;
			$idx_select_sku = 41;
		} elseif( defined('WCEX_AUTO_DELIVERY') ) {
			$idx_select_sku_switch = 31;
			$idx_select_sku_display = 32;
			$idx_select_sku = 33;
		} else {
			$idx_select_sku_switch = 27;
			$idx_select_sku_display = 28;
			$idx_select_sku = 29;
		}
		$idx_select_sku_switch = apply_filters( 'wcex_sku_select_filter_idx_select_sku_switch', $idx_select_sku_switch );
		$idx_select_sku_display = apply_filters( 'wcex_sku_select_filter_idx_select_sku_display', $idx_select_sku_display );
		$idx_select_sku = apply_filters( 'wcex_sku_select_filter_idx_select_sku', $idx_select_sku );

		$select_sku_switch = ( isset($datas[$idx_select_sku_switch]) ) ? (int)$datas[$idx_select_sku_switch] : 0;
		update_post_meta( $post_id, '_select_sku_switch', $select_sku_switch );

		$select_sku_display = ( isset($datas[$idx_select_sku_display]) ) ? (int)$datas[$idx_select_sku_display] : 0;
		update_post_meta( $post_id, '_select_sku_display', $select_sku_display );

		$select_sku = array();
		if( !empty($datas[$idx_select_sku]) ) {
			$data = ( $usces->options['system']['csv_encode_type'] == 0 ) ? trim(mb_convert_encoding($datas[$idx_select_sku],'UTF-8','SJIS')) : trim($datas[$idx_select_sku]);
			if( false !== strpos( $data, '><' ) ) {
				$data_select = explode( '><', $data );
			} else {
				$data_select = array($data);
			}
			$i = 0;
			foreach( $data_select as $select ) {
				$select_value = explode( '_', rtrim(ltrim($select,'<'),'>') );
				$id = $select_value[0];
				$name = $select_value[1];
				$lines = explode( ';', $select_value[2] );
				$esc_choices = '';
				foreach( (array)$lines as $line ) {
					if( trim($line) != '' ) {
						$esc_choices .= esc_js($line)."\n";
					}
				}
				$select_sku[$i]['id'] = (int)$id;
				$select_sku[$i]['name'] = esc_js(urldecode($name));
				$select_sku[$i]['choices'] = $esc_choices;
				$i++;
			}
		}
		update_post_meta( $post_id, '_select_sku', $select_sku );
	}

	public function uploadcsv_skuvalue( $skuvalue, $datas ) {
	
		$idx = USCES_COL_SKU_GPTEKIYO + 1;
		$paternkey = ( 'key' == substr( $datas[$idx], 0, 3 ) ) ? substr($datas[$idx], 3) : $datas[$idx];
		$skuvalue['paternkey'] = $paternkey;
		
		return $skuvalue;
	}

	public function downloadcsv_itemheader( $itemheader ) {
		$itemheader = ',"'.__('Use SKU Select', 'sku_select').'","'.__('SKU Select Display', 'sku_select').'","'.__('SKU Select Selection item', 'sku_select').'"';
		return $itemheader;
	}

	public function downloadcsv_header( $header ) {
		$header = ',"('.__('Do not change', 'sku_select').')'.__('SKU Paternkey', 'sku_select').'"';
		return $header;
	}

	public function downloadcsv_itemvalue( $itemvalue, $post_id ) {
		$select_sku_switch = get_post_meta( $post_id, '_select_sku_switch', true );
		$select_sku_display = get_post_meta( $post_id, '_select_sku_display', true );
		$select_sku = '';
		$_select_sku = get_post_meta( $post_id, '_select_sku', true );
		if( $_select_sku ) {
			foreach( (array)$_select_sku as $select ) {
				$select_sku .= '<'.$select['id'].'_'.$select['name'].'_';
				$choices = usces_change_line_break( urldecode($select['choices']) );
				$lines = explode("\n", $choices);
				foreach( (array)$lines as $line ) {
					if( trim($line) != '' ) {
						$select_sku .= esc_js($line).';';
					}
				}
				$select_sku = rtrim($select_sku, ';');
				$select_sku .= '>';
			}
		}
		$itemvalue .= ',"'.$select_sku_switch.'"';
		$itemvalue .= ',"'.$select_sku_display.'"';
		$itemvalue .= ',"'.usces_entity_decode($select_sku, 'csv').'"';
		return $itemvalue;
	}

	public function downloadcsv_skuvalue( $skuvalue, $sku ) {
		$paternkey = ( isset($sku['paternkey']) && '' != $sku['paternkey'] ) ? $sku['paternkey'] : $sku['code'];
		if( 'key' == substr( $paternkey, 0, 3 ) ){
			$skuvalue = ',"'.$paternkey.'"';
		}else{
			$skuvalue = ',"key'.$paternkey.'"';
		}
		return $skuvalue;
	}
	
	public static function get_sku_by_paternkey( $skus, $paternkey ) {
		$res = false;
		foreach( $skus as $i => $sku ){
			if( $sku['paternkey'] == $paternkey ){
				$index = $i;
				break;
			}
		}
		$res = $skus[$index];
		return $res;
	}

}
