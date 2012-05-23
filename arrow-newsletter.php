<?php
/*
Plugin Name: Jamie's WP Arrow Newsletter Subscriber
Version: 0.1
Description: Widget to add Q5 Media's Arrow newsletter subscription form to your site
Author: Jamie Grove
Author URI: http://www.martiniboy.co.uk
Plugin URI: http://www.martiniboy.co.uk/wordpress-plugins/arrow-newsletter-subscriber/
wp_arrow_newsletter_subscriber
*/
/*  Copyright 2012  Jamie Grove  (email : jamie@martiniboy.co.uk)

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
add_action( 'widgets_init', 'newsletter_load_widgets' );

/**
 * Register our widget.
 * *
 * @since 0.1
 */
function newsletter_load_widgets() {
	register_widget( 'arrow_newsletter_Widget' );
}
class arrow_newsletter_Widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function arrow_newsletter_Widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'arrow', 'description' => __('Widget to add arrow newsletter subscription form', 'arrow') );

		/* Widget control settings. */
		$control_ops = array( 'id_base' => 'arrow-widget' );

		/* Create the widget. */
		$this->WP_Widget( 'arrow-widget', __('Arrow Newsletter Subscribe', ''), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$listID = $instance['listID'];
		$userID = $instance['userID'];
		$inputvalue = $instance['inputvalue'];
		$submitvalue = $instance['submitvalue'];
		$thankyouurl = $instance['thankyouurl'];
		$errorurl = $instance['errorurl'];

		/* Before widget (defined by themes). */
		echo $before_widget;

	?>

<form name="remote" method="post" action="http://geo.q5media.net/geobase/arrow/ar_RemoteSave.asp">
        <label>Email:</label>
                 <input type="textbox" onfocus="if(this.value=='<?php if ( $inputvalue )
			printf( $inputvalue );?>'){this.value=''};" onblur="if(this.value==''){this.value='<?php if ( $inputvalue )
			printf( $inputvalue );?>'};"  name="Email" maxlength="255" value="<?php if ( $inputvalue )
			printf( $inputvalue );?>" />
                <input type="hidden" name="adddel" value="add" checked="checked"/>
			<input type="hidden" name="ListID" value="<?php if ( $listID )
			printf( $listID );?>"/>
            <input type="hidden" name="mailtype" value="0" checked="checked"/>
            <input type="hidden" name="mailtype" value="1"/>
			<input type ="hidden" name="remotepagecolor" value="#FFFFFF"/>
            <input type="hidden" name="remotesize" value="300"/>
            <input type="hidden" name="remotebordercolor" value="#00CC99"/>
            <input type="hidden" name="remotebgcolor" value="#FFFFFF"/>
            <input type="hidden" name="remotefont" value="Arial,Helvetica,Sans-Serif"/>
            <input type="hidden" name="remotefontsize"  value="2"/>
            <input type="hidden" name="remotefontcolor" value="#000000"/>
            <input type="hidden" name="remotepopup" value="on">
            <input type="hidden" name="thankurl" value="<?php if ( $thankyouurl )printf( $thankyouurl );?>"/>
            <input type="hidden" name="errorurl" value="<?php if ( $errorurl )printf( $errorurl );?>"/>
            <input type="hidden" name="resultssendtoemail" value="0"/>
            <input type="hidden" name="resultsemail" value=""/>
            <input type="hidden" name="resultsemailprefs" value="0"/>
            <input type="hidden" name="popupwidth"  value=""/>
            <input type="hidden" name="popupheight" value=""/>
            <input type="hidden" name="linktext " value=""/>
            <input type="hidden" name="remotelinkcolor" value="#"/>
            <input type="hidden" name="remotetitle" value =""/>
            <input type="hidden" name="UserID" value="<?php if ( $userID )printf( $userID );?>"/>
            <input type="submit" id="submit" name="Submit" value="<?php if ( $submitvalue ) printf( $submitvalue );?>"/>
      </form>
<?php

		echo $after_widget;
	}
	function form( $instance ) {
		$defaults = array( 'listID' => __('', ''), 'userID' => __('','' ), 'submitvalue' => __('','' ));
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		<!-- Your Name: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'listID' ); ?>"><?php _e('List ID:', ''); ?></label>
			<input id="<?php echo $this->get_field_id( 'listID' ); ?>" name="<?php echo $this->get_field_name( 'listID' ); ?>" value="<?php echo $instance['listID']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'userID' ); ?>"><?php _e('User ID:', ''); ?></label> 
			<input id="<?php echo $this->get_field_id( 'userID' ); ?>" name="<?php echo $this->get_field_name( 'userID' ); ?>" value="<?php echo $instance['userID']; ?>" />
			
		</p>
        	<p>
			<label for="<?php echo $this->get_field_id( 'inputvalue' ); ?>"><?php _e('Input Value:', ''); ?></label> 
			<input id="<?php echo $this->get_field_id( 'inputvalue' ); ?>" name="<?php echo $this->get_field_name( 'inputvalue' ); ?>" value="<?php echo $instance['inputvalue']; ?>" />
			
		</p>
<p>
			<label for="<?php echo $this->get_field_id( 'submitvalue' ); ?>"><?php _e('Submit Value:', ''); ?></label> 
			<input id="<?php echo $this->get_field_id( 'submitvalue' ); ?>" name="<?php echo $this->get_field_name( 'submitvalue' ); ?>" value="<?php echo $instance['submitvalue']; ?>" />
			
		</p>
        <p>
			<label for="<?php echo $this->get_field_id( 'thankyouurl' ); ?>"><?php _e('Thankyou Url: thankyou message page', ''); ?></label> <br />
			<input id="<?php echo $this->get_field_id( 'thankyouurl' ); ?>" name="<?php echo $this->get_field_name( 'thankyouurl' ); ?>" value="<?php echo $instance['thankyouurl']; ?>" />
			
		</p>
        <p>
			<label for="<?php echo $this->get_field_id( 'errorurl' ); ?>"><?php _e('Error Url:  error message page', ''); ?></label>
			<input id="<?php echo $this->get_field_id( 'errorurl' ); ?>" name="<?php echo $this->get_field_name( 'errorurl' ); ?>" value="<?php echo $instance['errorurl']; ?>" />
			
		</p>
	
	<?php
	}
}

?>