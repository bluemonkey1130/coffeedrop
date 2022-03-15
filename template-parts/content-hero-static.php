<?php
$backgroundImage = get_field('background_image');
$text = get_field('hero_text');
$image = get_field('hero_image');
$appButtons = get_field('display_app_logos');
$appIOS = get_field('ios');
$appAndroid = get_field('android');
?>
    <section id="hero "
             class="grid-row static"
             style="background: url(<?php echo $backgroundImage['url']; ?>) center center/cover no-repeat">
        <div class="grid align-wide has-two-columns right-wide">
            <div class="color-light-main centreLeft gap-top-500 pad-bottom-600 pad-top-600 pad-right-300">
                <?php echo $text; ?>
                <?php
                if ($appButtons) {
                    ?>
                    <div class="button-wrap">
                        <a href="#">
                            <?php echo wp_get_attachment_image($appIOS['id'], '', false, ["class" => "", "alt" => $image['alt']]); ?>
                        </a>
                        <a href="#">
                            <?php echo wp_get_attachment_image($appAndroid['id'], '', false, ["class" => "", "alt" => $image['alt']]); ?>
                        </a>
                    </div>
                <?php }
                ?>
            </div>
            <div class="bottomCentre pad-top-500">
                <?php
                $img_id = $image['id']; //need to get it dynamically
                $cropped_image = wp_get_attachment_image_url($img_id, 'full');
                ?>
                <img src="<?php echo $cropped_image ?>" alt="">

            </div>
        </div>
    </section>
<?php
