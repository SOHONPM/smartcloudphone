<section class="feature_v2-section" style="<?php echo get_sub_field('background') < 1 ? 'background:url(' . get_sub_field('background_image') . ')' : 'background:' . get_sub_field('background_color') ?>">
    <div class="container">
        <h3 class="main_title"><?php echo get_sub_field('title') ?></h3>
        <?php if (get_sub_field('subtitle')) : ?>
            <h4 class="subtitle"><?php echo get_sub_field('subtitle') ?></h4>
        <?php endif; ?>
        <div class="row">
            <?php
            if (have_rows('features')) :
                while (have_rows('features')) : the_row();
            ?>
                    <div class="col-md-4">
                        <div class="wrapper" style="border-top-color:<?php echo get_sub_field('border_color') ?>!important">
                            <div class="container">
                                <i class="<?php echo get_sub_field('icon') ?>"></i>
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
        <?php
        if (have_rows('button')) : the_row();
        ?>
            <div class="button_div">
                <a class="findOutMore" href="<?php echo get_sub_field('button_link') ?>"><?php echo get_sub_field('button_label') ?></a>
            </div>
        <?php endif; ?>
    </div>
</section>