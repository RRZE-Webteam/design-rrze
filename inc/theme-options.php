<?php

function _rrze_options_pages() {
    $pages = array( 
        'layout.options' => array( 
            'value' => 'layout.options', 
            'label' => __('Layout', '_rrze' )
        ),
        
        'typography.options' => array( 
            'value' => 'typography.options', 
            'label' => __('Schriftart', '_rrze' )
        ),
        
        'color.options' => array( 
            'value' => 'color.options', 
            'label' => __('Farben', '_rrze' )
        )
        
    );
    
    return apply_filters( '_rrze_options_pages', $pages );
}

add_filter( 'option_page_capability__rrze_options', function( $capability ) {
	return 'edit_theme_options';
} );

add_action( 'admin_menu', function() {
	add_theme_page( __( 'Einstellungen', '_rrze' ), __( 'Einstellungen', '_rrze' ), 'edit_theme_options', 'theme_options', '_rrze_theme_options_menu_page' );
    
    $pages = _rrze_options_pages();
    foreach( $pages as $page) {
        add_submenu_page( 'theme_options', $page['label'], $page['label'], 'edit_theme_options', $page['value'], '_rrze_theme_options_menu_page' );
    }
}, 100 );

add_action( 'admin_print_scripts-appearance_page_theme_options', function() { 
	wp_enqueue_script( 'wp-color-picker' );
	wp_enqueue_style( 'wp-color-picker' );
    
    wp_enqueue_script( 'theme-options', sprintf( '%s/js/theme-options.js', get_template_directory_uri() ), array('jquery') );
    
}, 50);

function _rrze_theme_default_options() {
	$options = array(
        'color.schema' => 'blau',
        'color.style' => _rrze_default_color_style_data(),
		'column.layout' => '1-3',
        'footer.layout' => '33-33-33',
		'search.form.position' => 'bereichsmenu',
        'body.typography' => '"Droid Sans", Arial, Helvetica, sans-serif',
        'heading.typography' => '"Droid Sans", Arial, Helvetica, sans-serif',
        'menu.typography' => '"Droid Sans", Arial, Helvetica, sans-serif',
        'widget.title.typography' => '"Droid Sans", Arial, Helvetica, sans-serif',
        'widget.content.typography' => '"Droid Sans", Arial, Helvetica, sans-serif'
	);

    return apply_filters( '_rrze_default_theme_options', $options );
}

function _rrze_theme_options( $key = '' ) {
	$default_options = _rrze_theme_default_options();
    
	$options = (array) get_option( _RRZE_THEME_OPTIONS_NAME );
        
	$options = wp_parse_args( $options, $default_options );
    $options = array_intersect_key( $options, $default_options );   
    
    if( !empty( $key ) )
        return isset($options[$key]) ? $options[$key] : NULL;
    
    
    
    return $options;
}

add_action( 'admin_init', function() {
    
    /* Layout options */
    register_setting( 'layout.options', '_rrze_theme_options', '_rrze_theme_options_validate' );

    add_settings_section( 'layout.section', __( 'Layouteinstellungen', '_rrze' ), '_rrze_section_layout_callback', 'layout.options' );

    add_settings_field( 'column.layout', __( 'Seitenlayout', '_rrze' ), '_rrze_field_columnlayout_callback', 'layout.options', 'layout.section' );
    
    add_settings_field( 'footer.layout', __( 'Footer-Layout', '_rrze' ), '_rrze_field_footer_layout_callback', 'layout.options', 'layout.section' );
    
    add_settings_field( 'search.form', __( 'Position des Suchformulars', '_rrze' ), '_rrze_field_searchform_callback', 'layout.options', 'layout.section' );
    
    /* Typography options */
    register_setting( 'typography.options', '_rrze_theme_options', '_rrze_theme_options_validate' );

    add_settings_section( 'typography.section', __('Schriftart', '_rrze' ), '_rrze_section_typography_callback', 'typography.options' );

    add_settings_field( 'body.typography', __('Allgemein', '_rrze' ), '_rrze_field_body_typography_callback', 'typography.options', 'typography.section' );

    add_settings_field( 'heading.typography', __('Überschrift', '_rrze' ), '_rrze_field_heading_typography_callback', 'typography.options', 'typography.section' );

    add_settings_field( 'menu.typography', __('Menü', '_rrze' ), '_rrze_field_menu_typography_callback', 'typography.options', 'typography.section' );

    add_settings_field( 'widget.title.typography', __('Widget-Titel', '_rrze' ), '_rrze_field_widget_title_typography_callback', 'typography.options', 'typography.section' );

    add_settings_field( 'widget.content.typography', __('Widget-Inhalt', '_rrze' ), '_rrze_field_widget_content_typography_callback', 'typography.options', 'typography.section' );
    
    /* Color options */
    register_setting( 'color.options', '_rrze_theme_options', '_rrze_theme_options_validate' );

    add_settings_section( 'color.schema.section', __('Farbeinstellungen', '_rrze' ), '_rrze_section_color_style_callback', 'color.options' );

    //add_settings_field( 'color.style', __('Farben', '_rrze' ), '_rrze_field_color_style_callback', 'color.options', 'color.schema.section' );
    
    add_settings_field( 'color.schema', __('Farbschemas', '_rrze' ), '_rrze_field_color_schema_callback', 'color.options', 'color.schema.section' );
    
} );

