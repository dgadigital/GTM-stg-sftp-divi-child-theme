<?php
$background_color = get_sub_field('background_color') ?: '';
$title       = get_sub_field('title') ?: '';
$description = get_sub_field('description') ?: '';

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
        <p><?= wp_kses_post($description); ?></p>
      <?php endif; ?>

    </div>
  </div>
</section>
