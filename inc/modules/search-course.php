<?php
/**
 * search_course section
 *
 * This is the template for the content of search_course section
 *
 * @package Theme Palace
 * @subpackage Kids Education
 * @since Kids Education 0.1
 */
if ( class_exists( 'TP_Education' ) ) :
    if ( ! function_exists( 'kids_education_add_search_course_section' ) ) :
        /**
        * Add search_course section
        *
        *@since Kids Education 0.1
        */
        function kids_education_add_search_course_section() {
            // Check if search_course is enabled on frontpage
            $search_course_enable = apply_filters( 'kids_education_section_status', true, 'search_course_enable' );
            if ( true !== $search_course_enable ) {
                return false;
            }

            // Render search_course section now.
            kids_education_render_search_course_section();
        }
    endif;
    add_action( 'kids_education_primary_content', 'kids_education_add_search_course_section', 40 );

    if ( ! function_exists( 'kids_education_render_search_course_section' ) ) :
        /**
        * Start search_course section
        *
        * @return string search_course content
        * @since Kids Education 0.1
        *
        */
        
        function kids_education_render_search_course_section() {
            $section_bottom_disabled = kids_education_search_course_no_margin_top();

            $section_class = !empty( $section_bottom_disabled ) ? 'no-margin-top' : '';
        ?>
            <section id="search-course-tab" class="page-section <?php echo esc_attr( $section_class ); ?> move-section-up background-image-properties os-animation" data-os-animation="fadeIn">
                <div class="container">
                    <div class="entry-content">
                        <?php do_shortcode( '[TP_EDUCATION_SEARCH_TAB]' ); ?>
                    </div><!-- .entry-content -->
                </div><!-- .container -->
            </section><!-- .search-course-tab -->
        <?php 
        }
    endif;
endif;