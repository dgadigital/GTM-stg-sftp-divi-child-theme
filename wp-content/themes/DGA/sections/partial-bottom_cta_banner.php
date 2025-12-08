<?php
$background_image = get_sub_field('background_image');
$title       = get_sub_field('title') ?: '';
$description = get_sub_field('description') ?: '';
$small_text  = get_sub_field('small_text') ?: '';
$button      = get_sub_field('button');

if (
    empty($background_image) &&
    empty($title) &&
    empty($description) &&
    empty($button) &&
    empty($small_text)
) {
    return;
}

$bg_style = '';
if (!empty($background_image)) {
  $bg_style = sprintf(
    'style="background-image: url(%s);"',
    esc_url(wp_get_attachment_image_url($background_image, 'full'))
  );
}
?>

<section class="bottom-cta-banner" <?= $bg_style; ?>>
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

      <?php if (!empty($button)) : 
        $btn_url    = esc_url($button['url']);
        $btn_title  = esc_html($button['title']);
        $btn_target = esc_attr($button['target'] ?: '_self');
      ?>
        <a href="<?= $btn_url; ?>" target="<?= $btn_target; ?>" class="btn btn-tertiary">
          <?= $btn_title; ?>
        </a>
      <?php endif; ?>

      <?php if (!empty($small_text)) : ?>
        <p class="small-bottom"><?= esc_html($small_text); ?></p>
      <?php endif; ?>
      
    </div>
  </div>
</section>
