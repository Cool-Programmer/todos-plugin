<?php
/*
*	Plugin name: Todo List
*	Plugin URI: http://www.iodevllc.com
*	Description: Todo lists as custom posts
* 	Version: 0.1 beta
*	Author:	Mher Margaryan
*	Author URI: iodevllc.com
*/

if (!defined('ABSPATH')) {
	exit("You are not allowed to be here.");
}

// Require scripts
require_once(plugin_dir_path(__FILE__) . '/includes/todo-list-scripts.php');

// Require shortcodes
require_once(plugin_dir_path(__FILE__) . '/includes/todo-list-shortcodes.php');

// Check if admin, then load custom post type (cpt) && custom fields
if (is_admin()) {
	require_once(plugin_dir_path(__FILE__) . '/includes/todo-list-cpt.php');
	require_once(plugin_dir_path(__FILE__) . 'includes/todo-list-fields.php');
}