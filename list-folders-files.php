<?php
/**
 * Plugin Name: List Folders & Files
 * Description: Elementor widget to list folders and files
 * Version: 1.0
 * Author: Ordan Jovanoski
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

function register_list_folders_files_widget($widgets_manager) {
    require_once(__DIR__ . '/widgets/list-folders-files-widget.php');
    $widgets_manager->register(new \Elementor_List_Folders_Files_Widget());
}
add_action('elementor/widgets/register', 'register_list_folders_files_widget');