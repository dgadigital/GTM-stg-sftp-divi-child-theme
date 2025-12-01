<?php
/**
 * Accordion Section Layout
 */

// ============================
// ACF FIELDS
// ============================
$section_id     = get_sub_field('section_id');              // Text
$bg_color       = get_sub_field('section_background');        // Select
$title          = get_sub_field('section_title');                   // Text
$Items           = get_sub_field('items');                    // Repeater (array)
// ============================

// Early return if no Items
if (empty($Items)) return;

$section_index  = $args['section_index'] ?? 0;

$final_id = $section_id ? $section_id : 'section-' . $section_index;

$bg_class = $bg_color ? esc_attr($bg_color) : '';
?>

<section id="<?php echo esc_attr($final_id); ?>" class="accordion-section <?php echo $bg_class; ?> section-<?php echo esc_attr($section_index); ?>" id="<?php echo esc_attr($final_id); ?>">
  <div class="container">

    <?php if ($title): ?>
      <h2 class="section-title section-title-small">
        <?php echo esc_html($title); ?>
      </h2>
    <?php endif; ?>

    <div class="accordion-container">

      <?php foreach ($Items as $index => $Item): 
        $question = $Item['question'];   // Text
        $answer   = $Item['answer'];     // WYSIWYG or textarea

        if (empty($question) && empty($answer)) continue;

        // First Item should be open
        $is_open = $index === 0 ? ' open' : '';
        $show_content = $index === 0 ? ' show' : '';
      ?>

      <div class="accordion-item">
        <div class="accordion-header<?php echo $is_open; ?>">
          <?php echo esc_html($question); ?>
        </div>

        <div class="accordion-content<?php echo $show_content; ?>">
          <div class="accordion-inner">
            <?php echo wp_kses_post($answer); ?>
          </div>
        </div>
      </div>

      <?php endforeach; ?>

    </div>

  </div>
</section>
