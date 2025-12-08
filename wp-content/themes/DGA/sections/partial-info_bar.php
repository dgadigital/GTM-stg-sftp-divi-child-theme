<?php
$items = get_sub_field('items');

if (empty($items)) {
  return;
}
?>

<section class="info-bar">
  <div class="container">
    <div class="info-bar-wrapper">

      <?php foreach ($items as $item) :
        $icon  = $item['icon'] ?? '';   
        $title = $item['title'] ?? '';
        $text  = $item['text'] ?? '';
      ?>

        <div class="item">
          <?php if (!empty($icon)) : ?>
            <div class="icon">
              <img src="<?= esc_url($icon); ?>" alt="">
            </div>
          <?php endif; ?>

          <div class="text">
            <?php if (!empty($title)) : ?>
              <h3><?= esc_html($title); ?></h3>
            <?php endif; ?>

            <?php if (!empty($text)) : ?>
              <p><?= esc_html($text); ?></p>
            <?php endif; ?>
          </div>
        </div>

      <?php endforeach; ?>

    </div>
  </div>
</section>
