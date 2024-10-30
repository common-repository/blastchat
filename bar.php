<?php
/*  Copyright © 2004-2013 BlastChat - chat for your website or blog. All Rights Reserved.

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

class BlastChatBar_Widget extends WP_Widget {
	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
	 		'blastchatbar_widget', // Base ID
			'BlastChatBar_Widget', // Name
			array(
				'name' => __( 'BlastChat Bar', 'text_domain' ),
				'description' => __( 'Communication system for your website providing chat and instant messaging functionality', 'text_domain' )
			) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		extract( $args );
		//$title = apply_filters( 'widget_title', $instance['title'] );

		echo $before_widget;

		$par = blastchat_getconfig();

		$bcData = new stdClass();
		$bcData->detached = 0;
		$bcData->client = 'bar';
		$bcData->interface = $instance["interface"] ? $instance["interface"] : "bar";
		$bcData->version = "4.0";

		$bcData->roomids = $instance["rids"] ? $instance["rids"] : 1; //comma separated list of room ids to open
		$bcData->id = "bc_".$args['widget_id'];

		$bcData->barWidth = $instance["width"];
		$bcData->barHeight = $intsance["height"];

		include(dirname(__FILE__). DIRECTORY_SEPARATOR .'loader.php');
		echo '<div class="bcMainBarLoading bcMainLoading" id="'.$bcData->id.'"></div>';

		echo $after_widget;
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['interface'] = strip_tags( $new_instance['interface'] );
		$instance['width'] = strip_tags( $new_instance['width'] );
		$instance['height'] = strip_tags( $new_instance['height'] );
		$instance['rids'] = strip_tags( $new_instance['rids'] );

		return $instance;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : __( 'New title', 'text_domain' );
		$interface = isset( $instance[ 'interface' ] ) ? $instance[ 'interface' ] : __( "bar", 'text_domain' );
		$width = isset( $instance[ 'width' ] ) ? $instance[ 'width' ] : __( "180", 'text_domain' );
		$height = isset( $instance[ 'height' ] ) ? $instance[ 'height' ] : __( "30", 'text_domain' );
		$rids = isset( $instance[ 'rids' ] ) ? $instance[ 'rids' ] : __( "", 'text_domain' );
?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'interface' ); ?>" title="<?php _e( BLASTCHAT_FIELD_INTERFACE_DESC_BAR ); ?>"><?php _e( BLASTCHAT_FIELD_INTERFACE_LABEL.':' ); ?></label> 
		<select title="<?php _e( BLASTCHAT_FIELD_INTERFACE_DESC_BAR ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'interface' ); ?>" name="<?php echo $this->get_field_name( 'interface' ); ?>">
			<option value="bar" selected><?php _e( BLASTCHAT_FIELD_INTERFACE_BAR ); ?></option>
		</select>
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'width' ); ?>" title="<?php _e( BLASTCHAT_FIELD_WIDTH_DESC_BAR ); ?>"><?php _e( BLASTCHAT_FIELD_WIDTH_LABEL.':' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'width' ); ?>" title="<?php _e( BLASTCHAT_FIELD_WIDTH_DESC_BAR ); ?>" name="<?php echo $this->get_field_name( 'width' ); ?>" type="text" value="<?php echo esc_attr( $width ); ?>" />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'height' ); ?>" title="<?php _e( BLASTCHAT_FIELD_HEIGHT_DESC_BAR ); ?>"><?php _e( BLASTCHAT_FIELD_HEIGHT_LABEL.':' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'height' ); ?>" title="<?php _e( BLASTCHAT_FIELD_HEIGHT_DESC_BAR ); ?>" name="<?php echo $this->get_field_name( 'height' ); ?>" type="text" value="<?php echo esc_attr( $height ); ?>" />
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'rids' ); ?>" title="<?php _e( BLASTCHAT_FIELD_RIDS_DESC ); ?>"><?php _e( BLASTCHAT_FIELD_RIDS_LABEL.':' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'rids' ); ?>" title="<?php _e( BLASTCHAT_FIELD_RIDS_DESC ); ?>" name="<?php echo $this->get_field_name( 'rids' ); ?>" type="text" value="<?php echo esc_attr( $rids ); ?>" />
		</p>
<?php
	}
}
?>