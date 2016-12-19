<?php
/**
 * Kids Education custom helper funtions
 *
 * This is the template that includes all the other files for core featured of Kids Education
 *
 * @package Theme Palace
 * @subpackage Kids Education
 * @since Kids Education 0.1
 */

if( ! function_exists( 'kids_education_check_enable_status' ) ):
	/**
	 * Check status of content.
	 *
	 * @since Kids Education 0.1
	 */
  	function kids_education_check_enable_status( $input, $content_enable ){
		 $options = kids_education_get_theme_options();

		 // Content status.
		 $content_status = $options[ $content_enable ];

		 // Get Page ID outside Loop.
		 $query_obj = get_queried_object();
		 $page_id   = null;
	    if ( is_object( $query_obj ) && 'WP_Post' == get_class( $query_obj ) ) {
	    	$page_id = get_queried_object_id();
	    }

		 // Front page displays in Reading Settings.
		 $page_on_front  = get_option( 'page_on_front' );

		 if ( ( ! is_home() && is_front_page() ) && ( 'static-frontpage' === $content_status ) ) {
			$input = true;
		 }
		 else {
			$input = false;
		 }
		 return ( $input );

  	}
endif;
add_filter( 'kids_education_section_status', 'kids_education_check_enable_status', 10, 2 );


if ( ! function_exists( 'kids_education_is_frontpage_content_enable' ) ) :
	/**
	 * Check home page ( static ) content status.
	 *
	 *.0
	 *
	 * @param bool $status Home page content status.
	 * @return bool Modified home page content status.
	 */
	function kids_education_is_frontpage_content_enable( $status ) {
		if ( is_front_page() ) {
			$options = kids_education_get_theme_options();
			$front_page_content_status = $options['enable_frontpage_content'];
			if ( false === $front_page_content_status ) {
				$status = false;
			}
		}
		return $status;
	}

endif;

add_filter( 'kids_education_filter_frontpage_content_enable', 'kids_education_is_frontpage_content_enable' );


add_action( 'kids_education_simple_breadcrumb', 'kids_education_simple_breadcrumb' , 10 );
if ( ! function_exists( 'kids_education_simple_breadcrumb' ) ) :

	/**
	 * Simple breadcrumb.
	 *
	 *
	 * @param  array $args Arguments
	 */
	function kids_education_simple_breadcrumb( $args = array() ) {

		/**
		 * Add breadcrumb.
		 *
		 */
		$options = kids_education_get_theme_options();
		// Bail if Breadcrumb disabled.
		$breadcrumb = $options['breadcrumb_enable'];
		if ( false === $breadcrumb ) {
			return;
		}

		$args = array(
			'show_on_front'   => false,
			'show_title'      => true,
			'show_browse'     => false,
		);
		breadcrumb_trail( $args );      

		return;
	}

endif;


add_action( 'kids_education_action_pagination', 'kids_education_pagination', 10 );

if ( ! function_exists( 'kids_education_pagination' ) ) :

	/**
	 * pagination.
	 *
	 * @since Kids Education 0.1
	 */
	function kids_education_pagination() {
		$options = kids_education_get_theme_options();
		if ( true == $options['pagination_enable'] ) {
			$pagination = $options['pagination_type'];
			if ( $pagination == 'default' ) :
				the_posts_navigation();
			elseif ( $pagination == 'numeric' ) :
				the_posts_pagination( array(
				    'mid_size' => 2,
				    'prev_text' => __( 'Previous', 'kids-education' ),
				    'next_text' => __( 'Next', 'kids-education' ),
				) );
			endif;
		}
	}

endif;

add_action( 'kids_education_action_post_pagination', 'kids_education_post_pagination', 10 );

if ( ! function_exists( 'kids_education_post_pagination' ) ) :

	/**
	 * post pagination.
	 *
	 * @since Kids Education 0.1
	 */
	function kids_education_post_pagination() {
		$options = kids_education_get_theme_options(); // get theme options

		if( $options['post_navigation_enable'] ){

			$args = array( 
				'prev_text'          => __( 'prev post:', 'kids-education' ),
	            'next_text'          => __( 'next post:', 'kids-education' ),
	            'in_same_term'       => true,
	            'screen_reader_text' => __( 'Continue Reading', 'kids-education' ),
	        );

	        if( 'post_title' == $options['post_navigation_type'] ){
	        	$args = array(
		        	'prev_text'                  => __( '%title', 'kids-education' ),
	            	'next_text'                  => __( '%title', 'kids-education' ),
	            	'in_same_term'               => true,
	            	'screen_reader_text' => __( 'Continue Reading', 'kids-education' ),
	            );
	        }

			the_post_navigation( $args );	
		}

	}
endif;

/**
 * long excerpt
 * 
 * @since Kids Education 0.1
 * @return  long excerpt value
 */
function kids_education_excerpt_length(){
	$options = kids_education_get_theme_options();
	$length = $options['long_excerpt_length'];
	return $length;
}
/**
 * create the custom excerpts callback
 *
 * @since Kids Education 0.1
 * @return  custom excerpts callback
 */
