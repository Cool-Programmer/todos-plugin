<?php
	if (is_admin()) {
		function tdl_enqueue_scripts_admin()
		{
			wp_enqueue_style('tdl-main-stylesheet', plugins_url() . '/todo-list/css/style-admin.css');
		}
	}
	add_action('admin_init', 'tdl_enqueue_scripts_admin');



	function tdl_enqueue_scripts()
	{
		wp_enqueue_style('tdl-main-stylesheet', plugins_url() . '/todo-list/css/style.css');
		wp_enqueue_script('tdl-main-javascript', plugins_url() . '/todo-list/js/main.js', ['jquery']);
	}
	add_action('wp_enqueue_scripts', 'tdl_enqueue_scripts');