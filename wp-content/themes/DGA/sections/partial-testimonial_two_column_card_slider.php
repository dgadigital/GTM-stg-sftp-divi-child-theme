<?php /* testimonial_two_column_card_slider */ ?>
<?php
if (empty(get_row_layout())) return;

$section_index = $args['section_index'] ?? 0;

/* ---------------------------------------------
   Section ID Logic
--------------------------------------------- */
$section_id = get_sub_field('section_id');
if (empty($section_id)) {
  $page_id    = get_the_ID();
  $section_id = 'page_' . $page_id . '-section_' . $section_index;
}

/* ---------------------------------------------
   Styling Fields
--------------------------------------------- */
$background_color = get_sub_field('section_background'); // bg-gray-150 etc
$font_color       = get_sub_field('font_color');       // text-dark text-white etc

/* ---------------------------------------------
   Section Content
--------------------------------------------- */
$section_title = get_sub_field('section_title');       // heading only (no subtitle)
$post_limit    = get_sub_field('post_limit') ?: -1;    // optional limit
?>
<section
  id="<?= esc_attr($section_id); ?>"
  class="testimonial-two-column-card-slider section-<?= esc_attr($section_index); ?> <?= esc_attr($background_color . ' ' . $font_color); ?>"
>
  <div class="container">

    <?php if ($section_title): ?>
      <div class="section-title text-center">
        <h2><?= esc_html($section_title); ?></h2>
      </div>
    <?php endif; ?>


    <!-- Two Column Slider -->
    <div class="testimonial-two-column-card-slider-wrapper">
      <div class="two-column-card-slider">

        <?php
        // Pull from CPT instead of ACF repeater
        $testimonials = new WP_Query([
          'post_type'      => 'spt_testimonial', // ← your CPT name
          'posts_per_page' => $post_limit,
          'post_status'    => 'publish',
        ]);

        if ($testimonials->have_posts()):
          while ($testimonials->have_posts()):
            $testimonials->the_post();
            $post_id = get_the_ID();

            // meta based on your plugin structure
            $meta = get_post_meta($post_id, 'sp_tpro_meta_options', true);
            $meta = maybe_unserialize($meta);

            // Get full content with formatting
            $full_content = wp_strip_all_tags(apply_filters('the_content', get_the_content()));

            // Extract first 2 sentences
            $sentences = preg_split('/(\.|\!|\?)\s/', $full_content, 3, PREG_SPLIT_DELIM_CAPTURE);

            $excerpt = '';
            if (!empty($sentences[0])) {
                $excerpt .= $sentences[0] . (isset($sentences[1]) ? $sentences[1] : '') . '.';
            }
            if (isset($sentences[2])) {
                $excerpt .= ' ' . $sentences[2]; // second sentence + punctuation
            }


            $client_name   = $meta['tpro_name'] ?? '';
            $logo_image    = get_the_post_thumbnail_url($post_id, 'medium'); // logo or face
            $video = get_field('testimonial_video', $post_id); // ACF source now
            $testimonial_video_poster = get_field('testimonial_video_poster', $post_id); // ACF source now
        ?>

          <div class="testimonial-card">
            <div class="card-row">

              <!-- Left: Video -->
              <div class="video-col card-row-column">
                <div class="video-wrapper">
                  <?php if (!empty($video)): ?>

                    <video
                      class="testimonial-video"
                      controls
                      preload="metadata"
                      <?php if (!empty($testimonial_video_poster)): ?>
                        poster="<?= esc_url($testimonial_video_poster); ?>"
                      <?php endif; ?>
                    >
                      <source src="<?= esc_url($video); ?>" type="video/mp4">
                    </video>

                  <?php elseif (!empty($testimonial_video_poster)): ?>
                    <img
                      src="<?= esc_url($testimonial_video_poster); ?>"
                      alt="<?= esc_attr($client_name ?: 'Client testimonial'); ?>"
                      class="testimonial-video-placeholder"
                      loading="lazy"
                    >
                  <?php endif; ?>

                </div>

              </div>

              <!-- Right: Content -->
              <div class="details-col card-row-column">
                <div class="details-col-inner text-left">
                    
                  <?php if ($full_content): ?>
                    <div class="testimonial"><?= esc_html($excerpt) ?></div>
                  <?php endif; ?>

                  <div class="details-col-bottom-card-wrapper">
                    <?php if ($client_name): ?>
                      <h3><?= esc_html($client_name) ?></h3>
                    <?php endif; ?>

                    <?php if ($logo_image): ?>
                      <div class="logo-wrapper">
                        <img src="<?= esc_url($logo_image) ?>" alt="<?= esc_attr($client_name); ?>">
                      </div>
                    <?php endif; ?>
                  </div>

                </div>
              </div>

            </div>
          </div>

        <?php endwhile; wp_reset_postdata(); endif; ?>

      </div>
    </div>

  </div>
</section>
