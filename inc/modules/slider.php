<?php
/**
 * Slider section
 *
 * This is the template for the content of slider section
 *
 * @package Theme Palace
 * @subpackage Kids Education
 * @since Kids Education 0.1
 */
if ( ! function_exists( 'kids_education_add_slider_section' ) ) :
  /**
   * Add slider section
   *
   *@since Kids Education 0.1
   */
  function kids_education_add_slider_section() {

    // Check if slider is enabled on frontpage
    $enable_main_slider = apply_filters( 'kids_education_section_status', true, 'enable_main_slider' );

    if ( true !== $enable_main_slider ) {
      return false;
    }

    // Get slider section details
    $section_details = array();
    $section_details = apply_filters( 'kids_education_filter_slider_section_details', $section_details );

    if ( empty( $section_details ) ) {
      return;
    }

    // Render slider section now.
    kids_education_render_slider_section( $section_details );
  }
endif;
add_action( 'kids_education_primary_content', 'kids_education_add_slider_section', 10 );


if ( ! function_exists( 'kids_education_get_main_slider_section_details' ) ) :
  /**
   * Slider section details.
   *
   * @since Kids Education 0.1
   * @param array $input Slider section details.
   */
   function kids_education_get_main_slider_section_details( $input ) {
      $options = kids_education_get_theme_options(); 

      // Main SLider type
      $main_slider_content_type    = $options['main_slider_type'];
      $no_of_posts = $options['main_slider_no_of_posts'];

      $content = array();

         switch ( $main_slider_content_type ) {

            case 'page':
                $page_list = array();
                for ( $i = 1; $i <= $no_of_posts ; $i++ ) { 
                    $page_id    = ! empty ( $options['page_id_' . $i] ) ? absint( $options['page_id_' . $i] ) : '';
                    $page_list  = array_merge( $page_list, array( $page_id ) );
                }

                if ( ! empty( $page_list ) ) {
                
                    $args = array(
                        'post_type'          => 'page',
                        'post__in'           => $page_list,
                        'posts_per_page'     => $no_of_posts,
                    );
                }
            break;

            default:
            break;          
         }
         if( $options['main_slider_type'] != 'demo'  ) :
            
            if( ! empty ( $args ) ) :
                $custom_posts = get_posts( $args );
        
                $i = 0;
                foreach ( $custom_posts as $key => $custom_post ) {
                    $img_array = null;

                    if ( has_post_thumbnail( $custom_post->ID ) ) {
                            $img_array = wp_get_attachment_image_src( get_post_thumbnail_id( $custom_post->ID ), '' );
                    } else {
                            $img_array = array ( get_template_directory_uri() . '/assets/uploads/no-featured-image-1350x550.jpg' );
                    }

                    if ( isset( $img_array ) ) {
                        $content[$i]['img_array'] = $img_array;
                    }

                    $content[$i]['url']      = get_permalink( $custom_post->ID );
                    $content[$i]['title']    = get_the_title( $custom_post->ID );
                    $content[$i]['content']  = kids_education_trim_content( 20, $custom_post );
                $i++;
                }
            endif;
         endif;

         if ( ! empty( $content ) ) {
            $input = $content;
         }
    return $input; 
}
endif;
// Slider section content details.
add_filter( 'kids_education_filter_slider_section_details', 'kids_education_get_main_slider_section_details' );


if ( ! function_exists( 'kids_education_render_slider_section' ) ) :
  /**
   * Start slider section
   *
   * @return string Slider content
   * @since Kids Education 0.1
   *
   */
   function kids_education_render_slider_section( $content_details = array() ) {
        $options          = kids_education_get_theme_options();
        $read_more_button = $options['main_slider_learn_more_text']; 
        $content_type     = $options['main_slider_type'];

        $data_slick_value = '{"slidesToShow": 1, "slidesToScroll": 1, "infinite": true, "speed": 800, "dots": false, "arrows": true, "autoplay": true, "fade": false }';

        if ( empty( $content_details ) ) {
            return;
        } ?>
        <section id="main-slider">
            <div class="regular" data-effect="fade" data-slick=<?php echo "'" . $data_slick_value . "'"; ?>>

                <?php foreach ($content_details as $content_detail ) : ?> 
                <div class="slider-item" style="background-image:url('<?php echo esc_url( $content_detail['img_array'][0] ); ?>')">
                    <a href="<?php echo esc_url( $content_detail['url'] ); ?>">
                    <div class="black-overlay"></div></a>
                    <div class="main-slider-contents">
                        <?php if( !empty( $content_detail['title'] ) ){ ?>
                            <h2 class="title"><a href="<?php echo esc_url( $content_detail['url'] ); ?>"><?php echo esc_html( $content_detail['title'] );?></a></h2> 
                        <?php }
                        if( !empty( $content_detail['content'] ) ){ ?>
                            <p><?php echo esc_html( $content_detail['content'] );?></p>
                        <?php } 
                            $learn_more_link = ( 'demo' == $content_type ) ? '#' : $content_detail['url'];

                        if( !empty( $read_more_button ) ) :
                        ?>
                        <a href="<?php echo esc_url( $learn_more_link ); ?>" class="btn btn-default"><?php echo esc_html( $read_more_button );?></a>
                        <?php endif; ?>
                    </div><!-- .main-slider-contents -->
                </div><!-- .slider-item -->
                <?php endforeach; ?>

            </div><!-- .regular -->
            <div class="divider">
                <img src="<?php echo get_template_directory_uri() .'/assets/uploads/slider-divider.png'; ?>" alt="<?php _e( 'slider divider', 'kids-education' ); ?>">
            </div><!-- .divider -->
        </section><!-- #main-slider -->       
<?php 
    }
endif;