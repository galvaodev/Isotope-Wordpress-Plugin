# Isotope Wordpress Plugin

### :heart_eyes: Love Isotope + Wordpress :heart_eyes:

Implementation isotope in wordpress with button load more fully configured in your administrative panel.
The plugin generates a custom post type with the filled information to display it in a friendly and simple way.

The plugin by default automatically generates the name of the post type but if you want to change the names below, go to:

(../isotope-more/public/isotope-postfolio.php) line: 7 to 18:
```sh
         name' => _x( 'Portfólio', 'portfolio','custom' ),
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
```

Taxonomy (../isotope-more/public/isotope-postfolio.php) line: 45 to 59

```sh
    function n_taxonomy() {  
	   register_taxonomy(  
	    'produto',
	    'portfolio',
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
```


This text you see here is *actually* written in Markdown! To get a feel for Markdown's syntax, type some text into the left window and watch the results in the right.

### Installation

Plugin requires [Wordpress](https://wordpress.org/download/) v3+ to run.

Download via github not yet available in wordpress.org to download the plugin:

```sh
$ git clone https://github.com/jvgm/Isotope-Wordpress-Plugin.git

shortcode [galeria]
```
Shortcode:
```sh
 [galeria] or <?php echo do_shortcode('[galeria]'); ?>
```

### Plugins


| Plugin | LINK |
| ------ | ------ |
| Isotope | https://github.com/metafizzy/isotope |
| Card expansion | https://github.com/claudiocalautti/card-expansion |


Bye!
