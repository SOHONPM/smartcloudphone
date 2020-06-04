<?php
/**
 * Partial template for content post
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @since   1.0.0
 * @package themezero
 */

?>
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<div class="entry-content">

  		<div class="row">

          <div class="col-md-5">

                   <?php 
                 
                        if ( has_post_thumbnail() ) {

                            $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );

                            if ( ! empty( $large_image_url[0] ) ) {

                                echo '<div class="image" style="background-image: url(' . esc_url( $large_image_url[0] ) . ')">';
                                echo '</div>';
                            }

                        }
                        else {


                                echo '<div class="image" style="background-image: url(' . get_template_directory_uri() . '/assets/img/default-thumbnail.jpg)">';
                                echo '</div>';
                        }

                  ?> 
              
          </div>
          <div class="col-md-7">

               <div class="blog blog__header">
                   <h2 class="blog__title no-margin-top no-margin-bottom"><?php echo get_the_title() ?></h2>
                   <span class="blog__date"><?php echo get_the_date(); ?></span>
               </div>

               <div class="blog__excerpt">
                <?php the_excerpt(); ?>
              </div>
        
          </div>

      </div>

	
	</div><!-- .entry-content -->

</article>