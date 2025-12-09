<?php
/**
 * Partial: Bottom CTA Banner
 */

$args = $args ?? [];
$section_index = isset($args['section_index']) ? (int)$args['section_index'] : 0;

// ============================
// ACF Fields
// ============================

// Image (ID, Array, or URL)
$background_image = get_sub_field('background_image');

// Text fields
$title       = get_sub_field('title') ?: '';
$description = get_sub_field('description') ?: '';
$small_text  = get_sub_field('small_text') ?: '';

// Link (Array)
$button = get_sub_field('button');

// ============================
// Section ID Logic
// ============================
$section_id = get_sub_field('section_id');
if (empty($section_id)) {
    $page_id    = get_the_ID();
    $section_id = 'page_' . $page_id . '-section_' . $section_index;
}

// ============================
// Early Return
// ============================
if (
    empty($background_image) &&
    empty($title) &&
    empty($description) &&
    empty($button) &&
    empty($small_text)
) {
    return;
}

// ============================
// Background Image Handling
// ============================
$bg_url = '';

if (!empty($background_image)) {
    if (is_array($background_image) && isset($background_image['url'])) {
        $bg_url = $background_image['url'];                  // Image array
    } elseif (is_numeric($background_image)) {
        $bg_url = wp_get_attachment_image_url($background_image, 'full'); // ID
    } elseif (is_string($background_image)) {
        $bg_url = $background_image;                         // Direct URL
    }
}

$bg_style = $bg_url ? 'style="background-image: url(' . esc_url($bg_url) . ');"' : '';

?>

<section 
  id="<?= esc_attr($section_id); ?>" 
  class="bottom-cta-banner section-<?= esc_attr($section_index); ?>" 
  <?= $bg_style; ?>
>
  <div class="container">
    <div class="content-wrapper text-center">

      <?php if (!empty($title)) : ?>
        <h2><?= esc_html($title); ?></h2>
      <?php endif; ?>

      <?php if (!empty($description)) : ?>
        <div class="description">
          <?= wp_kses_post($description); ?>
        </div>
      <?php endif; ?>

      <?php if (!empty($button)) : ?>
        <a 
          href="<?= esc_url($button['url']); ?>" 
          target="<?= esc_attr($button['target'] ?: '_self'); ?>" 
          class="btn btn-tertiary"
        >
          <?= esc_html($button['title']); ?>
        </a>
      <?php endif; ?>

      <?php if (!empty($small_text)) : ?>
        <p class="small-bottom"><?= esc_html($small_text); ?></p>
      <?php endif; ?>

    </div>
  </div>
</section>
