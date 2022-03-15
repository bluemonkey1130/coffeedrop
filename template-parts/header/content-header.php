<?php
/**
 * Displays the site header.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

$headerSettings = get_field('header_settings', 'option');
$headerBuilder = get_field('header_builder', 'option');

?>

<header id="header" class="<?php echo $headerSettings['position'] ?>">
    <script type="text/javascript">
        var mobileBreakpoint = '<?php echo $headerSettings['mobile_navigation'] ? $headerSettings['mobile_navigation'] : 767 ?>';
        var headerPosition = '<?php echo $headerSettings['position'] ? $headerSettings['position'] : 'align-wide' ?> ';
    </script>
    <style>
        @media screen and (min-width: <?php echo $headerSettings['mobile_navigation']  ?>px) {
        header .grid-row .grid nav {
            display: inherit !important;
        }

        header .grid-row nav div.nav-link ul.sub-nav {
            margin: 0;
            display: none;
            position: absolute;
            z-index: 3;
            top: 100%;
            width: 100%;
        }

        header .grid-row nav div.nav-link:hover ul.sub-nav {
            display: block;
        }
        }
        @media screen and (max-width: <?php echo $headerSettings['mobile_navigation'] ; ?>px) {
        header.active section{
            padding-bottom: var(--s2);
        }
        header .grid-row .grid {
            display: grid;
            grid-template-rows: repeat(auto-fit, minmax(5px, auto));
            grid-template-columns: repeat(3, minmax(5px, auto));
            align-content: start;
            gap: 0;
        }

        header .grid-row .grid nav {
            display: none;
            flex-direction: column;
            grid-row: auto;
            grid-column: 1 / span 3;
            height: 100%;
            gap: 0;
        }
        header .grid-row .grid .logo {
            grid-row: 1;
        }
        header .grid-row .grid button {
            grid-row: 1;
        }
        header .grid-row .grid nav:nth-last-child(1) {

        }

        header .grid-row .grid nav .nav-link {
            justify-content: space-between;
            font-size: var(--f1);
            grid-template-rows: auto auto;
            grid-template-columns: auto auto;
            display: grid;
            border-bottom: 1px solid var(--light-main);
        }

        header .grid-row .grid .sub-menu {
            font-size: var(--f1);
        }

        header .grid-row .grid .sub-menu.active:before {
            content: '\f077';
        }

        header#header .grid-row nav div.nav-link > a {
            grid-row: 1;
            grid-column: 1 / span 1;
            justify-content: flex-start;
            justify-self: flex-start;
            padding: var(--s1) 0;
        }

        header .grid-row nav div.nav-link button {
            grid-row: 1;
            grid-column: 2 / span 2;
            justify-content: flex-end;
            justify-self: flex-end;
        }

        header .grid-row nav div.nav-link ul.sub-nav {
            display: none;
            grid-row: auto / span 2;
            grid-column: 1 / span 3;
            margin-bottom: 0;
            margin-top: var(--s-neg1);
        }

        header .grid-row nav div.nav-link ul.sub-nav li {
            margin-bottom: 0;
        }

        header .grid-row nav div.nav-link ul.sub-nav li a {
            font-size: var(--f0);
            padding: var(--s1) 0;
        }

        header .grid-row nav div.nav-link:hover ul.sub-nav {
            position: relative;
        }

        #menu-icon {
            grid-column: 3;
        }

        #menu-icon, #contact-icon {
            display: inline-flex !important;
        }

        header .button {
            display: none !important;
        }

        header .logo {
            max-width: 300px;
            align-self: center;
            justify-self: center;
            display: flex;
        }
        }
        @media screen and (max-width:  767px) {
            header .grid-row .logo{
            }
            header .grid-row  #menu-icon {
            }
        }
        @media screen and (max-width: 480px) {
            header .grid-row .logo{
            }
        }
    </style>
    <section class="grid-row <?php echo $headerSettings['background_colour']; ?>">
        <div class="grid <?php echo $headerSettings['width']; ?> <?php echo $headerSettings['gap']; ?>">
            <?php
            if ($headerBuilder > 0) {
                foreach ($headerBuilder as $key => $block) {
                    switch ($block['acf_fc_layout']) {
                        case 'navigation_block':
                            ?>
                            <nav id="nav-main" class="nav-main
                                <?php echo $block['text_colour'] ?>
                                <?php echo $block['hover_style'] ?>
                                <?php echo $block['nav_orientation'] ?>
                                <?php echo $block['nav_gap'] ?>"
                                 role="navigation">
                                <?php
                                wp_nav_menu(array(
                                    'container' => false,
                                    'theme_location' => 'main-menu',
                                    'walker' => new Theme_Walker()
                                ));
                                ?>
                            </nav>
                            <?php break;
                        case 'logo_block': ?>
                            <?php if ($block['logo']) { ?>
                                <a href="<?php echo home_url(); ?>" class="logo centreCentre
                                <?php echo $block['padding']['padding_top'] . ' ' . $block['padding']['padding_bottom'] . ' ' . ' ' . $block['padding']['padding_left'] . ' ' . ' ' . $block['padding']['padding_right'] . ' ' ?>"
                                   style="flex: 1 1 <?php echo $block['width'] ?>%; max-width: <?php echo $block['max_width'] ?>px; min-width: <?php echo $block['min_width'] ?>px">
                                    <figure>
                                        <?php echo wp_get_attachment_image($block['logo']['id'], $block['crop'], false, ["class" => "", "alt" => $block['logo']['alt']]); ?>
                                    </figure>
                                </a>
                            <?php } else { ?>
                                <h2 class="logo" role="banner">
                                    <a class="hdr-logo-link" href="<?php echo home_url(); ?>"
                                       rel="home"><?php echo get_bloginfo('name'); ?></a>
                                </h2>
                            <?php } ?>
                            <?php break;
                        case 'cta_block': ?>

                            <a class="button <?php echo $block['button_style'] . ' ' . $block['button_colour'] ?>"
                               style="flex: 1 1 <?php echo $block['width'] ?>%;"
                               href="<?php echo $block['button']['url'] ?>"
                               target="<?php echo $block['button']['target'] ?>"><?php echo $block['button']['title']; ?></a>
                            <?php break;
                        case 'cart': ?>
                            <?php global $woocommerce; ?>
                            <a class="header-cart"
                               href="<?php echo $woocommerce->cart->get_cart_url(); ?>"
                               title="<?php _e('Cart View', 'woothemes'); ?>">
                                <i class="fas fa-shopping-cart"></i>
                                <?php echo sprintf(_n('%d', '%d', $woocommerce->cart->cart_contents_count, 'woothemes'),
                                    $woocommerce->cart->cart_contents_count); ?>
                            </a>
                            <?php break;
                        default;
                    }
                }
            }
            ?>

            <button id="menu-icon">
                <span></span>
            </button>
        </div>
    </section>
</header><!-- #masthead -->