<?php
/**
 *  The basic Simple Search Redirect widget
 *
 *  Build the simple little widget that will give users a search box that redirects their query to the selected search engine, with the site:{user's site url} filter applied.
 *
 *  @since Simple Search Redirect 1.0.0
 */
class Simple_Search_Redirect_Widget extends WP_Widget {



    /**
     *  set it all up
     *  @since Simple Search Redirect 1.0.0
     */
    function Simple_Search_Redirect_Widget() {

        $widget_ops = array(
            'classname'   => 'simple-search-redirect',
            'description' => __('Redirect users to various search engines with the `site:` filter for your site.', 'simple-search-redirect')
        );

        $control_ops = array(
            'width'   => 200,
            'height'  => 350,
            'id_base' => 'simple-search-redirect'
        );

        $this->WP_Widget(
            'simple-search-redirect',
            __('Simple Search Redirect', 'simple-search-redirect'),
            $widget_ops,
            $control_ops
        );
    
    }



    /**
     *  display the search input
     *  @since Simple Search Redirect 1.0.0
     */
    function widget( $args, $instance ) {

        extract( $args );

        // user settings
        $title   = apply_filters('widget_title', $instance['title'] );
        $engine  = $instance['engines'];
        $value   = apply_filters('simple_search_redirect_placeholder', $instance['value'] );
        $button  = isset( $instance['button'] ) ? $instance['button'] : false;
        $credits = isset( $instance['credits'] ) ? $instance['credits'] : false;

        // show submit button or not?
        $button_output = '';

        // clean site url
        $messy_url = get_site_url();
        $clean_url = $this->remove_protocols_from($messy_url);

        if( $button )
            $button_output = '<input type="submit" value="'. __('Search','simple-search-redirect') .'">';


        echo $before_widget;

        if ( $title )
            echo $before_title . $title . $after_title; 

        ob_start(); ?>

        <?php switch($engine) {

            case 'google' : ?>
                <form onsubmit="location.href='//www.google.com/search?q=' + document.getElementById('simple-search-redirect-google').value + '+site%3A<?php echo $clean_url; ?>'; return false;">
                    <input type="text" id="simple-search-redirect-google" placeholder="<?php echo esc_attr($value); ?>" class="widefat">
                    <?php echo $button_output; ?>
                </form>
            <?php break; 

            case 'duckduckgo' : ?>
                <form onsubmit="location.href='//www.duckduckgo.com/?q=' + document.getElementById('simple-search-redirect-duckduckgo').value + '+site%3A<?php echo $clean_url; ?>'; return false;">
                    <input type="text" id="simple-search-redirect-duckduckgo" placeholder="<?php echo esc_attr($value); ?>">
                    <?php echo $button_output; ?>
                </form>
            <?php break;

            case 'bing' : ?>
                <form onsubmit="location.href='//www.bing.com/search?q=' + document.getElementById('simple-search-redirect-bing').value + '+%20site%3A<?php echo $clean_url; ?>'; return false;">
                    <input type="text" id="simple-search-redirect-bing" placeholder="<?php echo esc_attr($value); ?>">
                    <?php echo $button_output; ?>
                </form>
            <?php break;

            case 'yahoo' : ?>
                <form onsubmit="location.href='//search.yahoo.com/search?p=' + document.getElementById('simple-search-redirect-yahoo').value + '+site%3A<?php echo $clean_url; ?>'; return false;">
                    <input type="text" id="simple-search-redirect-yahoo" placeholder="<?php echo esc_attr($value); ?>">
                    <?php echo $button_output; ?>
                </form>
            <?php break;
        }

        $search_form = ob_get_contents();
        ob_end_clean();

        echo $search_form;

        if ( $credits )
            printf( __('<p>Powered by <a href="%s">Simple Search Redirect</a></p>', 'simple-search-redirect'), '//wordpress.org/extend/plugins/simple-search-redirect');

        echo $after_widget;
    }