function kids_education_custom_excerpt( $length_callback = '', $more_callback = '' ){
	$post_id = get_queried_object_id();
	if ( function_exists( $length_callback ) ){
		add_filter( 'excerpt_length', $length_callback );
	}
	$output = get_the_excerpt( $post_id );
	$output = apply_filters( 'wptexturize', $output );
	$output = apply_filters( 'convert_chars', $output );
	$output = $output;
	echo esc_html( $output );
}

// read more
function kids_education_excerpt_more( $more ){
	return '...';
}
add_filter( 'excerpt_more', 'kids_education_excerpt_more' );

/**
 * custom excerpt function
 * 
 * @since Kids Education 0.1
 * @return  no of words to display
 */
function kids_education_trim_content( $length = 40, $post_obj = null ) {
	global $post;
	if ( is_null( $post_obj ) ) {
		$post_obj = $post;
	}

	$length = absint( $length );
	if ( $length < 1 ) {
		$length = 40;
	}

	$source_content = $post_obj->post_content;
	if ( ! empty( $post_obj->post_excerpt ) ) {
		$source_content = $post_obj->post_excerpt;
	}

	$source_content = preg_replace( '`\[[^\]]*\]`', '', $source_content );
	$trimmed_content = wp_trim_words( $source_content, $length, '...' );

   return apply_filters( 'kids_education_trim_content', $trimmed_content );
}


if ( ! function_exists( 'kids_education_custom_content_width' ) ) :

	/**
	 * Custom content width.
	 *
	 * @since Kids Education 0.1
	 */
	function kids_education_custom_content_width() {

		global $content_width;

		if ( ! is_active_sidebar( 'sidebar-1' ) ) {
			$content_width = 1170;
		}else {
			  $content_width = 819;
		}

	}
endif;
add_action( 'template_redirect', 'kids_education_custom_content_width' );

if ( ! function_exists( 'kids_education_get_thumbnail_image' ) ) :
	/**
	 * display post or page thumbnail image
	 *
	 * @since Kids Education 0.1
	 *
	 * @return string value
	 */
	function kids_education_get_thumbnail_image() {
		if ( post_password_required() || is_attachment() ) {
		return;
		}

		if ( is_singular() ) {
			if( has_post_thumbnail() ){
				the_post_thumbnail( 'full', array( 'alt' => the_title_attribute( 'echo=0' ) ) ); 
			}

		} elseif( is_home() ){ ?>
			<a class="post-thumbnail" href="<?php echo esc_url( get_the_permalink() ); ?>" aria-hidden="true">
			<?php 
				if( has_post_thumbnail() ){
					the_post_thumbnail( 'kids-education-blog-images',  array( 'alt' => the_title_attribute( 'echo=0' ) ) );
				} else { 
					echo '<img  src="'. esc_url( get_template_directory_uri() .'/assets/uploads/no-featured-image-175x230.jpg') .'" alt="'. get_the_title() .'">';
				}
			?>
			</a>
			<?php

		} elseif( is_archive() || is_search() ){ ?>

			<a class="post-thumbnail" href="<?php echo esc_url( get_the_permalink() ); ?>" aria-hidden="true">
			<?php 
				if( has_post_thumbnail() ){
					the_post_thumbnail( 'kids-education-archive-search-image',  array( 'alt' => the_title_attribute( 'echo=0' ) ) );
				}else {
					echo '<img  src="'. esc_url( get_template_directory_uri() .'/assets/uploads/no-featured-image-350x265.jpg') .'" alt="'. get_the_title() .'">';
				}
			?>
			</a>
		<?php

		}
		else { ?>
			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
				<?php the_post_thumbnail( 'post-thumbnail', array( 'alt' => the_title_attribute( 'echo=0' ) ) ); ?>
			</a>
		<?php } 
	}
endif;
/*
 * Function to get author profile
 */           
function kids_education_get_author_profile(){
    $author_url = !empty( get_the_author_meta( 'user_url' ) ) ? get_the_author_meta( 'user_url' ) : '#' ;
    ?>
    <div class="about-author">
        <div class="author-image">
          	<?php echo get_avatar( get_the_author_meta( 'ID' ), 150 );  ?>
        </div><!-- .author-image -->
        <div class="author-content">
          	<div class="author-name clear">
             	<h6><?php the_author_posts_link(); ?></h6>
          	</div><!-- .author-name -->
         	<?php if( !empty(  get_the_author_meta( 'description') ) ) : ?>
        	<p><?php the_author_meta( 'description'); ?></p>
        	<?php endif; ?>
        </div><!-- .author-content -->
    </div><!-- .about-author -->
<?php
}
add_action( 'kids_education_author_profile', 'kids_education_get_author_profile' );


/*
 * Function to get related posts
 */           
