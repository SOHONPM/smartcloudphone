<?php

/** 
*  Template Tags Functions
*
* Learn more: https://codex.wordpress.org/Functions_File_Explained
*
* @since   1.0.0
* @package themezero
*/



/**
*  BREADCRUMBS                        
*/

function the_breadcrumb() {
    $sep = '<span> > </span>';
    if (!is_front_page()) {
    
    // Start the breadcrumb with a link to your homepage
        echo '<div id="breadcrumbs" class="breadcrumbs">';
        echo '<a href="';
        echo get_option('home');
        echo '">';
        echo 'Home';
        echo '</a>' . $sep;
    
    // Check if the current page is a category, an archive or a single page. If so show the category or archive name.
        if (is_category() || is_single() ){
            
                the_category(', ', 'single');
            
        } elseif (is_archive() || is_single()){
            if ( is_day() ) {
                printf( __( '%s', 'text_domain' ), get_the_date() );
            } elseif ( is_month() ) {
                printf( __( '%s', 'text_domain' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'text_domain' ) ) );
            } elseif ( is_year() ) {
                printf( __( '%s', 'text_domain' ), get_the_date( _x( 'Y', 'yearly archives date format', 'text_domain' ) ) );
            } else {
                _e( 'Blog Archives', 'text_domain' );
            }
        }
    
    // If the current page is a single post, show its title with the separator
        if (is_single()) {
            echo $sep;
            the_title();
        }
    
    // If the current page is a static page, show its title.
        if (is_page()) {
            echo the_title();
        }
    
    // if you have a static page assigned to be you posts list page. It will find the title of the static page and display it. i.e Home >> Blog
        if (is_home()){
            global $post;
            $page_for_posts_id = get_option('page_for_posts');
            if ( $page_for_posts_id ) { 
                $post = get_page($page_for_posts_id);
                setup_postdata($post);
                the_title();
                rewind_posts();
            }
        }
        echo '</div>';
    }
}


/**
* Extra Entry Info
*
* @return tags,cats,comments Visible only if Login user
*/
if ( ! function_exists( 'themezero_posted_on' ) ) :

        function themezero_posted_on() {

            $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
            if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
                $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
            }
            $time_string = sprintf( $time_string,
                esc_attr( get_the_date( 'c' ) ),
                esc_html( get_the_date() ),
                esc_attr( get_the_modified_date( 'c' ) ),
                esc_html( get_the_modified_date() )
            );
            $posted_on = sprintf(
                esc_html_x( 'Posted on %s', 'post date', 'themezero' ),
                 $time_string 
            );
            $byline = sprintf(
                esc_html_x( 'by %s', 'post author', 'themezero' ),
                '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author_meta( 'display_name' ) ) . '</a></span>'
            );
            echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

        }
endif;


/**
* Extra Entry Info
*
* @return tags,cats,comments Visible only if Login user
*/
if ( ! function_exists( 'themezero_entry_footer' ) ) :

        function themezero_entry_footer() {
            // Hide category and tag text for pages.
            if ( 'post' === get_post_type() ) {
                /* translators: used between list items, there is a space after the comma */
                $categories_list = get_the_category_list( esc_html__( ', ', 'themezero' ) );
                if ( $categories_list ) {
                    printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'themezero' ) . '</span>', $categories_list ); // WPCS: XSS OK.
                }
                /* translators: used between list items, there is a space after the comma */
                $tags_list = get_the_tag_list( '', esc_html__( ', ', 'themezero' ) );
                if ( $tags_list ) {
                    printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'themezero' ) . '</span>', $tags_list ); // WPCS: XSS OK.
                }
            }
            if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
                echo '<span class="comments-link">';
                comments_popup_link( esc_html__( 'Leave a comment', 'themezero' ), esc_html__( '1 Comment', 'themezero' ), esc_html__( '% Comments', 'themezero' ) );
                echo '</span>';
            }
            edit_post_link(
                sprintf(
                    /* translators: %s: Name of current post */
                    esc_html__( 'Edit %s', 'themezero' ),
                    the_title( '<span class="screen-reader-text">"', '"</span>', false )
                ),
                '<span class="edit-link">',
                '</span>'
            );
        }
endif;


