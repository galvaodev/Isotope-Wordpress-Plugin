<?php 

//Register Script Footer 
function jvgm_portfolio_scripts_footer(){?>
    <?php $color = get_option( 'jvgm_option_box' ); ?>
    <script>window.jQuery || document.write('<script src="js/jquery.min.js"><\/script>')</script>  
    <script type="text/javascript">
        
    jQuery(document).ready(function($) {

      //Loop Isotope
      var $container = $('.isotope').isotope({
        itemSelector: '.element-item',
        layoutMode: 'fitRows',
        getSortData: {
          name: '.name',
          symbol: '.symbol',
          number: '.number parseInt',
          category: '[data-category]',
          weight: function(itemElem) {
            var weight = $(itemElem).find('.weight').text();
            return parseFloat(weight.replace(/[\(\)]/g, ''));
          }
        }
      });

      // Filtragem
      var filterFns = {
     
        numberGreaterThan50: function() {
          var number = $(this).find('.number').text();
          return parseInt(number, 10) > 1000;
        },
       
        ium: function() {
          var name = $(this).find('.name').text();
          return name.match(/ium$/);
        }
      };


      $('#filters').on('click', 'button', function() {
        var filterValue = $(this).attr('data-filter');
        
        filterValue = filterFns[filterValue] || filterValue;
        $container.isotope({
          filter: filterValue
        });
      });


      $('#sorts').on('click', 'button', function() {
        var sortByValue = $(this).attr('data-sort-by');
        $container.isotope({
          sortBy: sortByValue
        });
      });

      //A mudança é classe verificada em botões
      $('.button-group').each(function(i, buttonGroup) {
        var $buttonGroup = $(buttonGroup);
        $buttonGroup.on('click', 'button', function() {
          $buttonGroup.find('.is-checked').removeClass('is-checked');
          $(this).addClass('is-checked');
        });
      });

    
      var initShow = '<?php echo $color['posts_qnt']; ?>'; 
      var counter = initShow; 
      var iso = $container.data('isotope');

      loadMore(initShow); 

      function loadMore(toShow) {
        $container.find(".hidden").removeClass("hidden");

        var hiddenElems = iso.filteredItems.slice(toShow, iso.filteredItems.length).map(function(item) {
          return item.element;
        });
        $(hiddenElems).addClass('hidden');
        $container.isotope('layout');

        
        if (hiddenElems.length == 0) {
          jQuery("#load-more").hide();
        } else {
          jQuery("#load-more").show();
        };

      }

      $container.after('<button id="load-more"> CARREGAR MAIS</button>');


      


      $("#load-more").click(function() {
        if ($('#filters').data('clicked')) {
          
          counter = initShow;
          $('#filters').data('clicked', false);
        } else {
          counter = counter;
        };

        counter = counter + initShow;

        loadMore(counter);
      });

      
      $("#filters").click(function() {
        $(this).data('clicked', true);

        loadMore(initShow);
      });
      
    });
    </script>

   <?php      
   wp_register_script('jquery-isotope', plugins_url('/dist/js/jquery-3.1.1.js', __FILE__));
    wp_register_script( 'isotope-portfolio-jvgm', plugins_url( '/dist/js/isotope-docs.min.js', __FILE__ ) );
    wp_register_script( 'easing-portfolio-jvgm', plugins_url( '/dist/js/jquery.easing-1.3.js', __FILE__ ) ); 
    wp_register_script( 'cash-portfolio-jvgm', plugins_url( '/dist/js/vendors/cash.min.js', __FILE__ ) ); 
    wp_register_script( 'scrolltoplugin-portfolio-jvgm', plugins_url( '/dist/js/vendors/ScrollToPlugin.min.js', __FILE__ ) ); 
    wp_register_script( 'trianglify-portfolio-jvgm', plugins_url( '/dist/js/vendors/trianglify.min.js', __FILE__ ) ); 
    wp_register_script( 'easing-tweenmax-jvgm', plugins_url( '/dist/js/vendors/TweenMax.min.js', __FILE__ ) ); 
    wp_enqueue_script( 'likes-public-jvgm', plugins_url('/dist/js/simple-likes-public.js', __FILE__ ) );
    wp_localize_script( 'likes-public-jvgm', 'simpleLikes', array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'like' => __( 'Like', 'JVGM Plugin' ),
        'unlike' => __( 'Unlike', 'JVGM Plugin' )
    ) ); 

    //JS Plugin    
    wp_enqueue_script( 'isotope-portfolio-jvgm');
    wp_enqueue_script( 'jquery-isotope');
    wp_enqueue_script('easing-portfolio-jvgm');
    wp_enqueue_script('cash-portfolio-jvgm');
    wp_enqueue_script('scrolltoplugin-portfolio-jvgm');
    wp_enqueue_script('trianglify-portfolio-jvgm');
    wp_enqueue_script('easing-tweenmax-jvgm');  
  
}
add_action( 'wp_footer', 'jvgm_portfolio_scripts_footer' );

