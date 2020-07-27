<section class="headline-section" style="<?php echo get_sub_field('background') < 1 ? 'background:url(' . get_sub_field('background_image') . ')' : 'background:' . get_sub_field('background_color') ?>">
    <div class="container">
        <div class="row">
            <div class="col-md-4 align-self-center">
                <h2><?php echo get_sub_field('title') ?></h2>
                <?php if (get_sub_field('subtitle')) : ?>
                    <p><?php echo get_sub_field('subtitle') ?></p>
                <?php endif ?>
            </div>
            <div class="col-md-8">
                <div class="wrapper">
                    <h4 class="form_title"><?php echo get_sub_field('form_title') ?></h4>
                    <?php echo get_sub_field('form') ?>
                </div>
            </div>
        </div>
    </div>
</section>