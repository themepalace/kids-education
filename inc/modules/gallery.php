<?php
/**
 * gallery section
 *
 * This is the template for the content of gallery section
 *
 * @package Theme Palace
 * @subpackage Kids Education
 * @since Kids Education 0.1
 */
if ( ! function_exists( 'kids_education_add_gallery_section' ) ) :
  /**
   * Add gallery section
   *
   *@since Kids Education 0.1
   */
  function kids_education_add_gallery_section() {

    // Check if gallery is enabled on frontpage
    $gallery_enable = apply_filters( 'kids_education_section_status', true, 'gallery_enable' );
    if ( true !== $gallery_enable ) {
      return false;
    }

    // Get gallery section details
    $section_details = array();
    $section_details = apply_filters( 'kids_education_filter_gallery_section_details', $section_details );

    if ( empty( $section_details ) ) {
      return;
    }

    // Render gallery section now.
    kids_education_render_gallery_section( $section_details );
  }
endif;
add_action( 'kids_education_primary_content', 'kids_education_add_gallery_section', 80 );


if ( ! function_exists( 'kids_education_get_gallery_section_details' ) ) :
  /**
   * gallery section details.
   *
   * @since Kids Education 0.1
   * @param array $input gallery section details.
   */
  function kids_education_get_gallery_section_details( $input ) {
    $options = kids_education_get_theme_options();

    // gallery type
    $gallery_content_type  = $options['gallery_source'];

    $content = array();
    switch ( $gallery_content_type ) {

      case 'category':
        $cat_ids = '';
        if ( !empty( $options['gallery_category'] ) ) {
            $cat_ids = $options['gallery_category'];
        }

        // Bail if no valid pages are selected.
        if ( empty( $cat_ids ) ) {
            return $input;
        }

        $args = array(
            'category__in'   => $cat_ids,
            'post_type'      => 'post',
            'posts_per_page' => absint( $options['gallery_no_of_img'] ),
            'order'          => 'ASC',
            'orderby'        => 'rand',
        );
      break;

      default:
      break;
    }

    if ( 'demo' != $gallery_content_type ) {
      // Fetch posts.
      $posts = get_posts( $args );

      if ( !empty( $posts ) ) {

          $i = 1;
          foreach ( $posts as $key => $post ) {
              $page_id = $post->ID;
              $img_array = null;
              $img_array_large = null;
            if ( has_post_thumbnail( $page_id ) ) {
                $img_array       = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'kids-education-gallery-section-small' );
                $img_array_large = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
            } else {
                $img_array[0]       =  get_template_directory_uri().'/assets/uploads/no-featured-image-300x300.png';
                $img_array_large[0] =  get_template_directory_uri().'/assets/uploads/no-featured-image-625x400.png';
            }

            $content[$i]['img_array']       = $img_array;
            $content[$i]['img_array_large'] = $img_array_large;
            $content[$i]['url']             = get_permalink( $page_id );
            $content[$i]['title']           = get_the_title( $page_id );
            $content[$i]['alt']             = get_the_title( $page_id );
            $content[$i]['terms']           = get_the_category( $page_id );

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
// gallery section content details.
add_filter( 'kids_education_filter_gallery_section_details', 'kids_education_get_gallery_section_details' );


if ( ! function_exists( 'kids_education_render_gallery_section' ) ) :
  /**
   * Start gallery section
   *
   * @return string gallery content
   * @since Kids Education 0.1
   *
   */
   function kids_education_render_gallery_section( $content_details = array() ) {

        if ( empty( $content_details ) ) {
          return;
        } 
        $options               = kids_education_get_theme_options();
        $content_type          = $options['gallery_source'];
        $gallery_title         = !empty( $options['gallery_title'] ) ? $options['gallery_title'] : '';
        $gallery_category_ids  = !empty( $options['gallery_category'] ) ? $options['gallery_category'] : array();
        $gallery_readmore_text = !empty( $options['gallery_page_readmore'] ) ? $options['gallery_page_readmore'] : '';
        $gallery_readmore_link = !empty( $options['gallery_page_link'] ) ? get_permalink( $options['gallery_page_link'] ) : '#';
        ?>
        <section id="portfolio-gallery" class="page-section move-section-up background-image-properties os-animation" data-os-animation="fadeIn">
            <div class="container">
                <?php if( !empty( $gallery_title ) ): ?>
                <header class="entry-header">
                  <h2 class="entry-title"><?php echo esc_html( $gallery_title );?></h2>
                </header><!-- .entry-header -->
                <?php endif; ?>

                <div class="entry-content">
                    <nav class="portfolio-filter">
                        <ul>
                        <?php 
                            echo '<li class="active"><a href="#" data-filter="*">'. __( 'Filter all', 'kids-education' ) .'</a></li>';
                            foreach ( $gallery_category_ids as $gallery_category_id ) {
                                $tp_category = get_category( $gallery_category_id );
                                echo '<li><a href="#" data-filter=".' . esc_attr( $tp_category->slug ) . '">' . esc_html( $tp_category->name ) . '</a></li>';
                            }
                          ?>
                        </ul>
                    </nav><!-- .portfolio-filter -->

                    <div id="four-col" class="portfolio-wrapper">
                      <?php foreach ($content_details as $content_detail ) { 

                        $categories = $content_detail['terms'];
                        $tab_name = '';
                        foreach ( $categories as $category ) {
                          $tab_name .= $category->slug . ' ';
                        }
                        
                        ?>

                        <div class="portfolio-item <?php echo esc_attr( $tab_name );?>">
                            <div class="image-wrapper">
                              <img src="<?php echo esc_url( $content_detail['img_array'][0] ); ?>" alt="<?php echo esc_attr( $content_detail['alt'] );?>">
                              <div class="blue-overlay"></div>
                            </div><!-- .image-wrapper -->
                            <div class="hovercontent">
                              <a data-title="Gallery" href="<?php echo esc_url( $content_detail['img_array_large'][0] ); ?>" data-lightbox="masonry"><i class="fa fa-search"></i></a>
                              <a href="<?php echo esc_url( $content_detail['url'] ); ?>"><i class="fa fa-link"></i></a>
                              <p><a href="<?php echo esc_url( $content_detail['url'] ); ?>"><?php echo esc_html( $content_detail['title'] ); ?></a></p>
                            </div><!-- end .hover-content -->
                        </div><!-- end .portfolio-item -->

                    <?php } ?>              
                    </div><!-- end portfolio -->

                    <?php 
                    if( !empty( $gallery_readmore_text ) ){ ?>
                        <div class="text-center">
                            <a href="<?php echo esc_url( $gallery_readmore_link ); ?>" class="btn btn-blue"><?php echo esc_html( $gallery_readmore_text ); ?></a>
                        </div><!-- end .text-center -->
                    <?php } ?>

                </div><!-- end .entry-content -->

            </div><!-- end .container -->
        </section><!-- #portfolio-gallery -->
<?php 
    }
endif;