<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head(); ?>
  
</head>

<body <?php body_class(); ?>>

<?php
// ✅ Safety check: ensure menus are registered
$locations = get_nav_menu_locations();
?>

<!-- ==================== DESKTOP NAV ==================== -->
<nav class="desktop-nav navbar navbar-expand-lg sticky-top d-none d-lg-flex">
  <div class="nav-container">

    <!-- LEFT MENU -->
    <div class="navbar-left flex-grow-1 d-flex justify-content-end">
      <ul id="menu-left" class="navbar-nav"><li class="nav-item dropdown"><div class="dropdown-wrapper"><a class="nav-link " href="https://gtm2dev.wpenginepowered.com/about-us-gtm/">About Us</a><a class="dropdown-toggle" href="#" role="button" aria-haspopup="true" aria-expanded="false"><svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 21 21" fill="none"><path d="M4.33 9.48C3.52 8.68 4.09 7.3 5.23 7.3h10.11c1.14 0 1.71 1.38.9 2.18l-5.06 5.06a1.1 1.1 0 0 1-1.81 0L4.33 9.48Z" fill="#ffffff"></path></svg></a></div>
<div class="dropdown-menu box-style" aria-labelledby="navbarDropdown0">
<div class="dropdown-item-wrapper"><a class="dropdown-item " href="https://gtm2dev.wpenginepowered.com/our-team/">Our Team</a></div><div class="dropdown-item-wrapper"><a class="dropdown-item " href="https://gtm2dev.wpenginepowered.com/our-board/">Our Board</a></div></div>
</li>
<li class="nav-item dropdown"><div class="dropdown-wrapper"><a class="nav-link " href="/">Services</a><a class="dropdown-toggle" href="#" role="button" aria-haspopup="true" aria-expanded="false"><svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 21 21" fill="none"><path d="M4.33 9.48C3.52 8.68 4.09 7.3 5.23 7.3h10.11c1.14 0 1.71 1.38.9 2.18l-5.06 5.06a1.1 1.1 0 0 1-1.81 0L4.33 9.48Z" fill="#ffffff"></path></svg></a></div>
<div class="dropdown-menu box-style" aria-labelledby="navbarDropdown0">
<div class="dropdown-item-wrapper"><a class="dropdown-item  has-submenu" href="https://gtm2dev.wpenginepowered.com/pr-agency/">PR - Australia</a><a class="dropdown-toggle" href="#" role="button" aria-haspopup="true" aria-expanded="false"><svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 21 21" fill="none"><path d="M4.33 9.48C3.52 8.68 4.09 7.3 5.23 7.3h10.11c1.14 0 1.71 1.38.9 2.18l-5.06 5.06a1.1 1.1 0 0 1-1.81 0L4.33 9.48Z" fill="#ffffff"></path></svg></a><div class="dropdown-submenu"><a class="dropdown-subitem " href="https://gtm2dev.wpenginepowered.com/pr-agency-sydney/">PR - Sydney</a><a class="dropdown-subitem " href="https://gtm2dev.wpenginepowered.com/pr-agency-melbourne/">PR - Melbourne</a><a class="dropdown-subitem " href="https://gtm2dev.wpenginepowered.com/pr-agency-adelaide/">PR - Adelaide</a><a class="dropdown-subitem " href="https://gtm2dev.wpenginepowered.com/pr-agency-auckland/">PR - NZ</a></div></div><div class="dropdown-item-wrapper"><a class="dropdown-item  has-submenu" href="https://gtm2dev.wpenginepowered.com/media-agencies/">Media Agency</a><a class="dropdown-toggle" href="#" role="button" aria-haspopup="true" aria-expanded="false"><svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 21 21" fill="none"><path d="M4.33 9.48C3.52 8.68 4.09 7.3 5.23 7.3h10.11c1.14 0 1.71 1.38.9 2.18l-5.06 5.06a1.1 1.1 0 0 1-1.81 0L4.33 9.48Z" fill="#ffffff"></path></svg></a><div class="dropdown-submenu"><a class="dropdown-subitem " href="https://gtm2dev.wpenginepowered.com/media-agency-sydney/">Media Agency Sydney</a><a class="dropdown-subitem " href="https://gtm2dev.wpenginepowered.com/media-agency-melbourne/">Media Agency Melbourne</a></div></div><div class="dropdown-item-wrapper"><a class="dropdown-item  has-submenu" href="https://gtm2dev.wpenginepowered.com/media-training/">Media Training</a><a class="dropdown-toggle" href="#" role="button" aria-haspopup="true" aria-expanded="false"><svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 21 21" fill="none"><path d="M4.33 9.48C3.52 8.68 4.09 7.3 5.23 7.3h10.11c1.14 0 1.71 1.38.9 2.18l-5.06 5.06a1.1 1.1 0 0 1-1.81 0L4.33 9.48Z" fill="#ffffff"></path></svg></a><div class="dropdown-submenu"><a class="dropdown-subitem " href="https://gtm2dev.wpenginepowered.com/media-training-sydney/">Media Training Sydney</a></div></div><div class="dropdown-item-wrapper"><a class="dropdown-item  has-submenu" href="https://gtm2dev.wpenginepowered.com/crisis-management/">Crisis Management</a><a class="dropdown-toggle" href="#" role="button" aria-haspopup="true" aria-expanded="false"><svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 21 21" fill="none"><path d="M4.33 9.48C3.52 8.68 4.09 7.3 5.23 7.3h10.11c1.14 0 1.71 1.38.9 2.18l-5.06 5.06a1.1 1.1 0 0 1-1.81 0L4.33 9.48Z" fill="#ffffff"></path></svg></a><div class="dropdown-submenu"><a class="dropdown-subitem " href="https://gtm2dev.wpenginepowered.com/crisis-management-plan/">Crisis Management Plan</a></div></div><div class="dropdown-item-wrapper"><a class="dropdown-item  has-submenu" href="https://gtm2dev.wpenginepowered.com/public-relations/">Public Relations</a><a class="dropdown-toggle" href="#" role="button" aria-haspopup="true" aria-expanded="false"><svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 21 21" fill="none"><path d="M4.33 9.48C3.52 8.68 4.09 7.3 5.23 7.3h10.11c1.14 0 1.71 1.38.9 2.18l-5.06 5.06a1.1 1.1 0 0 1-1.81 0L4.33 9.48Z" fill="#ffffff"></path></svg></a><div class="dropdown-submenu"><a class="dropdown-subitem " href="https://gtm2dev.wpenginepowered.com/b2b-pr-agency/">B2B Public Relations Agency</a></div></div><div class="dropdown-item-wrapper"><a class="dropdown-item " href="https://gtm2dev.wpenginepowered.com/political-lobbying/">Lobbying and Campaigns</a></div></div>
</li>
<li class="nav-item dropdown"><div class="dropdown-wrapper"><a class="nav-link " href="/pr-campaign-sector/">Sectors</a><a class="dropdown-toggle" href="#" role="button" aria-haspopup="true" aria-expanded="false"><svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 21 21" fill="none"><path d="M4.33 9.48C3.52 8.68 4.09 7.3 5.23 7.3h10.11c1.14 0 1.71 1.38.9 2.18l-5.06 5.06a1.1 1.1 0 0 1-1.81 0L4.33 9.48Z" fill="#ffffff"></path></svg></a></div>
<div class="dropdown-menu box-style" aria-labelledby="navbarDropdown0">
<div class="dropdown-item-wrapper"><a class="dropdown-item " href="https://gtm2dev.wpenginepowered.com/pr-campaign-sector/non-profit/">Not-for-Profit</a></div><div class="dropdown-item-wrapper"><a class="dropdown-item " href="https://gtm2dev.wpenginepowered.com/pr-campaign-sector/disability/">Disability</a></div><div class="dropdown-item-wrapper"><a class="dropdown-item " href="https://gtm2dev.wpenginepowered.com/pr-campaign-sector/age-care/">Age Care</a></div><div class="dropdown-item-wrapper"><a class="dropdown-item " href="https://gtm2dev.wpenginepowered.com/pr-campaign-sector/education/">Education</a></div><div class="dropdown-item-wrapper"><a class="dropdown-item " href="https://gtm2dev.wpenginepowered.com/pr-campaign-sector/homelessness/">Homelessness</a></div><div class="dropdown-item-wrapper"><a class="dropdown-item " href="https://gtm2dev.wpenginepowered.com/pr-campaign-sector/medical/">Medical</a></div><div class="dropdown-item-wrapper"><a class="dropdown-item " href="https://gtm2dev.wpenginepowered.com/pr-campaign-sector/domestic-violence/">Domestic Violence</a></div><div class="dropdown-item-wrapper"><a class="dropdown-item " href="https://gtm2dev.wpenginepowered.com/pr-campaign-sector/public-housing/">Public Housing</a></div><div class="dropdown-item-wrapper"><a class="dropdown-item " href="https://gtm2dev.wpenginepowered.com/pr-campaign-sector/environmental/">Environment</a></div><div class="dropdown-item-wrapper"><a class="dropdown-item " href="https://gtm2dev.wpenginepowered.com/pr-campaign-sector/mental-health/">Mental Health</a></div><div class="dropdown-item-wrapper"><a class="dropdown-item " href="https://gtm2dev.wpenginepowered.com/pr-campaign-sector/technology/">Technology</a></div></div>
</li>
<li class="nav-item dropdown"><div class="dropdown-wrapper"><a class="nav-link " href="/case-study/">Case Studies</a><a class="dropdown-toggle" href="#" role="button" aria-haspopup="true" aria-expanded="false"><svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 21 21" fill="none"><path d="M4.33 9.48C3.52 8.68 4.09 7.3 5.23 7.3h10.11c1.14 0 1.71 1.38.9 2.18l-5.06 5.06a1.1 1.1 0 0 1-1.81 0L4.33 9.48Z" fill="#ffffff"></path></svg></a></div>
<div class="dropdown-menu box-style" aria-labelledby="navbarDropdown0">
<div class="dropdown-item-wrapper"><a class="dropdown-item " href="https://gtm2dev.wpenginepowered.com/testimonials/">Testimonials</a></div></div>
</li>
</ul>    </div>

    <!-- CENTER LOGO -->
    <div class="navbar-logo text-center">
      
        <a href="https://gtm2dev.wpenginepowered.com/" class="custom-logo-link" rel="home" data-wpel-link="internal"><picture class="custom-logo" decoding="async">
