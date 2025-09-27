<?php

/**
 * ThemesCamp Global (TCG) functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ThemesCamp Global (TCG)
 */

defined('ABSPATH') || exit;

add_action( 'after_setup_theme', 'technex_theme_setup' );
function technex_theme_setup() {

	/* 
	* Add filters, actions, and theme-supported features.
	*/

	//add thumbnail
	add_theme_support( 'post-thumbnails' );

	//custom background
	add_theme_support( 'custom-background' );

	//Support Html5  
	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script' ) );

	//Let WordPress manage the document title
	add_theme_support( 'title-tag' );

	//automatic feed
	add_theme_support( 'automatic-feed-links' );

	// Add support for editor styles.
	add_theme_support( 'editor-styles' );

	// Wide Alignment.
	add_theme_support( 'align-wide' );

	// Enqueue editor styles.
	add_editor_style( 'css/style-editor.css' ); 

	// Enqueue editor font sizes.
	add_theme_support('disable-custom-font-sizes');

	// Responsive embeds.
	add_theme_support('responsive-embeds');

	// Add support for block styles
	add_theme_support('wp-block-styles');

	//add menu homepage,portfolio and blog
	add_action( 'init', 'technex_register_menu' );
  
	// Set the theme's text domain using the unique identifier from above
	load_theme_textdomain('technex', get_template_directory() . '/lang');
  
	//width content
	if ( ! isset( $content_width ) )$content_width = 1170;
  
	//theme default script.
	add_action('wp_enqueue_scripts', 'technex_theme_scripts');

	//theme default styles.
	add_action('wp_enqueue_scripts', 'technex_theme_styles');
  
	//register sidebar
	add_action( 'widgets_init', 'technex_sidebar' );
  
	/*
	* custom filters
	*/

	//custom excerpt
	add_filter( 'excerpt_length', 'technex_excerpt_length', 10 );

	//remove [..] in excerpt
	add_filter('get_the_excerpt', 'technex_trim_excerpt');

	//custom comment styles
	add_filter('comment_form_default_fields','technex_modify_comment_form_fields');

	//tag cloud filter
	add_filter('wp_generate_tag_cloud', 'technex_tag_cloud',10,1);

	//next post link.
	add_filter('next_post_link', function($link) {
		$next_post = get_next_post();
		$title = esc_attr( $next_post->post_title);
		$link = str_replace('href=', 'title="'.esc_attr($title).'" href=', $link);
		return $link;
	});
  
	//previous post link.
	add_filter('previous_post_link', function($link) {
		$previous_post = get_previous_post();
		$title = esc_attr($previous_post->post_title);
		$link = str_replace('href=', 'title="'.esc_attr($title).'" href=', $link);
		return $link;
	});

	//custom header
	add_action('tcg-custom-header','themescamp_header_start') ;

	//create custom header
	add_action('technex-header-page','themescamp_custom_header_page') ;

	//custom header option
	add_action('technex-header-global','themescamp_custom_header_global') ;
  
	//custom footer
	add_action('technex-custom-footer','themescamp_footer_start') ;

	//custom side panel
	add_action('tcg-custom-sidepanel','themescamp_sidepanel_start') ;
  
	//add image size
	add_image_size( 'technex-related-post', 500, 300, array( 'center', 'center' ) );
	//add image gallery size
	add_image_size( 'technex-gallery', 63, 63, array( 'center', 'center' ) );
  
	//comment reply
	add_action(  'wp_enqueue_scripts', 'technex_enqueue_comments_reply' );
  


}

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function technex_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'technex_pingback_header' );




//tag cloud filter
function technex_tag_cloud($input){
 	return preg_replace('/ style=("|\')(.*?)("|\')/','',$input);
}


//custom excerpt function
function technex_excerpt_length( $length ) {
	return 60;
}

