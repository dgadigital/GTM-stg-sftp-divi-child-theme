<?php
/**
 * Partial: Case Study Hub
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

if (empty($section_title) && empty($section_description) && empty($wp_query->posts)) {
    return;
}

?>

<section 
  id="<?= esc_attr($section_id); ?>" 
  class="case-study-hub section-<?= esc_attr($section_index); ?> <?= esc_attr(trim($section_background . ' ' . $font_color)); ?>"
>
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


    <div class="case-study-content-wrapper">

<?php
$paged = get_query_var('paged') ?: 1;

$case_query = new WP_Query([
  'post_type'      => 'case_study',
  'posts_per_page' => 6,
  'paged'          => $paged
]);

if ($case_query->have_posts()) :
?>
  <div class="case-study-items">

    <?php while ($case_query->have_posts()) : $case_query->the_post(); ?>

      <div class="case-study-class">

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

        <div class="excerpt-wrapper">
          <p><?= esc_html( wp_trim_words(get_the_excerpt(), 20) ); ?></p>
        </div>

        <div class="data-display-wrapper">
          <?php 
            $terms = get_the_term_list(get_the_ID(), 'industry', '', ', ');
            if ($terms) :
          ?>
            <span class="data-item"><?= wp_kses_post($terms); ?></span>
          <?php endif; ?>
          <a href="<?= esc_url(get_permalink()); ?>" class="learn-more-btn">Learn more</a>
        </div>

      </div>

    <?php endwhile; ?>

  </div>

  <div class="case-study-pagination">
    <?= paginate_links([
      'total'        => $case_query->max_num_pages,
      'current'      => $paged,
      'mid_size'     => 2,
      'prev_text'    => '',
      'next_text'    => '',
      'type'         => 'plain'
    ]); ?>
  </div>

<?php else : ?>

  <p>No case studies found.</p>

<?php endif; ?>

<?php wp_reset_postdata(); ?>


    </div><!-- .case-study-content-wrapper -->

  </div><!-- .container -->
  <?php wp_reset_postdata(); ?>
</section>
