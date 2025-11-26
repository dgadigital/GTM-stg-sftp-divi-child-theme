<?php
function dt_enqueue_styles() {
    $parenthandle = 'divi-style'; 
    $theme = wp_get_theme();
    wp_enqueue_style( $parenthandle, get_template_directory_uri() . '/style.css', 
        array(), // if the parent theme code has a dependency, copy it to here
        $theme->parent()->get('Version')
    );
    wp_enqueue_style( 'child-style', get_stylesheet_uri(),
        array( $parenthandle ),
        $theme->get('Version') 
    );
}
// add_action( 'wp_enqueue_scripts', 'dt_enqueue_styles' );
add_action( 'wp_enqueue_scripts', 'dt_enqueue_styles', 999 );

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

function add_testimonial_grid_css() {
    ?>
    <style>
        .testimonial-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin: 20px 0;
        }
		.star {
			font-size: 24px;
			color: #ccc;
		}

		.star.filled {
			color: gold;
		}
        .testimonial-item {
            background: #fff;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 15px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .testimonial-item:hover {
            transform: translateY(-5px);
        }

        .testimonial-image img {
            width: 100%;
            height: 150px;
            object-fit: contain;
        }

        .testimonial-name {
            font-size: 1.2em;
            font-weight: bold;
            margin: 10px 0;
        }

        .testimonial-content {
            font-size: 1em;
            color: #555;
        }
		@media (max-width: 768px) { /* For tablets and smaller devices */
			.testimonial-grid {
				grid-template-columns: 1fr; /* Single column */
			}
		}
    </style>
    <?php
}

add_action('wp_footer', 'add_testimonial_grid_css');


// ========================================================================================================================================================================================================

require_once get_stylesheet_directory() . '/inc/class-custom-walker-nav.php';
require_once get_stylesheet_directory() . '/inc/class-custom-walker-nav-mobile.php';

// ==========================================================
// 0. sige logo
// ==========================================================
function divi_child_theme_setup() {
  add_theme_support('post-thumbnails');
  add_theme_support('custom-logo', [
    'height'      => 100,
    'width'       => 400,
    'flex-height' => true,
    'flex-width'  => true,
  ]);
}
add_action('after_setup_theme', 'divi_child_theme_setup');




// ==========================================================
// 1. Conditionally enqueue Bootstrap, Slick, and Custom Theme Scripts
// ==========================================================
add_action('wp_enqueue_scripts', function () {
    // Only load custom assets if current page uses Flexible Content template
    if (!is_page_template('page-flexible-content.php')) {
        return;
    }

    // Ensure jQuery loads
    wp_enqueue_script('jquery');

    // Theme URI (safe for local/dev/prod)
$theme_uri = get_stylesheet_directory_uri();


    // --- Bootstrap ---
    wp_enqueue_style(
        'bootstrap-css',
        $theme_uri . '/assets/vendor/bootstrap/dist/css/bootstrap.min.css',
        ['child-style'],
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

    // --- Main Compiled Theme CSS ---
    $style_path  = get_stylesheet_directory() . '/assets/css/style.min.css';
    $bundle_path = get_stylesheet_directory() . '/assets/js/dist/bundle.min.js';

    if (file_exists($style_path)) {
        wp_enqueue_style(
            'acf-child-style',
            $theme_uri . '/assets/css/style.min.css',
            ['bootstrap-css', 'slick-theme-css'],
            filemtime($style_path)
        );
    }

    // --- Child Scripts (compiled JS bundle) ---
    if (file_exists($bundle_path)) {
        wp_enqueue_script(
            'acf-child-scripts',
            $theme_uri . '/assets/js/dist/bundle.min.js',
            ['jquery', 'bootstrap-js', 'slick-js'],
            filemtime($bundle_path),
            true
        );
    }

    error_log('✅ Custom assets enqueued for Flexible Content template.');
}, 30);



// Put this anywhere in functions.php (after your existing enqueue block is fine)
add_action('wp_enqueue_scripts', function () {
    if (!is_page_template('page-flexible-content.php')) return;

    // If our compiled CSS is already enqueued, bump it to the very end
    if (wp_style_is('acf-child-style', 'enqueued')) {
        wp_dequeue_style('acf-child-style');
        wp_enqueue_style('acf-child-style'); // re-enqueue with same src/deps/version
    }
}, 998);
// Remove Divi Customizer global CSS file from <head> on flexible pages only
add_action('template_redirect', function () {
    // Only run for Flexible Content template
    if (!is_page_template('page-flexible-content.php')) {
        return;
    }

    ob_start(function ($html) {
        // Remove both Divi-generated CSS links from output
        $patterns = [
            // 1. Global Divi Customizer CSS
            '#<link[^>]+et-cache/global/et-divi-customizer-global\.min\.css[^>]*>#i',

            // 2. Dynamic per-page Divi CSS (matches any numeric folder like 227155)
            '#<link[^>]+et-cache/\d+/et-divi-dynamic-\d+\.css[^>]*>#i',
        ];

        return preg_replace($patterns, '', $html);
    });
});


// ==========================================================
// 2. Ensure Divi’s own assets are untouched on other pages
// ==========================================================
// (No dequeue needed; Divi handles its own enqueues.)

// ==========================================================
// 3. Safety net – Force print enqueued JS in footer for ACF pages
// ==========================================================
add_action('wp_footer', function () {
    if (is_page_template('page-flexible-content.php')) {
        wp_print_scripts(['bootstrap-js', 'slick-js', 'child-scripts']);
    }
}, 100);

// ==========================================================
// 4. Save and Load ACF JSON for version control
// ==========================================================
add_filter('acf/settings/save_json', function ($path) {
    return get_stylesheet_directory() . '/acf-json';
});

add_filter('acf/settings/load_json', function ($paths) {
    unset($paths[0]);
    $paths[] = get_stylesheet_directory() . '/acf-json';
    return $paths;
});

// ==========================================================
// 5. Register Primary Navigation Menu
// ==========================================================
add_action('after_setup_theme', function () {
    register_nav_menus([
        'left'    => __('Left Menu', 'divi-child'),
        'right'   => __('Right Menu', 'divi-child'),
        'primary' => __('Primary Mobile Menu', 'divi-child'),
        'footer'  => __('Footer Menu', 'divi-child'),
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
// 7. Force ACF-created CPTs to have archives + menus
// ==========================================================
// add_action('acf/init', function () {
//     add_action('wp_loaded', function () {
//         $post_types = get_post_types(['public' => true, '_builtin' => false], 'objects');
//         foreach ($post_types as $pt) {
//             $pt->has_archive = true;
//             $pt->show_in_nav_menus = true;
//         }
//     }, 20);
// });

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

add_action('wp_enqueue_scripts', function () {
    error_log('✅ wp_enqueue_scripts is running for Divi Child');
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

    $template_file = get_page_template_slug($post_id);
    if ($template_file !== 'page-flexible-content.php') {
        return;
    }

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




// ==========================================================================
// Enqueue: Divi Additional Script (for default page templates)
// ==========================================================================
add_action('wp_enqueue_scripts', function () {
    // Only run on pages that use the default page template
    if (!is_page_template('default')) {
        return;
    }

    // Ensure jQuery is available
    wp_enqueue_script('jquery');

    $theme_uri  = get_stylesheet_directory_uri();
    $script_path = get_stylesheet_directory() . '/assets/js/divi-additional.js';

    if (file_exists($script_path)) {
        wp_enqueue_script(
            'divi-additional',
            $theme_uri . '/assets/js/divi-additional.js',
            ['jquery'],
            filemtime($script_path),
            true // load in footer
        );
    }
}, 40);





