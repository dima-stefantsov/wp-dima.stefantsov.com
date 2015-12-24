<?php

// ========================
// http://wordpress.stackexchange.com/a/182023/76002
// Add all required styles of parent before child.
//
// The idea is to simply filter the call to get_stylesheet_uri() in the parent
// theme to return it's own stylesheet instead of the child theme's.
// The child theme's stylesheet is then enqueued later in the action hook my_theme_styles.
// ========================

// Filter get_stylesheet_uri() to return the parent theme's stylesheet
add_filter('stylesheet_uri', 'use_parent_theme_stylesheet');
function use_parent_theme_stylesheet() {
    // Use the parent theme's stylesheet
    return get_template_directory_uri() . '/style.css';
}

// Enqueue this theme's scripts and styles (after parent theme)
add_action('wp_enqueue_scripts', 'my_theme_styles', 20);
function my_theme_styles() {
    $themeVersion = wp_get_theme()->get('Version');

    // Enqueue our style.css with our own version
    wp_enqueue_style('child-theme-style', get_stylesheet_directory_uri() . '/style.css',
        array(), $themeVersion);
}




















// =========================
// Replace parent functions.
// =========================

function child_momentous_display_credit_link() {

	printf('Сделано с любовью<a href="http://stefantsov.com">.</a>');
}

function child_momentous_display_site_title() { ?>
	<a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
		<h1 class="site-title"><?php bloginfo('name'); ?></h1>
	</a>
<?php
}

add_action( 'after_setup_theme', 'remove_parent_theme_features');
function remove_parent_theme_features() {
	remove_action( 'momentous_credit_link', 'momentous_display_credit_link' );
    add_action( 'momentous_credit_link', 'child_momentous_display_credit_link' );

    remove_action( 'momentous_site_title', 'momentous_display_site_title' );
    add_action( 'momentous_site_title', 'child_momentous_display_site_title' );
}

add_action( 'after_setup_theme', 'd_globals');
function d_globals() {
	// Set Content Width more than default 860.
	global $content_width;
	$content_width = 875;
}





















// ==========================
// Override parent functions.
// ==========================

// Display Postmeta Data
function momentous_display_postmeta() {

	// Get Theme Options from Database
	$theme_options = momentous_theme_options();

	// Display Date unless user has deactivated it via settings
	if ( isset($theme_options['meta_date']) and $theme_options['meta_date'] == true ) : ?>
		<span class="meta-date">
		<?php printf('<time class="entry-date published updated" title="%1$s" datetime="%2$s">%3$s</time>',
				esc_attr( get_the_time() ),
				esc_attr( get_the_date( 'c' ) ),
				esc_html( get_the_date() )
			);
		?>
		</span>
	<?php endif;

	// Display Author unless user has deactivated it via settings
	if ( isset($theme_options['meta_author']) and $theme_options['meta_author'] == true ) : ?>
		<span class="meta-author">
		<?php printf(__('by <span class="author vcard"><a class="fn" href="%1$s" title="%2$s" rel="author">%3$s</a></span>', 'momentous-lite'),
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				esc_attr( sprintf( __( 'View all posts by %s', 'momentous-lite' ), get_the_author() ) ),
				get_the_author()
			);
		?>
		</span>
	<?php endif;
}

// Display Postinfo Data on Archive Pages
function momentous_display_postinfo_index() {
	if ( comments_open() ) : ?>
		<div class="meta-comments">
			<?php comments_popup_link( '0', '1', '%' ); ?>
		</div>
	<?php endif;

	// Get Theme Options from Database
	$theme_options = momentous_theme_options();

	// Display Date unless user has deactivated it via settings
	if ( isset($theme_options['meta_category']) and $theme_options['meta_category'] == true ) : ?>
		<span class="meta-category">
			<?php printf('%1$s', get_the_category_list(', '));

			// Display Date unless user has deactivated it via settings
			if ( isset($theme_options['meta_tags']) and $theme_options['meta_tags'] == true ) {
				$tag_list = get_the_tag_list(', ', ', ');
				if ( $tag_list ) {
					printf('%1$s', $tag_list);
				}
			} ?>
		</span>
	<?php endif;
}

