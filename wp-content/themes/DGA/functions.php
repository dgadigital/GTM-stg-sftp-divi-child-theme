<?php



add_action('after_setup_theme', function () {
    load_theme_textdomain('dga', get_template_directory() . '/languages');
});

function spt_testimonial_shortcode() {
    $query = new WP_Query(array(
        'post_type' => 'spt_testimonial',
        'posts_per_page' => -1,
		'post_status' => 'publish'
    ));

    $output = '<div class="testimonial-grid">';

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
			
            $name = get_the_title();
            $content = get_the_content();
            $image = get_the_post_thumbnail(get_the_ID(), 'medium');

            $output .= '<div class="testimonial-item">';
            $output .= '<div class="testimonial-image">' . $image . '</div>';
            $output .= '<h3 class="testimonial-name">' . $name . '</h3>';
			$sp_tpro_meta_options = get_post_meta(get_the_ID(), 'sp_tpro_meta_options');
			$output .= '<div class="testimonial-rating">';
            $rating = $sp_tpro_meta_options[0]['tpro_rating'];
			switch ($rating) {
				case 'one_star':
					$rating = 1;
					break;
				
				case 'two_star':
					$rating = 2;
					break;
						
				case 'three_star':
					$rating = 3;
					break;

				case 'four_star':
					$rating = 4;
					break;

				case 'five_star':
					$rating = 5;
					break;
			}
			for ($i = 1; $i <= 5; $i++) {
				if ($i <= $rating) {
					$output .= '<span class="star filled">★</span>';
				} else {
					$output .= '<span class="star">★</span>';
				}
			}
            $output .= '</div>';
            $output .= '<p class="testimonial-content">' . wp_trim_words($content, 20, '...') . '</p>';
            $output .= '</div>';
        }
    }

    $output .= '</div>';

    // Reset post data
    wp_reset_postdata();

    return $output;
}
add_shortcode('spt_testimonial', 'spt_testimonial_shortcode');






// ========================================================================================================================================================================================================

require_once get_template_directory() . '/inc/class-custom-walker-nav.php';
require_once get_template_directory() . '/inc/class-custom-walker-nav-mobile.php';

// ==========================================================
// 0. sige logo
// ==========================================================





// ==========================================================
// 1. Conditionally enqueue Bootstrap, Slick, and Custom Theme Scripts
// ==========================================================
add_action('wp_enqueue_scripts', function () {
    // Only load custom assets if current page uses Flexible Content template
    

    // Ensure jQuery loads
    wp_enqueue_script('jquery');

    // Theme URI (safe for local/dev/prod)
$theme_uri = get_template_directory_uri();
$theme_dir  = get_template_directory();

/* ABSOLUTE PATHS (server) */
    $style_path  = $theme_dir . '/assets/css/style.min.css';
    $script_path = $theme_dir . '/assets/js/dist/bundle.min.js';

    /* PUBLIC URLS (browser) */
    $style_url   = $theme_uri . '/assets/css/style.min.css';
    $script_url  = $theme_uri . '/assets/js/dist/bundle.min.js';

    // --- Bootstrap ---
    wp_enqueue_style(
        'bootstrap-css',
        $theme_uri . '/assets/vendor/bootstrap/dist/css/bootstrap.min.css',
        [],
        '5.3.8'
    );
    wp_enqueue_script(
        'bootstrap-js',
        $theme_uri . '/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js',
        ['jquery'],
        '5.3.8',
        true
    );

    // --- Slick Carousel ---
    wp_enqueue_style(
        'slick-css',
        $theme_uri . '/assets/vendor/slick-carousel/slick/slick.css',
        ['bootstrap-css'],
        '1.8.1'
    );
    wp_enqueue_style(
        'slick-theme-css',
        $theme_uri . '/assets/vendor/slick-carousel/slick/slick-theme.css',
        ['slick-css'],
        '1.8.1'
    );
    wp_enqueue_script(
        'slick-js',
        $theme_uri . '/assets/vendor/slick-carousel/slick/slick.min.js',
        ['jquery'],
        '1.8.1',
        true
    );

    
// CSS
    if (file_exists($style_path)) {
        wp_enqueue_style(
            'dga-style',
            $style_url,
            [],
            filemtime($style_path)
        );
    }

    // JS
    if (file_exists($script_path)) {
        wp_enqueue_script(
            'dga-scripts',
            $script_url,
            ['jquery'],
            filemtime($script_path),
            true
        );
    }
    
}, 30);



