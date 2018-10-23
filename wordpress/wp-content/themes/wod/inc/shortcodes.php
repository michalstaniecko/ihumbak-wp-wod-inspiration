<?php
/**
 *
 * Created by PhpStorm.
 * User: Michal Staniecko
 * Date: 19.10.18
 * Time: 16:46
 */


add_shortcode('exercise_form', array($exercise,'form'));
add_shortcode('exercise_list', array($exercise, 'list'));
add_shortcode('wod_list', array($wod, 'list'));
add_shortcode('wod_form', array($wod,'form'));
add_shortcode('wod_table', array($wod,'table'));
add_shortcode('login_form', array($render,'form_login'));
