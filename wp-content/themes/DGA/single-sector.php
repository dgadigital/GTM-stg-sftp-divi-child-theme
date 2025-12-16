<?php 
get_header(); 

$section_index = 1;

// FLEXIBLE CONTENT SECTIONS
if ( have_rows('flex_content') ) {
    while ( have_rows('flex_content') ) {
        the_row();

        $layout = get_row_layout();
        $sections = 'sections/partial';

        get_template_part(
            $sections,
            $layout,
            ['section_index' => $section_index]
        );

        $section_index++;
    }
}

get_footer();