function _rrze_searchform_options() {
    $options = array(
        'none' => array(
            'value' => 'none',
            'label' => __( 'keiner', '_rrze' )
        ),
        
        'bereichsmenu' => array(
            'value' => 'bereichsmenu',
            'label' => __( 'Bereichsmenü', '_rrze' )
        )          
    );

    return apply_filters( '_rrze_searchform_options', $options );
}

function _rrze_columnlayout_options() {
    $options = array(
        '1-3' => array(
            'value' => '1-3',
            'label' => __( '2 Spalten - linke Sidebar', '_rrze' )
        ),
        
        '2-3' => array(
            'value' => '2-3',
            'label' => __( '2 Spalten - rechte Sidebar', '_rrze' )
        ),
        
        '1-2-3' => array(
            'value' => '1-2-3',
            'label' => __( '3 Spalten - linke und rechte Sidebar', '_rrze' )
        )
        
    );

    return apply_filters( '_rrze_columnlayout_options', $options );
}

function _rrze_footer_layout_options() {
    $options = array(
        '100' => array( 'group' => 1, 'value' => '100', 'label' => '100%' ),
        '25-75' => array( 'group' => 2, 'value' => '25-75', 'label' => '25% | 75%' ),
        '33-66' => array( 'group' => 2, 'value' => '33-66', 'label' => '33% | 66%' ),
        '38-62' => array( 'group' => 2, 'value' => '38-62', 'label' => '38% | 62%' ),
        '40-60' => array( 'group' => 2, 'value' => '40-60', 'label' => '40% | 60%' ),
        '50-50' => array( 'group' => 2, 'value' => '50-50', 'label' => '50% | 50%' ),
        '60-40' => array( 'group' => 2, 'value' => '60-40', 'label' => '60% | 40%' ),
        '62-38' => array( 'group' => 2, 'value' => '62-38', 'label' => '62% | 38%' ),
        '66-33' => array( 'group' => 2, 'value' => '66-33', 'label' => '66% | 33%' ),
        '75-25' => array( 'group' => 2, 'value' => '75-25', 'label' => '75% | 25%' ),
        '25-25-50' => array( 'group' => 3, 'value' => '25-25-50', 'label' => '25% | 25% | 50%' ),
        '25-50-25' => array( 'group' => 3, 'value' => '25-50-25', 'label' => '25% | 50% | 25%' ),
        '50-25-25' => array( 'group' => 3, 'value' => '50-25-25', 'label' => '50% | 25% | 25%' ),
        '33-33-33' => array( 'group' => 3, 'value' => '33-33-33', 'label' => '33% | 33% | 33%' )
    );

    return apply_filters( '_rrze_footer_layout_options', $options );
}

function _rrze_default_color_style_data() {
    $color_schemas = _rrze_color_schema_options();
    return $color_schemas['blau']['colors'];
}

