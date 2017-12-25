<?php
/**
 * The template for displaying the footer.
 *
 * @package Magid
 */

use Magid\App\ACF;

// get footer site options
$options     = ( new ACF() )->getACFOptions();
$footer_logo = ! empty( $options['footer_logo'] ) ? wp_get_attachment_image_src( $options['footer_logo'] ) : null;
$socials     = [ 'twitter', 'linkedin' ];
$form_id     = isset( $options['footer_form'] ) ? $options['footer_form'] : false;
$form        = GFAPI::get_form( $form_id );
?>

<?php if ( ! is_page_template( 'templates/template-form.php' ) ) : ?>
    <footer <?php hybrid_attr( 'footer' ); ?>>
        <div class="container--lg">
            <div class="row">
                <div class="col-sm-7 col-md-6 col-lg-4 footer__form-action">
                    <div class="footer__form">
                        <?php
                        if ( $form ) {
                           // echo $form['title'];
                        
                       
                        if ( isset( $options['footer_form_link'] ) ) {
                            echo '<a href="' . esc_url( $options['footer_form_link'] ) . '" class="btn btn--primary">' . __( $form['title'], 'magid' ) . '</a>';
                        }
                        }
                        ?>
                    </div>
                </div>
                <div class="clearfix visible-sm visible-md"></div>
                <div class="col-sm-6 col-lg-4 footer__menu">
                    <?php hybrid_get_menu( 'footer' ); // Loads the menu/footer.php template. ?>
                </div>
                <div class="col-sm-6 col-lg-4 footer__branding">
                    <?php get_template_part( 'components/socials' ); // Loads the components/socials.php template.?>

                    <a class="footer__branding-link" href="<?php echo home_url( '/' ); ?>"
                       title="<?php echo get_bloginfo( 'name' ); ?>">
                        <img data-src="<?php echo esc_url( $footer_logo[0] ); ?>"
                             alt="<?php echo get_bloginfo( 'name' ); ?>"
                             title="<?php echo get_bloginfo( 'name' ); ?>"/>
                    </a>
                </div>
            </div>
            <div class="footer__copyright">
                <?php
                printf(
                    __( '&#169;%1$s %2$s', 'magid' ),
                    date_i18n( 'Y' ), get_bloginfo( 'name' )
                );
                $privacy_policy = get_page_by_title( 'Privacy Policy' );
                if ( $privacy_policy ) {
                    printf(
                        __( '<span>&#47;</span><a href="%1$s" title="%2$s">%2$s</a>', 'magid' ),
                        esc_url( get_permalink( $privacy_policy->ID ) ),
                        $privacy_policy->post_title
                    );
                }
                $terms = get_page_by_title( 'Terms of Use' );
                if ( $terms ) {
                    printf(
                        __( '<span>&#47;</span><a href="%1$s" title="%2$s">%2$s</a>', 'magid' ),
                        esc_url( get_permalink( $terms->ID ) ),
                        $terms->post_title
                    );
                }
                ?>
            </div><!-- /.copyright -->
        </div>
    </footer><!-- #footer -->
<?php endif; ?>
<div class="nav__overlay"></div>

<?php wp_footer(); ?>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>jQuery('.mentions__load-more .btn--outline').switchClass( "btn--outline", "btn--primary");</script>
<script type="text/javascript">
    jQuery(document).ready(function (event) {   
    jQuery('#memberdropmb').on('mouseenter', 'option', function (e) {
        this.style.color = "red";
    });
    jQuery('#memberdropmb').on('mouseleave', 'option', function (e) {
        this.style.color = "black";
    });
});
</script>
</body>
</html>