<?php
/**
 * Partial: Case Study Hub (ARCHIVE SAFE)
 */

$args = $args ?? [];
$section_index = $args['section_index'] ?? 0;

// Archive-safe section ID
$section_id = 'case-study-hub-' . $section_index;

// Bail ONLY if no posts exist
if (!have_posts()) {
  return;
}
?>

<section id="<?= esc_attr($section_id); ?>" class="case-study-hub text-dark bg-gray-150">
  <div class="container content-wrapper">

    <div class="section-header">
      <h2 class="section-title">Real stories. Real coverage. Real results xtest</h2>
      <div class="section-description">
        Every client you see here came to us with a challenge — to grow faster, speak louder, or take control of their message. We helped them break through the noise and own their space.
      </div>
    </div>

    <div class="case-study-content-wrapper">

      <div class="case-study-items">

        <?php while (have_posts()) : the_post(); ?>

          <div class="case-study-class">

            <div class="logo-wrapper">
              <?php if (has_post_thumbnail()) :
                the_post_thumbnail('medium', [
                  'alt'   => esc_attr(get_the_title()),
                  'class' => 'img-fluid'
                ]);
              endif; ?>
            </div>

            <div class="excerpt-wrapper">
              <p><?= esc_html(wp_trim_words(get_the_excerpt(), 20)); ?></p>
            </div>

            <div class="data-display-wrapper">

              <?php
              $terms = get_the_term_list(get_the_ID(), 'industry', '', ', ');
              if ($terms && !is_wp_error($terms)) :
              ?>
                <span class="data-item"><?= wp_kses_post($terms); ?></span>
              <?php endif; ?>

              <?php if ($percentage = get_field('percentage')) : ?>
                <span class="percentage"><?= esc_html($percentage); ?></span>
              <?php endif; ?>

              <a href="<?= esc_url(get_permalink()); ?>" class="learn-more-btn">
                Learn more
              </a>

            </div>

          </div>

        <?php endwhile; ?>

      </div>

      <?php
      global $wp_query;

      $pagination = paginate_links([
        'total'      => $wp_query->max_num_pages,
        'current'    => max(1, get_query_var('paged')),
        'mid_size'   => 2,
        'prev_text'  => '',
        'next_text'  => '',
        'type'       => 'plain',
      ]);

      if ($pagination) : ?>
        <div class="case-study-pagination">
          <?= wp_kses_post($pagination); ?>
        </div>
      <?php endif; ?>

    </div>

  </div>
</section>