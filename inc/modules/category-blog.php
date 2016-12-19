<?php
/**
 * category_blog section
 *
 * This is the template for the content of category_blog section
 *
 * @package Theme Palace
 * @subpackage Kids Education
 * @since Kids Education 0.1
 */
if ( ! function_exists( 'kids_education_add_category_blog_section' ) ) :
  /**
   * Add category_blog section
   *
   *@since Kids Education 0.1
   */
  function kids_education_add_category_blog_section() {

    // Check if category_blog is enabled on frontpage
    $category_blog_enable = apply_filters( 'kids_education_section_status', true, 'category_blog_enable' );
    if ( true !== $category_blog_enable ) {
      return false;
    }

    // Get category_blog section details
    $section_details = array();
    $section_details = apply_filters( 'kids_education_filter_category_blog_section_details', $section_details );

    if ( empty( $section_details ) ) {
      return;
    }

    // Render category_blog section now.
    kids_education_render_category_blog_section( $section_details );
  }
endif;
add_action( 'kids_education_primary_content_footer', 'kids_education_add_category_blog_section', 10 );


if ( ! function_exists( 'kids_education_get_category_blog_section_details' ) ) :
  /**
   * category_blog section details.
   *
   * @since Kids Education 0.1
   * @param array $input category_blog section details.
   */
  function kids_education_get_category_blog_section_details( $input ) {
    $options = kids_education_get_theme_options();

    // category_blog type
    $category_blog_content_type  = $options['category_blog_content_type'];

    $content = array();
    switch ( $category_blog_content_type ) {

      case 'category':
        $cat_ids = '';
        if ( !empty( $options['category_blog_content_category'] ) ) {
            $cat_ids = $options['category_blog_content_category'];
        }
        
        // Bail if no valid pages are selected.
        if ( empty( $cat_ids ) ) {
            return $input;
        }
        $args = array(
            'post_type'      => 'post',
            'category__in'   => $cat_ids,
            'posts_per_page' => absint( $options['category_blog_count'] ),
            'orderby'        => 'ASC',
        );
      break;

      default:
      break;
    }

    if ( 'demo' != $category_blog_content_type ) {
      // Fetch posts.
      $posts = get_posts( $args );

      if ( ! empty( $posts ) ) {

          $i = 1;
          foreach ( $posts as $key => $post ) {

            $page_id = $post->ID;
            $img_array = null;

            if ( has_post_thumbnail( $page_id ) ) {
                $img_array = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'kids-education-blog-images' );
            } else {
                $img_array[0] =  get_template_directory_uri().'/assets/uploads/no-featured-image-175x230.jpg';
            }

            if ( isset( $img_array ) ) {
              $content[$i]['img_array'] = $img_array;
            }

            $year  = get_the_time('Y', $page_id );
            $month = get_the_time('m', $page_id );
            $day   = get_the_time('d', $page_id );

            $content[$i]['url']       = get_permalink( $page_id );
            $content[$i]['title']     = get_the_title( $page_id );
            $content[$i]['excerpt']   = kids_education_trim_content( 15, $post  );
            $content[$i]['alt']       = get_the_title( $page_id );
            $content[$i]['date']      = get_the_date( '', $page_id );
            $content[$i]['date_link'] = get_day_link( $year, $month, $day );
            $content[$i]['gmt_time']  = $post->post_date_gmt;
            $content[$i]['likes']     = function_exists( 'tp_education_like_button' )  ? tp_education_like_button( $page_id ) : '';
            $content[$i]['comment']   = get_comments_number( $page_id );

            $i++;
          }
      }
    }

    if ( ! empty( $content ) ) {
      $input = $content;
    }
    return $input;
  }
endif;
// category_blog section content details.
add_filter( 'kids_education_filter_category_blog_section_details', 'kids_education_get_category_blog_section_details' );