<source type="image/webp" srcset="https://gtm2dev.wpenginepowered.com/wp-content/uploads/2025/11/GTM-Logo.png.webp">
<img width="165" height="64" src="https://gtm2dev.wpenginepowered.com/wp-content/uploads/2025/11/GTM-Logo.png" alt="Good Talent Media" decoding="async">
</picture>
</a>      
    </div>

    <!-- RIGHT MENU -->
    <div class="navbar-right flex-grow-1 d-flex">
      <div class="menu-right-wrapper">
        <ul id="menu-right" class="navbar-nav"><li class="nav-item dropdown"><div class="dropdown-wrapper"><a class="nav-link " href="/">Reputation</a><a class="dropdown-toggle" href="#" role="button" aria-haspopup="true" aria-expanded="false"><svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 21 21" fill="none"><path d="M4.33 9.48C3.52 8.68 4.09 7.3 5.23 7.3h10.11c1.14 0 1.71 1.38.9 2.18l-5.06 5.06a1.1 1.1 0 0 1-1.81 0L4.33 9.48Z" fill="#ffffff"></path></svg></a></div>
<div class="dropdown-menu box-style" aria-labelledby="navbarDropdown0">
<div class="dropdown-item-wrapper"><a class="dropdown-item " href="https://gtm2dev.wpenginepowered.com/online-reputation-management/">Online reputation management</a></div></div>
</li>
<li class="nav-item dropdown"><div class="dropdown-wrapper"><a class="nav-link " href="/">Skills</a><a class="dropdown-toggle" href="#" role="button" aria-haspopup="true" aria-expanded="false"><svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 21 21" fill="none"><path d="M4.33 9.48C3.52 8.68 4.09 7.3 5.23 7.3h10.11c1.14 0 1.71 1.38.9 2.18l-5.06 5.06a1.1 1.1 0 0 1-1.81 0L4.33 9.48Z" fill="#ffffff"></path></svg></a></div>
<div class="dropdown-menu box-style" aria-labelledby="navbarDropdown0">
<div class="dropdown-item-wrapper"><a class="dropdown-item  has-submenu" href="https://gtm2dev.wpenginepowered.com/communication-skills-training/">Communication Skills Training</a><a class="dropdown-toggle" href="#" role="button" aria-haspopup="true" aria-expanded="false"><svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 21 21" fill="none"><path d="M4.33 9.48C3.52 8.68 4.09 7.3 5.23 7.3h10.11c1.14 0 1.71 1.38.9 2.18l-5.06 5.06a1.1 1.1 0 0 1-1.81 0L4.33 9.48Z" fill="#ffffff"></path></svg></a><div class="dropdown-submenu"><a class="dropdown-subitem " href="https://gtm2dev.wpenginepowered.com/communication-skills-training-melbourne/">Communication Skills Training Melbourne</a></div></div><div class="dropdown-item-wrapper"><a class="dropdown-item  has-submenu" href="https://gtm2dev.wpenginepowered.com/course-presentation-skills/">Presentation Skills Training</a><a class="dropdown-toggle" href="#" role="button" aria-haspopup="true" aria-expanded="false"><svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 21 21" fill="none"><path d="M4.33 9.48C3.52 8.68 4.09 7.3 5.23 7.3h10.11c1.14 0 1.71 1.38.9 2.18l-5.06 5.06a1.1 1.1 0 0 1-1.81 0L4.33 9.48Z" fill="#ffffff"></path></svg></a><div class="dropdown-submenu"><a class="dropdown-subitem " href="https://gtm2dev.wpenginepowered.com/presentation-skills-course-melbourne/">Presentation Skills Training Melbourne</a></div></div><div class="dropdown-item-wrapper"><a class="dropdown-item " href="https://gtm2dev.wpenginepowered.com/interview-coaching/">Interview Coaching</a></div></div>
</li>
<li class="nav-item dropdown"><div class="dropdown-wrapper"><a class="nav-link " href="https://gtm2dev.wpenginepowered.com/faq/">FAQ</a><a class="dropdown-toggle" href="#" role="button" aria-haspopup="true" aria-expanded="false"><svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 21 21" fill="none"><path d="M4.33 9.48C3.52 8.68 4.09 7.3 5.23 7.3h10.11c1.14 0 1.71 1.38.9 2.18l-5.06 5.06a1.1 1.1 0 0 1-1.81 0L4.33 9.48Z" fill="#ffffff"></path></svg></a></div>
<div class="dropdown-menu box-style" aria-labelledby="navbarDropdown0">
<div class="dropdown-item-wrapper"><a class="dropdown-item " href="https://gtm2dev.wpenginepowered.com/faq/">FAQ</a></div><div class="dropdown-item-wrapper"><a class="dropdown-item " href="https://gtm2dev.wpenginepowered.com/modern-slavery-statement/">Modern Slavery Statement</a></div></div>
</li>
<li class="nav-item"><div class="dropdown-wrapper"><a class="nav-link " href="/news/">News</a></div></li>
<li class="nav-item"><div class="dropdown-wrapper"><a class="nav-link " href="https://gtm2dev.wpenginepowered.com/contact/">Contact</a></div></li>
</ul>      </div>
      <a class="call-btn nav-link btn btn-primary" href="tel:1300%20881%20972" data-wpel-link="internal">1300 881 972</a>
      
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