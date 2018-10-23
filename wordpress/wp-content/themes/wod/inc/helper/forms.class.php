<?php
/**
 *
 * Created by PhpStorm.
 * User: Michal Staniecko
 * Date: 21.10.18
 * Time: 12:18
 */

class Forms {
	public function __construct() {
	}

	function select( $name, $options, $is_multiple = false ) {

		$multiple = $is_multiple ? 'multiple' : null;
		echo '<select name="'.$name.'" '.$multiple.' class="form-control js-select" placeholder="">';
		echo '<option></option>';
		foreach ( $options as $key => $option ) {
			echo '<option value=' . $key . '>' . $option . '</options>';
		}
		echo '</select>';
	}
}

