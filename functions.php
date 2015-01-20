<?php
/**
 * VividMusic functions and definitions
 *
 * @package VividMusic
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'vivid_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function vivid_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on VividMusic, use a find and replace
	 * to change 'vivid' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'vivid', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'vivid' ),
	) );
	
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link'
	) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'vivid_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // vivid_setup
add_action( 'after_setup_theme', 'vivid_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function vivid_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'vivid' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'vivid_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function vivid_scripts() {
	wp_enqueue_style( 'vivid-style', get_stylesheet_uri() );

    if ( ! is_admin() ) {
        wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css', null, '4.1.0' );
    }

	wp_enqueue_script( 'vivid-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

    wp_enqueue_style( 'google-header-font', "http://fonts.googleapis.com/css?family=Roboto+Slab:700,400");
    wp_enqueue_style( 'google-body-font', "http://fonts.googleapis.com/css?family=Raleway:500");

	wp_enqueue_script( 'vivid-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	wp_enqueue_script( 'vivid-jquery-scrollto', 'http://balupton.github.io/jquery-scrollto/lib/jquery-scrollto.js', array('jquery'), '20130115', false );

	wp_enqueue_script( 'vivid-jquery.history', 'http://browserstate.github.io/history.js/scripts/bundled/html4+html5/jquery.history.js', array('jquery'), false, false );

	wp_enqueue_script( 'vivid-ajaxify-html5', 'http://rawgithub.com/browserstate/ajaxify/master/ajaxify-html5.js', array('jquery'), false, false );

    wp_enqueue_script( 'load-soundcloud-iframe', get_template_directory_uri() . '/js/load-soundcloud-iframe.js', array('jquery'), false, true);

    wp_enqueue_style( 'custom-scrollbar-style', get_template_directory_uri() . '/custom-scrollbar.css' );

    wp_enqueue_script( 'custom-scrollbar', "http://malihu.github.io/custom-scrollbar/jquery.mCustomScrollbar.concat.min.js", array('jquery'), false, false );

    wp_enqueue_script( 'load-custom-scrollbar', get_template_directory_uri() . '/js/load-custom-scrollbar.js', array('jquery'), false, false );

    wp_enqueue_script( 'responsive-nav', get_template_directory_uri() . '/js/responsive-nav.js', array('jquery'), false, false );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'vivid_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/*function new_wp_trim_excerpt($text) {
    $raw_excerpt = $text;
    if ( '' == $text ) {
        $text = get_the_content('');
 
        $text = strip_shortcodes( $text );
 
        $text = apply_filters('the_content', $text);
        $text = str_replace(']]>', ']]>', $text);
        $text = strip_tags($text, '<a>');
        $excerpt_length = apply_filters('excerpt_length', 55);
 
        $excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');
        $words = preg_split('/(<a.*?a>)|\n|\r|\t|\s/', $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY|PREG_SPLIT_DELIM_CAPTURE );
        if ( count($words) > $excerpt_length ) {
            array_pop($words);
            $text = implode(' ', $words);
            $text = $text . $excerpt_more;
        } else {
            $text = implode(' ', $words);
        }
    }
    return apply_filters('new_wp_trim_excerpt', $text, $raw_excerpt);
 
}
remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'new_wp_trim_excerpt');*/

// Replaces the excerpt "more" text by a link
function new_excerpt_more($more) {
       global $post;
	return ' ... ';
}
add_filter('excerpt_more', 'new_excerpt_more');


/***************************************************************** 

Create class Custom_Meta_Boxes for posts

******************************************************************/
class Custom_Meta_Boxes {

    protected $custom_meta_fields;

    function __construct() {
        $this->custom_meta_fields = $this->create_fields_array();
        //add_action( 'add_meta_boxes', array( $this, 'create_fields_array') );
        add_action( 'load-post.php', array( $this,'setup_boxes') );
        add_action( 'load-post-new.php', array( $this, 'setup_boxes') );


    }

    /* Meta box setup function. */
    function setup_boxes() {
      /* Add meta boxes on the 'add_meta_boxes' hook. */
      add_action( 'add_meta_boxes', array( $this, 'add_boxes') );
      /* Save post meta on the 'save_post' hook. */
      add_action('save_post', array( $this, 'save_meta'));
    }

    /* Create one or more meta boxes to be displayed on the post editor screen. */
    public function add_boxes() {

      /* Defines the choices meta box */
      add_meta_box(
        'custom_meta_box',      // Unique ID
        esc_html__( 'Songcloud Embed', 'example' ),    // Title
        array( $this, 'show_boxes' ),   // Callback function
        'post',         // Admin page (or post type)
        'normal',         // Context
        'default'         // Priority
      );
    }

    // Field Array
    function create_fields_array() {

        $fields_array = array();
        $prefix = 'custom_meta_';

        $fields_array[0] = array(
                'label'=> 'Soundcloud embed FULL link',
                'desc'  => 'Go to any Soundcloud song -> Share -> Embed -> Copy the (NON-wordpress) code. ',
                'id'    => $prefix.'songlink',
                'type'  => 'textarea'
            );
        $fields_array[1] = array(
                'label'=> 'Song name',
                'desc'  => 'What is the name of the song?',
                'id'    => $prefix.'songname',
                'type'  => 'text'
            );


        $fields_array[2] = array(
                'label'=> 'Song artist',
                'desc'  => 'By: __________ ',
                'id'    => $prefix.'songartist',
                'type'  => 'text'
            );


        return $fields_array;
    }

