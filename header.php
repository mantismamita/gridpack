<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package gridpack
 */
$description = get_bloginfo( 'description', 'display' );
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
    <header id="masthead" class="site-header">
        <a class="skip-link screen-reader-text"
           href="#content"><?php esc_html_e( 'Skip to content', 'gridpack' ); ?></a>
        <div class="site-branding">
			<?php the_custom_logo(); ?>
			<?php if ( is_front_page() ) : ?>
                <h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
			<?php else : ?>
                <p class="site-title h2"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php endif; ?>
        </div><!-- .site-branding -->
	    <?php if (( $description || is_customize_preview() ) && ( is_front_page() )) : ?>
            <p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
	    <?php endif; ?>

        <nav id="site-navigation" class="main-navigation">
            <button class="menu-toggle" aria-controls="primary-menu"
                    aria-expanded="false"><?php esc_html_e( 'Menu', 'gridpack' ); ?></button>
			<?php
			wp_nav_menu( array(
				'theme_location' => 'menu-1',
				'menu_id'        => 'primary-menu',
			) );
			?>
        </nav><!-- #site-navigation -->
    </header><!-- #masthead -->

    <div id="content" class="site-content">
