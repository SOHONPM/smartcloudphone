<section class="text-section <?php echo get_sub_field('background_image') ? 'image' : '' ?>" style="<?php echo get_sub_field('background') < 1 ? 'background:url(' . get_sub_field('background_image') . ')' : 'background:' . get_sub_field('background_color') ?>">
    <div class="container">
        <h4 class="title"><?php echo get_sub_field('title') ?></h4>
        <?php echo get_sub_field('content') ?>
    </div>
</section>