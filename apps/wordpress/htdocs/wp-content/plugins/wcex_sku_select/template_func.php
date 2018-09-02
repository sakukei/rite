<?php
/*
WCEX SKU Select Template Functions
Author: Collne Inc.
*/

function wcex_sku_select_form( $post_id = NULL ){
	global $usces;
	
	if( ! $post_id ){
		global $post;
		$post_id = $post->ID;
	}

	$select_sku_dispaly = get_post_meta( $post_id, '_select_sku_display', true );
	$_select_sku = get_post_meta( $post_id, '_select_sku', true );
	$_select_sku = empty($_select_sku) ? array() : $_select_sku;
	
	if( 1 == $select_sku_dispaly && 2 >= count($_select_sku) ){
		$skus = $usces->get_skus( $post_id, 'paternkey');
		if( 1 == count($_select_sku) ){
		
			$select_sku = $_select_sku[0];
			$form = '<dl class="item-sku">' . "\n";
			$choices = usces_change_line_break( urldecode($select_sku['choices']) );
			$lines = explode("\n", $choices);

			$form .= '	<dt>' . esc_html($select_sku['name']) . '</dt>' . "\n";
			$form .= '	<dd>' . "\n";
			
			$cflag = false;
			for( $l=0; $l<count($lines); $l++ ){
				$line = trim($lines[$l]);
				if( $line != '' ){
					$paternkey = (string)$l;
				//	$sku = $skus[$paternkey];
					$sku = WCEX_SKU_SELECT::get_sku_by_paternkey($skus, $paternkey);
					$sku_code = $sku['code'];
					$is_stock = $usces->is_item_zaiko( $post_id, $sku_code );
					if( $is_stock && !$cflag ){
						$checked = ' checked="checked"';
						$cflag = true;
					}else{
						$checked = '';
					}
					$form .= '	<input type="radio" name="sku_selct" id="sku_selct_' . $l . '" class="sku_select" value="' . $l . '"' . $checked . ' >' . "\n";
					$form .= '	<label for="sku_selct_' . $l . '">' . esc_html($line) . '</label>' . "\n";
				}
			}
			$form .= '	</dd>' . "\n";
			$form .= '</dl>' . "\n";

		}else{
		
			$horizontal = $_select_sku[0];
			$vertical = $_select_sku[1];
			$choices = usces_change_line_break( urldecode($horizontal['choices']) );
			$horizontal_lines = explode("\n", $choices);
			$choices = usces_change_line_break( urldecode($vertical['choices']) );
			$vertical_lines = explode("\n", $choices);

			$form = '<table class="item-sku">' . "\n";
			$form .= '<thead>' . "\n";
			$form .= '<tr><th></th>' . "\n";
			foreach( $horizontal_lines as $hkey => $hline ){
				$form .= '<th>' . esc_html($hline) . '</th>' . "\n";
			}
			$form .= '</tr>' . "\n";
			$form .= '</thead>' . "\n";
			$form .= '<tbody>' . "\n";
			
			$cflag = false;
			foreach( $vertical_lines as $vkey => $vline ){
				$form .= '<tr><th>' . $vline . '</th>' . "\n";
				foreach( $horizontal_lines as $hkey => $hline ){
					$paternkey = $hkey . ':' . $vkey;
					$sku = WCEX_SKU_SELECT::get_sku_by_paternkey($skus, $paternkey);

					$sku_code = $sku['code'];
					$enc_value = urlencode($sku_code);

					$is_stock = $usces->is_item_zaiko( $post_id, $sku_code );
					if( $is_stock && !$cflag ){
						$checked = ' checked="checked"';
						$cflag = true;
					}else{
						$checked = '';
					}
					$form .= '<td><input type="radio" name="sku_selct" class="sku_select" value="' . $enc_value . '"' . $checked . ' ></td>' . "\n";
				}
				$form .= '</tr>' . "\n";
			}
			$form .= '</tbody>' . "\n";
			$form .= '</table>' . "\n";
		
		}
	
	}else{
	
		$skus = $usces->get_skus($post_id);
		foreach( $skus as $sku ){
			$is_stock = $usces->is_item_zaiko( $post_id, $sku['code'] );
			if( $is_stock ){
				$paternkey = $sku['paternkey'];
				$select_line = explode( ':', $paternkey );
				break;
			}			
		}

		$form = '<dl class="item-sku">' . "\n";
		foreach( $_select_sku as $index => $select_sku ){

			$choices = usces_change_line_break( urldecode($select_sku['choices']) );
			$lines = explode("\n", $choices);

			$form .= '	<dt>' . esc_html($select_sku['name']) . '</dt>' . "\n";
			$form .= '	<dd>' . "\n";
			$form .= '	<select name="sku_selct_' . (int)$select_sku['id'] . '" id="sku_selct_' . (int)$select_sku['id'] . '" class="sku_select" >' . "\n";
			
			for( $l=0; $l<count($lines); $l++ ){
				$line = trim($lines[$l]);
				if( $line != '' ){
					if( isset($select_line[$index]) && $select_line[$index] == $l ){
						$selected = ' selected="selected"';
					}else{
						$selected = '';
					}
					$form .= '		<option value="' . $l . '"' . $selected . '>' . esc_html($line) . '</option>' . "\n";
				}
			}
			$form .= '	</select>' . "\n";
			$form .= '	</dd>' . "\n";
		}
		$form .= '</dl>' . "\n";
	
	}
	$args = compact( 'select_sku_dispaly', '_select_sku', 'post_id' );
	echo apply_filters( 'wcex_sku_select_form', $form, $args );
}