    /**
     *  save and update what the user sets
     *  @since Simple Search Redirect 1.0.0
     */
    function update( $new_instance, $old_instance ) {

        $instance = $old_instance;

        $instance['title']   = strip_tags( $new_instance['title'] );
        $instance['engines'] = $new_instance['engines'];
        $instance['value']   = strip_tags( $new_instance['value'] );
        $instance['button']  = $new_instance['button'];
        $instance['credits'] = $new_instance['credits'];

        return $instance;
    }



    /**
     *  the (very simple) widget interface
     *  @since Simple Search Redirect 1.0.0
     */
    function form( $instance ) {

        $defaults = array( 
            'title'   => __('Site Search', 'simple-search-redirect'),
            'engines' => 'google',
            'value'   => __('Search ...', 'simple-search-redirect'),
            'button'  => true,
            'credits' => true
        );

        $instance = wp_parse_args( (array) $instance, $defaults ); ?>

        <!-- Title -->
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title', 'simple-search-redirect'); ?></label>
            <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat">
        </p>

        <!-- Search Engines -->
        <p>
            <label for="<?php echo $this->get_field_id( 'engines' ); ?>">
                <p><?php _e('Search Engine','simple-search-redirect'); ?></p>
            </label> 
            <select id="<?php echo $this->get_field_id( 'engines' ); ?>" name="<?php echo $this->get_field_name( 'engines' ); ?>" class="widefat">
                <option value="google"      <?php if ( 'google' == $instance['engines'] ) echo 'selected="selected"';     ?>><?php _e('Google', 'simple-search-redirect');       ?></option>
                <option value="duckduckgo"  <?php if ( 'duckduckgo' == $instance['engines'] ) echo 'selected="selected"'; ?>><?php _e('Duck Duck Go', 'simple-search-redirect'); ?></option>
                <option value="bing"        <?php if ( 'bing' == $instance['engines'] ) echo 'selected="selected"';       ?>><?php _e('Bing', 'simple-search-redirect');         ?></option>
                <option value="yahoo"       <?php if ( 'yahoo' == $instance['engines'] ) echo 'selected="selected"';      ?>><?php _e('Yahoo', 'simple-search-redirect');        ?></option>
            </select>
        </p>

        <!-- Placeholder Text -->
        <p>
            <label for="<?php echo $this->get_field_id( 'value' ); ?>"><?php _e('Placeholder Text', 'simple-search-redirect'); ?></label>
            <input id="<?php echo $this->get_field_id( 'value' ); ?>" name="<?php echo $this->get_field_name( 'value' ); ?>" value="<?php echo $instance['value']; ?>" class="widefat">
        </p>

        <!-- Submit Button -->
        <p>
            <input class="checkbox" type="checkbox" <?php checked( $instance['button'], 'on' ); ?> id="<?php echo $this->get_field_id( 'button' ); ?>" name="<?php echo $this->get_field_name( 'button' ); ?>"> 
            <label for="<?php echo $this->get_field_id('button'); ?>"><?php _e('Show search submit button?', 'simple-search-redirect'); ?></label>
        </p>

        <!-- Credits -->
        <p>
            <input class="checkbox" type="checkbox" <?php checked( $instance['credits'], 'on' ); ?> id="<?php echo $this->get_field_id( 'credits' ); ?>" name="<?php echo $this->get_field_name( 'credits' ); ?>"> 
            <label for="<?php echo $this->get_field_id('credits'); ?>"><?php _e('Show plugin credits?', 'simple-search-redirect'); ?></label>
        </p>


        <?php
    }



    /**
     *  remove http:// and https:// from url so our filter can work
     *  thank you jakob relkin! http://stackoverflow.com/users/220819/jacob-relkin
     *  @since Simple Search Redirect 1.0.0
     */
    function remove_protocols_from($url) {

        // don't know of any WP sites, personally, using https://, but why not?
        $protocols = array('http://', 'https://');

        foreach($protocols as $protocol) :
            
            if(strpos($url, $protocol) === 0)
                return str_replace($protocol, '', $url);

        endforeach;

        return $url;
    }



} 

?>