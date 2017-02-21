<?php

//Registrando post_type
add_action( 'init', 'nportfolio', 20 );
function nportfolio() {
    $labels = array(
        'name' => _x( 'Portfólio', 'portfolio','custom' ),
        'singular_name' => _x( 'Portfólio', 'portfolio', 'custom' ),
        'add_new' => _x( 'Adicionar novo', 'portfolio', 'custom' ),
        'add_new_item' => _x( 'Adicionar novo portfolio', 'portfolio', 'custom' ),
        'edit_item' => _x( 'Editar Portfólio', 'portfolio', 'custom' ),
        'new_item' => _x( 'Novo Portfólio', 'portfolio', 'custom' ),
        'view_item' => _x( 'Ver Portfólio', 'portfolio', 'custom' ),
        'search_items' => _x( 'Procurar portfolio', 'portfolio', 'custom' ),
        'not_found' => _x( 'Não existe', 'portfolio', 'custom' ),
        'not_found_in_trash' => _x( 'Não existe portfolio', 'portfolio', 'custom' ),
        'parent_item_colon' => _x( 'Procuro por:', 'portfolio', 'custom' ),
        'menu_name' => _x( 'Portfólio Posts', 'portfolio', 'custom' ),
    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => false,
        'description' => 'Portfólio Posts',
        'supports' => array( 'title', 'editor', 'thumbnail'),
        'taxonomies' => array( 'post_tag','produto'),
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon' => get_stylesheet_directory_uri() . '/functions/panel/images/catchinternet-small.png',
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'query_var' => true,
        'can_export' => true,
        'menu_icon' => 'dashicons-welcome-view-site',
        'rewrite' => array('slug' => 'produtos'),
        'public' => true,
        'has_archive' => 'portfolio',
        'capability_type' => 'post',
    );  
    register_post_type( 'portfolio', $args );//max 20 charachter cannot contain capital letters and spaces
}  

	function n_taxonomy() {  
	    register_taxonomy(  
	        'produto',  //The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces). 
	        'portfolio',        //post type name
	        array(  
	            'hierarchical' => true,  
	            'label' => 'Categoria de produto',  //Display name
	            'query_var' => true,
	            'rewrite' => array(
	                'slug' => 'portfolio', // This controls the base slug that will display before each term
	                'with_front' => false // Don't display the category base before 
	            )
	        )  
	    );  
	}  
	add_action( 'init', 'n_taxonomy');

	add_theme_support( 'post-thumbnails' ); 



   