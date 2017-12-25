<?php
/**
 * Template part for displaying the social icons
 */

use Magid\App\ACF;

// get footer site options
$options = ( new ACF() )->getACFOptions();
$socials = [ 'linkedin', 'twitter' ];
?>

<?php foreach ( $socials as $social ) : ?>
    <?php if ( isset( $options[ $social . '_url' ] ) ) : ?>
        <a class="site__social site__social--<?php echo $social; ?>"
           href="<?php echo esc_url( $options[ $social . '_url' ] ); ?>" target="_blank">
            <svg class="icon icon-<?php echo $social; ?>">
                <use xlink:href="#icon-<?php echo $social; ?>"></use>
            </svg>
        </a>
    <?php endif; ?>
<?php endforeach; ?>