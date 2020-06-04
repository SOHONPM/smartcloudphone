<section class="feature_v3-section" style="<?php echo get_sub_field('background') < 1 ? 'background:url(' . get_sub_field('background_image') . ')' : 'background:' . get_sub_field('background_color') ?>">
    <div class="container">
        <h2 class="main_title"><?php echo get_sub_field('title') ?></h2>
        <?php if (get_sub_field('subtitle')) : ?>
            <h3 class="main_subtitle"><?php echo get_sub_field('subtitle') ?></h3>
        <?php endif; ?>
        <div class="row feature_v3">
            <?php
            if (have_rows('features')) :
                while (have_rows('features')) : the_row();
            ?>
                    <div class="col-md-4 pull-bottom">
                        <div class="wrapper" style="border-top-color:<?php echo get_sub_field('border_color') ?>!important">
                            <i class="<?php echo get_sub_field('icon') ?>"></i>
                            <h3 class="title"> <?php echo get_sub_field('title'); ?></h3>
                            <hr style="background-color:<?php echo get_sub_field('border_color') ?>">
                            <div class="content">
                                <h4 class="content_title"> <?php echo get_sub_field('subtitle'); ?></h3>
                                    <?php echo get_sub_field('content'); ?>
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
            <a href="<?php echo get_sub_field('button_link') ?>"><?php echo get_sub_field('button_label') ?></a>
        <?php endif; ?>
    </div>
</section>