// Display Content Pagination
function momentous_display_pagination() {
	global $wp_query;
	$big = 999999999; // need an unlikely integer
	$paginate_links = paginate_links( array(
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format' => '?paged=%#%',
			'current' => max( 1, get_query_var( 'paged' ) ),
			'total' => $wp_query->max_num_pages,
			'next_text' => '<span class="goto-older-posts">Следующая →</span>',
			'prev_text' => '<span class="goto-newer-posts">← Предыдущая</span>',
			'add_args' => false
		) );

	// Display the pagination if more than one page is found
	if ( $paginate_links ) : ?>
		<div class="post-pagination clearfix">
			<?php echo $paginate_links; ?>
		</div>
	<?php
	endif;
}

// Disable displaying custom header featured image for pages.
// At least for now. It looked beautiful.
function momentous_display_custom_header() {}

















// ========
// Filters.
// ========

// Localization.
add_filter( 'get_the_archive_title', function ($title) {
    if(is_category() && is_tag()) {
    	$tag = get_tag(get_query_var('tag_id'));
    	$category = get_category(get_query_var('cat'));
    	$title = sprintf(
    		'Статьи с темой <a href="%s" title="%s"><span>%s</span></a> и тегом <a href="%s" title="%s"><span>%s</span></a>',
    		get_category_link($category->term_id),
    		plural($category->category_count, '%d статья', '%d статьи', '%d статей'),
    		$category->name,
    		get_tag_link($tag->term_id),
    		plural($tag->count, '%d статья', '%d статьи', '%d статей'),
    		$tag->name);
    }
    else if (is_category()) {
		$title = sprintf("Тема: <span>%s</span>", single_cat_title('', false));

	} elseif (is_tag()) {
		$title = sprintf("Тег: <span>%s</span>", single_tag_title('', false));

	} elseif (is_month()) {
        $title = sprintf("Архив за <span>%s</span>", get_the_date('F Y'));
    }

    return $title;
});


add_filter( 'get_the_archive_description', function ($desc) {
    if(is_category() && is_tag()) {
        $tag = get_tag(get_query_var('tag_id'));
        $category = get_category(get_query_var('cat'));

        if(tag_description($tag->term_id)) {
            $desc = tag_description($tag->term_id);
        }
    }

    return $desc;
});















// ========================
// Augmenting parent theme.
// ========================

// Display favicon.
function favicon_link() {
    echo '<link rel="shortcut icon" href="/favicon.ico">' . "\n";
}
add_action( 'wp_head', 'favicon_link' );

