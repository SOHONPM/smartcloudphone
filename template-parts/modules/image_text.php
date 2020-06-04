<section class="image_text-section" style="background:url(<?php echo get_sub_field('background') ?>)">
    <div class="container">
        <h3 class="main_title"><?php echo get_sub_field('title') ?></h3>
        <div class="row">
            <?php
            if (have_rows('image_text')) :

                // loop through the rows of data
                while (have_rows('image_text')) : the_row();
                    if (get_sub_field('image_right') > 0) :
            ?>
                        <div class="col-md-7">
                            <div class="wrapper">
                                <div class="content">
                                    <h4 class="title"><?php echo get_sub_field('title') ?></h4>
                                    <div class="content"><?php echo get_sub_field('content') ?></div>
                                    <?php
                                    if (get_sub_field('link_to')) :
                                    ?>
                                        <a href="<?php echo get_sub_field('link_to')['link_url'] ?>"><?php echo get_sub_field('link_to')['link_label'] ?></a>
                                    <?php
                                    endif;
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <img src="<?php echo get_sub_field('image') ?>">
                        </div>
                    <?php
                    else :
                    ?>
                        <div class="col-md-5">
                            <img src="<?php echo get_sub_field('image') ?>">
                        </div>
                        <div class="col-md-7">
                            <div class="wrapper">
                                <div class="content">
                                    <h4 class="title"><?php echo get_sub_field('title') ?></h4>
                                    <div class="content"><?php echo get_sub_field('content') ?></div>
                                    <?php
                                    if (get_sub_field('link_to')) :
                                    ?>
                                        <a href="<?php echo get_sub_field('link_to')['link_url'] ?>"><?php echo get_sub_field('link_to')['link_label'] ?></a>
                                    <?php
                                    endif;
                                    ?>
                                </div>
                            </div>
                        </div>
            <?php
                    endif;
                endwhile;

            else :

            // no layouts found

            endif;
            ?>
        </div>
    </div>
</section>