    // The Callback
    public function show_boxes() {

        global $post;


        // Use nonce for verification
        echo '<input type="hidden" name="custom_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';
         
        // Begin the field table and loop
        echo '<table class="form-table">';
        
        foreach ($this->custom_meta_fields as $field) {
            // get value of this field if it exists for this post
            $meta = get_post_meta($post->ID, $field['id'], true);
            // begin a table row with
            echo '<tr>
                    <th><label for="'.$field['id'].'">'.$field['label'].'</label></th>
                    <td>';
                    switch($field['type']) {
                        // text
                        case 'text':
                            echo '<input type="text" placeholder="'.$field['desc'].'" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="70" />';
                        break;
                        // textarea
                        case 'textarea':
                            echo '<textarea name="'.$field['id'].'" id="'.$field['id'].'" cols="60" rows="4">'.$meta.'</textarea>
                                <br /><span class="description">'.$field['desc'].'</span>';
                        break;
                        // select
                        case 'select':
                            echo '<select name="'.$field['id'].'" id="'.$field['id'].'">';
                            foreach ($field['options'] as $option) {
                                echo '<option', $meta == $option['value'] ? ' selected="selected"' : '', ' value="'.$option['value'].'">'.$option['label'].'</option>';
                            }
                            echo '</select><br /><span class="description">'.$field['desc'].'</span>';
                        break;
                        // checkbox
                        case 'checkbox':
                            echo '<input type="checkbox" name="'.$field['id'].'" id="'.$field['id'].'" ',$meta ? ' checked="checked"' : '','/>
                                <label for="'.$field['id'].'">'.$field['desc'].'</label>';
                        break;
                        // image
                        case 'image':
                            $image = plugins_url('/images/default.png', __FILE__);  
                            echo '<span class="custom_default_image" style="display:none">'.$image.'</span>';
                            if ($meta) { $image = wp_get_attachment_image_src($meta, 'medium'); $image = $image[0]; }               
                            echo    '<input name="'.$field['id'].'" type="hidden" class="custom_upload_image" value="'.$meta.'" />
                                        <img src="'.$image.'" class="custom_preview_image" alt="" /><br />
                                        <input class="custom_upload_image_button button" type="button" value="Choose Image" />
                                        <small> <a href="#" class="custom_clear_image_button">Remove Image</a></small>';
                        break;
                    } //end switch
            echo '</td></tr>';
        } // end foreach
        echo '</table>'; // end table
    }



    // Save the Data
    public function save_meta($post_id) {
        
        // verify nonce
        if (!wp_verify_nonce($_POST['custom_meta_box_nonce'], basename(__FILE__))) 
            return;
        // check autosave
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            return;
        // check permissions
        $post_type_slug = get_post_type( $post_id );
        $post_type = get_post_type_object( $post_type_slug );

        if( $post_type_slug === $_POST['post_type'] ){
            if( !current_user_can( $post_type->cap->edit_post, $post_id ) ) 
                return;
        }

        // loop through fields and save the data
        //foreach ($this->custom_meta_fields as $field) {
        $how_many_times = 0;
        foreach ($this->custom_meta_fields as $field) {
            

            $old = get_post_meta($post_id, $field['id'], true);
            $new = $_POST[$field['id']];

            if ($new && $new != $old) {
                update_post_meta($post_id, $field['id'], $new);
            } elseif ('' == $new && $old) {
                delete_post_meta($post_id, $field['id'], $old);
            }
        } // end foreach
    }

    function load_scripts() {
      wp_enqueue_script('media-upload');
      wp_enqueue_script('thickbox');
      wp_enqueue_style('thickbox');
      wp_enqueue_script('jquery');

      wp_register_script('vp_customizer_img_upload', plugins_url( '/js/vp_customizer_img_upload.js', __FILE__ ), array('jquery','media-upload','thickbox'));
      wp_enqueue_script('vp_customizer_img_upload');
    }

}

$my_custom_meta_box = new Custom_Meta_Boxes;

// Set custom excerpt length
function custom_excerpt_length( $length ) {
return 33;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999);

// Custom Comments Form
function alter_comment_form_fields($fields){ 
    $fields['author'] = 
    '<p class="comment-form-author comment-field"><label for="author">' .
    ( $req ? '<span class="required">*</span>' : '' ) .
    '<input id="author" name="author" placeholder="Name*" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
    '" size="30"' . $aria_req . ' /></p>'; 

    $fields['email'] = 
    '<p class="comment-form-email comment-field"><label for="email">' .
    ( $req ? '<span class="required">*</span>' : '' ) .
    '<input id="email" name="email" placeholder="Email*" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
    '" size="30"' . $aria_req . ' /></p>';  //removes email field

    $fields['url'] = 
    '<p class="comment-form-url comment-field"><label for="url">' .
    '<input id="url" name="url" placeholder="Your Website | If you would like :-)" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
    '" size="30" /></p>';  //removes website field

    return $fields;
}

add_filter('comment_form_default_fields','alter_comment_form_fields');

function alter_comment_field($defaults, $input) {

    $defaults['comment_notes_before'] = '';

    return $defaults;

}

add_filter('comment_form_defaults','alter_comment_field');