// Put this anywhere in functions.php (after your existing enqueue block is fine)
add_action('wp_enqueue_scripts', function () {
    

    // If our compiled CSS is already enqueued, bump it to the very end
    if (wp_style_is('dga-style', 'enqueued')) {
        wp_dequeue_style('dga-style');
        wp_enqueue_style('dga-style'); // re-enqueue with same src/deps/version
    }
}, 998);






// ==========================================================
// 3. Safety net – Force print enqueued JS in footer for ACF pages
// ==========================================================
add_action('wp_footer', function () {
    
        wp_print_scripts(['bootstrap-js', 'slick-js', 'dga-scripts']);
    
}, 100);

// ==========================================================
// 4. Save and Load ACF JSON for version control
// ==========================================================
add_filter('acf/settings/save_json', function ($path) {
    return get_template_directory() . '/acf-json';
});

add_filter('acf/settings/load_json', function ($paths) {
    unset($paths[0]);
    $paths[] = get_template_directory() . '/acf-json';
    return $paths;
});

// ==========================================================
// 5. Register Primary Navigation Menu
// ==========================================================
add_action('after_setup_theme', function () {
    register_nav_menus([
        'left'    => __('Left Menu', 'dga'),
        'right'   => __('Right Menu', 'dga'),
        'primary' => __('Primary Mobile Menu', 'dga'),
        'footer'  => __('Footer Menu', 'dga'),
    ]);
});

// ==========================================================
// 6. Enable menus for all public CPTs
// ==========================================================
add_action('wp_loaded', function () {
    $post_types = get_post_types(['public' => true, '_builtin' => false], 'objects');
    foreach ($post_types as $pt) {
        $pt->show_in_nav_menus = true;
    }
});



// ==========================================================
// 8. Debug CPT output in admin logs
// ==========================================================
add_action('admin_init', function () {
    $pt = get_post_type_object('case-study');
    if ($pt) {
        error_log('CPT FOUND ✅');
        error_log('has_archive: ' . var_export($pt->has_archive, true));
        error_log('show_in_nav_menus: ' . var_export($pt->show_in_nav_menus, true));
    } else {
        error_log('CPT NOT FOUND ❌');
    }
});



// ==========================================================
// 9. Improve logo alt attribute handling
// ==========================================================
add_filter('get_custom_logo', function ($html) {
    $custom_logo_id = get_theme_mod('custom_logo');
    if (!$custom_logo_id) return $html;

    $alt = get_post_meta($custom_logo_id, '_wp_attachment_image_alt', true);
    if (empty($alt)) {
        $alt = get_bloginfo('name');
    }

    $html = preg_replace('/alt="[^"]*"/', 'alt="' . esc_attr($alt) . '"', $html);
    return $html;
});

// ==========================================================
// 10. Disable only the default WYSIWYG editor for Flexible Content pages
// ==========================================================
add_action('load-post.php', 'dga_disable_editor_for_flexible_template');
add_action('load-post-new.php', 'dga_disable_editor_for_flexible_template');

function dga_disable_editor_for_flexible_template() {
    $screen = get_current_screen();
    if (empty($screen) || $screen->post_type !== 'page') {
        return;
    }

    $post_id = isset($_GET['post']) ? (int) $_GET['post'] : (isset($_POST['post_ID']) ? (int) $_POST['post_ID'] : 0);
    if (!$post_id) return;

    
    

    // Disable Gutenberg (use Classic editor only)
    add_filter('use_block_editor_for_post', function ($use_block, $post) use ($post_id) {
        return ($post && (int)$post->ID === $post_id) ? false : $use_block;
    }, 10, 2);

    // Remove only the default WYSIWYG (Classic Editor) box
    add_action('admin_head', function () {
        remove_post_type_support('page', 'editor');
    });

    // Just to be safe, hide the #postdivrich (content box) only — NOT title or slug
    add_action('admin_head', function () {
        echo '<style>#postdivrich, .et_pb_toggle_builder_wrapper { display:none !important; }</style>';
    });
    
}