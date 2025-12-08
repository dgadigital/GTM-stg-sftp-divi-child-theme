<?php
$items = get_sub_field('items');

if (empty($items)) {
  return;
}

// detect if any icon exists
$has_icon = false;
foreach ($items as $item) {
  if (!empty($item['icon'])) {
    $has_icon = true;
    break;
  }
}

$icon_class = $has_icon ? 'with-icon' : 'no-icon';

$title       = get_sub_field('title');
$description = get_sub_field('description');
$bottom_text = get_sub_field('bottom_text');
?>

<section class="icon-row-section bg-white <?= $icon_class; ?>">
  <div class="container">

    <div class="section-header d-flex justify-content-between align-items-start flex-column flex-lg-row">
      <?php if (!empty($title)) : ?>
        <h2 class="section-title text-dark"><?= $title; ?></h2>
      <?php endif; ?>

      <?php if (!empty($description)) : ?>
        <div class="section-description text-dark">
          <?= $description; ?>
        </div>
      <?php endif; ?>
    </div>

    <div class="icons-wrapper">
      <?php foreach ($items as $item) : 
        $icon   = $item['icon'] ?? '';
        $ititle = $item['title'] ?? '';
        $text   = $item['text'] ?? '';
      ?>
        <div class="item">
          <div class="icon-group">

            <?php if (!empty($icon)) : ?>
              <img src="<?= $icon; ?>">
            <?php endif; ?>

            <?php if (!empty($ititle)) : ?>
              <p class="title"><?= $ititle; ?></p>
            <?php endif; ?>

          </div>

          <?php if (!empty($text)) : ?>
            <p class="description"><?= $text; ?></p>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    </div>

    <?php if (!empty($bottom_text)) : ?>
      <div class="bottom-text text-center">
        <?= $bottom_text; ?>
      </div>
    <?php endif; ?>

  </div>
</section>
