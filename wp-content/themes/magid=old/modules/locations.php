<?php
/**
 * Module: Locations
 *
 * @package Magid
 */

$locations = get_sub_field( 'locations' );
?>

<section id="locations-<?php echo $module_id; ?>" class="module module-location">
    <div class="container--lg">
        <div class="row">
            <div class="locations">
                <?php
                foreach ( $locations as $index => $location ) :
                    extract( $location );
                    ?>
                    <div class="location">
                        <?php
                        echo $name ? '<h5 class="hdg hdg--5 hdg--medium">' . esc_html( $name ) . '</h5>' : '';
                        echo $address ? '<div class="location__address">' . $address . '</div>' : '';
                        echo $phone ? '<div class="location__number">' . $phone . '</div>' : '';
                        echo $fax ? '<div class="location__number">' . $fax . __( ' Fax', 'magid' ) . '</div>' : '';
                        echo $email ? '<a class="location__email" href="mailto:' . $email . '" target="_blank">' . $email . '</a>' : '';
                        ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