function _rrze_default_color_style() {
    $colors = _rrze_default_color_style_data();
    
    $color_style = array( 
        'menu' => array( 
            'label' => __( 'Menüfarbe', '_rrze' ),
            'color' => $colors['menu'] 
         ),
        'title' => array( 
            'label' => __( 'Titelfarbe', '_rrze' ),
            'color' => $colors['title'] 
         ),
        'link' => array( 
            'label' => __( 'Linkfarbe', '_rrze' ),
            'color' => $colors['link'] 
         ),        
        'hover' => array( 
            'label' => __( 'Hover-Farbe', '_rrze' ),
            'color' => $colors['hover'] 
         ),
        'widget-title' => array( 
            'label' => __( 'Widget-Titel in Spalten', '_rrze' ),
            'color' => $colors['widget-title'] 
         ),
        'widget-linien' => array( 
            'label' => __( 'Widget-Linien in Spalten', '_rrze' ),
            'color' => $colors['widget-linien'] 
         ),
        'widget-hover' => array( 
            'label' => __( 'Widget-Hover-Farbe in Spalten', '_rrze' ),
            'color' => $colors['widget-hover'] 
         ),        
        'footer-widget-title' => array( 
            'label' => __( 'Widget-Titel im Footer', '_rrze' ),
            'color' => $colors['footer-widget-title'] 
         ),
        'footer-widget-linien' => array( 
            'label' => __( 'Widget-Linien im Footer', '_rrze' ),
            'color' => $colors['footer-widget-linien'] 
         ),
        'footer-hover' => array( 
            'label' => __( 'Hover-Farbe im Footer', '_rrze' ),
            'color' => $colors['footer-hover'] 
         ),        
        'background' => array( 
            'label' => __( 'Hintergrundfarbe', '_rrze' ),
            'color' => $colors['background'] 
         )        
    );

    return apply_filters( '_rrze_default_color_style', $color_style );
}

function _rrze_color_schema_options() {
    $options = array(
        'grau' => array(
            'value' => 'grau',
            'label' => __( 'Grau', '_rrze' ),
            'colors' => array( 'menu' => '#222222', 'title' => '#444444', 'link' => '#020202', 'hover' => '#515151', 'widget-title' => '#444444', 'widget-linien' => '#DDDDDD', 'widget-hover' => '#888888', 'footer-widget-title' => '#9E9E9E', 'footer-widget-linien' => '#686868', 'footer-hover' => '#303030', 'background' => '#7A7A7A' ),
        ),
        
        'blau' => array(
            'value' => 'blau',
            'label' => __( 'Blau', '_rrze' ),
            'colors' => array( 'menu' => '#00425F', 'title' => '#00425F', 'link' => '#1E6296', 'hover' => '#005D85', 'widget-title' => '#00425F', 'widget-linien' => '#B3C6CE', 'widget-hover' => '#6B8EAD', 'footer-widget-title' => '#D0D0D0', 'footer-widget-linien' => '#006F9F', 'footer-hover' => '#005D85', 'background' => '#D4D7D9' ),
        ),
            
        'gruen' => array(
            'value' => 'gruen',
            'label' => __( 'Grün', '_rrze' ),
            'colors' => array( 'menu' => '#006600', 'title' => '#006600', 'link' => '#006600', 'hover' => '#0E510E', 'widget-title' => '#366636', 'widget-linien' => '#8BB797', 'widget-hover' => '#6F9977', 'footer-widget-title' => '#829985', 'footer-widget-linien' => '#829985', 'footer-hover' => '#55754D', 'background' => '#E9E7D7' ),
        ),
        
        'rot' => array(
            'value' => 'rot',
            'label' => __( 'Rot', '_rrze' ),
            'colors' => array( 'menu' => '#AF290D', 'title' => '#B35B22', 'link' => '#B35B22', 'hover' => '#B35B22', 'widget-title' => '#B35B22', 'widget-linien' => '#B29C8E', 'widget-hover' => '#B2876B', 'footer-widget-title' => '#B29C8E', 'footer-widget-linien' => '#B29C8E', 'footer-hover' => '#B27349', 'background' => '#BCA279' ),
        ),        
        
    );

    return apply_filters( '_rrze_color_schemas', $options );
}

function _rrze_section_layout_callback() {
    printf( '<p>%s</p>', __( 'Wählen Sie, welche Optionen aktivieren möchten.', '_rrze' ) );
}

function _rrze_section_typography_callback() {
    printf( '<p>%s</p>', __( 'Geben Sie eine beliebige Schriftart ein um der Ihres Websites zu ändern. Andererseits, geben Sie einen Leerwert ein um den Standardschriftart wieder einzustellen.', '_rrze' ) );
}

function _rrze_section_color_style_callback() {
    printf( '<p>%s</p>', __( 'Wählen Sie, welche Farbschema aktivieren möchten.', '_rrze' ) );
}

