<?php
if (empty(get_row_layout())) return;

$section_index = $args['section_index'] ?? 0;

// === Section ID Logic ===
$section_id = get_sub_field('section_id');
if (empty($section_id)) {
  $page_id    = get_the_ID();
  $section_id = 'page_' . $page_id . '-section_' . $section_index;
}

// === ACF Fields ===
$section_title        = get_sub_field('section_title');
$section_description  = get_sub_field('section_description');
$block_wrapper_title  = get_sub_field('block_wrapper_title');
$background_color     = get_sub_field('background_color');
$font_color           = get_sub_field('font_color');
$blocks               = get_sub_field('blocks');
$content_source       = get_sub_field('content_source') ?: 'sectors';
$bottom_btn           = get_sub_field('bottom_btn');
$column_layout        = get_sub_field('column_layout');
$exclude_post         = get_sub_field('exclude_post');
$text_align         = get_sub_field('text_align');
$flex_classes = ($text_align === 'text-start') ? 'left d-flex justify-content-between align-items-start flex-column flex-lg-row' : 'center d-flex justify-content-center align-items-center flex-column flex-lg-column';
?>

<section
  id="<?= esc_attr($section_id); ?>"
  class="icon-column-section section-<?= esc_attr($section_index); ?> <?= esc_attr($background_color . ' ' . $font_color . ' ' . $column_layout); ?>"
>

  <div class="container">
    <?php if (!empty($section_title) || !empty($section_description)) : ?>
      <div class="section-header <?=  $flex_classes ?>">
        <?php if (!empty($section_title)): ?>
          <h2 class="section-title <?= $font_color .' '.$text_align ?> "><?= esc_html($section_title); ?></h2>
        <?php endif; ?>

        <?php if (!empty($section_description)): ?>
          <div class="section-description <?= $font_color ?>">
            <?= wp_kses_post($section_description); ?>
          </div>
        <?php endif; ?>
      </div>
    <?php endif; ?>

    <?php if (!empty($block_wrapper_title)): ?>
      <h3 class="block-wrapper-title <?= $font_color ?>"><?= esc_html($block_wrapper_title); ?></h3>
    <?php endif; ?>


    <?php
    // ==========================================================
    // OPTION 1 → Auto pull from CPT "sector"
    // ==========================================================
    if ($content_source === 'sectors') :

      $current_id = get_the_ID();
      $exclude_current = is_singular('sector') ? [$current_id] : [];

      $sectors = new WP_Query([
        'post_type'      => 'sector',
        'posts_per_page' => -1,
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
        'post_status'    => 'publish',
        'post__not_in'   => $exclude_current,
      ]);

      if ($sectors->have_posts()) :
    ?>
        <div class="row icon-blocks">
          <?php while ($sectors->have_posts()) : $sectors->the_post();

            $sector_icon  = get_field('sector_icon');
            $sector_title = get_the_title();
            $sector_desc  = get_field('sector_description') ?: get_the_excerpt();

          ?>
            <a href="<?= esc_url(get_permalink()); ?>" class="icon-block">
              <div class="icon-block-inner">

                <?php if (!empty($sector_icon)): ?>
                  <div class="icon-wrapper">
                    <?= wp_get_attachment_image($sector_icon, 'medium', false, [
                        'class' => 'icon',
                        'alt'   => esc_attr($sector_title)
                    ]); ?>
                  </div>
                <?php endif; ?>

                <div class="block-text-wrapper">
                  <h4 class="block-title"><?= esc_html($sector_title); ?></h4>
                  <?php if (!empty($sector_desc)): ?>
                    <div class="block-description"><?= wp_kses_post($sector_desc); ?></div>
                  <?php endif; ?>
                </div>

              </div>
            </a>

          <?php endwhile; wp_reset_postdata(); ?>
        </div>
      <?php endif; ?>


    <?php
    // ==========================================================
    // OPTION 2 → Auto pull from CPT "services"
    // ==========================================================
    elseif ($content_source === 'services') :

      $exclude_ids = [];
      if (!empty($exclude_post)) {
        foreach ($exclude_post as $p) {
            $exclude_ids[] = is_object($p) ? $p->ID : (int)$p;
        }
      }

      $services = new WP_Query([
        'post_type'      => 'services',
        'posts_per_page' => -1,
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
        'post_status'    => 'publish',
        'post__not_in'   => $exclude_ids,
      ]);

      if ($services->have_posts()) :
    ?>
        <div class="row icon-blocks">
          <?php while ($services->have_posts()) : $services->the_post();

            // Same ACF fields as sectors
            $sector_icon  = get_field('sector_icon');
            $sector_title = get_the_title();
            $sector_desc  = get_field('sector_description') ?: get_the_excerpt();

          ?>
            <a href="<?= esc_url(get_permalink()); ?>" class="icon-block">
              <div class="icon-block-inner">

                <?php if (!empty($sector_icon)): ?>
                  <div class="icon-wrapper">
                    <?= wp_get_attachment_image($sector_icon, 'medium', false, [
                        'class' => 'icon',
                        'alt'   => esc_attr($sector_title)
                    ]); ?>
                  </div>
                <?php endif; ?>

                <div class="block-text-wrapper">
                  <h4 class="block-title"><?= esc_html($sector_title); ?></h4>
                  <?php if (!empty($sector_desc)): ?>
                    <div class="block-description"><?= wp_kses_post($sector_desc); ?></div>
                  <?php endif; ?>
                </div>

              </div>
            </a>

          <?php endwhile; wp_reset_postdata(); ?>
        </div>
      <?php endif; ?>


    <?php
    // ==========================================================
    // OPTION 3 → Manual Repeater
    // ==========================================================
    elseif ($content_source === 'manual' && !empty($blocks)) :
    ?>

      <div class="row icon-blocks">
        <?php foreach ($blocks as $block):

          $icon              = $block['icon']['url'] ?? '';
          $block_title       = $block['block_title'] ?? '';
          $block_description = $block['block_description'] ?? '';
          $page_link         = $block['page_link']['url'] ?? '';

        // Determine wrapper element
      $has_link = !empty($page_link);

      // Open wrapper (a or div)
      echo $has_link
        ? '<a href="' . esc_url($page_link) . '" class="icon-block">'
        : '<div class="icon-block">';
    ?>
            <div class="icon-block-inner">

              <?php if (!empty($icon)): ?>
                <div class="icon-wrapper">
                  <img src="<?= esc_url($icon); ?>" class="icon" alt="<?= esc_attr($block_title ?: 'Icon'); ?>">
                </div>
              <?php endif; ?>

              <div class="block-text-wrapper">
                <?php if (!empty($block_title)): ?>
                  <h4 class="block-title"><?= esc_html($block_title); ?></h4>
                <?php endif; ?>

                <?php if (!empty($block_description)): ?>
                  <div class="block-description"><?= wp_kses_post($block_description); ?></div>
                <?php endif; ?>
              </div>

            </div>
          <?php
      // Close wrapper
      echo $has_link ? '</a>' : '</div>';

    endforeach; ?>
      </div>

    <?php endif; ?>

  </div>

  <?php if (!empty($bottom_btn)): ?>
    <div class="container">
      <div class="section-button text-center mt-4">
        <a href="<?= $bottom_btn['url'] ?>" class="btn btn-tertiary"><?= $bottom_btn['title'] ?></a>
      </div>
    </div>
  <?php endif; ?>

</section>

