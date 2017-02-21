<?php
 
function sandbox_example_theme_menu() {
 
    add_menu_page(
        'Settings Portfólio',        // The title to be displayed in the browser window for this page.
        'Settings Portfólio',        // The text to be displayed for this menu item
        'administrator',             // Which type of users can see this menu item
        'jvgm_option',    			 // The unique ID - that is, the slug - for this menu item
        'jvgm_display',     		 // The name of the function to call when rendering this menu's page
         plugin_dir_url( __FILE__ ) . '../dist/img/icon.png'
    );
 
} // end sandbox_example_theme_menu
add_action( 'admin_menu', 'sandbox_example_theme_menu' );
 
/**
 * Renders a simple page to display for the theme menu defined above.
 */
function jvgm_display() {
?>
    <!-- Create a header in the default WordPress 'wrap' container -->
    <div class="wrap">
     
        <div id="icon-themes" class="icon32"></div>
        <h2>Isotope - Configuração</h2>
        <?php settings_errors(); ?>
        <?php require_once(ISO_DIR.'/dist/css/style.admin.php'); ?> 
        <form method="post" action="options.php">
             
            <?php settings_fields( 'jvgm_option_box' ); ?>
			<?php do_settings_sections( 'jvgm_option_box' ); ?>     
            <?php submit_button(); ?>
        </form>
         
    </div><!-- /.wrap -->
<?php
} // end jvgm_display