function _rrze_field_searchform_callback() {
	$options = _rrze_theme_options();
	?>
	<select name="_rrze_theme_options[search.form.position]" id="searchform-position">
		<?php
			$selected = $options['search.form.position'];
			$html = '';

			foreach ( _rrze_searchform_options() as $option ) {
				$html .= '<option value="'.esc_attr($option['value']).'"'.($selected == $option['value'] ? ' selected="selected"' : '').'>'.esc_attr($option['label']).'</option>';
			}
			echo $html;
		?>
	</select>
	<?php
}

function _rrze_field_columnlayout_callback() {
	$options = _rrze_theme_options();

	foreach ( _rrze_columnlayout_options() as $button ):
	?>
	<div class="layout">
		<label class="description">
			<input type="radio" name="_rrze_theme_options[column.layout]" value="<?php echo esc_attr( $button['value'] ); ?>" <?php checked( $options['column.layout'], $button['value'] ); ?> />
			<?php echo $button['label']; ?>
		</label>
	</div>
	<?php
	endforeach;
}

function _rrze_field_footer_layout_callback() {
	$options = _rrze_theme_options();
	?>
	<select name="_rrze_theme_options[footer.layout]" id="footer-layout">
		<?php
			$selected = $options['footer.layout'];
			$html = '';
            
            foreach( _rrze_footer_layout_options() as $option ) {
                $groups[] = $option['group'];
            }
            
            $groups = array_unique($groups);
            foreach($groups as $group) {
                $html .= '<optgroup label="'. esc_attr($group). ' ' .esc_attr( _n( 'Spalte', 'Spalten', $group, '_rrze' ) ) . '" rel="' . esc_attr($group) . '">';
                foreach ( _rrze_footer_layout_options() as $option ) {
                    if($option['group'] == $group) {
                        $html .= '<option value="'.esc_attr($option['value']).'"'.($selected == $option['value'] ? ' selected="selected"' : '').'>'.esc_attr($option['label']).'</option>';
                    }
                }
                $html .= '</optgroup>';
            }
            echo $html;
		?>
	</select>
	<?php

}

function _rrze_field_body_typography_callback() {
	$options = _rrze_theme_options();
	?>
    <input type="text" class="regular-text" name="_rrze_theme_options[body.typography]" value="<?php echo esc_attr($options['body.typography']); ?>" />
	<?php
}

function _rrze_field_heading_typography_callback() {
	$options = _rrze_theme_options();
	?>
    <input type="text" class="regular-text" name="_rrze_theme_options[heading.typography]" value="<?php echo esc_attr($options['heading.typography']); ?>" />
	<?php
}

function _rrze_field_menu_typography_callback() {
	$options = _rrze_theme_options();
	?>
    <input type="text" class="regular-text" name="_rrze_theme_options[menu.typography]" value="<?php echo esc_attr($options['menu.typography']); ?>" />
	<?php
}

function _rrze_field_widget_title_typography_callback() {
	$options = _rrze_theme_options();
	?>
    <input type="text" class="regular-text" name="_rrze_theme_options[widget.title.typography]" value="<?php echo esc_attr($options['widget.title.typography']); ?>" />
	<?php
}

function _rrze_field_widget_content_typography_callback() {
	$options = _rrze_theme_options();
	?>
    <input type="text" class="regular-text" name="_rrze_theme_options[widget.content.typography]" value="<?php echo esc_attr($options['widget.content.typography']); ?>" />
	<?php
}

function _rrze_field_color_style_callback() {
    $option = _rrze_theme_options( 'color.style' );
    ?>
    <ul class="rrze-section-content">
	<?php foreach ( _rrze_default_color_style() as $key => $style ): ?>
    <li id="rrze-control-header_textcolor" class="rrze-control rrze-control-color">
    <label>
    <span class="rrze-control-title"><?php echo $style['label']; ?></span>
    <input type="text" data-default-color="<?php echo $style['color']; ?>" value="<?php echo $option[$key]; ?>" class="color-picker-field" />
    </label>
    </li>
	<?php endforeach; ?>
    </ul>
    <?php
}

