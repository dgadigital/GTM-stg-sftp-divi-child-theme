<?php
/**
 * Hero Banner Section
 * Layout: hero_banner_two_column
 */

$section_index = $args['section_index'] ?? 0;

// === Section ID Logic ===
$section_id = get_sub_field('section_id');
if (empty($section_id)) {
  $page_id    = get_the_ID();
  $section_id = 'page_' . $page_id . '-section_' . $section_index;
}

// === Section Styling Fields ===
$background_color = get_sub_field('background_color'); // Select (e.g. bg-white, bg-dark)
$background_image = get_sub_field('background_image'); // Image (array)
$font_color       = get_sub_field('font_color');       // Select (e.g. text-white, text-dark)

// === Section Content Fields ===
$intro_line       = get_sub_field('intro_line');
$headline         = get_sub_field('headline');
$tagline          = get_sub_field('tagline');
$image          = get_sub_field('image');
$form          = get_sub_field('form');

// === Early return if essential data missing ===
if (empty($headline) && empty($background_image)) return;
?>

<section
  id="<?= esc_attr($section_id); ?>"
  class="hero-banner-two-column section-<?= esc_attr($section_index); ?> <?= esc_attr($background_color . ' ' . $font_color); ?>"
  <?php if (!empty($background_image)): ?>
    style="background-image:url('<?= esc_url($background_image['url']); ?>');"
  <?php endif; ?>
>
  <div class="container hero-content">    
    <div class="hero-content-left hero-column">
        <?php if (!empty($intro_line)): ?>
        <span class="hero-intro"><?= esc_html($intro_line); ?></span>
        <?php endif; ?>
        <?php if (!empty($headline)): ?>
            <h1 class="hero-title"><?= wp_kses_post($headline); ?></h1>
        <?php endif; ?>
        <?php if (!empty($tagline)): ?>
            <div class="hero-tagline"><?= ($tagline); ?></div>
        <?php endif; ?>
        <div class="hero-buttons">
            <?php if (!empty($primary_button['url'])): ?>
            <a href="<?= esc_url($primary_button['url']); ?>"
                class="btn btn-primary"
                <?php if (!empty($primary_button['target'])) echo 'target="' . esc_attr($primary_button['target']) . '"'; ?>>
                <?= esc_html($primary_button['title']); ?>
            </a>
            <?php endif; ?>

            <?php if (!empty($secondary_button['url'])): ?>
            <a href="<?= esc_url($secondary_button['url']); ?>"
                class="btn btn-secondary"
                <?php if (!empty($secondary_button['target'])) echo 'target="' . esc_attr($secondary_button['target']) . '"'; ?>>
                <?= esc_html($secondary_button['title']); ?>
            </a>
            <?php endif; ?>
        </div>
    </div>
    <div class="hero-content-right hero-column">
        <?php if (!empty($image)): ?>
            <?= wp_get_attachment_image($image, 'full', false, ['alt' => esc_attr($headline)]); ?>
        <?php endif; ?>
        <?php if (!empty($form)): ?>
          <div class="form-wrapper">
            <?= do_shortcode($form); ?>
          </div>
        <?php endif; ?>
    </div>
  </div>
</section>