if ( ! function_exists( 'kids_education_render_category_blog_section' ) ) :
  /**
   * Start category_blog section
   *
   * @return string category_blog content
   * @since Kids Education 0.1
   *
   */
   function kids_education_render_category_blog_section( $content_details = array() ) {
        $options          = kids_education_get_theme_options();

        if ( empty( $content_details ) ) {
          return;
        } 
        $blog_content_type =  !empty(  $options['category_blog_content_type'] ) ? $options['category_blog_content_type'] : 'demo';
        $blog_title        = !empty( $options['category_blog_title'] ) ? $options['category_blog_title'] : '';
        $blog_description  = !empty( $options['category_blog_description'] ) ? $options['category_blog_description'] : '';
        ?>
        <section id="blog" class="page-section no-padding-top background-image-properties os-animation" data-os-animation="fadeIn">
        	<div class="blog-divider"><img src="<?php echo get_template_directory_uri();?>/assets/uploads/blog-divider.png"></div>
	        <div class="container">
	        <?php if( !empty( $blog_title ) ) : ?>
	         	<header class="entry-header">
	            <h2 class="entry-title"><?php echo esc_html( $blog_title ); ?></h2>
	          </header><!-- .entry-header -->
	        <?php endif; ?>

				<div class="entry-content two-columns">

				<?php foreach ( $content_details as $content_detail ): ?>
					<div class="column-wrapper has-post-thumbnail">
						<div class="blog-wrapper">
							<div class="blog-image">
								<a href="<?php echo esc_url( $content_detail['url'] ); ?>" class="post-thumbnail"><img src="<?php echo esc_url( $content_detail['img_array'][0] ); ?>" alt="<?php echo esc_html( $content_detail['title'] );?>"></a>
							</div><!-- .blog-image -->

							<div class="blog-contents">
								<h6 class="blog-title"><a href="<?php echo esc_url( $content_detail['url'] );?>"><?php echo esc_html( $content_detail['title'] );?></a></h6>
								<p class="entry-meta">
								  	<span class="posted-on">
								    	<span class="screen-reader-text"><?php _e( 'Posted on', 'kids-education' ); ?></span>
								    	<a href="<?php echo esc_url($content_detail['date_link'] );?>">
								      		<time class="entry-date published" datetime="<?php echo esc_attr( $content_detail['gmt_time'] );?>"><?php echo esc_html( $content_detail['date'] );?></time>
								      		<time class="updated" datetime="<?php echo esc_attr( $content_detail['gmt_time'] );?>"><?php echo esc_html( $content_detail['date'] ); ?></time>
								    	</a>
								  	</span><!-- .posted-on -->
								  	<?php if ( 'demo' == $blog_content_type ){
								        echo '<span class="likes"><a href="#"><i class="fa fa-likes"></i>'. absint( $content_detail['likes'] ) .'</a></span>';
								  	} else{
								    	echo wp_kses_post( $content_detail['likes'] );
								  	}?>

								  	<span class="comments-links">
								    	<span class="screen-reader-text"><?php _e( 'Comments', 'kids-education' ); ?></span> 
								 	<?php echo absint( $content_detail['comment'] );?>
								  	</span><!-- .comments-links -->
								</p><!-- .entry-meta -->

								<p><?php echo esc_html( $content_detail['excerpt']);?></p>
								<a href="<?php echo esc_url( $content_detail['url'] ); ?>" class="read-more"><?php echo esc_html( $options['read_more_text'] ); ?></a>
							</div><!-- .blog-contents -->
						</div><!-- .blog-wrapper -->
					</div><!-- .column-wrapper -->
				<?php
				endforeach;
				?>

				</div><!-- .entry-content -->
	        </div><!-- .container -->
      	</section><!-- #blog -->
    </div><!--.site-content-->

    <div class="footer-divider">
      <img src="<?php echo get_template_directory_uri();?>/assets/uploads/footer-divider.png" alt="">
    </div><!-- .footer-divider -->
<?php 
    }
endif;