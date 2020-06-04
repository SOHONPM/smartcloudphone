<section class="image_feature-section" style="<?php echo get_sub_field('background') < 1 ? 'background:url(' . get_sub_field('background_image') . ')' : 'background:' . get_sub_field('background_color') ?>">
    <div class="container">

        <div class="row">
            <div class="col-md-12 col-lg-4">
                <img src="<?php echo get_sub_field('image'); ?>">
            </div>
            <div class="col-md-12 col-lg-8">
                <h2 class="main_title"><?php echo get_sub_field('title') ?></h2>
                <h6 class="subtitle"><?php echo get_sub_field('subtitle') ?></h6>
                <div class="row">
                    <?php
                    if (have_rows('features')) :
                        while (have_rows('features')) : the_row();
                    ?>
                            <div class="col-md-6">
                                <div class="row">
                                    <?php if (get_sub_field('icon')) : ?>
                                        <div class="col-md-2"><i class="<?php echo get_sub_field('icon') ?>"></i></div>
                                    <?php endif;   ?>
                                    <div class="<?php echo get_sub_field('icon') ? 'col-md-10' : 'col-md-12' ?>">
                                        <p class="title"> <?php echo get_sub_field('title'); ?></p>
                                        <div class="content">
                                            <?php echo get_sub_field('content'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php
                        endwhile;
                    endif;
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>