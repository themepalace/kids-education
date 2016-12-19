<?php
/**
 * recent section
 *
 * This is the template for the content of recent section
 *
 * @package Theme Palace
 * @subpackage Kids Education
 * @since Kids Education 0.1
 */

if ( ! function_exists( 'kids_education_add_recent_section' ) ) :
    /**
    * Add recent section
    *
    *@since Kids Education 0.1
    */
    function kids_education_add_recent_section() {

        // Check if recent is enabled on frontpage
        $recent_enable = apply_filters( 'kids_education_section_status', true, 'recent_enable' );
        if ( true !== $recent_enable ) {
          return false;
        }

        // Get recent section details
        $section_details = array();
        $section_details = apply_filters( 'kids_education_filter_recent_section_details', $section_details );

        if ( empty( $section_details ) ) {
          return;
        }

        // Render recent section now.
        kids_education_render_recent_section( $section_details );
    }
endif;
add_action( 'kids_education_primary_content', 'kids_education_add_recent_section', 50 );


if ( ! function_exists( 'kids_education_get_recent_section_details' ) ) :
    /**
    * recent section details.
    *
    * @since Kids Education 0.1
    * @param array $input recent section details.
    */
    function kids_education_get_recent_section_details( $input ) {
        $options = kids_education_get_theme_options();

        //recent type
        $recent_content_type  = $options['recent_content_type'];

        $content = array();
        switch ( $recent_content_type ) {
            case 'demo':
                for ( $i=1; $i<=5; $i++ ) {
                  $content[ $i ]['img_array'][0] = get_template_directory_uri() . '/assets/uploads/recent-classes-0'.$i.'.jpg';
                  $content[$i]['url']          = '#';
                  $content[$i]['title']        = __( 'Shapes match class', 'kids-education' );
                  $content[$i]['alt']          = __( 'recent Image', 'kids-education' );
                }
            break;

            case 'post':
                $args = array(
                    'post_type'      => 'post',
                    'posts_per_page'  => absint( $options['recent_count'] ),
                );
            break;

            case 'class':
                $args = array(
                    'post_type'      => 'tp-class',
                    'posts_per_page'  => absint( $options['recent_count'] ),
                );
            break;

            case 'event':
                $args = array(
                    'post_type'      => 'tp-event',
                    'posts_per_page'  => absint( $options['recent_count'] ),
                );
            break;

            case 'course':
                $args = array(
                    'post_type'      => 'tp-course',
                    'posts_per_page'  => absint( $options['recent_count'] ),
                );
            break;

            case 'excursion':
                $args = array(
                    'post_type'      => 'tp-excursion',
                    'posts_per_page'  => absint( $options['recent_count'] ),
                );
            break;

            default:
            break;
        }

        if ( 'demo' != $recent_content_type ) {
            // Fetch posts.
            $posts = get_posts( $args );

            if ( ! empty( $posts ) ) {

                $i = 1;
                foreach ( $posts as $key => $post ) {
                    $page_id = $post->ID;
                    $img_array = null;
                    if ( has_post_thumbnail( $page_id ) ) {
                        $img_array = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'post-thumbnail', array( 'alt' => the_title_attribute( array( 'echo' => false) ) ) );
                    } else {
                        $img_array[0] =  get_template_directory_uri().'/assets/uploads/no-featured-image-300x200.jpg';
                    }

                    if ( isset( $img_array ) ) {
                        $content[$i]['img_array'] = $img_array;
                    }
                    $content[$i]['id']       = $page_id;
                    $content[$i]['url']      = get_permalink( $page_id );
                    $content[$i]['title']    = get_the_title( $page_id );
                    $content[$i]['alt']      = get_the_title( $page_id );
                    $content[$i]['excerpt']  = kids_education_trim_content( 15, $post );

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

// recent section content details.
add_filter( 'kids_education_filter_recent_section_details', 'kids_education_get_recent_section_details' );


if ( ! function_exists( 'kids_education_render_recent_section' ) ) :
    /**
    * Start recent section
    *
    * @return string recent content
    * @since Kids Education 0.1
    *
    */
    function kids_education_render_recent_section( $content_details = array() ) {
        $options                = kids_education_get_theme_options();
        $recent_title           = $options['recent_title'];
        $no_of_slides_visible   = !empty( $options['recent_visible_no_of_slides'] ) ? absint( $options['recent_visible_no_of_slides'] ) : 3;

        switch ( $no_of_slides_visible ) {
            case 4:
                $slides_visble_class = 'four-slides-visible';
                break;
            
            default:
                 $slides_visble_class = 'three-slides-visible';
                break;
        }

        if ( empty( $content_details ) ) {
          return;
        } ?>
        <section id="recent-classes-slider" class="page-section os-animation" data-os-animation="fadeIn">
            <div class="container">
                <header class="entry-header">
                    <?php if ( ! empty( $recent_title ) ) : ?>
                        <h2 class="entry-title"><?php echo esc_html( $recent_title ); ?></h2>
                    <?php endif; ?>
                </header><!-- .entry-header -->

                <div class="entry-content regular <?php echo esc_attr( $slides_visble_class ); ?>" data-slick='{"slidesToShow": <?php echo absint( $no_of_slides_visible ); ?>, "slidesToScroll": 1, "infinite": true, "speed": 800, "pauseOnHover": true, "draggable": true, "arrows":false, "autoplay": true, "dots": true }'>
                    <?php foreach ($content_details as $content_detail ) : ?> 
                        <div class="slider-item">
                            <div class="image-wrapper">
                                <a href="<?php echo esc_url( $content_detail['url'] ); ?>"><img src="<?php echo esc_url( $content_detail['img_array'][0] ); ?>" alt="<?php echo esc_attr( $content_detail['alt'] ); ?>">
                                <div class="white-overlay"></div></a>
                                <a href="<?php echo esc_url( $content_detail['url'] ); ?>" class="btn btn-blue"><?php echo esc_html( $options['read_more_text'] ); ?></a>
                            </div><!-- .image-wrapper -->
                            <div class="slider-contents">
                                <div class="slider-header-contents">
                                    <h5 class="title"><a href="<?php echo esc_url( $content_detail['url'] ); ?>"><?php echo esc_html( $content_detail['title'] ); ?></a></h5> 
                                    <div class="categories">
                                        <?php 
                                        $recent_content_type  = $options['recent_content_type'];
                                        if ( class_exists( 'TP_Education' ) ) :
                                            switch ( $recent_content_type ) {
                                                case 'class':
                                                    tp_education_get_terms( 'tp-class-category', $content_detail['id'] );
                                                break;

                                                case 'event':
                                                    tp_education_get_terms( 'tp-event-category', $content_detail['id'] );
                                                break;

                                                case 'course':
                                                    tp_education_get_terms( 'tp-course-category', $content_detail['id'] );
                                                break;

                                                case 'excursion':
                                                    tp_education_get_terms( 'tp-excursion-category', $content_detail['id'] );
                                                break;

                                                default:
                                                break;
                                            }
                                        endif;

                                        switch ( $recent_content_type ) {
                                            case 'post':
                                                the_category( ' ', '', $content_detail['id'] );
                                            break;

                                            case 'demo':
                                                echo '<a href="#" class="category-name">'. __( 'Kindergarden', 'kids-education' ) . '</a> <a href="#" class="category-name">'. __( 'Primary', 'kids-education' ) . '</a>';

                                            break;
                                              
                                            default:
                                            break;
                                        }
                                        ?>
                                    </div><!-- .categories -->
                                </div><!-- .slider-header-contents -->
                                <?php
                                if ( class_exists( 'TP_Education' ) ) :
                                    switch ( $recent_content_type ) {
                                        case 'class': ?>
                                            <div class="slider-footer-contents">
                                                <ul>
                                                    <li>
                                                        <?php  
                                                        // class age group
                                                        tp_class_age_group( $content_detail['id'] );
                                                        ?>
                                                    </li>
                                                    <li>
                                                        <?php  
                                                        // class size
                                                        tp_class_size( $content_detail['id'] );
                                                        ?>
                                                    </li>
                                                </ul>
                                                <div class="price">
                                                    <?php  
                                                    // class cost
                                                    tp_class_cost( $content_detail['id'] );    

                                                    // class period
                                                    tp_class_period( $content_detail['id'] );
                                                    ?>
                                                </div><!-- .price -->
                                            </div><!-- .slider-footer-contents -->
                                        <?php break;

                                        case 'event': ?>
                                            <div class="slider-footer-contents">
                                                <ul>
                                                    <li class="clear">
                                                        <?php  
                                                        // event date
                                                        tp_event_date( $content_detail['id'] );
                                                        ?>
                                                    </li>
                                                    <li>
                                                        <?php  
                                                        // event start time
                                                        tp_event_start_time( $content_detail['id'] );
                                                        ?>
                                                    </li>
                                                    <li>
                                                        <?php  
                                                        // event end time
                                                        tp_event_end_time( $content_detail['id'] );
                                                        ?>
                                                    </li>
                                                    <li class="clear">
                                                        <?php  
                                                        // event location
                                                        tp_event_location( $content_detail['id'] );
                                                        ?>
                                                    </li>
                                                </ul>
                                            </div><!-- .slider-footer-contents -->
                                        <?php break;

                                        case 'course': ?>
                                            <div class="slider-footer-contents">
                                                <ul>
                                                    <li>
                                                        <?php  
                                                        // course type
                                                        tp_course_type( $content_detail['id'] );
                                                        ?>
                                                    </li>
                                                    <li>
                                                        <?php  
                                                        // course duration
                                                        tp_course_duration( $content_detail['id'] );
                                                        ?>
                                                    </li>
                                                </ul>
                                            </div><!-- .slider-footer-contents -->
                                        <?php break;

                                        case 'excursion': ?>
                                            <div class="slider-footer-contents">
                                                <ul>
                                                    <li class="clear">
                                                        <?php  
                                                        // excursion start date
                                                        tp_excursion_start_date( $content_detail['id'] );
                                                        ?>
                                                    </li>
                                                    <li class="clear">
                                                        <?php  
                                                        // excursion end date
                                                        tp_excursion_end_date( $content_detail['id'] );
                                                        ?>
                                                    </li>
                                                    <li class="clear">
                                                        <?php  
                                                        // excursion location
                                                        tp_excursion_location( $content_detail['id'] );
                                                        ?>
                                                    </li>
                                                </ul>
                                            </div><!-- .slider-footer-contents -->
                                        <?php break;

                                        default:
                                        break;
                                    }
                                endif;
                                switch ( $recent_content_type ) {

                                    case 'post': ?>
                                        <div class="slider-footer-contents">
                                            <ul>
                                                <li><span><?php echo esc_html( $content_detail['excerpt'] ); ?></span></li>
                                            </ul>
                                        </div><!-- .slider-footer-contents -->
                                    <?php break;

                                    case 'demo': ?>
                                        <div class="slider-footer-contents">
                                            <ul>
                                                <li><small><?php _e( 'Years old', 'kids-education' ); ?></small><span><?php _e( '2-5', 'kids-education' ); ?></span></li>
                                                <li><small><?php _e( 'Class size', 'kids-education' ); ?></small><span><?php _e( '17', 'kids-education' ); ?></span></li>
                                            </ul>
                                            <div class="price"><small><?php _e( '$124', 'kids-education' ); ?></small><span><?php _e( 'per/day', 'kids-education' ); ?></span></div><!-- .price -->
                                        </div><!-- .slider-footer-contents -->
                                    <?php break;
                                              
                                    default:
                                    break;
                                }
                                ?>
                            </div><!-- .slider-contents -->
                        </div><!-- .slider-item -->
                    <?php endforeach; ?>
                </div><!-- .entry-content -->
            </div><!-- .container -->
        </section><!-- #recent-classes-slider -->
    <?php 
    }
endif;