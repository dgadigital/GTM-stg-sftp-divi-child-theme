<?php
/**
 * Two Column Member Repeater (two_column_member_repeater)
 */

// =======================================
// ACF FIELDS (Section Settings - clone)
// =======================================
$section_id          = get_sub_field('section_id');            // Text
$section_title       = get_sub_field('section_title');         // Text
$section_description = get_sub_field('section_description');   // WYSIWYG
$bg_color            = get_sub_field('section_background');    // Select (e.g. bg-white)
$font_color          = get_sub_field('font_color');            // Select (e.g. text-dark)

// =======================================
// ACF FIELDS (Layout-specific)
// =======================================
$member_wrapper_title = get_sub_field('member_wrapper_title'); // Text
$members              = get_sub_field('members');              // Repeater (array)

// Early return if no members
if (empty($members)) {
  return;
}

$section_index = $args['section_index'] ?? 0;
$final_id      = $section_id ? $section_id : 'section-' . $section_index;
?>

<section id="<?php echo esc_attr($final_id); ?>"
         class="two-column-member-repeater section-<?php echo esc_attr($section_index); ?> <?php echo esc_attr($bg_color); ?> <?php echo esc_attr($font_color); ?>">

  <div class="container">
    <?php if ($section_title): ?>
      <div class="section-header d-flex justify-content-between align-items-start flex-column flex-lg-row">
        <h2 class="section-title text-dark">
          <?php echo ($section_title); ?>
        </h2>

        <?php if ($section_description): ?>
          <div class="section-description text-dark">
            <?php echo ($section_description); ?>
          </div>
        <?php endif; ?>
      </div>
    <?php endif; ?>
  </div>

  <div class="container">

    <?php if ($member_wrapper_title): ?>
      <h3 class="member-wrapper-title">
        <?php echo esc_html($member_wrapper_title); ?>
      </h3>
    <?php endif; ?>

    <div class="members">
      <?php foreach ($members as $member_row): ?>

        <?php
        $image        = $member_row['member'] ?? '';
        $member_name  = $member_row['member_name'] ?? '';
        $member_pos   = $member_row['member_position'] ?? '';
        $member_desc  = $member_row['member_description'] ?? '';
        $button_link  = $member_row['button_link'] ?? null;
        $linkedin     = $member_row['linkedin'] ?? null;
        ?>

        <div class="member">
          <div class="member-inner">

            <div class="image-wrapper">
              <?php
              if (!empty($image)) {
                echo wp_get_attachment_image(
                  $image,
                  'large',
                  false,
                  [
                    'class' => 'icon',
                    'alt'   => esc_attr($member_name),
                  ]
                );
              }
              ?>
            </div>

            <div class="member-text-wrapper">

              <div class="member-text-wrapper-top">
                <?php if ($member_name): ?>
                  <h4 class="member-name">
                    <?php echo esc_html($member_name); ?>
                  </h4>
                <?php endif; ?>

                <?php if ($member_pos): ?>
                  <div class="member-position">
                    <?php echo esc_html($member_pos); ?>
                  </div>
                <?php endif; ?>
              </div>

              <div class="member-text-wrapper-bottom">
                <?php if ($member_desc): ?>
                  <div class="member-description">
                    <?php echo wp_kses_post($member_desc); ?>
                  </div>
                <?php endif; ?>
              </div>
<?php if (!empty($button_link['url']) || !empty($linkedin['url'])): ?>
    <div class="member-button">
        <?php if (!empty($button_link['url'])): ?>
            <a href="<?= esc_url($button_link['url']); ?>" class="btn btn-primary"><?= esc_html($button_link['title']); ?></a>
        <?php endif; ?>

        <?php if (!empty($linkedin['url'])): ?>
            <a href="<?= esc_url($linkedin['url']); ?>" class="btn social"><i class="fab fa-linkedin dark"></i></a>
        <?php endif; ?>
    </div>
<?php endif; ?>


            </div><!-- .member-text-wrapper -->

          </div><!-- .member-inner -->
        </div><!-- .member -->

      <?php endforeach; ?>
    </div><!-- .members -->

  </div><!-- .container -->

</section>