function wcex_auto_delivery_sku_select_form( $post_id = NULL ){
	global $usces;
	
	if( ! $post_id ){
		global $post;
		$post_id = $post->ID;
	}

	$select_sku_dispaly = get_post_meta( $post_id, '_select_sku_display', true );
	$_select_sku = get_post_meta( $post_id, '_select_sku', true );
	$_select_sku = empty($_select_sku) ? array() : $_select_sku;
//	$skus = $usces->get_skus( $post_id, 'code');
	
	if( 1 == $select_sku_dispaly && 2 >= count($_select_sku) ){
	
		if( 1 == count($_select_sku) ){
		
			$select_sku = $_select_sku[0];
			$form = '<dl class="item-sku">' . "\n";
			$choices = usces_change_line_break( urldecode($select_sku['choices']) );
			$lines = explode("\n", $choices);

			$form .= '	<dt>' . esc_html($select_sku['name']) . '</dt>' . "\n";
			$form .= '	<dd>' . "\n";
			
			$cflag = false;
			for( $l=0; $l<count($lines); $l++ ){
				$line = trim($lines[$l]);
				if( $line != '' ){
					$sku_code = (string)$l;
					$is_stock = $usces->is_item_zaiko( $post_id, $sku_code );
					if( $is_stock && !$cflag ){
						$checked = ' checked="checked"';
						$cflag = true;
					}else{
						$checked = '';
					}
					$form .= '	<input type="radio" name="sku_selct" id="sku_selct_regular_' . $l . '" class="sku_select" value="' . $l . '"' . $checked . ' >' . "\n";
					$form .= '	<label for="sku_selct_regular_' . $l . '">' . esc_html($line) . '</label>' . "\n";
				}
			}
			$form .= '	</dd>' . "\n";
			$form .= '</dl>' . "\n";

		}else{
		
			$horizontal = $_select_sku[0];
			$vertical = $_select_sku[1];
			$choices = usces_change_line_break( urldecode($horizontal['choices']) );
			$horizontal_lines = explode("\n", $choices);
			$choices = usces_change_line_break( urldecode($vertical['choices']) );
			$vertical_lines = explode("\n", $choices);

			$form = '<table class="item-sku">' . "\n";
			$form .= '<thead>' . "\n";
			$form .= '<tr><th></th>' . "\n";
			foreach( $horizontal_lines as $hkey => $hline ){
				$form .= '<th>' . esc_html($hline) . '</th>' . "\n";
			}
			$form .= '</tr>' . "\n";
			$form .= '</thead>' . "\n";
			$form .= '<tbody>' . "\n";
			
			$cflag = false;
			foreach( $vertical_lines as $vkey => $vline ){
				$form .= '<tr><th>' . $vline . '</th>' . "\n";
				foreach( $horizontal_lines as $hkey => $hline ){
					$sku_code = $hkey . ':' . $vkey;
					$enc_value = urlencode($sku_code);
					$is_stock = $usces->is_item_zaiko( $post_id, $sku_code );
					if( $is_stock && !$cflag ){
						$checked = ' checked="checked"';
						$cflag = true;
					}else{
						$checked = '';
					}
					$form .= '<td><input type="radio" name="sku_selct" class="sku_select" value="' . $enc_value . '"' . $checked . ' ></td>' . "\n";
				}
				$form .= '</tr>' . "\n";
			}
			$form .= '</tbody>' . "\n";
			$form .= '</table>' . "\n";
		
		}
	
	}else{
	
		$skus = $usces->get_skus($post_id);
		foreach( $skus as $sku ){
			$is_stock = $usces->is_item_zaiko( $post_id, $sku['code'] );
			if( $is_stock ){
				$select_line = explode( ':', $sku['code'] );
				break;
			}			
		}

		$form = '<dl class="item-sku">' . "\n";
		foreach( $_select_sku as $index => $select_sku ){
			$choices = usces_change_line_break( urldecode($select_sku['choices']) );
			$lines = explode("\n", $choices);

			$form .= '	<dt>' . esc_html($select_sku['name']) . '</dt>' . "\n";
			$form .= '	<dd>' . "\n";
			$form .= '	<select name="sku_selct_' . (int)$select_sku['id'] . '" id="sku_selct_regular_' . (int)$select_sku['id'] . '" class="sku_select" >' . "\n";
			
			for( $l=0; $l<count($lines); $l++ ){
				$line = trim($lines[$l]);
				if( $line != '' ){
					if( isset($select_line[$index]) && $select_line[$index] == $l ){
						$selected = ' selected="selected"';
					}else{
						$selected = '';
					}
					$form .= '		<option value="' . $l . '"' . $selected . '>' . esc_html($line) . '</option>' . "\n";
				}
			}
			$form .= '	</select>' . "\n";
			$form .= '	</dd>' . "\n";
		}
		$form .= '</dl>' . "\n";
	
	}

	$args = compact( 'select_sku_dispaly', '_select_sku', 'post_id' );
	echo apply_filters( 'wcex_auto_delivery_sku_select_form', $form, $args );
}