add_action( 'admin_enqueue_scripts', 'jvgm_add_color_picker' );
function jvgm_add_color_picker( $hook ) {
 
    if( is_admin() ) {      
        wp_enqueue_style( 'adminstyle', plugins_url('/dist/css/style.admin.php', __FILE__ ));

        wp_enqueue_style( 'wp-color-picker' );          
        wp_enqueue_script( 'custom-script-handle', plugins_url( '/dist/js/custom-script.js', __FILE__ ), array( 'wp-color-picker' ), false, true ); 
        wp_enqueue_script('custom-js', plugins_url('/dist/js/custom-js.js', __FILE__) );
    }
}


//Register the script like this for a Plugin JS end CSS Custom Header
function jvgm_portfolio_scripts_header(){

    //JS
    wp_register_script( 'portfolio-jvgm', plugins_url( '/dist/js/all.js', __FILE__ ) );
    //CSS
    wp_enqueue_style( 'portfolio', plugins_url('/dist/css/style.min.css', __FILE__ ));

    //JS Plugin
    wp_enqueue_script( 'portfolio-jvgm' );
    //CSS Plugin
    wp_enqueue_style( 'portfolio' );
}
add_action( 'wp_head', 'jvgm_portfolio_scripts_header' );

function wpdocs_theme_add_editor_styles() {
    wp_enqueue_style( 'adminstyle', plugins_url('/dist/css/admin-post.css', __FILE__ ));
}
add_action( 'admin_init', 'wpdocs_theme_add_editor_styles' );


function add_jvgm_custom_metabox_upload() {

    // Define the portfolio metabox :) 
    add_meta_box(
        'jvgm_upfile', 
        'Imagem pequena', 
        'jvgm_meta_box', 
        'portfolio', 
        'side'          
    );         
         
}


//Save MetaBox
function jvgm_meta_box( $post ) {
        $meta_key = 'second_featured_img';
        echo jvgm_image_uploader_field( $meta_key, get_post_meta($post->ID, $meta_key, true) );
    }    

    add_action('save_post', 'jvgm_save');
    
    //Save Get_post 
    function jvgm_save( $post_id ) {
        if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
            return $post_id;
     
        $meta_key = 'second_featured_img';
     
        update_post_meta( $post_id, $meta_key, $_POST[$meta_key] );
        return $post_id;
    } 

    add_action('add_meta_boxes', 'add_jvgm_custom_metabox_upload');

    function jvgm_image_uploader_field( $name, $value = '') {
    $image = ' button">Upload image';
    $image_size = 'full'; 
    $display = 'none'; //
 
    if( $image_attributes = wp_get_attachment_image_src( $value, $image_size ) ) {
 
        // $image_attributes[0] - image URL
        // $image_attributes[1] - image width
        // $image_attributes[2] - image height
 
        $image = '"><img src="' . $image_attributes[0] . '" style="max-width:95%;display:block;" />';
        $display = 'inline-block';
 
    } 
 
    return '
    <div>
        <a href="#" class="misha_upload_image_button' . $image . '</a>
        <input type="hidden" name="' . $name . '" id="' . $name . '" value="' . $value . '" />
        <a href="#" class="misha_remove_image_button" style="display:inline-block;display:' . $display . '">Remove image</a>
    </div>';
}

