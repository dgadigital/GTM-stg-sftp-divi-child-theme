<?php
/**
 * Archive Template: Sector
 */

get_header();


// ==========================
// 1) FLEXIBLE CONTENT SECTIONS
// ==========================
?>
<?php
$section_index = 1;

if ( have_rows('flex_content_sector', 'option') ) :
    while ( have_rows('flex_content_sector', 'option') ) :
        the_row();

        $layout = get_row_layout();

        get_template_part('sections/partial', $layout, compact('section_index'));

        $section_index++;
    endwhile;
endif;




get_footer();