function kids_education_get_related_posts(){
    global $post;

    $options = kids_education_get_theme_options(); // get theme options

    $post_categories = get_the_category( $post->ID ); // get category object
    $category_ids = array(); // set an empty array

    foreach ( $post_categories as $post_category ) {
      $category_ids[] = $post_category->term_id;
    }

    if( empty( $category_ids ) ) return;

    $qargs = array(
            'posts_per_page'  => 2,
            'category__in'    => $category_ids,
            'post__not_in'    => array( $post->ID ),
            'order'           => 'ASC',
            'orderby'         => 'rand'
        );

    $related_posts = get_posts( $qargs ); // custom posts
    ?>
    	 	<div id="related-posts" class="two-columns">
          <h2 class="related-post-title"><?php _e( 'Related posts', 'kids-education' ); ?></h2>

          <?php foreach ($related_posts as $related_post ) :

            if ( has_post_thumbnail( $related_post->ID ) ) {
                $img_array = wp_get_attachment_image_src( get_post_thumbnail_id( $related_post->ID ), 'kids-education-related-posts-image' );
            } else {
                $img_array = array( get_template_directory_uri() . '/assets/uploads/no-featured-image-400x200.jpg' );
            }

			$post_title     = get_the_title( $related_post->ID );
			$post_url       = get_permalink( $related_post->ID );
			$post_date      = get_the_date( '', $related_post->ID);
			$post_content   = kids_education_trim_content( 20, $related_post );
			$post_date_gmt  = $related_post->post_date_gmt;
			$comment_number =  get_comments_number( $related_post->ID );

			$year  = get_the_time('Y', $related_post->ID );
            $month = get_the_time('m', $related_post->ID );
            $day   = get_the_time('d', $related_post->ID );


        	?>

          <article id="post-<?php the_ID(); ?>" class="column-wrapper <?php post_class(); ?>">
            <div class="blog-post-wrap">
               <a class="post-thumbnail" href="<?php echo esc_url( $post_url ); ?>" aria-hidden="true">
                  <img src="<?php echo esc_url( $img_array[0] ); ?>" alt="<?php echo esc_html( $post_title ); ?>">  
               </a><!-- .post-thumbnail -->

              <header class="entry-header">
                <h2 class="entry-title"><a href="<?php echo esc_url( $post_url ) ?>" rel="bookmark"><?php echo esc_html(  $post_title ); ?></a></h2> 
                <p class="entry-meta">
                  <span class="posted-on"><span class="screen-reader-text"><?php _e( 'Posted on', 'kids-education'); ?></span>
                    <a href="<?php echo esc_url( get_day_link( $year, $month, $day ) ); ?>">
                      <time class="entry-date published" datetime="<?php echo esc_attr( $post_date_gmt );?>"><?php echo esc_html( $post_date ); ?></time>
                      <time class="updated" datetime="<?php echo esc_attr( $post_date_gmt );?>"><?php echo esc_html( $post_date ); ?></time>
                    </a>
                  </span><!-- .posted-on -->

                 <?php 
                 	if( function_exists( 'tp_education_like_button') ) :
                 		$likes = tp_education_like_button( $related_post->ID );
                 		echo wp_kses_post( $likes );
                 	endif;
                ?>

                  <span class="comments-links">
                    <span class="screen-reader-text"><?php _e( 'Comments', 'kids-education'); ?></span> 
                    <span class="comments-number"><?php echo absint( $comment_number ); ?></span>
                  </span> 
                </p><!-- .entry-meta -->
              </header><!-- .entry-header -->

              <div class="entry-content">
                <p><?php echo esc_html( $post_content ); ?></p> 
                <a href="<?php echo esc_url( $post_url ); ?>" class="read-more"><?php _e( 'Read More','kids-education'); ?><i class="fa fa-angle-right"></i></a>
              </div><!-- .entry-content -->
            </div><!-- .blog-post-wrap -->
          </article><!-- #post -->
          <?php endforeach; ?>
        </div><!-- .two-columns -->

<?php   
}
add_action( 'kids_education_related_posts', 'kids_education_get_related_posts' );

if ( ! function_exists( 'kids_education_check_top_section' ) ) :
	/**
	 * Check if section is top section
	 *
	 * @since Kids Education 0.1
	 *
	 * @return string padding-top
	 */
	function kids_education_check_top_section() {
		
		$options = kids_education_get_theme_options(); // get theme options

		$sections_enable_id = array( 'enable_main_slider', 'features_enable', 'search_course_enable', 'recent_enable', 'gallery_enable', 'category_blog_enable' );

		foreach ($sections_enable_id as $key ) {
			$section_enabled =  apply_filters( 'kids_education_section_status', true, $key );

    		if ( true !== $section_enabled ) {
      			return  'padding-top';
    		}
    		return '';
		}
	}
endif;

if ( ! function_exists( 'kids_education_search_course_no_margin_top' ) ) :
	/**
	 * Check if section below search course is disabled
	 *
	 * @since Kids Education 0.1
	 *
	 * @return string no-margin-top
	 */
	function kids_education_search_course_no_margin_top() {
		
		$options = kids_education_get_theme_options(); // get theme options

		$sections_enable_id = array( 'recent_enable', 'gallery_enable' );

		foreach ($sections_enable_id as $key ) {
			$section_enabled =  apply_filters( 'kids_education_section_status', true, $key );

    		if ( true !== $section_enabled ) {
      			return  'no-margin-top';
    		}
    		return '';
		}
	}
endif;
