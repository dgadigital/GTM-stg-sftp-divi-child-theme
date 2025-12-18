<?php
/**
 * Partial:News Hub
 */
$args = $args ?? [];
$section_index = isset($args['section_index']) ? (int)$args['section_index'] : 0;



// ============================
// ACF SECTION SETTINGS (Seamless clone)
// ============================

$section_title       = get_sub_field('section_title') ?: '';
$section_description = get_sub_field('section_description') ?: '';
$section_background  = get_sub_field('section_background') ?: '';
$font_color          = get_sub_field('font_color') ?: '';


// === Section ID Logic ===
$section_id = get_sub_field('section_id');
if (empty($section_id)) {
  $page_id    = get_the_ID();
  $section_id = 'page_' . $page_id . '-section_' . $section_index;
}


// If absolutely nothing to show and no posts, bail
global $wp_query;



?>

<section id="<?= esc_attr($section_id); ?>"   class="news-hub section-<?= esc_attr($section_index); ?> <?= esc_attr(trim($section_background . ' ' . $font_color)); ?>">
  <div class="container content-wrapper">

    <?php if (!empty($section_title) || !empty($section_description)) : ?>
      <div class="section-header">

        <?php if (!empty($section_title)) : ?>
          <h2 class="section-title">
            <?= esc_html($section_title); ?>
          </h2>
        <?php endif; ?>

        <?php if (!empty($section_description)) : ?>
          <div class="section-description">
            <?= wp_kses_post($section_description); ?>
          </div>
        <?php endif; ?>

      </div>
    <?php endif; ?>

<div class="news-content-wrapper">

  <?php
  // SAFER PAGED VALUE
  $paged = max( 1, get_query_var('paged'), get_query_var('page') );

  // ==========================
  // news QUERY
  // ==========================
  $news_query = new WP_Query([
    'post_type'      => 'post',     // ✔ CPT with hyphen
    'posts_per_page' => 6,
    'post_status'    => 'publish',
    'paged'          => $paged
  ]);

  if ($news_query->have_posts()) :
  ?>

    <div class="news-items">

      <?php while ($news_query->have_posts()) : $news_query->the_post(); ?>

        <a href="<?php the_permalink(); ?>" class="news-class">
            <div class="logo-wrapper">
                <?php 
                if (has_post_thumbnail()) {
                the_post_thumbnail('medium', [
                    'alt'   => esc_attr(get_the_title()),
                    'class' => 'img-fluid'
                ]);
                }
                ?>
            </div>
            <div class="news-class-content">
                <div class="text-content-wrapper">
                    <h4 class="news-title"><?php the_title(); ?></h4>
                    <div class="date-wrapper">
                        <?= esc_html( get_the_date('j M Y') ); ?>
                    </div>
                    <div class="excerpt-wrapper">
                    <?php
                        // 1. Get raw post content
                        $raw = get_the_content();
        
                        // 2. Remove Divi shortcodes [et_pb_*] and closing tags [/et_pb_*]
                        $clean = preg_replace('/\[(\/?et_pb_[^\]]*)\]/', '', $raw);
        
                        // 3. Remove any leftover shortcodes like [et_pb_column ...] etc.
                        $clean = strip_shortcodes($clean);
        
                        // 4. Remove weird inline span props like <span data-...>
                        $clean = preg_replace('/<span[^>]*data-[^>]*>/', '', $clean);
                        $clean = str_replace('</span>', '', $clean);
        
                        // 5. Strip all HTML tags (keeps plain text only)
                        $clean = wp_strip_all_tags($clean);
        
                        // 6. Trim to 20 words
                        $clean_excerpt = wp_trim_words($clean, 20);
                    ?>
                    <p><?= esc_html($clean_excerpt); ?></p>
                    </div>
                </div>
                <div class="btn-wrapper">
                <span class="read-more-btn">Read more</span>    
                </div>
            </div>
        </a>

      <?php endwhile; ?>

    </div><!-- .news-items -->

    <?php
    // ==========================
    // SAFE PAGINATION
    // ==========================
    $pagination = paginate_links([
      'total'        => $news_query->max_num_pages,
      'current'      => $paged,
      'mid_size'     => 2,
      'prev_text'    => '',
      'next_text'    => '',
      'type'         => 'plain'
    ]);

    // Only output pagination if valid HTML exists
    if ($pagination) :?>
      <div class="news-pagination">
        <?= wp_kses_post($pagination); ?>
      </div>
    <?php endif; ?>

  <?php endif; ?>

  <?php wp_reset_postdata(); ?>

</div><!-- .news-content-wrapper -->



  </div><!-- .container -->  
</section>
