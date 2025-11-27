<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head(); ?>
  
  <style>
  .dropdown-wrapper .btn-primary {
position: absolute;
    right: 20px;
    top: 40px;
}

nav .navbar-logo img {
    height: auto !important;
    width: auto !important;
}

nav .nav-link {font-size:14px;}
@media (min-width: 992px) and (max-width: 1464px) {
.leadership-fullwidth-automatic-slider .members .member .member-inner .member-text-wrapper .member-text-wrapper-top .member-position {font-size:17px;}
}
@media (min-width: 992px) and (max-width: 1464px) {
.navbar-nav .nav-link {font-size: 11px;}
.navbar #menu-left.navbar-nav {width:100%}
.navbar #menu-right.navbar-nav {width:100%}
.nav-container {width:100%;}

  .dropdown-wrapper .btn-primary {
position: absolute;
    right: 20px;
    top: 84px;
}
.navbar-right .menu-right-wrapper {width:100%;padding-right:20px;}

}

  </style>
</head>

<body <?php body_class(); ?>>

<?php
// ✅ Safety check: ensure menus are registered
$locations = get_nav_menu_locations();
?>

<!-- ==================== DESKTOP NAV ==================== -->
<nav class="desktop-nav navbar navbar-expand-lg sticky-top d-none d-lg-flex">
  <div class="nav-container d-flex align-items-center justify-content-between m-auto">

    <!-- LEFT MENU -->
    <div class="navbar-left flex-grow-1 d-flex justify-content-end">
      <?php
      if (isset($locations['left'])) {
        wp_nav_menu([
          'theme_location' => 'left',
          'container'      => false,
          'menu_class'     => 'navbar-nav',
          'fallback_cb'    => false,
          'walker'         => new Custom_Walker_Nav(),
        ]);
      }
      ?>
    </div>

    <!-- CENTER LOGO -->
    <div class="navbar-logo mx-4 text-center">
      
        <?php
        if (function_exists('the_custom_logo') && has_custom_logo()) {
          the_custom_logo();
        } else {
          echo esc_html(get_bloginfo('name'));
        }
        ?>
      
    </div>

    <!-- RIGHT MENU -->
    <div class="navbar-right flex-grow-1 d-flex">
      <div class="menu-right-wrapper">
        <?php
        if (isset($locations['right'])) {
          wp_nav_menu([
            'theme_location' => 'right',
            'container'      => false,
            'menu_class'     => 'navbar-nav',
            'fallback_cb'    => false,
            'walker'         => new Custom_Walker_Nav(),
          ]);
        }
        ?>
        <div class="dropdown-wrapper"><a class="nav-link btn btn-primary" href="tel:1300%20881%20972" data-wpel-link="internal">1300 881 972</a></div>
      </div>
      <!-- <a href="" class="search-icon"></a> -->
      
    </div>

  </div>
</nav>



<!-- ==================== MOBILE NAV ==================== -->
<nav class="mobile-nav navbar navbar-expand-lg sticky-top d-lg-none">
  <div class="container-fluid d-flex flex-column align-items-stretch px-3">

    <!-- Top Row -->
    <div class="d-flex justify-content-center align-items-center w-100 py-2">
      
        <?php
        if (function_exists('the_custom_logo')) {
          the_custom_logo();
        } else {
          echo esc_html(get_bloginfo('name'));
        }
        ?>
      

      <!-- Toggle -->
      <button class="navbar-toggler mobile-burger" type="button"
        data-bs-toggle="collapse" data-bs-target="#mobileNav"
        aria-controls="mobileNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>

    <!-- Collapsible Menu -->
    <div class="collapse navbar-collapse mt-2" id="mobileNav">
      <?php
      if (isset($locations['primary'])) {
        wp_nav_menu([
          'theme_location'  => 'primary',
          'container'       => false,
          'menu_class'      => 'navbar-nav text-center gap-2',
          'fallback_cb'     => false,
          'walker'          => new Custom_Walker_Nav_Mobile(),
        ]);
      }
      ?>
    </div>

  </div>
</nav>
<main>