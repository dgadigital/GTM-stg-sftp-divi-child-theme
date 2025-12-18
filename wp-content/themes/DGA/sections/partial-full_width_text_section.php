<?php
$background_color = get_sub_field('background_color') ?: '';
$title       = get_sub_field('title') ?: '';
$description = get_sub_field('description') ?: '';
// $content_text_size_class = get_sub_field('content_text_size_class') ?: '';

if (empty($title) && empty($description)) {
  return;
}
?>

<section class="full-width-text-section <?= esc_attr($background_color); ?>">
  <div class="container">
    <div class="content-wrapper text-center">

      <?php if (!empty($title)) : ?>
        <h2><?= esc_html($title); ?></h2>
      <?php endif; ?>

      <?php if (!empty($description)) : ?>
        <div class="content-text-wrapper small">
          <?= wp_kses_post($description); ?>
        </div>
        
      <?php endif; ?>

    </div>
  </div>
</section>
