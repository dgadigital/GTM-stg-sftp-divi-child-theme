<?php
/**
 * Archive Template: Case Studies
 */

get_header();

// ==========================
// 1) FLEXIBLE CONTENT SECTIONS
// ==========================?>

<?php

$section_index = 1;

if ( have_rows('flex_content_case', 'option') ) :
    while ( have_rows('flex_content_case', 'option') ) :
        the_row();

        $layout = get_row_layout();

        get_template_part('sections/partial', $layout, compact('section_index'));

        $section_index++;
    endwhile;
endif;


// ==========================
// 2) CASE STUDY HUB SECTION
// ==========================

get_template_part('sections/partial', 'case_study_hub', compact('section_index'));

get_footer();
