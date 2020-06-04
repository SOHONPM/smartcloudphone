<section class="feature-section" style="<?php echo get_sub_field('background') < 1 ? 'background:url(' . get_sub_field('background_image') . ')' : 'background:' . get_sub_field('background_color') ?>">
    <div class="container">
        <?php if (get_sub_field('title')) : ?>
            <h3 class="main_title"><?php echo get_sub_field('title') ?></h3>
        <?php endif; ?>
        <?php if (get_sub_field('subtitle')) : ?>
            <h4 class="subtitle"><?php echo get_sub_field('subtitle') ?></h4>
        <?php endif; ?>
        <div class="row feature">
            <?php
            if (have_rows('features')) :
                while (have_rows('features')) : the_row();
            ?>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="wrapper" style="border-left-color: <?php echo get_sub_field('border_color') ?>;border-bottom-color: <?php echo get_sub_field('border_color') ?> ">
                                    <?php if (get_sub_field('icon')) : ?>
                                        <i class="<?php echo get_sub_field('icon') ?>"></i>
                                    <?php endif; ?>
                                    <p class="title"> <?php echo get_sub_field('title'); ?></p>
                                    <div class="content">
                                        <?php echo get_sub_field('content'); ?>
                                    </div>
                                    <i class="fas fa-cloud below-icon" style="color: <?php echo get_sub_field('border_color') ?>"></i>
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
</section>