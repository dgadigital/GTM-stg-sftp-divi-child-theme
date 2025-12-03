<?php
/**
 * Image + Text Section (image_and_text)
 */

if (empty(get_row_layout())) return;

$section_index = $args['section_index'] ?? 0;

/* ---------------------------------------------
   Section Settings (clone group)
--------------------------------------------- */
$section_id     = get_sub_field('section_id');          // Text
$bg_color       = get_sub_field('background_color');    // Select
$font_color     = get_sub_field('font_color');          // Select

/* ---------------------------------------------
   Section Content Fields
--------------------------------------------- */
$title        = get_sub_field('section_title');                    // Text
$image        = get_sub_field('image');                            // Image ID
$top_text     = get_sub_field('top_text');                         // WYSIWYG or textarea
$name         = get_sub_field('name');                             // Text
$label        = get_sub_field('label');                            // Text
$details      = get_sub_field('details');                          // Text
$bottom_wysiwyg = get_sub_field('bottom_wysiwyg');                // WYSIWYG

/* ---------------------------------------------
   Early Return
--------------------------------------------- */
if (empty($image) && empty($top_text) && empty($title)) return;

/* ---------------------------------------------
   Section ID Logic
--------------------------------------------- */
if (empty($section_id)) {
  $page_id    = get_the_ID();
  $section_id = 'page_' . $page_id . '-section_' . $section_index;
}

/* ---------------------------------------------
   Classes
--------------------------------------------- */
$bg_class   = $bg_color ? esc_attr($bg_color) : 'bg-white';
$font_class = $font_color ? esc_attr($font_color) : 'text-dark';
?>

<section
  id="<?php echo esc_attr($section_id); ?>"
  class="image-and-text <?php echo $bg_class; ?> <?php echo $font_class; ?> section-<?php echo esc_attr($section_index); ?>"
>

  <div class="container">

    <?php if ($title): ?>
      <div class="section-title">
        <h2><?php echo esc_html($title); ?></h2>
      </div>
    <?php endif; ?>

    <div class="content">
      <div class="content-inner">

        <?php if ($image): ?>
          <div class="image-content-wrapper">
            <?php
              echo wp_get_attachment_image(
                $image,
                'full',
                false,
                [
                  'class' => 'icon img-fluid',
                  'alt'   => esc_attr($name ?: $title)
                ]
              );
            ?>
          </div>
        <?php endif; ?>

        <div class="text-content-wrapper">

          <?php if ($top_text): ?>
            <div class="text-content-wrapper-top">
              <?php echo wp_kses_post($top_text); ?>
            </div>
          <?php endif; ?>

          <div class="text-content-wrapper-bottom">
            <?php if ($name): ?>
              <h4 class="name"><?php echo esc_html($name); ?></h4>
            <?php endif; ?>

            <?php if ($label): ?>
              <div class="label"><?php echo esc_html($label); ?></div>
            <?php endif; ?>

            <?php if ($details): ?>
              <div class="details"><?php echo esc_html($details); ?></div>
            <?php endif; ?>
          </div>

        </div><!-- .text-content-wrapper -->

      </div><!-- .content-inner -->
    </div><!-- .content -->

    <?php if ($bottom_wysiwyg): ?>
      <div class="bottom-wysiwyg">
        <?php echo wp_kses_post($bottom_wysiwyg); ?>
      </div>
    <?php endif; ?>

  </div><!-- .container -->

</section>
