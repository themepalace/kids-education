<?php
/**
 * Social Media Widget
 *
 * @package Theme Palace
 * @subpackage Kids Education
 * @since Kids Education 0.1
 */

if ( ! class_exists( 'kids_education_Social_Link' ) ) :
	/**
	 * Social Media class.
	 *
	 * @since Kids Education 0.1
	 */
	class kids_education_Social_Link extends WP_Widget {
		/**
		 * Sets up the widgets name etc
		 */
		public function __construct() {
			$widget_ops = array(
				'classname'   => 'widget_social_icons',
				'description' => __( 'Enter the url only the icon will be displayed as per the links.', 'kids-education' ),
			);
			parent::__construct( 'kids_education_social_link', __( 'TP : Social Link','kids-education' ), $widget_ops );
		}

		/**
		 * Outputs the content of the widget
		 *
		 * @param array $args
		 * @param array $instance
		 */
		public function widget( $args, $instance ) {
			// outputs the content of the widget
			if ( ! isset( $args['widget_id'] ) ) {
				$args['widget_id'] = $this->id;
			}

			$title 	= ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';

			$open_link  = ! empty( $instance['open_link'] ) ? true : false;
			$target = ( empty( $open_link ) ) ? '' : 'target=_blank';


			echo $args['before_widget'];
				if ( ! empty( $title ) ) {
					echo $args['before_title'] . esc_html( $title ) . $args['after_title'];
				}
			$number = isset( $instance['number'] ) ? absint( $instance['number'] ) : 3; ?>

			   	<ul class="social-icons">
					<?php
					for ( $i=1; $i <= $number ; $i++ ) {
						$link = ( ! empty( $instance['link' . '-' . $i] ) ) ? $instance['link' . '-' . $i] : ''; 
					?>
				        <li><a href="<?php echo esc_url( $link ) . '" ' . esc_attr( $target ); ?> class="icon-animation icon-hover-effect"></a></li>
					<?php } ?>
	     		</ul>
			<?php
			echo $args['after_widget'];
		}

		/**
		 * Outputs the options form on admin
		 *
		 * @param array $instance The widget options
		 */
		public function form( $instance ) {
			$title     	= isset( $instance['title'] ) ? ( $instance['title'] ) : __( 'Stay Connected', 'kids-education' );
			$number 	= isset( $instance['number'] ) ? absint( $instance['number'] ) : 3;
			$open_link 	= isset( $instance['open_link'] ) ? $instance['open_link'] : false;
		   ?>

		   <p>
			   <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'kids-education' ); ?></label>
			   <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		   </p>

		   <p>
		   	<label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php _e( 'Number of links to show:', 'kids-education' ); ?></label>
		   	<input class="tiny-text" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="number" step="1" min="1" max="6" value="<?php echo absint( $number ); ?>" size="3" />
		   </p>

		   <p>
		      <label for="<?php echo esc_attr( $this->get_field_id( 'open_link' ) ); ?>"><?php _e( 'Open in New Tab', 'kids-education' ); ?>:</label>
		      <input type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'open_link' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'open_link' ), 'kids-education' ); ?>"  <?php checked( $open_link, true ); ?> />
		    </p>

		   <?php for ( $i=1; $i <= $number; $i++ ) {
		   	$link = isset( $instance['link'. '-' . $i ] ) ? $instance['link' . '-' . $i ] : '';?>
			   <p>
			   	<label for="<?php echo esc_attr( $this->get_field_id( 'link' . '-' . $i ) ); ?>"><?php printf( __( 'Link %s :', 'kids-education' ), $i ); ?></label>
			   	<input type="url" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link' . '-' . $i ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link' . '-' . $i ) ); ?>" value="<?php echo esc_url( $link ); ?>"/>
			   </p>
		   <?php }?>

		   <?php
		}

		/**
		* Processing widget options on save
		*
		* @param array $new_instance The new options
		* @param array $old_instance The previous options
		*/
		public function update( $new_instance, $old_instance ) {
			// processes widget options to be saved
			$instance           			= $old_instance;
			$instance['title']  			= sanitize_text_field( $new_instance['title'] );
			$instance['number'] 			= absint( $new_instance['number'] );
			$instance['open_link']       	= !empty( $new_instance['open_link'] ) ? 1 : 0;
			for ( $i=1; $i <= $instance['number']; $i++ ) {
				$instance['link' . '-' . $i] = esc_url( $new_instance['link' . '-' . $i] );
			}
			return $instance;
		}
	}
endif;

function kids_education_register_social_link_widget() {
	register_widget( 'kids_education_Social_Link' );
}
add_action( 'widgets_init', 'kids_education_register_social_link_widget' );