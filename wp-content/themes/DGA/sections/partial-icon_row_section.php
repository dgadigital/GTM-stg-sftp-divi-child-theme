<?php
if (empty(get_row_layout())) return;

$section_index = $args['section_index'] ?? 0;

// === ACF Fields: Section Settings (SEAMLESS CLONE) ===
$section_id       = get_sub_field('section_id');
$background_color = get_sub_field('section_background');
$font_color       = get_sub_field('font_color');

// Section ID fallback
if (empty($section_id)) {
    $page_id    = get_the_ID();
    $section_id = 'page_' . $page_id . '-section_' . $section_index;
}

// === Other ACF Fields ===
$items         = get_sub_field('items');
$title         = get_sub_field('title');
$description   = get_sub_field('description');
$bottom_text   = get_sub_field('bottom_text');
$header_layout = get_sub_field('header_layout') ?: 'row';
$title_size    = get_sub_field('title_size') ?: 'large';

// Early return
if (empty($items) && empty($title) && empty($description) && empty($bottom_text)) {
    return;
}

// detect if any icon exists
$has_icon = false;
if (!empty($items)) {
    foreach ($items as $item) {
        if (!empty($item['icon'])) {
            $has_icon = true;
            break;
        }
    }
}

$icon_class = $has_icon ? 'with-icon' : 'no-icon';

$icon_shit = $has_icon ? '' : 'align-items-center';
?>

<section id="<?= $section_id; ?>"
  class="icon-row-section section-<?= $section_index; ?> <?= trim("$background_color $font_color $icon_class header-$header_layout"); ?>">

  <div class="container">

    <div class="section-header">
      <?php if (!empty($title)) : ?>
        <h2 class="section-title"><?= $title; ?></h2>
      <?php endif; ?>

      <?php if (!empty($description)) : ?>
        <div class="section-description">
          <?= $description; ?>
        </div>
      <?php endif; ?>
    </div>

    <div class="icons-wrapper">
      <?php if (!empty($items)) : ?>
        <?php foreach ($items as $item) :
          $icon   = $item['icon'] ?? '';
          $ititle = $item['title'] ?? '';
          $text   = $item['text'] ?? '';

          if (empty($icon) && empty($ititle) && empty($text)) continue;
        ?>
          <div class="item">
            <div class="item-wrapper">
              <?php if (!empty($icon) || !empty($ititle)) : ?>
                <div class="icon-group">
    
                  <?php if (!empty($icon)) : ?>
                    <?php if (is_numeric($icon)) : ?>
                      <?= wp_get_attachment_image($icon, 'full'); ?>
                    <?php else : ?>
                      <img src="<?= $icon; ?>">
                    <?php endif; ?>
                  <?php endif; ?>
    
                  <?php if (!empty($ititle)) : ?>
                    <p class="title title-<?= $title_size; ?>"><?= $ititle; ?></p>
                  <?php endif; ?>
    
                </div>
              <?php endif; ?>
              <?php if (!empty($text)) : ?>
                <p class="description"><?= $text; ?></p>
              <?php endif; ?>
            </div>
            

          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>

    <?php if (!empty($bottom_text)) : ?>
      <div class="bottom-text">
        <?= $bottom_text; ?>
      </div>
    <?php endif; ?>

  </div>
</section>
