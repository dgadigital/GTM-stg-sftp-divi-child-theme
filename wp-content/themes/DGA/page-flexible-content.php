<?php
/**
 * Template Name: Flexible Content
 */?>

<?php get_header(); 
$section_index = 1;


    if (have_rows('flex_content')) {
        while (have_rows('flex_content')) {
            the_row();
            
            // Get layout type
            $layout = get_row_layout();

            // Define the base path for the template part files
            $sections = 'sections/partial';

            // Include the template part file
            get_template_part($sections, $layout,['section_index' => $section_index]);

            $section_index++;
        }
    }


get_footer(); ?>