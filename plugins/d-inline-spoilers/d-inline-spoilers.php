<?php
/*
Plugin Name: D Inline Spoilers
Version: 1.2.6
Description: [dspoiler title="This Is Spoiler" class="additional classes" id="unique-id"]multiline html hidden content[/dspoiler]
Author: Dima Stefantsov
Author URI: http://stefantsov.com/
Forked from: Inline Spoilers, https://wordpress.org/plugins/inline-spoilers/, 1.2.5, Sergey Kuzmich
*/


if ( ! defined( 'ABSPATH' ) ) {
	die;
}

add_shortcode( 'dspoiler', 'dis_spoiler_shortcode' );
add_shortcode( 'dspoiler1', 'dis_spoiler_shortcode' );
add_shortcode( 'dspoiler2', 'dis_spoiler_shortcode' );
add_shortcode( 'dspoiler3', 'dis_spoiler_shortcode' );
add_shortcode( 'dspoiler4', 'dis_spoiler_shortcode' );
add_shortcode( 'dspoiler5', 'dis_spoiler_shortcode' );
add_shortcode( 'dspoiler6', 'dis_spoiler_shortcode' );
add_shortcode( 'dspoiler7', 'dis_spoiler_shortcode' );
add_shortcode( 'dspoiler8', 'dis_spoiler_shortcode' );
add_shortcode( 'dspoiler9', 'dis_spoiler_shortcode' );
add_shortcode( 'dspoiler0', 'dis_spoiler_shortcode' );
function dis_spoiler_shortcode( $atts, $content ) {
	extract( shortcode_atts( array(
		'title'         => __( 'Скрытый текст', 'inline-spoilers' ),
		'initial_state' => 'collapsed',
		'id' => '',
		'class' => '',
		'hclass' => '',
		'bclass' => '',
	), $atts ) );

	$title      = esc_attr( $title );
	$head_class = ( esc_attr( $initial_state ) == 'collapsed' ) ? 'collapsed' : 'expanded';
	$body_atts = ( esc_attr( $initial_state ) == 'collapsed' ) ? 'style="display: none;"' : 'style="display: block;"';

	$output =
		"<div " . ($id ? "id=\"{$id}\" " : '') . "class=\"spoiler-wrap {$class}\">
			<div class=\"spoiler-head {$head_class} {$hclass}\">{$title}</div>
			<div class=\"spoiler-body {$bclass}\" {$body_atts}>" .
    			balanceTags( do_shortcode( $content ), true ) .
			"</div>
		</div>";

	return $output;
}

add_action( 'wp_enqueue_scripts', 'dis_styles_scripts' );
function dis_styles_scripts() {
	global $post;
	if ( !has_shortcode( $post->post_content, 'dspoiler' ) ) {
		return;
	}


	wp_register_style( 'd-inline-spoilers_style',
		plugins_url( 'css/d-inline-spoilers.css', __FILE__ ),
		null,
		'1.0' );
	wp_register_script(	'd-inline-spoilers_script',
		plugins_url( 'js/d-inline-spoilers.js', __FILE__ ),
		array( 'jquery' ),
		'1.0',
		true );
	wp_enqueue_style( 'd-inline-spoilers_style' );
	wp_enqueue_script( 'd-inline-spoilers_script' );
}
