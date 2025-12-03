<?php
/**
 * Block Hover Slider Section
 */

// ============================
// ACF FIELDS
// ============================
$section_index = $args['section_index'] ?? 0;

// === Section ID Logic ===
$section_id = get_sub_field('section_id');
if (empty($section_id)) {
  $page_id    = get_the_ID();
  $section_id = 'page_' . $page_id . '-section_' . $section_index;
}

// === Section Styling Fields ===
$background_color = get_sub_field('background_color'); // e.g. bg-white, bg-dark
$font_color       = get_sub_field('font_color');       // e.g. text-dark, text-light


$section_title       = get_sub_field('section_title');      // Text
$section_description = get_sub_field('section_description'); // Text
$items               = get_sub_field('blocks');              // Repeater (array)

// Skip if nothing to show
if (empty($items)) return;


?>

<section id="<?= esc_attr($section_id); ?>" class="block-hover section-<?php echo esc_attr($section_index); ?> <?php echo esc_attr(trim($background_color . ' ' . $font_color)); ?>">
  <div class="container content-wrapper">

    <?php if ($section_title || $section_description) : ?>
      <div class="section-header">

        <?php if ($section_title) : ?>
          <h2 class="section-title">
            <?php echo esc_html($section_title); ?>
          </h2>
        <?php endif; ?>

        <?php if ($section_description) : ?>
          <div class="section-description">
            <?php echo esc_html($section_description); ?>
          </div>
        <?php endif; ?>

      </div>
    <?php endif; ?>

    <div class="section-card-slider">

      <?php foreach ($items as $item) :

        $link       = $item['page_link'] ?? [];
        $image      = $item['background_image'] ?? '';
        $icon       = $item['icon'] ?? '';
        $title      = $item['title'] ?? '';
        $short_text = $item['short_text'] ?? '';
        $long_text  = $item['long_text'] ?? '';

        // Skip item if no link
        if (empty($link['url'])) continue;
      ?>
      
        <a href="<?php echo esc_url($link['url']); ?>"
           class="card"
           target="<?php echo esc_attr($link['target'] ?? '_self'); ?>"
           tabindex="0">

          <?php if ($image) : ?>
            <div class="card-image">
              <?php
                // FULL image, no reduction, preserves original image size
                echo wp_get_attachment_image(
                  $image,
                  'full',
                  false,
                  [
                    'alt' => esc_attr($title),
                  ]
                );
              ?>
            </div>
          <?php endif; ?>

          <div class="card-content">
            <div class="content-wrap">

              <?php if ($icon) : ?>
                <div class="icon">
                  <?php
                    echo wp_get_attachment_image(
                      $icon,
                      'full',
                      false,
                      [
                        'alt' => esc_attr($title),
                      ]
                    );
                  ?>
                </div>
              <?php endif; ?>

              <?php if ($title) : ?>
                <h3 class="section-title <?php echo esc_attr(trim($font_color)); ?>">
                  <?php echo esc_html($title); ?>
                </h3>
              <?php endif; ?>

              <?php if ($short_text) : ?>
                <div class="short section-description <?php echo esc_attr(trim($font_color)); ?>">
                  <?php echo esc_html($short_text); ?>
                </div>
              <?php endif; ?>

              <?php if ($long_text) : ?>
                <div class="long">
                  <?php echo esc_html($long_text); ?>
                </div>
              <?php endif; ?>

              <?php if (!empty($link['title'])): ?>
                <div class="btn-wrapper">
                  <span class="btn btn-primary">
                    <?php echo esc_html($link['title']); ?>
                  </span>
                </div>
              <?php endif; ?>


            </div>
          </div>

        </a>

      <?php endforeach; ?>

    </div><!-- .section-card-slider -->

  </div><!-- .container -->
</section>