function thumbs_color() {
 
    // If the social options don't exist, create them.
    if( false == get_option( 'jvgm_option_box' ) ) {   
        add_option( 'jvgm_option_box' );
    } // end if

    // Create Section end Filds
    add_settings_section(
	    'cores_abas_section',          			// ID used to identify this section and with which to register options
	    'Configuração Abas',                    // Title to be displayed on the administration page
	    'jvgm_option_box_callback',  			// Callback used to render the description of the section
	    'jvgm_option_box'      					// Page on which to add this section of options
	);

	add_settings_field( 
	    'cores',     						// ID used to identify this fild                
	    'Cor do fundo:',                    // Title to be displayed on the administration page
	    'cores_jvgm_callback', 				// Callback used to render the description of the section
	    'jvgm_option_box', 					// Page on which to add this section of options
	    'cores_abas_section'				// ID used to identify this section and with which to register options 
	);	

	add_settings_field( 
	    'posts_qnt',     						// ID used to identify this fild                
	    'Quantidade ser exebido:',                    // Title to be displayed on the administration page
	    'quantidade_jvgm_callback', 				// Callback used to render the description of the section
	    'jvgm_option_box', 					// Page on which to add this section of options
	    'cores_abas_section'				// ID used to identify this section and with which to register options 
	);	

	add_settings_field( 
	    'cores_hover',     						
	    'cores_jvgm_callback', 					// Callback used to render the description of the section
	    'jvgm_option_box', 						// Page on which to add this section of options
	    'cores_abas_section'					// ID used to identify this section and with which to register options 
	);

	add_settings_field( 
	    'cores_fonte', 
	    'Cores fontes',    						// ID used to identify this fild   
	    'cores_fonte_jvgm_callback', 			// Callback used to render the description of the section
	    'jvgm_option_box', 						// Page on which to add this section of options
	    'cores_abas_section'					// ID used to identify this section and with which to register options 
	);

	add_settings_field( 
	    'cores_fonte_hover',    				 
	    'cores_fonte_jvgm_callback', 			// Callback used to render the description of the section
	    'jvgm_option_box', 						// Page on which to add this section of options
	    'cores_abas_section'					// ID used to identify this section and with which to register options 
	);

	add_settings_field( 
	    'cores_more_button',    				// ID used to identify this fild   
	    'Cores Botão carregar',    						 
	    'cores_more_jvgm_callback', 			// Callback used to render the description of the section
	    'jvgm_option_box', 						// Page on which to add this section of options
	    'cores_abas_section'					// ID used to identify this section and with which to register options 
	);

	add_settings_field( 
	    'cores_more_font',    						// ID used to identify this fild   
	    'cores_more_jvgm_callback', 			// Callback used to render the description of the section
	    'jvgm_option_box', 						// Page on which to add this section of options
	    'cores_abas_section'					// ID used to identify this section and with which to register options 
	);
	

	function jvgm_option_box_callback() {
	    echo '<p>Configuração de cores das abas de categoria da galeria</p>';
	} // end sandbox_general_options_callback


	function cores_jvgm_callback() {
     
	    // First, we read the social options collection
	    $options = get_option( 'jvgm_option_box' );
	     
	    // Next, we need to make sure the element is defined in the options. If not, we'll set an empty string.
	    $url = '';
	    if( isset( $options['cores'] ) ) {
	        $url = $options['cores'];
	    }    

	    echo '
	    <div class="tabela">
	    <span>Normal</span>
	    <input type="text" name="jvgm_option_box[cores]" value="' . $options['cores'] . '" class="cpa-color-picker" >
	    </div>';

	    $url = '';
	    if( isset( $options['cores_hover'] ) ) {
	        $url = $options['cores_hover'];
	    } // end if

	     echo '
	     <div class="tabela">
	     <span>Hover</span>
	     <input type="text" name="jvgm_option_box[cores_hover]" value="' . $options['cores_hover'] . '" class="cpa-color-picker" >
	     </div>';
     
	} // end cores_jvgm_callback

	function quantidade_jvgm_callback() {
     
	    // First, we read the social options collection
	    $options = get_option( 'jvgm_option_box' );
	    
	    $url = '';
	    if( isset( $options['posts_qnt'] ) ) {
	        $url = $options['posts_qnt'];
	    }

	    echo '
	    <div class="tabela">
	    <span>Quantidade</span>
	    <input type="number" min="1" name="jvgm_option_box[posts_qnt]" value="'.$options['posts_qnt'].'">
	    </div>';    
     
	} 


	function cores_fonte_jvgm_callback() {
     
	    // First, we read the social options collection
	    $options = get_option( 'jvgm_option_box' );
	     
	    // Next, we need to make sure the element is defined in the options. If not, we'll set an empty string.
	    $url = '';
	    if( isset( $options['cores_fonte'] ) ) {
	        $url = $options['cores_fonte'];
	    }    

	    echo '
	    <div class="tabela">
	    <span>Normal</span>
	    <input type="text" name="jvgm_option_box[cores_fonte]" value="' . $options['cores_fonte'] . '" class="cpa-color-picker" >
	    </div>';

	    $url = '';
	    if( isset( $options['cores_fonte_hover'] ) ) {
	        $url = $options['cores_fonte_hover'];
	    } // end if

	     echo '
	     <div class="tabela">
	     <span>Hover</span>
	     <input type="text" name="jvgm_option_box[cores_fonte_hover]" value="' . $options['cores_fonte_hover'] . '" class="cpa-color-picker" >
	     </div>';
     
	} // end cores_jvgm_callback

	function cores_more_jvgm_callback() {
     
	    // First, we read the social options collection
	    $options = get_option( 'jvgm_option_box' );
	     
	    // Next, we need to make sure the element is defined in the options. If not, we'll set an empty string.
	    $url = '';
	    if( isset( $options['cores_more_button'] ) ) {
	        $url = $options['cores_more_button'];
	    }    

	    echo '
	    <div class="tabela">
	    <span>Normal</span>
	    <input type="text" name="jvgm_option_box[cores_more_button]" value="' . $options['cores_more_button'] . '" class="cpa-color-picker" >
	    </div>';

	    $url = '';
	    if( isset( $options['cores_more_font'] ) ) {
	        $url = $options['cores_more_font'];
	    } // end if

	     echo '
	     <div class="tabela">
	     <span>Hover</span>
	     <input type="text" name="jvgm_option_box[cores_more_font]" value="' . $options['cores_more_font'] . '" class="cpa-color-picker" >
	     </div>';
     
	} // end cores_jvgm_callback



	register_setting(
	    'jvgm_option_box',
	    'jvgm_option_box',
	    'sandbox_theme_sanitize_social_options'
	);

	function sandbox_theme_sanitize_social_options( $input ) {
     
	    // Define the array for the updated options
	    $output = array();
	 
	    // Loop through each of the options sanitizing the data
	    foreach( $input as $key => $val ) {
	     
	        if( isset ( $input[$key] ) ) {
	             $output[$key] = strip_tags( stripslashes( $input[ $key ] ) );
	        } // end if 
	     
	    } // end foreach
	    
 	    // Return the new collection
	    return apply_filters( 'sandbox_theme_sanitize_social_options', $output, $input );
	 
	} // end sandbox_theme_sanitize_social_options
 
} // end thumbs_color
add_action( 'admin_init', 'thumbs_color' );


