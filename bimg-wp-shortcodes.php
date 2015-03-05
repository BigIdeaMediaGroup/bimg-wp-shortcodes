<?php
/**
 * Plugin Name: BIMG WP Shortcodes
 * Plugin URI: https://github.com/BigIdeaMediaGroup/bimg-wp-shortcodes
 * Description: A set of general plugins for use in BIMG projects.
 * Version: 0.1
 * Author: Big Idea Media Group
 * Author URI: https://github.com/BigIdeaMediaGroup
 * License: GPL2
 *
 * Copyright 2015 Big Idea Media Group
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2, as
 * published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

foreach ( glob( plugin_dir_path( __FILE__ ) . 'shortcodes/*.php' ) as $file ) {
	include_once $file;
}

// Grid System
$bimg_row = new BIMGRow;
$bimg_col = new BIMGColumn;

// Separator
$bimg_separator = new BIMGSeparator;

// Tab System
$bimg_tab_group = new BIMGTabGroup;
$bimg_tab = new BIMGTab;

// Button
$bimg_button = new BIMGButton;

