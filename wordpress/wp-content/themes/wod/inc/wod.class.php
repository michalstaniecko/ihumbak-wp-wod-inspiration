<?php
/**
 *
 * Created by PhpStorm.
 * User: Michal Staniecko
 * Date: 19.10.18
 * Time: 16:30
 */

class WOD extends Exercise {

	public function __construct() {
		add_action( 'init', array( $this, 'post_type' ) );

		add_filter( 'rwmb_meta_boxes', array( $this, 'wod_meta_boxes' ) );


		add_action( 'admin_post_nopriv_add_wod', array( $this, 'add' ) );
		add_action( 'admin_post_add_wod', array( $this, 'add' ) );

		$this->set_modality();
		$this->set_time();
		$this->set_repetitions();
		$this->set_scheme();
		$this->set_priority();

	}

	function set_modality() {
		$this->modality = array(
			'gymnastics'           => 'Gymnastics',
			'metabolic'            => 'Metabolic',
			'weightlifting-light'  => 'Weightlifting - Light',
			'weightlifting-medium' => 'Weightlifting - Medium',
			'weightlifting-heavy'  => 'Weightlifting - Heavy',
		);
	}

	function set_time() {
		$this->time = array(
			'heavy-day' => 'Heavy Day',
			'5min'      => '< 5 min',
			'5-10min'   => '5-10 min',
			'11-20min'  => '11-20 min',
			'20min'     => '> 20 min',
		);
	}

	function set_repetitions() {
		$this->repetitions = array(
			'low'    => 'Low (< 50 reps)',
			'medium' => 'Medium (50-200 reps)',
			'high'   => 'High (> 200 reps)'
		);
	}

	function set_scheme() {
		$this->scheme = array(
			'single'  => 'Single',
			'couplet' => 'Couplet',
			'triplet' => 'Triplet',
			'chipper' => '4 moves & chippers'
		);
	}

	function set_priority() {
		$this->priority = array(
			'time' => 'Time',
			'task' => 'Task'
		);
	}

	function save_meta() {

	}

	function form() {
		global $post_id;

		if (is_user_logged_in()){

			$exercises = $this->prepare_exercises();

			$render = new Render( 'partials/form-add-wod', [
				'post_id'   => $post_id,
				'exercises' => $exercises,
			] );
		} else {
			$render = new Render('partials/form-login');
		}
		$render->render();

	}

	function prepare_exercises( $type = null ) {
		$_exercises = Exercise::get_exercise( $type );
		$prepared   = [];
		foreach ( $_exercises as $exercise ) {
			$prepared[ $exercise['id'] ] = $exercise['name'];

		}

		return $prepared;
	}

	function add() {
		$wod_name        = $_REQUEST['wod-name'];
		$wod_description = $_REQUEST['wod-description'];
		$wod_exercises   = $_REQUEST['wod-exercises'];
		$wod_modalities  = $_REQUEST['wod-modality'];
		$wod_time        = $_REQUEST['wod-time'];
		$wod_repetitions = $_REQUEST['wod-repetitions'];
		$wod_scheme      = $_REQUEST['wod-scheme'];
		$wod_priority    = $_REQUEST['wod-priority'];

		$args    = array(
			'post_title'  => $wod_name,
			'post_author' => 1,
			'post_type'   => 'wod',
			'post_status' => 'publish',
		);
		$post_id = wp_insert_post( $args );
		if ( $post_id ) {
			add_post_meta( $post_id, 'wod_description', $wod_description );
			add_post_meta( $post_id, 'wod_time', $wod_time );
			add_post_meta( $post_id, 'wod_repetitions', $wod_repetitions );
			add_post_meta( $post_id, 'wod_scheme', $wod_scheme );
			add_post_meta( $post_id, 'wod_priority', $wod_priority );
			if ( ! empty( $wod_exercises ) ) {

				foreach ( $wod_exercises as $wod_exercise ) {

					add_post_meta( $post_id, 'wod_exercises', $wod_exercise );
				}
			}
			if ( ! empty( $wod_modalities ) ) {

				foreach ( $wod_modalities as $wod_modality ) {

					add_post_meta( $post_id, 'wod_modality', $wod_modality );
				}
			}

		}
		wp_redirect( $_REQUEST['back-url'] . '?status=wod_added' );
	}