function sub_descrio_get_meta( $value ) {
    global $post;

    $field = get_post_meta( $post->ID, $value, true );
    if ( ! empty( $field ) ) {
        return is_array( $field ) ? stripslashes_deep( $field ) : stripslashes( wp_kses_decode_entities( $field ) );
 
        return false;
    }
}


function sub_descrio_add_meta_box() {
    add_meta_box(
        'sub_descrio-sub-descrio',
        __( 'Sub descrição', 'sub_descrio' ),
        'sub_descrio_html',
        'portfolio',
        'advanced',
        'low'
    );
}
//Box description
add_action( 'add_meta_boxes', 'sub_descrio_add_meta_box' );

function sub_descrio_html( $post) {
    wp_nonce_field( '_sub_descrio_nonce', 'sub_descrio_nonce' ); ?>
    <p>Acrescente um texto antes da postagem aqui, máximo 300 caracteres</p>

    <p>
      <textarea style="width: 100%; min-height: 200px;" maxlength="300" name="sub_descrio_descicao" id="" ><?php echo sub_descrio_get_meta( 'sub_descrio_descicao' ); ?></textarea>
    
    </p><?php
}

//Save Description
function sub_descrio_save( $post_id ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! isset( $_POST['sub_descrio_nonce'] ) || ! wp_verify_nonce( $_POST['sub_descrio_nonce'], '_sub_descrio_nonce' ) ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    if ( isset( $_POST['sub_descrio_descicao'] ) )
        update_post_meta( $post_id, 'sub_descrio_descicao', esc_attr( $_POST['sub_descrio_descicao'] ) );
}
add_action( 'save_post', 'sub_descrio_save' );

function likes_post_jvgm_admin() {
    add_meta_box(
        'likes_post',
        __( 'Curtidas', 'sub_descrio' ),
        'likes_box_jvgm',
        'portfolio',
        'side'
    );
}
//Box description
add_action( 'add_meta_boxes', 'likes_post_jvgm_admin' );

function likes_box_jvgm() { ?>    
        <?php echo get_count_admin(get_the_ID()); ?>
   <?php
}

//Script facebook Like
function facebook_jvgm_like() {
?>
<script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.8";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
<?php
}
add_action( 'wp_footer', 'facebook_jvgm_like' );


// add_action('wp_head', 'add_og_meta_tags');
//     function add_og_meta_tags() {
//         echo '<meta property="fb:admins" content="XXXXXXX"/>
//         <meta property="og:site_name" content="Example.com"/>
//         <meta property="og:image" content="http://www.example.com/image.png"/>';
//         if (is_front_page()) :
//         echo '<meta property="og:type" content="blog"/>
//         <meta property="og:description" content="test test test test"/>
//         <meta property="og:title" content="My title"/>
//         <meta property="og:url" content=" '. get_bloginfo('home') . '"/>';
//         elseif (is_single() || is_page()) :
//         echo '<meta property="og:type" content="article"/>
//         <meta property="og:title" content="' . trim(wp_title('', false)) . '"/>
//         <meta property="og:url" content="' . get_permalink() .'"/>';
//         elseif (!is_front_page() && !is_single() && !is_page()) :
//         echo '<meta property="og:title" content="' . trim(wp_title('', false)) .'"/>';
//     endif;
//     }



