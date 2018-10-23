<?php
/**
 *
 * Created by PhpStorm.
 * User: Michal Staniecko
 * Date: 20.10.18
 * Time: 15:57
 */


class Render {
	public function __construct($template=null, $data=null) {
		$this->template= $template;
		$this->data=$data;
	}
	public function render() {
		set_query_var('data', $this->data);
		get_template_part($this->template);
	}

	function form_login() {
		if (!is_user_logged_in()) {

			$render = new Render('partials/form-login');
		} else {
			$render = new Render('partials/logged-in');
		}
		$render ->render();
	}
}

$render = new Render();
