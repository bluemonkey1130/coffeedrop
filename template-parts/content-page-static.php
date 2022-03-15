<?php
$pageRowSpace = get_field('space_top', $post->ID);
$pageGridGap = get_field('grid_gap', $post->ID);
?>
<section id="how-it-works" class="grid-row <?php echo $pageRowSpace; ?>">
    <?php $howItWorks = get_field('how_it_works', $post->ID); ?>
    <div class="grid <?php echo $pageGridGap; ?>">
        <div>
            <?php echo $howItWorks['text'] ?>
        </div>
    </div>
    <div class="grid grid-flex <?php echo $pageGridGap; ?>">
        <div class="stack pad-200">
            <?php
            $imageOne = $howItWorks['image_one'];
            $textOne = $howItWorks['text_one'];
            if ($imageOne) {
                echo wp_get_attachment_image($imageOne['id'], '', false, ["class" => "", "alt" => $imageOne['alt']]);
            }
            echo $textOne;
            ?>
        </div>
        <div class="arrow">
            <?php
            $arrowOne = $howItWorks['arrow_one'];
            if ($arrowOne) {
                echo wp_get_attachment_image($arrowOne['id'], '', false, ["class" => "", "alt" => $arrowOne['alt']]);
            }
            ?>
        </div>
        <div class="stack pad-200">
            <?php
            $imageTwo = $howItWorks['image_two'];
            $textTwo = $howItWorks['text_two'];
            if ($imageTwo) {
                echo wp_get_attachment_image($imageTwo['id'], '', false, ["class" => "", "alt" => $imageOne['alt']]);
            }
            echo $textTwo;
            ?>
        </div>
        <div class="arrow">
            <?php
            $arrowTwo = $howItWorks['arrow_two'];
            if ($arrowTwo) {
                echo wp_get_attachment_image($arrowTwo['id'], '', false, ["class" => "", "alt" => $arrowTwo['alt']]);
            }
            ?>
        </div>
        <div class="stack pad-200">
            <?php
            $imageThree = $howItWorks['image_three'];
            $textThree = $howItWorks['text_three'];
            if ($imageThree) {
                echo wp_get_attachment_image($imageThree['id'], '', false, ["class" => "", "alt" => $imageOne['alt']]);
            }
            echo $textThree;
            ?>
        </div>
    </div>
</section>
<section id="prices" class="grid-row <?php echo $pageRowSpace; ?> bg-dark-main">
    <?php $pricing = get_field('pricing', $post->ID); ?>
    <div class="grid <?php echo $pageGridGap; ?> pad-top-500">
        <div class="c">
            <?php echo $pricing['text'] ?>
        </div>
    </div>
    <div id="prices-detail" class="grid has-three-columns grid-gap-200 pad-bottom-500 gap-top-100">
        <div class="column stack-small">
            <?php $columnOne = $pricing['column_one'] ?>
            <div class="color-tertiary-main">
                <?php echo $columnOne['column_title'] ?>
            </div>
            <div>
                <?php foreach ($columnOne['repeater'] as $row) { ?>
                    <div class="row stack pad-100">
                        <?php echo $row['row']; ?>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="column stack-small">
            <?php $columnTwo = $pricing['column_two'] ?>
            <div class="color-tertiary-main">
                <?php echo $columnTwo['column_title'] ?>
            </div>
            <div>
                <?php foreach ($columnOne['repeater'] as $row) { ?>
                    <div class="row stack pad-100">
                        <?php echo $row['row']; ?>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="column stack-small">
            <?php $columnThree = $pricing['column_three'] ?>
            <div class="color-tertiary-main">
                <?php echo $columnThree['column_title'] ?>
            </div>
            <div>
                <?php foreach ($columnOne['repeater'] as $row) { ?>
                    <div class="row stack pad-100">
                        <?php echo $row['row']; ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
<section id="locations" class="grid-row ">
    <div class="grid align-full">
        <div class="map-wrapper medium">
            <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyANgHkhS6LhAxoZn4jfrbjLEdGsVvW6yps&callback=initmultiplePins&libraries=&v=beta&map_ids=542330e53d8be551"
                    defer></script>
            <div id="map" style="width: 100%; height: 500px; grid-column: 1 / -1">
                <div class="map-info">
                    6 ,542330e53d8be551
                </div>
                <?php
                $i = 0;
                while ($i < 5) {
                    $i++; //increment operator
                    $request = wp_remote_get('https://coffeedrop.staging2.image-plus.co.uk/api/locations/?page=' . $i);

                    if (is_wp_error($request)) {
                        echo 'There be errors, yo!';
                    } else {
                        $body = wp_remote_retrieve_body($request);
                        $data = json_decode($body);
                        foreach ($data->data as $block) { ?>
                            <div class="location">
                                <?php
                                echo $block->coordinates->latitude . ',';
                                echo $block->coordinates->longitude . ',';
                                echo '#27e7a9' . ', ';
                                echo $block->address->line1 . ',' . $block->address->line2 . ',' . $block->address->city . ',' . $block->address->postcode; ?>
                            </div>
                            <?php
                        }
                    }
                }
                ?>
            </div>
        </div>
    </div>
</section>
