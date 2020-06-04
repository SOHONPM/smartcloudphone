<?php
$background =  get_sub_field('background_type') == "image" ? 'background:url(' . get_sub_field('background_image') . ')' : 'background:' . get_sub_field('background_color');
?>
<section class="hero-section" style="<?php echo $background ?>">
    <div class="container">
        <div class="row">
            <div class="col-md-7 middle-align">
                <div class="wrapper">
                    <div class="content">
                        <?php echo get_sub_field('title') ?>
                        <h3 class="subtitle"><?php echo get_sub_field('subtitle') ?></h3>
                        <div class="content">
                            <?php echo get_sub_field('content') ?>
                        </div>
                        <div class="form">
                            <p class="form_title"><?php echo get_sub_field('form_title') ?></p>
                            <?php echo get_sub_field('form') ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5 middle-align">
                <div class="wrapper">
                    <div class="content">
                        <img src="<?php echo get_sub_field('right_side_image') ?>">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>