// Remove [...]
function technex_trim_excerpt($text) {
	$text = str_replace('[', '', $text);
	$text = str_replace(']', '', $text);
	return $text;
}

//adding sidebar widget
function technex_sidebar() {
	register_sidebar(
		array(
			'name' => esc_html__('Main Sidebar', 'technex' ),
			'id' => 'main-sidebar',
			'description' => esc_html__('Appears as the sidebar on blog and pages', 'technex' ),
			'before_widget' => '<div  id="%1$s" class="widget %2$s clearfix">','after_widget' => '</div>',
			'before_title' => '<h3 class="widgettitle">',
			'after_title' => '</h3> <div class="widget-border"></div>',
		)
	);
}

//add span to category
add_filter('wp_list_categories', 'technex_cat_count');
function technex_cat_count($links) {
	$links = str_replace('</a> (', '</a> <span>', $links);
	$links = str_replace(')', '</span>', $links);
	return $links;
}

add_filter('get_archives_link', 'technex_arch_count');
function technex_arch_count($links) {
	$links = str_replace('</a>&nbsp;(', '</a> <span>', $links);
	$links = str_replace(')</li>', '</span></li>', $links);
	return $links;
}

//custom comment form
function technex_modify_comment_form_fields($fields){
	$req = get_option('require_name_email');
	$commenter = wp_get_current_commenter();
	$aria_req = ( $req ? " aria-required='true'" : '' ); 
	$fields['author'] = '<p class="comment-form-author">' . ( $req ? '' : '' ) . '<input id="author" name="author" type="text" placeholder="'. esc_attr__('Your Name ...','technex').'" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>';
	$fields['email'] = '<p class="comment-form-email">' . ( $req ? '' : '' ) . '<input id="email" name="email" type="text" placeholder="'. esc_attr__('Your Email ...','technex') .'"  value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>';
	$fields['url'] = '<p class="comment-form-url">'. '<input id="url" name="url" type="text" placeholder="'. esc_attr__('Your Website ...','technex').'" value="' . esc_url( $commenter['comment_author_url'] ) . '" size="30" /></p>';
	return $fields;
}

//comment reply script
function technex_enqueue_comments_reply() {
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

//Get unique ID. 
function technex_unique_id( $prefix = '' ) {
	static $id_counter = 0;
	if ( function_exists( 'wp_unique_id' ) ) {
		return wp_unique_id( $prefix );
	}
	return $prefix . (string) ++$id_counter;
}


//add menu for all page 

function technex_register_menu() {
	register_nav_menus( [
				'primary_menu' => esc_html__('All pages menu', 'technex')
			] ); 
}


//function custom header by page settings   
function technex_custom_menu_page ($menu) {
	global $post ;
	if(has_nav_menu('primary_menu')):
		$menu = '';
		wp_nav_menu( array(
			'menu_id'         => '',
			'items_wrap' => '<ul id="%1$s" class="home-nav navigation %2$s">%3$s</ul>',
			'theme_location' => 'primary_menu',
			  
		) );
	endif;
}

//function custom header by page settings
function technex_custom_flat_menu_page ($flatmenu) {
	global $post ;

		$menuParameters_flat = array(
			'theme_location' => 'primary_menu',
			'container'       => false,
			'items_wrap'      => '<ul id="%1$s" class="mob-nav  %2$s">%3$s</ul>',
			'depth'           => 0,
		);
	echo strip_tags(wp_nav_menu( $menuParameters_flat ), '<a>' );
}



/*
* Theme scripts & Styles
*/
//include theme style
include( get_template_directory().'/inc/theme-style.php' );

//include theme script
include( get_template_directory().'/inc/theme-script.php');

//include comment template
include( get_template_directory().'/inc/comment-template.php');

//pagination
include( get_template_directory().'/inc/pagination.php');

//include TGM activation
include( get_template_directory().'/inc/plugin-install.php'); 

//include Hooks
include( get_template_directory().'/inc/hooks.php');




