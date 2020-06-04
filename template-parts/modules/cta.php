<section class="cta_buttons-section" style="<?php echo get_sub_field('background') < 1 ? 'background:url(' . get_sub_field('background_image') . ')' : 'background:' . get_sub_field('background_color') ?>">
    <div class="container">
        <h3 class="main_title"><?php echo get_sub_field('title') ?></h3>
        <?php if (get_sub_field('subtitle')) : ?>
            <h4 class="subtitle"><?php echo get_sub_field('subtitle') ?></h4>
        <?php endif; ?>
        <div class="buttons_wrapper">
            <div class="row">
                <?php
                if (have_rows('cta_buttons')) :
                    while (have_rows('cta_buttons')) : the_row();
                ?>
                        <div class="col-md-4 col-sm-4">
                            <div class="wrapper">
                                <a style="background: <?php echo get_sub_field("background_color") ?>" href="<?php echo get_sub_field('button_link') ?>"><?php echo get_sub_field('button_label') ?></a>
                            </div>
                        </div>
                <?php
                    endwhile;
                endif;
                ?>
            </div>
        </div>
    </div>
</section>