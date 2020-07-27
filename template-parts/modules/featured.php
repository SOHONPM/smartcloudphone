<div class="featured-section">
    <div class="container">
        <ul>
            <?php
            // Define our WP Query Parameters

            $the_query = new WP_Query(array('cat' => '1')) ?>
            <?php
            // Start our WP Query
            while ($the_query->have_posts()) : $the_query->the_post();
                // Display the Post Title with Hyperlink
            ?>
                <div class="wrapper">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="thumbnail">
                                <?php the_post_thumbnail(); ?>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <a href="<?php the_permalink() ?>">
                                <p class="title"><?php the_title(); ?></p>
                            </a>
                            <?php
                            // Display the Post Excerpt
                            the_excerpt(__('(more…)')); ?>
                        </div>
                    </div>
                </div>
            <?php
            // Repeat the process and reset once it hits the limit
            endwhile;
            wp_reset_postdata();
            ?>
        </ul>
    </div>
</div>