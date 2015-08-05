<?php

// ========================
// http://wordpress.stackexchange.com/a/182023/76002
// Add all required styles of parent before child.
//
// The idea is to simply filter the call to get_stylesheet_uri() in the parent
// theme to return it's own stylesheet instead of the child theme's.
// The child theme's stylesheet is then enqueued later in the action hook my_theme_styles.
// ========================

function use_parent_theme_stylesheet() {
    // Use the parent theme's stylesheet
    return get_template_directory_uri() . '/style.css';
}
// Filter get_stylesheet_uri() to return the parent theme's stylesheet 
add_filter('stylesheet_uri', 'use_parent_theme_stylesheet');

function my_theme_styles() {
    $themeVersion = wp_get_theme()->get('Version');

    // Enqueue our style.css with our own version
    wp_enqueue_style('child-theme-style', get_stylesheet_directory_uri() . '/style.css',
        array(), $themeVersion);
}
// Enqueue this theme's scripts and styles (after parent theme)
add_action('wp_enqueue_scripts', 'my_theme_styles', 20);




















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

function remove_parent_theme_features() {
	remove_action( 'momentous_credit_link', 'momentous_display_credit_link' );
    add_action( 'momentous_credit_link', 'child_momentous_display_credit_link' );
    
    remove_action( 'momentous_site_title', 'momentous_display_site_title' );
    add_action( 'momentous_site_title', 'child_momentous_display_site_title' );
}
add_action( 'after_setup_theme', 'remove_parent_theme_features');	




















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



















// ========
// Filters.
// ========

// Localization.
add_filter( 'get_the_archive_title', function ($title) {
    if ( is_category() ) {
		$title = sprintf("Тема: <span>%s</span>", single_cat_title('', false));
	} elseif ( is_tag() ) {
		$title = sprintf("Тег: <span>%s</span>", single_tag_title('', false));
	} elseif ( is_month() ) {
        $title = sprintf("Архив за <span>%s</span>", get_the_date('F Y'));
    }

    return $title;
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

add_action('wp_footer','d_metrika');
function d_metrika() {
	if (function_exists('get_field') && get_field("hide_metrika")) {
		return;
	}

    echo "

    <script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-65975495-1', 'auto');
	  ga('send', 'pageview');
	</script>

	".'

    <!-- Yandex.Metrika counter -->
    <script type="text/javascript">
        (function (d, w, c) {
            (w[c] = w[c] || []).push(function() {
                try {
                    w.yaCounter31383978 = new Ya.Metrika({
                        id:31383978,
                        clickmap:true,
                        trackLinks:true,
                        accurateTrackBounce:true
                    });
                } catch(e) { }
            });
            var n = d.getElementsByTagName("script")[0],
                s = d.createElement("script"),
                f = function () { n.parentNode.insertBefore(s, n); };
            s.type = "text/javascript";
            s.async = true;
            s.src = "https://mc.yandex.ru/metrika/watch.js";

            if (w.opera == "[object Opera]") {
                d.addEventListener("DOMContentLoaded", f, false);
            } else { f(); }
        })(document, window, "yandex_metrika_callbacks");
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/31383978" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->

    ';
}

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














?>