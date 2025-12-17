<?php get_header(); 

function dga_strip_divi_content($content) {
  $content = strip_shortcodes($content);

  $content = preg_replace(
    '/<a[^>]*>\s*<img[^>]*>\s*<\/a>|<img[^>]*>/i',
    '',
    $content,
    1
  );

  $content = preg_replace(
    '/<span[^>]*>(.*?)<\/span>/s',
    '$1',
    $content
  );

  $content = preg_replace('/<p>\s*<\/p>/', '', $content);

  return trim($content);
}

$content = get_the_content();
$clean_content = dga_strip_divi_content($content);

?>

<section class="hero-video-banner section-1 bg-black text-white">
  <div class="container hero-content">
    <div class="row align-items-center hero-content-wrapper">
      <div class="text-column col-lg-6 col-md-12 col-12">
          <h1 class="hero-intro">Case Studies</h1>
          <span class="hero-title"><?php the_title(); ?></span>
<!--           <p class="hero-tagline">Good Talent Media helped Typsy turn local awareness into national recognition with smart PR that worked.</p> -->
      </div>
      <div class="col-lg-6 col-md-12 col-12 video-control text-center">
		  <style>
			  .banner-image-wrapper {
				  position: relative;
				  padding-bottom: 40%;
				  width: 544px;
				  max-width: 100%;
			  }
			  
			  .banner-image-wrapper img {
				 position: absolute;
				  top: 50%;
				  left: 50%;
				  transform: translate(-50%, -50%);
			  }
		  </style>
		  <div class="banner-image-wrapper">
             <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>">
		  </div>
		</div>
    </div>
  </div>
</section>

<section class="new-blogs-content bg-white">
  <div class="container">

    <div class="new-blogs-content-wrapper">
      <div class="text">
          
		<div class="body-content">  
			 <?php echo apply_filters('the_content', $clean_content); ?>
		</div>

       <div class="bottom-nav">
  <?php
  $prev_post = get_previous_post();
  $next_post = get_next_post();

  function dga_trim_title($title, $limit = 20) {
    if (mb_strlen($title) <= $limit) {
      return $title;
    }
    return mb_substr($title, 0, $limit) . '...';
  }
  ?>

  <?php if ($prev_post) : ?>
    <a
      href="<?= esc_url(get_permalink($prev_post->ID)); ?>"
      class="btn btn-white prev-link"
    >
      ← <?= esc_html(dga_trim_title(get_the_title($prev_post->ID))); ?>
    </a>
  <?php endif; ?>

  <?php if ($next_post) : ?>
    <a
      href="<?= esc_url(get_permalink($next_post->ID)); ?>"
      class="btn btn-white next-link"
    >
      <?= esc_html(dga_trim_title(get_the_title($next_post->ID))); ?> →
    </a>
  <?php endif; ?>
</div>


        <div class="founder-widget">
          <div class="image">
              <img src="/wp-content/uploads/2025/12/image-10-1.png" class="img-fluid">
          </div>
          <div class="content">
            <p class="content-text">A great media trainer gets your sector, understands the nuances, and knows how the media thinks because they’ve been there. They run engaging workshops, work closely with your comms team, align with the CEO while pushing them further, and adapt to every personality in the room. In just four hours, they add huge value without overwhelming, building confidence and skills that take people to the next level. Media training is always different, always a privilege, and the most satisfying work I’ve done outside interviewing Prime Ministers for the ABC.</p>
            <p class="name">Tony Nicholls</p>
            <p class="position">Founder / Media Trainer</p>
            <p class="small-description">Ex-journalist turned PR strategist, helping purpose-driven organisations get heard where it matters most</p>
          </div>
        </div>

      </div>
      <div class="side-bar">
  <p>Recent Posts</p>

  <ul>
    <?php
    $current_post_id = get_the_ID();

    $recent_posts = new WP_Query([
      'post_type'      => 'case-study',
      'posts_per_page' => 5,
      'post__not_in'   => [$current_post_id],
      'post_status'    => 'publish',
      'orderby'        => 'date',
      'order'          => 'DESC',
    ]);

    if ($recent_posts->have_posts()) :
      foreach ($recent_posts->posts as $post) :
        setup_postdata($post);
        ?>
        <li>
          <a href="<?php the_permalink(); ?>">
            <?php echo esc_html(get_the_title()); ?>
          </a>
        </li>
        <?php
      endforeach;
      wp_reset_postdata();
    endif;
    ?>
  </ul>
</div>

    </div>

  </div>
</section>

<section class="case-study-card-slider bg-gray-150 text-black">
  <div class="container">

    <div class="section-title text-center mb-5">
      <h2>See How We’ve Made Brands Impossible to Ignore</h2>
    </div>

  </div>

  <div class="container">
    <div class="case-study-slider">

      <?php
      $case_studies = new WP_Query([
        'post_type'      => 'case-study',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
      ]);

      if ($case_studies->have_posts()) :
        while ($case_studies->have_posts()) :
          $case_studies->the_post();

          $image_id  = get_post_thumbnail_id();
          $title     = get_the_title();
          $excerpt   = get_the_excerpt();
      ?>
          <div class="case-study-card">
            <div class="card-inner text-center">

              <?php if ($image_id) : ?>
                <div class="image-wrapper mb-3">
                  <?= wp_get_attachment_image($image_id, 'medium', false, [
                    'alt' => esc_attr($title),
                  ]); ?>
                </div>
              <?php endif; ?>

              <div class="content">
                <?php if ($title) : ?>
                  <h3 class="title"><?= esc_html($title); ?></h3>
                <?php endif; ?>

                <?php if ($excerpt) : ?>
                  <div class="excerpt">
                    <?= esc_html($excerpt); ?>
                  </div>
                <?php endif; ?>
              </div>
              <a href="<?=  $permalink ?>" class="case-link">Read More ></a>

            </div>
          </div>
      <?php
        endwhile;
        wp_reset_postdata();
      endif;
      ?>

    </div>
  </div>

  <div class="container">
    <div class="section-button text-center mt-4">
      <a href="<?= esc_url(get_post_type_archive_link('case-study')); ?>" class="btn btn-tertiary">
        View All Case Studies
      </a>
    </div>
  </div>

</section>




<section class="bottom-cta-banner section-7" style="background-image: url(/wp-content/uploads/2025/12/Rectangle-51-3.png);">
  <div class="container">
    <div class="content-wrapper text-center">
              <h2>Ready to create your success story?</h2>
		<div class="description">
          <p>Let’s build a PR strategy that gets you noticed for all the right reasons.</p>
        </div>
              <a href="/contact/" target="_self" class="btn btn-tertiary" data-wpel-link="internal">
          Book My Training </a>
    </div>
  </div>
</section>

<?php get_footer(); ?>
