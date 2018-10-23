<?php
/**
 *
 * Created by PhpStorm.
 * User: Michal Staniecko
 * Date: 19.10.18
 * Time: 16:35
 */
class Exercise {
	public function __construct() {


		add_action( 'init', array( $this, 'post_type' ) );
		add_action( 'init', array( $this, 'taxonomy' ) );

		add_action( 'admin_post_nopriv_add_exercise', array( $this, 'add' ) );
		add_action( 'admin_post_add_exercise', array( $this, 'add' ) );

	}

	function add() {
		$exercise_names = $_REQUEST['exercise-name'];
		foreach ( $exercise_names as $key => $exercise_name ):
			$exercise_types = $_REQUEST['exercise-type'];
			$args           = array(
				'post_title'  => $exercise_name,
				'post_author' => 1,
				'post_type'   => 'exercise',
				'post_status' => 'publish',
				'tax_input'   => array(
					'exercise_type' => $exercise_types[ $key ]
				)
			);
			wp_insert_post( $args );
		endforeach;
		wp_redirect( $_REQUEST['back-url'] . '?status=exercise_added' );
	}

	function edit() {

	}


	function form() {
		global $post_id;
		if (is_user_logged_in()) {

			$render = new Render('partials/form-add-exercises', ['post_id'=>$post_id]);
		} else {
			$render = new Render('partials/form-login');
		}
		$render->render();

	}

	function list() {
		$exercises = $this->get_exercise();

		$render = new Render('partials/list-exercises', ['exercises'=>$exercises]);
		$render->render();

	}

	function get_exercise($_type = null) {
		$type= null;
		if (!empty($_type)) {
			$type = array(
				array(
					'taxonomy' => 'exercise_type',
					'field' => 'slug',
					'terms' => $_type
				)
			);
		}
		$args       = array(
			'post_type' => 'exercise',
			'posts_per_page' => -1,
			'tax_query' => $type
		);
		$_exercises = [];
		$exercises  = new WP_Query( $args );
		if ( $exercises->have_posts() ): while ( $exercises->have_posts() ): $exercises->the_post();
			$type         = get_the_terms(get_the_ID(), 'exercise_type');
			$_exercises[] = array(
				'name' => get_the_title(),
				'type' => $type,
				'id' => get_the_ID()
			);
		endwhile; wp_reset_postdata(); endif;

		return $_exercises;
	}

	// Register Custom Post Type

	function post_type() {

		$labels = array(
			'name'                  => _x( 'Exercises', 'Post Type General Name', 'wod' ),
			'singular_name'         => _x( 'Exercise', 'Post Type Singular Name', 'wod' ),
			'menu_name'             => __( 'Exercise', 'wod' ),
			'name_admin_bar'        => __( 'Exercise', 'wod' ),
			'archives'              => __( 'Item Archives', 'wod' ),
			'attributes'            => __( 'Item Attributes', 'wod' ),
			'parent_item_colon'     => __( 'Parent Item:', 'wod' ),
			'all_items'             => __( 'All Items', 'wod' ),
			'add_new_item'          => __( 'Add New Item', 'wod' ),
			'add_new'               => __( 'Add New', 'wod' ),
			'new_item'              => __( 'New Item', 'wod' ),
			'edit_item'             => __( 'Edit Item', 'wod' ),
			'update_item'           => __( 'Update Item', 'wod' ),
			'view_item'             => __( 'View Item', 'wod' ),
			'view_items'            => __( 'View Items', 'wod' ),
			'search_items'          => __( 'Search Item', 'wod' ),
			'not_found'             => __( 'Not found', 'wod' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'wod' ),
			'featured_image'        => __( 'Featured Image', 'wod' ),
			'set_featured_image'    => __( 'Set featured image', 'wod' ),
			'remove_featured_image' => __( 'Remove featured image', 'wod' ),
			'use_featured_image'    => __( 'Use as featured image', 'wod' ),
			'insert_into_item'      => __( 'Insert into item', 'wod' ),
			'uploaded_to_this_item' => __( 'Uploaded to this item', 'wod' ),
			'items_list'            => __( 'Items list', 'wod' ),
			'items_list_navigation' => __( 'Items list navigation', 'wod' ),
			'filter_items_list'     => __( 'Filter items list', 'wod' ),
		);
		$args   = array(
			'label'               => __( 'Exercise', 'wod' ),
			'description'         => __( 'Post Type Descripexercisetion', 'wod' ),
			'labels'              => $labels,
			'supports'            => array( 'title' ),
			'taxonomies'          => array( 'types' ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 5,
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'page',
		);
		register_post_type( 'exercise', $args );

	}

	// Register Custom Taxonomy
	function taxonomy() {

		$labels = array(
			'name'                       => _x( 'Exercise Types', 'Taxonomy General Name', 'wod' ),
			'singular_name'              => _x( 'Exercise Type', 'Taxonomy Singular Name', 'wod' ),
			'menu_name'                  => __( 'Exercise Type', 'wod' ),
			'all_items'                  => __( 'All Items', 'wod' ),
			'parent_item'                => __( 'Parent Item', 'wod' ),
			'parent_item_colon'          => __( 'Parent Item:', 'wod' ),
			'new_item_name'              => __( 'New Item Name', 'wod' ),
			'add_new_item'               => __( 'Add New Item', 'wod' ),
			'edit_item'                  => __( 'Edit Item', 'wod' ),
			'update_item'                => __( 'Update Item', 'wod' ),
			'view_item'                  => __( 'View Item', 'wod' ),
			'separate_items_with_commas' => __( 'Separate items with commas', 'wod' ),
			'add_or_remove_items'        => __( 'Add or remove items', 'wod' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'wod' ),
			'popular_items'              => __( 'Popular Items', 'wod' ),
			'search_items'               => __( 'Search Items', 'wod' ),
			'not_found'                  => __( 'Not Found', 'wod' ),
			'no_terms'                   => __( 'No items', 'wod' ),
			'items_list'                 => __( 'Items list', 'wod' ),
			'items_list_navigation'      => __( 'Items list navigation', 'wod' ),
		);
		$args   = array(
			'labels'            => $labels,
			'hierarchical'      => false,
			'public'            => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'show_tagcloud'     => true,
		);
		register_taxonomy( 'exercise_type', array( 'exercise' ), $args );

	}
}

$exercise = new Exercise;
