<?php /* section_title_bar */ ?> 
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
$section_title        = get_sub_field('section_title');        // Text
$section_description  = get_sub_field('section_description');  // WYSIWYG
$background_color     = get_sub_field('background_color');     // Select (bg-*)
$font_color           = get_sub_field('font_color');           // Select (text-*)
$section_content      = get_sub_field('section_content');  // WYSIWYG
?>

<section id="<?= esc_attr($section_id); ?>" class="section-title-bar section-<?= esc_attr($section_index); ?> <?= esc_attr($background_color . ' ' . $font_color . ' ' . $column_layout); ?>">
  <div class="container">
    <div class="section-header d-flex justify-content-between align-items-start flex-column flex-lg-row">
      <?php if (!empty($section_title)): ?>
        <h2 class="section-title <?= $font_color?>"><?= esc_html($section_title); ?></h2>
      <?php endif; ?>

      <?php if (!empty($section_description)): ?>
        <div class="section-description <?= $font_color?>">
          <?= wp_kses_post($section_description); ?>
        </div>
      <?php endif; ?>
    </div>

    <?php if (!empty($section_content)): ?>
        <div class="section-text-content <?= $font_color?>">
          <?= wp_kses_post($section_content); ?>
        </div>
    <?php endif; ?>
  </div>
</section>
