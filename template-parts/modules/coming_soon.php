<section class="coming_soon-section <?php echo get_sub_field('background_image') ? 'image' : '' ?>" style="<?php echo get_sub_field('background') < 1 ? 'background:url(' . get_sub_field('background_image') . ')' : 'background:' . get_sub_field('background_color') ?>">

    <div class="row">
        <div class="col-md-6">
            <?php echo get_sub_field('timer') ?>
        </div>
        <div class="col-md-6">
            <div class="right">
                <!-- <?php the_custom_logo() ?> -->
                <?php echo get_sub_field('content') ?>
                <div class="row">
                    <div class="col-md-6">
                        <a class='login' href=''>Login</a>
                    </div>
                    <div class="col-md-6">
                        <a class="signup" href='/signup'>Signup</a>
                    </div>
                </div>
            </div>
            <div class="footer">
                <div class="row">
                    <div class="col-xl-6">
                        <p><span>Phone:</span> <a href="tel:+6102345444">+6102345444</a></p>
                    </div>
                    <div class="col-xl-6">
                        <p><span>Email:</span> <a href="mailto:support@smartcloudphone.com.au">support@smartcloudphone.com.au</p>
                    </div>
                </div>

            </div>
        </div>
    </div>

</section>