// likes + - 
add_action( 'wp_ajax_nopriv_process_simple_like', 'process_simple_like' );
add_action( 'wp_ajax_process_simple_like', 'process_simple_like' );
function process_simple_like() {
    //Security
    $nonce = isset( $_REQUEST['nonce'] ) ? sanitize_text_field( $_REQUEST['nonce'] ) : 0;
    if ( !wp_verify_nonce( $nonce, 'simple-likes-nonce' ) ) {
        exit( __( 'Not permitted', 'JVGM Plugin' ) );
    }
    //Test if javascript is disabled
    $disabled = ( isset( $_REQUEST['disabled'] ) && $_REQUEST['disabled'] == true ) ? true : false;
    // Test if this is a comment
    $is_comment = ( isset( $_REQUEST['is_comment'] ) && $_REQUEST['is_comment'] == 1 ) ? 1 : 0;
    // Base variables
    $post_id = ( isset( $_REQUEST['post_id'] ) && is_numeric( $_REQUEST['post_id'] ) ) ? $_REQUEST['post_id'] : '';
    $result = array();
    $post_users = NULL;
    $like_count = 0;
    // Get plugin options
    if ( $post_id != '' ) {
        $count = ( $is_comment == 1 ) ? get_comment_meta( $post_id, "_comment_like_count", true ) : get_post_meta( $post_id, "_post_like_count", true ); // like count
        $count = ( isset( $count ) && is_numeric( $count ) ) ? $count : 0;
        if ( !already_liked( $post_id, $is_comment ) ) { // Like the post
            if ( is_user_logged_in() ) { // user is logged in
                $user_id = get_current_user_id();
                $post_users = post_user_likes( $user_id, $post_id, $is_comment );
                if ( $is_comment == 1 ) {
                    // Update User & Comment
                    $user_like_count = get_user_option( "_comment_like_count", $user_id );
                    $user_like_count =  ( isset( $user_like_count ) && is_numeric( $user_like_count ) ) ? $user_like_count : 0;
                    update_user_option( $user_id, "_comment_like_count", ++$user_like_count );
                    if ( $post_users ) {
                        update_comment_meta( $post_id, "_user_comment_liked", $post_users );
                    }
                } else {
                    // Update User & Post
                    $user_like_count = get_user_option( "_user_like_count", $user_id );
                    $user_like_count =  ( isset( $user_like_count ) && is_numeric( $user_like_count ) ) ? $user_like_count : 0;
                    update_user_option( $user_id, "_user_like_count", ++$user_like_count );
                    if ( $post_users ) {
                        update_post_meta( $post_id, "_user_liked", $post_users );
                    }
                }
            } else { // user is anonymous
                $user_ip = sl_get_ip();
                $post_users = post_ip_likes( $user_ip, $post_id, $is_comment );
                // Update Post
                if ( $post_users ) {
                    if ( $is_comment == 1 ) {
                        update_comment_meta( $post_id, "_user_comment_IP", $post_users );
                    } else { 
                        update_post_meta( $post_id, "_user_IP", $post_users );
                    }
                }
            }
            $like_count = ++$count;
            $response['status'] = "liked";
            $response['icon'] = get_liked_icon();
        } else { // Unlike the post
            if ( is_user_logged_in() ) { // user is logged in
                $user_id = get_current_user_id();
                $post_users = post_user_likes( $user_id, $post_id, $is_comment );
                // Update User
                if ( $is_comment == 1 ) {
                    $user_like_count = get_user_option( "_comment_like_count", $user_id );
                    $user_like_count =  ( isset( $user_like_count ) && is_numeric( $user_like_count ) ) ? $user_like_count : 0;
                    if ( $user_like_count > 0 ) {
                        update_user_option( $user_id, "_comment_like_count", --$user_like_count );
                    }
                } else {
                    $user_like_count = get_user_option( "_user_like_count", $user_id );
                    $user_like_count =  ( isset( $user_like_count ) && is_numeric( $user_like_count ) ) ? $user_like_count : 0;
                    if ( $user_like_count > 0 ) {
                        update_user_option( $user_id, '_user_like_count', --$user_like_count );
                    }
                }
                // Update Post
                if ( $post_users ) {    
                    $uid_key = array_search( $user_id, $post_users );
                    unset( $post_users[$uid_key] );
                    if ( $is_comment == 1 ) {
                        update_comment_meta( $post_id, "_user_comment_liked", $post_users );
                    } else { 
                        update_post_meta( $post_id, "_user_liked", $post_users );
                    }
                }
            } else { // user is anonymous
                $user_ip = sl_get_ip();
                $post_users = post_ip_likes( $user_ip, $post_id, $is_comment );
                // Update Post
                if ( $post_users ) {
                    $uip_key = array_search( $user_ip, $post_users );
                    unset( $post_users[$uip_key] );
                    if ( $is_comment == 1 ) {
                        update_comment_meta( $post_id, "_user_comment_IP", $post_users );
                    } else { 
                        update_post_meta( $post_id, "_user_IP", $post_users );
                    }
                }
            }
            $like_count = ( $count > 0 ) ? --$count : 0; // Prevent negative number
            $response['status'] = "unliked";
            $response['icon'] = get_unliked_icon();
        }
        if ( $is_comment == 1 ) {
            update_comment_meta( $post_id, "_comment_like_count", $like_count );
            update_comment_meta( $post_id, "_comment_like_modified", date( 'Y-m-d H:i:s' ) );
        } else { 
            update_post_meta( $post_id, "_post_like_count", $like_count );
            update_post_meta( $post_id, "_post_like_modified", date( 'Y-m-d H:i:s' ) );
        }
        $response['count'] = get_like_count( $like_count );
        $response['testing'] = $is_comment;
        if ( $disabled == true ) {
            if ( $is_comment == 1 ) {
                wp_redirect( get_permalink( get_the_ID() ) );
                exit();
            } else {
                wp_redirect( get_permalink( $post_id ) );
                exit();
            }
        } else {
            wp_send_json( $response );
        }
    }
}

