<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head <?php hybrid_attr( 'head' ); ?>>
    <?php wp_head(); ?>



    <!-- Google Tag Manager -->
    <script>(function (w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(), event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-P42XL7R');</script>
    <!-- End Google Tag Manager -->
</head>
<?php include( MAGID_THEME_DIR . 'assets/images/icons/general.svg' ); ?>
<body <?php hybrid_attr( 'body' ); ?>>
<!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-P42XL7R"
            height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->

<header <?php hybrid_attr( 'header' ); ?>>
    <?php hybrid_get_menu( 'primary' ); // Loads the menu/primary.php template. ?>
</header><!-- .header -->