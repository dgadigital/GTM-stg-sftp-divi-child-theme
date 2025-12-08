<?php
/**
 * Fallback index template
 */
get_header();
?>



<section class="bg-white">
    <h1><?php esc_html_e( 'Welcome to DGA Theme', 'dga' ); ?></h1>
    <p>This is the default template.</p>
   
<?php


$post_type = get_post_type_object('post');

echo '<pre>';
print_r($post_type);
echo '</pre>';





?>

</section>


<?php
get_footer();