//Alert Likes
function already_liked( $post_id, $is_comment ) {
    $post_users = NULL;
    $user_id = NULL;
    if ( is_user_logged_in() ) { // user is logged in
        $user_id = get_current_user_id();
        $post_meta_users = ( $is_comment == 1 ) ? get_comment_meta( $post_id, "_user_comment_liked" ) : get_post_meta( $post_id, "_user_liked" );
        if ( count( $post_meta_users ) != 0 ) {
            $post_users = $post_meta_users[0];
        }
    } else { // user is anonymous
        $user_id = sl_get_ip();
        $post_meta_users = ( $is_comment == 1 ) ? get_comment_meta( $post_id, "_user_comment_IP" ) : get_post_meta( $post_id, "_user_IP" ); 
        if ( count( $post_meta_users ) != 0 ) { // meta exists, set up values
            $post_users = $post_meta_users[0];
        }
    }
    if ( is_array( $post_users ) && in_array( $user_id, $post_users ) ) {
        return true;
    } else {
        return false;
    }
}

// Button like
function get_simple_likes_button( $post_id, $is_comment = NULL ) {
    $is_comment = ( NULL == $is_comment ) ? 0 : 1;
    $output = '';
    $nonce = wp_create_nonce( 'simple-likes-nonce' ); // Security
    if ( $is_comment == 1 ) {
        $post_id_class = esc_attr( ' sl-comment-button-' . $post_id );
        $comment_class = esc_attr( ' sl-comment' );
        $like_count = get_comment_meta( $post_id, "_comment_like_count", true );
        $like_count = ( isset( $like_count ) && is_numeric( $like_count ) ) ? $like_count : 0;
    } else {
        $post_id_class = esc_attr( ' sl-button-' . $post_id );
        $comment_class = esc_attr( '' );
        $like_count = get_post_meta( $post_id, "_post_like_count", true );
        $like_count = ( isset( $like_count ) && is_numeric( $like_count ) ) ? $like_count : 0;
    }
    $count = get_like_count( $like_count );
    $icon_empty = get_unliked_icon();
    $icon_full = get_liked_icon();
    // Loader
    $loader = '<span id="sl-loader"></span>';
    // Liked/Unliked Variables
    if ( already_liked( $post_id, $is_comment ) ) {
        $class = esc_attr( ' liked' );
        $title = __( 'Descurtir', 'JVGM Plugin' );
        $icon = $icon_full;
    } else {
        $class = '';
        $title = __( 'Curtir', 'JVGM Plugin' );
        $icon = $icon_empty;
    }
    $output = '<span class="sl-wrapper"><a href="' . admin_url( 'admin-ajax.php?action=process_simple_like' . '&post_id=' . $post_id . '&nonce=' . $nonce . '&is_comment=' . $is_comment . '&disabled=true' ) . '" class="sl-button' . $post_id_class . $class . $comment_class . '" data-nonce="' . $nonce . '" data-post-id="' . $post_id . '" data-iscomment="' . $is_comment . '" title="' . $title . '">' . $icon . $count . '</a>' . $loader . '</span>';
    return $output;
}