function _rrze_field_color_schema_callback() {
    $options = _rrze_theme_options();
    $color_schema = $options['color.schema'];
    $custom_colors = array_map( 'strtoupper', $options['color.style'] );
    $color_schema_options = _rrze_color_schema_options();
    foreach( $color_schema_options as $option ) {
        $colors = array_map( 'strtoupper', $option['colors'] );
        if( $options['color.schema'] == $option['value'] && array_diff_assoc( $custom_colors, $colors ) ) {
            $color_schema = '_custom';
            
            $color_schema_options[$color_schema] = array(
                'value' => $color_schema,
                'label' => __( 'Benutzerdefiniertes', '_rrze' ),
                'colors' => $custom_colors
            );
            
        }
    }
    
    ksort( $color_schema_options );
    
	foreach ( $color_schema_options as $option ):
        $label = '';
        $colors = $option['colors'];
	?>
	<div class="layout">
		<label class="description">
			<input type="radio" name="_rrze_theme_options[color.schema]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $color_schema, $option['value'] ); ?> />
            <?php
            sort( $colors );
            foreach ( $colors as $color ) {
                $label .= '<span style="width: 20px; height: 20px; min-width: 20px; padding: 0; margin: 0 1px 4px 0; line-height: 20px; display: inline-block; background-color: ' . $color . '" title="' . $option['label'] . ' ">&nbsp;</span>';
            }

            $label .= '<span style="width: 6px; display: inline-block;">&nbsp;</span>';
            $label .= $option['label'];
            echo $label;
            ?>
		</label>
	</div>
	<?php
	endforeach;
}

function _rrze_theme_options_menu_page() {
    $pages = _rrze_options_pages();
    $tab = isset( $_GET['tab'] ) && array_key_exists( $_GET['tab'], $pages ) ? $_GET['tab'] : 'layout.options';
    ?>
    <div class="wrap">

        <?php screen_icon(); ?>
        <h2><?php _e( 'Einstellungen', '_rrze' );?></h2>
        <?php settings_errors(); ?>
        <h2 class="nav-tab-wrapper">
            <?php foreach( $pages as $page):
                $active = ( $page['value'] == $tab ) ? 'nav-tab-active' : '';
                printf( '<a href="?page=theme_options&tab=%s" class="nav-tab %s">%s</a>', $page['value'], $active, $page['label']  );
            endforeach; ?>
        </h2>

        <form method="post" action="options.php">
            <?php 
            settings_fields( $tab );
            do_settings_sections( $tab );
            submit_button();
            ?>
        </form>

    </div>
    <?php
}

function _rrze_theme_options_validate( $input ) {
    $default_options = _rrze_theme_default_options();
    $options = _rrze_theme_options();
    
    $custom_schema = '_custom';
    $custom_colors = array_map( 'strtoupper', $options['color.style'] );
    $color_schema_options = _rrze_color_schema_options();
    
    foreach( $color_schema_options as $option ) {
        $colors = array_map( 'strtoupper', $option['colors'] );
        if( $options['color.schema'] == $option['value'] && array_diff_assoc( $custom_colors, $colors ) )
            $color_schema_options[$custom_schema] = array();
    }
    
	if ( isset( $input['search.form.position'] ) && array_key_exists( $input['search.form.position'], _rrze_searchform_options() ) )
		$options['search.form.position'] = $input['search.form.position'];
    
	if ( isset( $input['column.layout'] ) && array_key_exists( $input['column.layout'], _rrze_columnlayout_options() ) )
		$options['column.layout'] = $input['column.layout'];

	if ( isset( $input['footer.layout'] ) && array_key_exists( $input['footer.layout'], _rrze_footer_layout_options() ) )
		$options['footer.layout'] = $input['footer.layout'];
    
	if ( !empty( $input['body.typography'] ) ) {
        if( _rrze_validate_font_family( $input['body.typography'] ) )
            $options['body.typography'] = _rrze_replace_whitespaces( $input['body.typography'] );
    } else {
        $options['body.typography'] = $default_options['body.typography'];
    }
    
	if ( !empty( $input['heading.typography'] ) ) {
        if( _rrze_validate_font_family( $input['heading.typography'] ) )
            $options['heading.typography'] = _rrze_replace_whitespaces( $input['heading.typography']);
    } else {
        $options['heading.typography'] = $default_options['heading.typography'];
    }

	if ( !empty( $input['menu.typography'] ) ) {
        if( _rrze_validate_font_family( $input['menu.typography'] ) )
            $options['menu.typography'] = _rrze_replace_whitespaces( $input['menu.typography']);
    } else {
        $options['menu.typography'] = $default_options['menu.typography'];
    }

	if ( !empty( $input['widget.title.typography'] ) ) {
        if( _rrze_validate_font_family( $input['widget.title.typography'] ) )
            $options['widget.title.typography'] = _rrze_replace_whitespaces( $input['widget.title.typography']);
    } else {
        $options['widget.title.typography'] = $default_options['widget.title.typography'];
    }

	if ( !empty( $input['widget.content.typography'] ) ) {
        if( _rrze_validate_font_family( $input['widget.content.typography'] ) )
            $options['widget.content.typography'] = _rrze_replace_whitespaces( $input['widget.content.typography']);
    } else {
        $options['widget.content.typography'] = $default_options['widget.content.typography'];
    }
    
	if ( isset( $input['color.schema'] ) && array_key_exists( $input['color.schema'], $color_schema_options ) ) {
        if( $input['color.schema'] == $custom_schema ) {
            $options['color.style'] = $custom_colors;
        } else {
            $options['color.style'] = $color_schema_options[$input['color.schema']]['colors'];       
            $options['color.schema'] = $input['color.schema'];
        }
    }
    
	if ( isset( $input['color.style'] ) )
		$options['color.style'] = $input['color.style'];
        
    return apply_filters( '_rrze_theme_options_validate', $options, $input );
}

