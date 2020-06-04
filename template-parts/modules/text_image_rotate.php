<section class="text_image_rotate-section" style="<?php echo get_sub_field('background') < 1 ? 'background:url(' . get_sub_field('background_image') . ')' : 'background:' . get_sub_field('background_color') ?>">

    <div class="container">
        <div class="row">
            <div class="col-md-5 middle-align">
                <div class="wrapper">
                    <div class="content">
                        <h2 class="title"><?php echo get_sub_field('title') ?></h2>
                        <hr>
                        <div class="content">
                            <?php echo get_sub_field('content') ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7 middle-align">
                <div class="wrapper image">
                    <div class="content">
                        <img src="<?php echo get_sub_field('right_side_image') ?>">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <img class="right_side_image" src="<?php echo get_sub_field('right_side_image') ?>"> -->
</section>