<?php
/**
 * features section
 *
 * This is the template for the content of features section
 *
 * @package Theme Palace
 * @subpackage Kids Education
 * @since Kids Education 0.1
 */
if ( ! function_exists( 'kids_education_add_features_section' ) ) :
  /**
   * Add features section
   *
   *@since Kids Education 0.1
   */
  function kids_education_add_features_section() {

    // Check if features is enabled on frontpage
    $features_enable = apply_filters( 'kids_education_section_status', true, 'features_enable' );
    if ( true !== $features_enable ) {
      return false;
    }

    // Get features section details
    $section_details = array();
    $section_details = apply_filters( 'kids_education_filter_features_section_details', $section_details );

    if ( empty( $section_details ) ) {
      return;
    }

    // Render features section now.
    kids_education_render_features_section( $section_details );
  }
endif;
add_action( 'kids_education_primary_content', 'kids_education_add_features_section', 30 );


if ( ! function_exists( 'kids_education_get_features_section_details' ) ) :
  /**
   * features section details.
   *
   * @since Kids Education 0.1
   * @param array $input features section details.
   */
  function kids_education_get_features_section_details( $input ) {
    $options = kids_education_get_theme_options();

    // features type
    $features_content_type  = $options['features_section_type'];

    $content = array();
    switch ( $features_content_type ) {

      case 'category':
        $cat_id = '';
        if ( !empty( $options['features_dropdown_categories'] ) ) {
            $cat_id = $options['features_dropdown_categories'];
        }

        // Bail if no valid pages are selected.
        if ( empty( $cat_id ) ) {
            return $input;
        }
        $args = array(
            'no_found_rows'  => true,
            'cat'            => $cat_id,
            'post_type'      => 'post',
            'posts_per_page'  => 4,
            'orderby'        => 'ASC',
        );
      break;

      default:
      break;
    }

    if ( 'demo' != $features_content_type ) {
      // Fetch posts.
      $posts = get_posts( $args );

      if ( ! empty( $posts ) ) {

          $i = 1;
          foreach ( $posts as $key => $post ) {
            $page_id = $post->ID;

            $content[$i]['url']     = get_permalink( $page_id );
            $content[$i]['title']   = get_the_title( $page_id );
            $content[$i]['excerpt'] = kids_education_trim_content( 15, $post  );
            $content[$i]['icon']    = !empty( $options['features_icon_'.$i ] ) ? $options['features_icon_'.$i ] : '';

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
// features section content details.
add_filter( 'kids_education_filter_features_section_details', 'kids_education_get_features_section_details' );


if ( ! function_exists( 'kids_education_render_features_section' ) ) :
  /**
   * Start features section
   *
   * @return string features content
   * @since Kids Education 0.1
   *
   */
   function kids_education_render_features_section( $content_details = array() ) {
        $options              = kids_education_get_theme_options();
        $features_title       = !empty( $options['features_section_title'] ) ?  $options['features_section_title'] : '';

        if ( empty( $content_details ) ) {
          return;
        } ?>
        <section id="features" class="page-section background-image-properties os-animation move-section-up" data-os-animation="fadeInUp">
	        <div class="container">
	          	<header class="entry-header">
	          	<?php if( $features_title ){ ?>
	            	<h2 class="entry-title"><?php echo esc_html( $features_title );?></h2>
	          	<?php } ?>
	          	</header><!-- .entry-header -->

	          	<div class="entry-content four-columns">

			        <?php foreach ($content_details as $content_detail ) : ?>
			            <div class="column-wrapper">
			            <?php if( !empty( $content_detail['icon'] ) ){ ?>
			              	<div class="icon-container">
			                	<i class="fa <?php echo esc_attr( $content_detail['icon'] ); ?>"></i>
			              	</div><!-- .icon-container -->
			              	<?php } ?>
			              	<h5 class="title"><a href="<?php echo esc_url( $content_detail['url'] );?>"><?php echo esc_html( $content_detail['title'] );?></a></h5>
				            <?php if( !empty( $content_detail['excerpt'] ) ){ 
				                echo '<p>'. esc_html( $content_detail['excerpt'] ) . '</p>';
				            } ?>              
			            </div><!-- .column-wrapper -->
			        <?php endforeach; ?>

	          	</div><!-- .entry-content -->
	        </div><!-- .container -->
      	</section><!-- #features -->
      	
<?php 
    }
endif;