function _rrze_validate_font_family( $str ) {
    if( preg_match( '/^([a-z0-9,_-\s"])+$/i', $str ) )
        return true;
    
    return false;
}

function _rrze_replace_whitespaces( $str ) {
    $str = preg_replace( '/\s+/', ' ', $str );
    return implode( ', ', array_map( 'trim', explode( ',', $str ) ) );
}

function _rrze_validate_hex_color( $str ) {
    if( preg_match( '/^#[a-f0-9]{6}$/i', $str ) )
        return true;
    
    return false;
}

/*
 * Theme customizer
 */
add_action( 'customize_register', function( $wp_customize ) {
    $options = _rrze_theme_options();
    
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
    
    // color.style
    $color_style = $options['color.style'];
    $default_color_style = _rrze_default_color_style();
    $i = 20;
    foreach( $default_color_style as $key => $style ) {
        $wp_customize->add_setting( '_rrze_theme_options[color.style][' . $key . ']', array(
            'type' => 'option',
            'default' => $color_style[$key]
        ) );
        $wp_customize->add_control( new WP_Customize_Color_Control( 
            $wp_customize, 
            '_rrze_theme_options_color_style-' . $key, 
            array(
                'label' => $style['label'],
                'section' => 'colors',
                'settings' => '_rrze_theme_options[color.style][' . $key . ']',
                'priority' => $i
            )
        ) );
        $i++;
    }
    
    // column.layout
	$wp_customize->add_section( '_rrze_theme_layout', array(
		'title'    => __( 'Layout', '_rrze' ),
		'priority' => 100,
	) );
    
	$wp_customize->add_setting( '_rrze_theme_options[column.layout]', array(
		'type' => 'option',
		'default' => $options['column.layout'],
        'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_key',
	) );

	$choices = array();
	foreach ( _rrze_columnlayout_options() as $option ) {
		$choices[$option['value']] = $option['label'];
	}

	$wp_customize->add_control( '_rrze_theme_options_columns_layout', array(
        'label'      => __( 'Spalten', '_rrze' ),        
		'section'    => '_rrze_theme_layout',
		'type'       => 'radio',
		'choices'    => $choices,
        'settings' => '_rrze_theme_options[column.layout]',
        'priority' => 10
	) );
    
    // footer.layout
	$wp_customize->add_setting( '_rrze_theme_options[footer.layout]', array(
		'type' => 'option',
		'default' => $options['footer.layout'],
        'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_key',
	) );

	$choices = array();
	foreach ( _rrze_footer_layout_options() as $option ) {
		$choices[$option['value']] = $option['label'];
	}

	$wp_customize->add_control( '_rrze_theme_options_footer_layout', array(
        'label'      => __( 'Footer (Widgets)', '_rrze' ),        
		'section'    => '_rrze_theme_layout',
		'type'       => 'select',
		'choices'    => $choices,
        'settings' => '_rrze_theme_options[footer.layout]',
        'priority' => 20
	) );
    
} );

add_action( 'customize_preview_init', function() {
    wp_enqueue_script( 'theme-customizer', sprintf('%s/js/theme-customizer.js', get_template_directory_uri() ), array( 'jquery', 'customize-preview' ), false, true );
} );
