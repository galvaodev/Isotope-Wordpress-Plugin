<?php 

add_shortcode( 'shortcodename', 'display_custom_post_type' );     
    function display_custom_post_type(){
       require_once(ISO_DIR.'/dist/css/style.edition.php');
    
        echo '<div id="filters" class="button-group">
        <button class="button is-checked" data-filter="*">Todos</button>';
      
        //Loop da taxonomia e seus nomes a serem filtrados com seus produtos selecionados
        $terms = get_terms("produto"); 
             $count = count($terms); 
             if ( $count > 0 ){ 
             foreach ( $terms as $term ) {  //for each term:
             echo "<button class='button' data-filter='.".$term->slug."'>" . $term->name . "</button>\n";
             //Criar um item de lista com o termo atual slug para classificação e nome para o rótulo
             }
         } 
        echo '</div> <div class="clear"></div>';
        $args = array(
            //Post type
            'post_type' => 'portfolio',
            'post_status' => 'publish'
        );
        $string = '';
        $query = new WP_Query( $args );
        if( $query->have_posts() ){
            $string .= '';
            $string .= '<div class="isotope">';
            $string .= '<div class="pattern pattern--hidden"></div>';
            while( $query->have_posts() ){
                $query->the_post();
                    $termsArray = get_the_terms( $post->ID, "produto" );  //Obter os termos para este item específico Taxonomy
                    $termsString = ""; //Inicializar a seqüência de caracteres que conterá os termos
                    global $post;
                    $post_slug=$post->post_name;
                    // Galeria cortada thumbs!
                    $size = 'full';
                    $params = array( 'width' => 1920, 'height' => 500 );
                    $imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID, '' ), $thumb_size );

                    $descricao = sub_descrio_get_meta( 'sub_descrio_descicao' ); 
                    $burst_img2 = get_post_meta( $post->ID, 'second_featured_img', true); 
                    $burst_img = wp_get_attachment_image_src( $burst_img2, 'full' );


                    $full = 'full';
                    $tamanho = array( 'width' => 600, 'height' => 300 );
                    $img = $burst_img;
                    foreach ( $termsArray as $term ) { 
                         $termsString .= $term->slug.'';
                         $termsName .= $term->name.'';
                    }         


                    $string .= '             
                    <div class="card">
                    <div class="element-item hvr-grow '.$termsString.'" data-category="'.$post_slug.'">
                        
                        <div class="card__container card__container--closed">
                        <svg class="card__image" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1920 500" preserveAspectRatio="xMidYMid slice">
                        <defs>
                            <clipPath id="'.$post_slug.'">
                                <!-- r = 992 = hyp = Math.sqrt(960*960+250*250) -->
                                <circle class="clip" cx="960" cy="250" r="992"></circle>
                            </clipPath>
                        </defs>

                            <image class="close-img" clip-path="url(#'.$post_slug.')" width="1920" height="500" xlink:href="'.bfi_thumb( $img[0], $tamanho ).'"></image>
                            <image class="open" clip-path="url(#'.$post_slug.')" width="1920" height="500" xlink:href="'.bfi_thumb( $imgsrc[0], $params ).'"></image>
                        </svg>
                        <div class="card__content">
                        <i class="card__btn-close fa fa-times"></i>
                        <div class="card__caption">
                            <h2 class="card__title">'.get_the_title().'</h2>
                            <p class="card__subtitle">'.$termsName.'</p>
                            '.get_simple_likes_button(get_the_ID()).'
                        </div>
                        <div class="card__copy">
                            <div class="fb-like" 
                                data-href="'.get_the_permalink().'" 
                                data-layout="standard" 
                                data-action="like" 
                                data-show-faces="true">
                            </div>                            
                            <div class="descicao">'.$descricao.'</div>                            
                            <div id="fb-root"></div> 
                            <div class="meta">                                
                                Postado por: <span class="meta__author">'.get_author_name().'</span>
                                no dia <span class="meta__date">'.get_the_date('d/m/Y').'</span>
                            </div>
                           '.get_the_content().'
                        </div>
                        
                    </div>
                    ';                   
                    $string .= '</div></div> </div>';
            }
           $string .= '</div>';
        }
        wp_reset_postdata();         
        return $string;
    }