function get_count_admin( $post_id, $is_comment = NULL ) {
    $is_comment = ( NULL == $is_comment ) ? 0 : 1;
    $output = '';
    $nonce = wp_create_nonce( 'simple-likes-nonce' ); // Security
    if ( $is_comment == 1 ) {
        $post_id_class = esc_attr( ' sl-comment-button-' . $post_id );
        $comment_class = esc_attr( ' sl-comment' );
        $like_count = get_comment_meta( $post_id, "_comment_like_count", true );
        $like_count = ( isset( $like_count ) && is_numeric( $like_count ) ) ? $like_count : 0;
    } else {
        $post_id_class = esc_attr( ' sl-button-' . $post_id );
        $comment_class = esc_attr( '' );
        $like_count = get_post_meta( $post_id, "_post_like_count", true );
        $like_count = ( isset( $like_count ) && is_numeric( $like_count ) ) ? $like_count : 0;
    }
    $count = get_like_count( $like_count );
    $icon_empty = get_unliked_icon();
    $icon_full = get_liked_icon();
    // Loader
    $loader = '<span id="sl-loader"></span>';
    // Liked/Unliked Variables
    if ( already_liked( $post_id, $is_comment ) ) {
        $class = esc_attr( ' Ops! não existe curtidas :( ' );
        $title = __( 'Unlike', 'JVGM Plugin' );
        $icon = $icon_full;
    } else {
        $class = '';
        $title = __( 'Ops! não existe curtidas :( ', 'JVGM Plugin' );
        $icon = $icon_empty;
    }
    $output = ''.$icon.'<span class="sl-wrapper">'. $count .'</span>';
    return $output;
}

function get_count_search( $post_id, $is_comment = NULL ) {
    $is_comment = ( NULL == $is_comment ) ? 0 : 1;
    $output = '';
    $nonce = wp_create_nonce( 'simple-likes-nonce' ); // Security
    if ( $is_comment == 1 ) {
        $post_id_class = esc_attr( ' sl-comment-button-' . $post_id );
        $comment_class = esc_attr( ' sl-comment' );
        $like_count = get_comment_meta( $post_id, "_comment_like_count", true );
        $like_count = ( isset( $like_count ) && is_numeric( $like_count ) ) ? $like_count : 0;
    } else {
        $post_id_class = esc_attr( ' sl-button-' . $post_id );
        $comment_class = esc_attr( '' );
        $like_count = get_post_meta( $post_id, "_post_like_count", true );
        $like_count = ( isset( $like_count ) && is_numeric( $like_count ) ) ? $like_count : 0;
    }
    $count = get_like_count( $like_count );
    $icon_empty = get_unliked_icon();
    $icon_full = get_liked_icon();
    // Loader
    $loader = '<span id="sl-loader"></span>';
    // Liked/Unliked Variables
    if ( already_liked( $post_id, $is_comment ) ) {
        $class = esc_attr( ' Ops! não existe curtidas :( ' );
        $title = __( 'Unlike', 'JVGM Plugin' );
        $icon = $icon_full;
    } else {
        $class = '';
        $title = __( '0', 'JVGM Plugin' );
        $icon = $icon_empty;
    }
    $output = '<span>'. $count .'</span>';
    return $output;
}



function post_user_likes( $user_id, $post_id, $is_comment ) {
    $post_users = '';
    $post_meta_users = ( $is_comment == 1 ) ? get_comment_meta( $post_id, "_user_comment_liked" ) : get_post_meta( $post_id, "_user_liked" );
    if ( count( $post_meta_users ) != 0 ) {
        $post_users = $post_meta_users[0];
    }
    if ( !is_array( $post_users ) ) {
        $post_users = array();
    }
    if ( !in_array( $user_id, $post_users ) ) {
        $post_users['user-' . $user_id] = $user_id;
    }
    return $post_users;
} 