/**
*
* @return Display Custom Pagination from custom query
* @param $query Custom Query
*/
if ( ! function_exists( 'themezero_pagination_links' ) ) :

        function themezero_pagination_links($query) {

            $big = 999999999; // need an unlikely integer


                $args = array(
                    'base'                 => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                    'format'             => '?paged=%#%',
                    'total'              => $query->max_num_pages,
                    'current'            =>  max( 1, get_query_var('paged') ),
                    'show_all'           => false,
                    'end_size'           => 1,
                    'mid_size'           => 2,
                    'prev_next'          => true,
                    'prev_text'          => __('« '),
                    'next_text'          => __(' »'),
                    'type'               => 'list',
                    'add_args'           => false,
                    'add_fragment'       => '',
                    'before_page_number' => '',
                    'after_page_number'  => ''
                );

            echo paginate_links( $args );
        }

endif;


/**
* This is use to return logo setup from customizer
*
* @return Logo Image
*/
if ( ! function_exists( 'themezero_get_logo' ) ) :

    function themezero_get_logo() {

        $custom_logo_id = get_theme_mod( 'custom_logo' );

        $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
        if ( has_custom_logo() ) {
                echo wp_get_attachment_image($custom_logo_id);
        } else {
                echo '<h1>'. get_bloginfo( 'name' ) .'</h1>';
        }

    
    }

endif;


/**
*
* @return Display Archive Pagination
*/
if ( ! function_exists( 'themezero_pagination' ) ) :

    function themezero_pagination() {
        if ( is_singular() ) {
            return;
        }

        global $wp_query;

        /** Stop execution if there's only 1 page */
        if ( $wp_query->max_num_pages <= 1 ) {
            return;
        }

        $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
        $max   = intval( $wp_query->max_num_pages );

        /**    Add current page to the array */
        if ( $paged >= 1 ) {
            $links[] = $paged;
        }

        /**    Add the pages around the current page to the array */
        if ( $paged >= 3 ) {
            $links[] = $paged - 1;
            $links[] = $paged - 2;
        }

        if ( ( $paged + 2 ) <= $max ) {
            $links[] = $paged + 2;
            $links[] = $paged + 1;
        }

        echo '<nav aria-label="Page navigation"><ul class="pagination ">' . "\n";

        /**    Link to first page, plus ellipses if necessary */
        if ( ! in_array( 1, $links ) ) {
            $class = 1 == $paged ? ' class="active page-item"' : ' class="page-item"';

            printf( '<li %s><a class="page-link" href="%s"><i class="fa fa-step-backward" aria-hidden="true"></i></a></li>' . "\n",
            $class, esc_url( get_pagenum_link( 1 ) ), '1' );

            /**    Previous Post Link */
            if ( get_previous_posts_link() ) {
                printf( '<li class="page-item page-item-direction page-item-prev"><span class="page-link">%1$s</span></li> ' . "\n",
                get_previous_posts_link( '<span aria-hidden="true">&laquo;</span><span class="sr-only">Previous page</span>' ) );
            }

            if ( ! in_array( 2, $links ) ) {
                echo '<li class="page-item"></li>';
            }
        }

        // Link to current page, plus 2 pages in either direction if necessary.
        sort( $links );
        foreach ( (array) $links as $link ) {
            $class = $paged == $link ? ' class="active page-item"' : ' class="page-item"';
            printf( '<li %s><a href="%s" class="page-link">%s</a></li>' . "\n", $class,
                esc_url( get_pagenum_link( $link ) ), $link );
        }

        // Next Post Link.
        if ( get_next_posts_link() ) {
            printf( '<li class="page-item page-item-direction page-item-next"><span class="page-link">%s</span></li>' . "\n",
                get_next_posts_link( '<span aria-hidden="true">&raquo;</span><span class="sr-only">Next page</span>' ) );
        }

        // Link to last page, plus ellipses if necessary.
        if ( ! in_array( $max, $links ) ) {
            if ( ! in_array( $max - 1, $links ) ) {
                echo '<li class="page-item"></li>' . "\n";
            }

            $class = $paged == $max ? ' class="active "' : ' class="page-item"';
            printf( '<li %s><a class="page-link" href="%s" aria-label="Next"><span aria-hidden="true"><i class="fa fa-step-forward" aria-hidden="true"></i></span><span class="sr-only">%s</span></a></li>' . "\n",
            $class . '', esc_url( get_pagenum_link( esc_html( $max ) ) ), esc_html( $max ) );
        }

        echo '</ul></nav>' . "\n";
    }

endif;