//Hover Color Thumbs
function thumbs_hover_color() {
 
    // If the social options don't exist, create them.
    if( false == get_option( 'jvgm_option_box' ) ) {   
        add_option( 'jvgm_option_box' );
    } // end if

    // Create Section end Filds
    add_settings_section(
	    'cores_thumbs_hover',          			// ID used to identify this section and with which to register options
	    'Configuração Imagem',                    // Title to be displayed on the administration page
	    'jvgm_thumbs_info',  			// Callback used to render the description of the section
	    'jvgm_option_box'      					// Page on which to add this section of options
	);

	add_settings_field( 
	    'cores_thumbs_hover_img',     						// ID used to identify this fild                
	    'Cor do fundo:',                    // Title to be displayed on the administration page
	    'hover_thumbs', 				// Callback used to render the description of the section
	    'jvgm_option_box', 					// Page on which to add this section of options
	    'cores_thumbs_hover'				// ID used to identify this section and with which to register options 
	);	

	add_settings_field( 
	    'cores_thumbs_hover_fonte',     						// ID used to identify this fild       
	    'hover_thumbs', 				// Callback used to render the description of the section
	    'jvgm_option_box', 					// Page on which to add this section of options
	    'cores_thumbs_hover'				// ID used to identify this section and with which to register options 
	);
	

	function jvgm_thumbs_info() {
	    echo '<p>Configuração hover das imagens</p>';
	} // end sandbox_general_options_callback


	function hover_thumbs() {
     
	    // First, we read the social options collection
	    $options = get_option( 'jvgm_option_box' );
	     
	    // Next, we need to make sure the element is defined in the options. If not, we'll set an empty string.
	    $url = '';
	    if( isset( $options['cores_thumbs_hover_img'] ) ) {
	        $url = $options['cores_thumbs_hover_img'];
	    }    

	    echo '
	    <div class="tabela">
	    <span>Normal</span>
	    <input type="text" name="jvgm_option_box[cores_thumbs_hover_img]" value="' . $options['cores_thumbs_hover_img'] . '" class="cpa-color-picker" >
	    </div>';

	    // Next, we need to make sure the element is defined in the options. If not, we'll set an empty string.
	    $url = '';
	    if( isset( $options['cores_thumbs_hover_fonte'] ) ) {
	        $url = $options['cores_thumbs_hover_fonte'];
	    }    

	    echo '
	    <div class="tabela">
	    <span>Cor fonte</span>
	    <input type="text" name="jvgm_option_box[cores_thumbs_hover_fonte]" value="' . $options['cores_thumbs_hover_fonte'] . '" class="cpa-color-picker" >
	    </div>';
	   
     
	} // end cores_jvgm_callback



	register_setting(
	    'jvgm_option_box',
	    'jvgm_option_box',
	    'sandbox_theme_sanitize_social_options'
	);
	 
} // end thumbs_hover_color
add_action( 'admin_init', 'thumbs_hover_color' );

?>