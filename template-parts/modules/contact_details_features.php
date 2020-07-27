<section class="contact_details_features-section" style="<?php echo get_sub_field('background') < 1 ? 'background:url(' . get_sub_field('background_image') . ')' : 'background:' . get_sub_field('background_color') ?>">
    <div class="container">
        <div class="row">
            <?php
            if (have_rows('features')) :
                while (have_rows('features')) : the_row();
            ?>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-3 right">
                                <img class="icons" src="<?php echo get_sub_field('icon') ?>" />
                            </div>
                            <div class="col-md-9">
                                <p class="title"><?php echo get_sub_field('title') ?></p>
                                <?php echo get_sub_field('content') ?>
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