<section class="form_map-section" style="<?php echo get_sub_field('background') < 1 ? 'background:url(' . get_sub_field('background_image') . ')' : 'background:' . get_sub_field('background_color') ?>">
    <div class="container">
        <div class="row">
            <div class="col-md-6 align-self-center">
                <?php echo get_sub_field('form') ?>
            </div>
            <div class="col-md-6">
                <?php echo get_sub_field('map') ?>
            </div>
        </div>
    </div>
</section>