	function list() {
		$args   = array(
			'post_type'      => 'wod',
			'posts_per_page' => - 1,
			'post_status'    => array( 'future', 'publish' )
		);
		$wods   = new WP_Query( $args );
		$render = new Render( 'partials/list-wods', [ 'wods' => $wods ] );
		$render->render();

	}

	function table() {
		$render = new Render( 'partials/table-wods' );
		$render->render();
	}

	function post_type() {

		$labels = array(
			'name'                  => _x( 'WOD', 'Post Type General Name', 'wod' ),
			'singular_name'         => _x( 'WOD', 'Post Type Singular Name', 'wod' ),
			'menu_name'             => __( 'WOD', 'wod' ),
			'name_admin_bar'        => __( 'WOD', 'wod' ),
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
			'label'               => __( 'WOD', 'wod' ),
			'description'         => __( 'WOD', 'wod' ),
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
		register_post_type( 'wod', $args );

	}

	function wod_meta_boxes( $meta_boxes ) {
		$prefix       = 'wod_';
		$meta_boxes[] = array(
			'id'         => 'wod',
			'title'      => 'WOD Information',
			'post_types' => 'wod',
			'context'    => 'normal',
			'priority'   => 'high',

			'fields' => array(
				array(
					'name' => 'Description',
					'id'   => $prefix . 'description',
					'type' => 'textarea',
				),
				array(
					'name'     => 'Exercises',
					'id'       => $prefix . 'exercises',
					'type'     => 'select_advanced',
					'options'  => $this->prepare_exercises(),
					'multiple' => true,
				),
				array(
					'name'     => __( 'Modality/Load', 'wod' ),
					'id'       => $prefix . 'modality',
					'type'     => 'select_advanced',
					'options'  => $this->get_modality(),
					'multiple' => true
				),
				array(
					'name'    => __( 'Time', 'wod' ),
					'id'      => $prefix . 'time',
					'type'    => 'select_advanced',
					'options' => $this->get_time(),
				),
				array(
					'name'    => __( 'Total Repetitions', 'wod' ),
					'id'      => $prefix . 'repetitions',
					'type'    => 'select_advanced',
					'options' => $this->get_repetitions(),
				),
				array(
					'name'    => __( 'Scheme', 'wod' ),
					'id'      => $prefix . 'scheme',
					'type'    => 'select_advanced',
					'options' => $this->get_scheme(),
				),
				array(
					'name'    => __( 'Priority', 'wod' ),
					'id'      => $prefix . 'priority',
					'type'    => 'select_advanced',
					'options' => $this->get_priority(),
				)
			)
		);

		// Add more meta boxes if you want
		// $meta_boxes[] = ...

		return $meta_boxes;
	}

	function get_modality() {
		return $this->modality;
	}

	function get_time() {
		return $this->time;
	}

	function get_repetitions() {
		return $this->repetitions;
	}

	function get_scheme() {
		return $this->scheme;
	}

	function get_priority() {
		return $this->priority;
	}

	function get_wods_details( $wod_id = null ) {
		if ( WP_DEBUG ) {
			$wod_id = 132;
		}
		$wod_details_empty = $this->create_empty_wod_table();
		$args              = array(
			//'p' => $wod_id,
			'post_type'      => 'wod',
			'posts_per_page' => 10,
			'post_status'    => 'any'
		);
		$wod               = new WP_Query( $args );
		$all_wods_string   = '';
		$index             = 1;
		if ( $wod->have_posts() ): while ( $wod->have_posts() ): $wod->the_post();

			$wod_string = '<div class="js-wod-table-hightlight">';
			foreach ( $wod_details_empty['modalities'] as $key => $modality ) {
				$result = null;
				foreach ( rwmb_meta( 'wod_modality' ) as $value ) {
					$result = $key == $value ? 'active' : null;
					if ( $result ) {
						$wod_string .= '<div class="wod-table-item wod-table-item-' . $result . '"></div>';
						break;
					}
				}
				if ( empty( $result ) ) {
					$wod_string .= '<div class="wod-table-item wod-table-item-' . $result . '"></div>';
				}
			}

			$wod_string .= '</div><div class="js-wod-table-hightlight">';
			foreach ( $wod_details_empty['time'] as $key => $time ) {
				$result     = $key == rwmb_meta( 'wod_time' ) ? 'active' : null;
				$wod_string .= '<div class="wod-table-item wod-table-item-' . $result . '"></div>';

			}

			$wod_string .= '</div><div class="js-wod-table-hightlight">';
			foreach ( $wod_details_empty['reps'] as $key => $reps ) {
				$result     = $key == rwmb_meta( 'wod_repetitions' ) ? 'active' : null;
				$wod_string .= '<div class="wod-table-item wod-table-item-' . $result . '"></div>';

			}
			$wod_string .= '</div><div class="js-wod-table-hightlight">';
			foreach ( $wod_details_empty['scheme'] as $key => $scheme ) {
				$result     = $key == rwmb_meta( 'wod_scheme' ) ? 'active' : null;
				$wod_string .= '<div class="wod-table-item wod-table-item-' . $result . '"></div>';

			}
			$wod_string .= '</div><div class="js-wod-table-hightlight">';
			foreach ( $wod_details_empty['priority'] as $key => $priority ) {
				$result     = $key == rwmb_meta( 'wod_priority' ) ? 'active' : null;
				$wod_string .= '<div class="wod-table-item wod-table-item-' . $result . '"></div>';

			}
			$wod_string .= '</div><div class="js-wod-table-hightlight">';

			foreach ( $wod_details_empty['gymnastic'] as $key => $gymnastic ) {
				$result = null;
				foreach ( rwmb_meta( 'wod_exercises' ) as $e_key => $value ) {

					$result = $key == $value ? 'active' : null;
					if ( $result ) {
						$wod_string .= '<div class="wod-table-item wod-table-item-' . $result . '"></div>';

						break;
					}
				}
				if ( empty( $result ) ) {
					$wod_string .= '<div class="wod-table-item wod-table-item-' . $result . '"></div>';
				}
			}
			$wod_string .= '</div><div class="js-wod-table-hightlight">';
			foreach ( $wod_details_empty['weightlifting'] as $key => $weightlifting ) {
				$result = null;
				foreach ( rwmb_meta( 'wod_exercises' ) as $e_key => $value ) {

					$result = $key == $value ? 'active' : null;
					if ( $result ) {
						$wod_string .= '<div class="wod-table-item wod-table-item-' . $result . '"></div>';
						break;
					}
				}
				if ( empty( $result ) ) {
					$wod_string .= '<div class="wod-table-item wod-table-item-' . $result . '"></div>';
				}
			}
			$wod_string .= '</div><div class="js-wod-table-hightlight">';
			foreach ( $wod_details_empty['metabolic'] as $key => $metabolic ) {
				$result = null;
				foreach ( rwmb_meta( 'wod_exercises' ) as $e_key => $value ) {

					$result = $key == $value ? 'active' : null;
					if ( $result ) {
						$wod_string .= '<div class="wod-table-item wod-table-item-' . $result . '"></div>';
						break;
					}
				}
				if ( empty( $result ) ) {
					$wod_string .= '<div class="wod-table-item wod-table-item-' . $result . '"></div>';
				}
			}
			$wod_string .= '</div>';
			$all_wods_string .= '<div class="col-1-10 wod-table-column"><div class="border-bottom">WOD ' . $index .'</div>' . $wod_string . '</div>';
			$index ++;
		endwhile;
			wp_reset_postdata();endif;

		//return $current_wod_details;

		return $all_wods_string;
	}

	function create_empty_wod_table() {
		$wod_details = [];


		$details['modalities']    = $this->get_modality();
		$details['time']          = $this->get_time();
		$details['reps']          = $this->get_repetitions();
		$details['scheme']        = $this->get_scheme();
		$details['priority']      = $this->get_priority();
		$details['gymnastic']     = $this->prepare_exercises( 'gymnastic' );
		$details['weightlifting'] = $this->prepare_exercises( 'weightlifting' );
		$details['metabolic']     = $this->prepare_exercises( 'metabolic' );
		$wod_details              = [];
		foreach ( $details as $key => $detail ) {
			foreach ( $detail as $k => $d ) {
				$wod_details[ $key ][ $k ] = 0;
			}
		}

		return $wod_details;
	}
}

$wod = new WOD();
