<?php

    function register_jobs_post_type() {
        // jobs-info
        $labels = array(
            'name' => _x('Jobs', 'jobs-info'),
            'singular_name' => _x('Job', 'jobs-info'),
            'menu_name' => _x('Jobs', 'jobs-info'),
            'name_admin_bar' => _x('Job', 'jobs-info'),
            'add_new' => _x('Add New', 'jobs-info'),
            'add_new_item' => __('Add New Job', 'jobs-info'),
            'new_item' => __('New Job', 'jobs-info'),
            'edit_item' => __('Edit Job', 'jobs-info'),
            'view_item' => __('View Job', 'jobs-info'),
            'all_items' => __('All Jobs', 'jobs-info'),
            'search_items' => __('Search Jobs', 'jobs-info'),
            'parent_item_colon' => __('Parent Jobs:', 'jobs-info'),
            'not_found' => __('No jobs found', 'jobs-info'),
            'not_found_in_trash' => __('No jobs found in Trash', 'jobs-info'),
        );

        $args = array (
            'labels' => $labels,
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'jobs'),
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => false,
            'menu_position' => 5,
            'supports' => array('title', 'editor', 'author', 'excerpt'),
            'menu_icon' => 'dashicons-businessman',
        );

        register_post_type('job', $args);
}

add_action('init', 'register_jobs_post_type');


/** Add custom meta boxes */

function jobs_add_meta_boxes() {
	add_meta_box(
		'jobs_meta_box',
		'Job Details',
		'jobs_meta_box_html',
		'job'
	);
}

add_action('add_meta_boxes', 'jobs_add_meta_boxes');

function jobs_meta_box_html($post) {
	$job_title = get_post_meta( $post->ID, '_job_title', true );
	$salary = get_post_meta( $post->ID, '_salary', true );
	$location = get_post_meta( $post->ID, '_location', true );
	?>
	<p>
		<label for="job_title">Job Title:</label>
		<input type="text" name="job_title" id="job_title" value="<?php echo esc_attr($job_title); ?>" />
	</p>
	<p>
		<label for="salary">Salary:</label>
		<input type="text" name="salary" id="salary" value="<?php echo esc_attr($salary); ?>" />
	</p>
	<p>
		<label for="location">Location:</label>
		<input type="text" name="location" id="location" value="<?php echo esc_attr($location); ?>" />
	</p>
	<?php
 }

 function save_jobs_meta_box_data($post_id) {
	if(array_key_exists('job_title', $_POST)) {
		update_post_meta( $post_id, '_job_title', sanitize_text_field( $_POST['job_title'] ));
	}
	if(array_key_exists('salary', $_POST)) {
		update_post_meta( $post_id, '_salary', sanitize_text_field( $_POST['salary'] ));
	}
	if(array_key_exists('location', $_POST)) {
		update_post_meta( $post_id, '_location', sanitize_text_field( $_POST['location'] ));
	}
 }

 add_action('save_post', 'save_jobs_meta_box_data');