// Register widgets below post or other single.
function child_momentous_register_sidebars() {
	register_sidebar( array(
		'name' => __( 'Below post or other single', 'momentous-lite'),
		'id' => 'sidebar-below-single',
		'description' => __( 'Appears below posts.', 'momentous-lite'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widgettitle"><span>',
		'after_title' => '</span></h3>',
	));

	register_sidebar( array(
	'name' => __( 'Under title inline sidebar', 'momentous-lite'),
	'id' => 'sidebar-under-title-inline-single',
	'description' => __( 'Appears inline under posts title.', 'momentous-lite'),
	'before_widget' => '<div id="%1$s" class="widget-inline %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h3 class="widgettitle-inline"><span>',
	'after_title' => '</span></h3>',
	));
}
add_action( 'widgets_init', 'child_momentous_register_sidebars' );

wp_enqueue_script('child-momentous-lite-dindex-js', get_stylesheet_directory_uri() .'/js/index.js', array('jquery'));

// ACF Advanced Custom Fields
add_action('wp_head','d_head');
function d_head() {
	if(function_exists('get_field') && get_field("head")) {
		the_field("head");
	}
}

add_action('wp_head','d_head_css');
function d_head_css() {
	if(function_exists('get_field') && get_field("css")) {
		echo "<style>". get_field("css") ."</style>";
	}
}

add_action('wp_footer','d_footer');
function d_footer() {
	if(function_exists('get_field') && get_field("footer")) {
		the_field("footer");
	}
}

add_action('wp_footer','d_footer_jquery_ready');
function d_footer_jquery_ready() {
	if(function_exists('get_field') && get_field("js_ready")) {
		echo "<script>jQuery(document).ready(function($){". get_field("js_ready") ."});</script>";
	}
}


// Mailpoet
/**
 * function to return an undo unsbscribe string for MailPoet newsletters
 * you could place it in the functions.php of your theme
 * @return string
 */
add_shortcode('d_mailpoet_undo_unsubscribe', 'mailpoet_get_undo_unsubscribe');
function mailpoet_get_undo_unsubscribe() {
	if(class_exists('WYSIJA') && !empty($_REQUEST['wysija-key'])) {
        $undo_paramsurl = array(
	        'wysija-page'=>1,
	        'controller'=>'confirm',
	        'action'=>'undounsubscribe',
	        'wysija-key'=>$_REQUEST['wysija-key']
	        );

        $model_config = WYSIJA::get('config','model');
        $link_undo_unsubscribe = WYSIJA::get_permalink($model_config->getValue('confirmation_page'),$undo_paramsurl);

        $undo_unsubscribe = str_replace(
	        array('[link]','[/link]'),
	        array('<a href="'.$link_undo_unsubscribe.'">','</a>'),
			'<br/><p><strong>Отписались по ошибке? [link]Восстановить подписку[/link].</strong><p>');

        return $undo_unsubscribe;
    }
    return '';
}

/**
 * This is an example of a custom shortcode parser.
 * It's really easy to implement.
 * We already automatically parse all shortcodes with this notation for you: [custom:my_value]
 * You just have to add a filter and return the value you prefer.
 * In the following example we added [custom:my_name] and [custom:blog_name] to our newsletter.
 * We have now to return the preferred values, as string.
 */
// [custom:my_name]
// [custom:blog_name]
add_filter('wysija_shortcodes', 'mailpoet_shortcodes_custom_filter', 10, 2);
function mailpoet_shortcodes_custom_filter($tag_value, $user_id) {

    // $tag_value contains the string after custom:
    // This function will be called the first time with $tag_value = my_name
    // The second time with $tag_value = blog_name

    // $user_id contains the corresponding MailPoet's subscriber id,
    // this could be useful to fetch extra data from the WordPress user's meta for instance
    // e.g.: https://gist.github.com/benheu/cf9eb925b0e17e6dbd6c

    if ($tag_value === 'test') {
        $replacement = 'test: OK!';
    }
    else if ($tag_value === 'blog_name') {
        $replacement = get_bloginfo('name');
    }

    return $replacement;
}

// SNAP
// Increased http request timeout from default 5 to 10 for wordpress, used by SNAP too.
add_filter('http_request_timeout', function(){return 10;});

/*
 * $num число, от которого будет зависеть форма слова
 * $form_for_1 первая форма слова, например Товар
 * $form_for_2 вторая форма слова - Товара
 * $form_for_5 третья форма множественного числа слова - Товаров
 */
function plural($num, $form_for_1, $form_for_2, $form_for_5){
    $num = abs($num) % 100; // берем число по модулю и сбрасываем сотни (делим на 100, а остаток присваиваем переменной $num)
    $num_x = $num % 10; // сбрасываем десятки и записываем в новую переменную
    if ($num > 10 && $num < 20) // если число принадлежит отрезку [11;19]
        return sprintf($form_for_5, $num);
    if ($num_x > 1 && $num_x < 5) // иначе если число оканчивается на 2,3,4
        return sprintf($form_for_2, $num);
    if ($num_x == 1) // иначе если оканчивается на 1
        return sprintf($form_for_1, $num);
    return sprintf($form_for_5, $num);
}