//Meta ip User Like
function post_ip_likes( $user_ip, $post_id, $is_comment ) {
    $post_users = '';
    $post_meta_users = ( $is_comment == 1 ) ? get_comment_meta( $post_id, "_user_comment_IP" ) : get_post_meta( $post_id, "_user_IP" );
    // Retrieve post information
    if ( count( $post_meta_users ) != 0 ) {
        $post_users = $post_meta_users[0];
    }
    if ( !is_array( $post_users ) ) {
        $post_users = array();
    }
    if ( !in_array( $user_ip, $post_users ) ) {
        $post_users['ip-' . $user_ip] = $user_ip;
    }
    return $post_users;
} 


function sl_get_ip() {
    if ( isset( $_SERVER['HTTP_CLIENT_IP'] ) && ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif ( isset( $_SERVER['HTTP_X_FORWARDED_FOR'] ) && ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = ( isset( $_SERVER['REMOTE_ADDR'] ) ) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
    }
    $ip = filter_var( $ip, FILTER_VALIDATE_IP );
    $ip = ( $ip === false ) ? '0.0.0.0' : $ip;
    return $ip;
}


//Icon SVG
function get_liked_icon() {
    /* If already using Font Awesome with your theme, replace svg with: <i class="fa fa-heart"></i> */
    $icon = '<span class="sl-icon"><svg role="img" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0" y="0" viewBox="0 0 128 128" enable-background="new 0 0 128 128" xml:space="preserve"><path id="heart-full" d="M124 20.4C111.5-7 73.7-4.8 64 19 54.3-4.9 16.5-7 4 20.4c-14.7 32.3 19.4 63 60 107.1C104.6 83.4 138.7 52.7 124 20.4z"/>&#9829;</svg></span>';
    return $icon;
} 

//Icon SVG
function get_unliked_icon() {
   
    $icon = '<span class="sl-icon"><svg role="img" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0" y="0" viewBox="0 0 128 128" enable-background="new 0 0 128 128" xml:space="preserve"><path id="heart" d="M64 127.5C17.1 79.9 3.9 62.3 1 44.4c-3.5-22 12.2-43.9 36.7-43.9 10.5 0 20 4.2 26.4 11.2 6.3-7 15.9-11.2 26.4-11.2 24.3 0 40.2 21.8 36.7 43.9C124.2 62 111.9 78.9 64 127.5zM37.6 13.4c-9.9 0-18.2 5.2-22.3 13.8C5 49.5 28.4 72 64 109.2c35.7-37.3 59-59.8 48.6-82 -4.1-8.7-12.4-13.8-22.3-13.8 -15.9 0-22.7 13-26.4 19.2C60.6 26.8 54.4 13.4 37.6 13.4z"/>&#9829;</svg></span>';
    return $icon;
} 


function sl_format_count( $number ) {
    $precision = 2;
    if ( $number >= 1000 && $number < 1000000 ) {
        $formatted = number_format( $number/1000, $precision ).'K';
    } else if ( $number >= 1000000 && $number < 1000000000 ) {
        $formatted = number_format( $number/1000000, $precision ).'M';
    } else if ( $number >= 1000000000 ) {
        $formatted = number_format( $number/1000000000, $precision ).'B';
    } else {
        $formatted = $number; // Number is less than 1000
    }
    $formatted = str_replace( '.00', '', $formatted );
    return $formatted;
} 


function get_like_count( $like_count ) {
    $like_text = __( '0', 'JVGM Plugin' );
    if ( is_numeric( $like_count ) && $like_count > 0 ) { 
        $number = sl_format_count( $like_count );
    } else {
        $number = $like_text;
    }
    $count = '<span class="sl-count">' . $number . '</span>';
    return $count;
} 




function JVGM_columns_head($defaults) {
    $defaults['likes_post'] = 'Curtidas';
    return $defaults;
}
 
// SHOW THE FEATURED IMAGE
function JVGM_columns_content($column_name, $post_ID) {
    if ($column_name == 'likes_post') {
        $post_featured_image = get_count_search(get_the_ID());
        if ($post_featured_image) {
            echo ''.$post_featured_image.'';
        }
    }
}

add_filter('manage_posts_columns', 'JVGM_columns_head');
add_action('manage_posts_custom_column', 'JVGM_columns_content', 10, 2);