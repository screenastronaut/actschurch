<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // disable direct access
}

if ( ! class_exists('Mega_Menu_Tabbed') ) :

/**
 *
 */
class Mega_Menu_Tabbed {

    /**
     * Constructor
     *
     * @since 1.5
     */
    public function __construct() {

        add_filter( 'megamenu_submenu_options', array( $this, 'add_tabbed_megamenu_option'), 10, 2 );
        add_filter( 'megamenu_nav_menu_objects_before', array( $this, 'identify_tabbed_submenus' ), 7, 2 );
        add_filter( 'megamenu_tabs', array( $this, 'add_mega_menu_tab_to_second_level_items'), 11, 5 );
        add_filter( 'megamenu_load_scss_file_contents', array( $this, 'append_tabbed_scss'), 10 );
        add_filter( 'megamenu_theme_editor_settings', array( $this, 'add_theme_editor_settings' ), 10 );
        add_filter( 'megamenu_default_theme', array($this, 'add_theme_placeholders'), 10 );
    }


    /**
     * Insert theme placeholder values. Inherit from flyout menu styling.
     *
     * @since 1.5
     * @param array $theme
     * @return array
     */
    public function add_theme_placeholders( $theme ) {

        $theme['tabbed_link_background_from'] = 'flyout_background_from';
        $theme['tabbed_link_background_to'] = 'flyout_background_to';
        $theme['tabbed_link_color'] = 'flyout_link_color';
        $theme['tabbed_link_family'] = 'flyout_link_family';
        $theme['tabbed_link_size'] = 'flyout_link_size';
        $theme['tabbed_link_weight'] = 'flyout_link_weight';
        $theme['tabbed_link_padding_top'] = 'flyout_link_padding_top';
        $theme['tabbed_link_padding_right'] = 'flyout_link_padding_right';
        $theme['tabbed_link_padding_bottom'] = 'flyout_link_padding_bottom';
        $theme['tabbed_link_padding_left'] = 'flyout_link_padding_left';
        $theme['tabbed_link_height'] = 'flyout_link_height';
        $theme['tabbed_link_width'] = '20%';
        $theme['tabbed_link_text_decoration'] = 'flyout_link_text_decoration';
        $theme['tabbed_link_text_transform'] = 'flyout_link_text_transform';
        $theme['tabbed_link_background_hover_from'] = 'flyout_background_hover_from';
        $theme['tabbed_link_background_hover_to'] = 'flyout_background_hover_to';
        $theme['tabbed_link_weight_hover'] = 'flyout_link_weight_hover';
        $theme['tabbed_link_text_decoration_hover'] = 'flyout_link_text_decoration_hover';
        $theme['tabbed_link_color_hover'] = 'flyout_link_color_hover';
        $theme['tabbed_link_vertical_divider'] = '#ccc';

        return $theme;
    }


    /**
     * Add the tabbed mega menu settings to the theme editor
     *
     * @since 1.5
     * @param array $settings
     * @return array
     */
    public function add_theme_editor_settings( $settings ) {

        $new_settings = array(
            'tabbed_submenus' => array(
                'priority' => 240,
                'title' => __( "Tabbed Mega Menus", "megamenu" ),
                'description' => '',
            ),
            'tabbed_menu_item_background' => array(
                'priority' => 250,
                'title' => __( "Tab Background", "megamenu" ),
                'description' => __( "Set the background color for the tabs.", "megamenu" ),
                'settings' => array(
                    array(
                        'title' => __( "From", "megamenu" ),
                        'type' => 'color',
                        'key' => 'tabbed_link_background_from'
                    ),
                    array(
                        'title' => __( "To", "megamenu" ),
                        'type' => 'color',
                        'key' => 'tabbed_link_background_to'
                    )
                )
            ),
            'tabbed_menu_item_background_hover' => array(
                'priority' => 260,
                'title' => __( "Tab Background (Hover)", "megamenu" ),
                'description' => __( "Set the background color for the tabs (on hover).", "megamenu" ),
                'settings' => array(
                    array(
                        'title' => __( "From", "megamenu" ),
                        'type' => 'color',
                        'key' => 'tabbed_link_background_hover_from'
                    ),
                    array(
                        'title' => __( "To", "megamenu" ),
                        'type' => 'color',
                        'key' => 'tabbed_link_background_hover_to'
                    )
                )
            ),
            'tabbed_menu_item_height' => array(
                'priority' => 270,
                'title' => __( "Tab Height", "megamenu" ),
                'description' => __( "The height of each tab.", "megamenu" ),
                'settings' => array(
                    array(
                        'title' => __( "", "megamenu" ),
                        'type' => 'freetext',
                        'key' => 'tabbed_link_height',
                        'validation' => 'px'
                    )
                )
            ),
            'tabbed_link_width' => array(
                'priority' => 275,
                'title' => __( "Tab Width", "megamenu" ),
                'description' => __( "Width of each tab. Value must be a percentage (e.g. 20%)", "megamenu" ),
                'settings' => array(
                    array(
                        'title' => __( "", "megamenu" ),
                        'type' => 'freetext',
                        'key' => 'tabbed_link_width',
                        'validation' => 'px'
                    ),
                )
            ),
            'tabbed_link_vertical_divider' => array(
                'priority' => 278,
                'title' => __( "Tab Vertical Divider", "megamenu" ),
                'description' => __( "Set the vertical divider color.", "megamenu" ),
                'settings' => array(
                    array(
                        'title' => __( "Color", "megamenu" ),
                        'type' => 'color',
                        'key' => 'tabbed_link_vertical_divider'
                    )
                )
            ),
            'tabbed_menu_item_padding' => array(
                'priority' => 280,
                'title' => __( "Tab Padding", "megamenu" ),
                'description' => __( "Set the padding for each of the tabs.", "megamenu" ),
                'settings' => array(
                    array(
                        'title' => __( "Top", "megamenu" ),
                        'type' => 'freetext',
                        'key' => 'tabbed_link_padding_top',
                        'validation' => 'px'
                    ),
                    array(
                        'title' => __( "Right", "megamenu" ),
                        'type' => 'freetext',
                        'key' => 'tabbed_link_padding_right',
                        'validation' => 'px'
                    ),
                    array(
                        'title' => __( "Bottom", "megamenu" ),
                        'type' => 'freetext',
                        'key' => 'tabbed_link_padding_bottom',
                        'validation' => 'px'
                    ),
                    array(
                        'title' => __( "Left", "megamenu" ),
                        'type' => 'freetext',
                        'key' => 'tabbed_link_padding_left',
                        'validation' => 'px'
                    )
                )
            ),
            'tabbed_menu_item_font' => array(
                'priority' => 290,
                'title' => __( "Tab Font", "megamenu" ),
                'description' => __( "Set the font for the tabs.", "megamenu" ),
                'settings' => array(
                    array(
                        'title' => __( "Color", "megamenu" ),
                        'type' => 'color',
                        'key' => 'tabbed_link_color'
                    ),
                    array(
                        'title' => __( "Size", "megamenu" ),
                        'type' => 'freetext',
                        'key' => 'tabbed_link_size',
                        'validation' => 'px'
                    ),
                    array(
                        'title' => __( "Family", "megamenu" ),
                        'type' => 'font',
                        'key' => 'tabbed_link_family'
                    ),
                    array(
                        'title' => __( "Transform", "megamenu" ),
                        'type' => 'transform',
                        'key' => 'tabbed_link_text_transform'
                    ),
                    array(
                        'title' => __( "Weight", "megamenu" ),
                        'type' => 'weight',
                        'key' => 'tabbed_link_weight'
                    ),
                    array(
                        'title' => __( "Decoration", "megamenu" ),
                        'type' => 'decoration',
                        'key' => 'tabbed_link_text_decoration'
                    ),
                )
            ),
            'tabbed_menu_item_font_hover' => array(
                'priority' => 300,
                'title' => __( "Tab Font (Hover)", "megamenu" ),
                'description' => __( "Set the font for the tabs.", "megamenu" ),
                'settings' => array(
                    array(
                        'title' => __( "Color", "megamenu" ),
                        'type' => 'color',
                        'key' => 'tabbed_link_color_hover'
                    ),
                    array(
                        'title' => __( "Weight", "megamenu" ),
                        'type' => 'weight',
                        'key' => 'tabbed_link_weight_hover'
                    ),
                    array(
                        'title' => __( "Decoration", "megamenu" ),
                        'type' => 'decoration',
                        'key' => 'tabbed_link_text_decoration_hover'
                    ),
                )
            )
        );

        $settings['mega_panels']['settings'] = array_merge($settings['mega_panels']['settings'], $new_settings);

        return $settings;
    }


    /**
     * Add the CSS required to render tabbed mega menus
     *
     * @since 1.5
     * @param string $scss
     * @return string
     */
    public function append_tabbed_scss( $scss ) {

        $path = trailingslashit( plugin_dir_path( __FILE__ ) ) . 'scss/tabbed.scss';

        $contents = file_get_contents( $path );

        return $scss . $contents;

    }


    /**
     * Add the tabbed mega menu option to the available sub menu types
     *
     * @since 1.5
     * @param array $options
     * @param array $menu_item_meta
     */
    public function add_tabbed_megamenu_option( $options, $menu_item_meta ) {

        $options['tabbed'] = __("Mega Menu (Tabbed)", "megamenu");
        return $options;

    }


    /**
     * Return the Parent ID of a specified menu item
     *
     * @since 1.5
     * @param int $menu_id
     * @param int $menu_item_id
     */
    public function get_parent_menu_item_id( $menu_id, $menu_item_id ) {
        $menu_items = wp_get_nav_menu_items( $menu_id );

        foreach ( $menu_items as $order => $menu_item ) {
            if ($menu_item->ID == $menu_item_id) {
                return $menu_item->menu_item_parent;
            }
        }

        return 0;
    }


    /**
     *
     * @since 1.5
     */
    public function identify_tabbed_submenus( $items ) {

        $items_that_are_tabs = array();

        foreach ( $items as $item ) {
            if ( $item->parent_submenu_type == 'tabbed' ) {
                $items_that_are_tabs[] = $item->ID;
            }
        }

        foreach ( $items as $item ) {
            if ( in_array( $item->menu_item_parent, $items_that_are_tabs ) ) {
                $item->parent_submenu_type = 'megamenu'; // mark it as a mega menu so the core plugin will add widgets and handle ordering
            }
        }

        return $items;
    }


    /**
     *
     * @since 1.5
     */
    public function add_mega_menu_tab_to_second_level_items( $tabs, $menu_item_id, $menu_id, $menu_item_depth, $menu_item_meta ) {

        if ( $menu_item_depth !== 1 ) {
            return $tabs;
        }

        $parent_menu_item_id = $this->get_parent_menu_item_id($menu_id, $menu_item_id);

        $parent_megamenu_settings = get_post_meta( $parent_menu_item_id, '_megamenu', true );

        if ( is_array( $parent_megamenu_settings ) && isset( $parent_megamenu_settings['type'] ) && $parent_megamenu_settings['type'] != 'tabbed' ) {
            return $tabs;
        }

        $widget_manager = new Mega_Menu_Widget_Manager();

        $all_widgets = $widget_manager->get_available_widgets();

        $return = "<select id='mm_number_of_columns' name='settings[panel_columns]'>";
        $return .= "    <option value='1' " . selected( $menu_item_meta['panel_columns'], 1, false ) . ">1 " . __("column", "megamenu") . "</option>";
        $return .= "    <option value='2' " . selected( $menu_item_meta['panel_columns'], 2, false ) . ">2 " . __("columns", "megamenu") . "</option>";
        $return .= "    <option value='3' " . selected( $menu_item_meta['panel_columns'], 3, false ) . ">3 " . __("columns", "megamenu") . "</option>";
        $return .= "    <option value='4' " . selected( $menu_item_meta['panel_columns'], 4, false ) . ">4 " . __("columns", "megamenu") . "</option>";
        $return .= "    <option value='5' " . selected( $menu_item_meta['panel_columns'], 5, false ) . ">5 " . __("columns", "megamenu") . "</option>";
        $return .= "    <option value='6' " . selected( $menu_item_meta['panel_columns'], 6, false ) . ">6 " . __("columns", "megamenu") . "</option>";
        $return .= "    <option value='7' " . selected( $menu_item_meta['panel_columns'], 7, false ) . ">7 " . __("columns", "megamenu") . "</option>";
        $return .= "    <option value='8' " . selected( $menu_item_meta['panel_columns'], 8, false ) . ">8 " . __("columns", "megamenu") . "</option>";
        $return .= "</select>";

        $return .= "<select id='mm_widget_selector'>";
        $return .= "    <option value='disabled'>" . __("Select a Widget to add to the panel", "megamenu") . "</option>";

        foreach ( $all_widgets as $widget ) {
            $return .= "<option value='" . $widget['value'] . "'>" . $widget['text'] . "</option>";
        }

        $return .= "</select>";

        $return .= "<div id='widgets' class='enabled' data-columns='{$menu_item_meta['panel_columns']}'>";

        $items = $widget_manager->get_widgets_and_menu_items_for_menu_id( $menu_item_id, $menu_id );

        if ( count ( $items ) ) {

            foreach ( $items as $item ) {
                $return .= '<div class="widget" title="' . esc_attr( $item['title'] ) . '" id="' . esc_attr( $item['id'] ) . '" data-columns="' . esc_attr( $item['columns'] ) . '" data-type="' . esc_attr( $item['type'] ) . '" data-id="' . esc_attr( $item['id'] ) . '">';
                $return .= '    <div class="widget-top">';
                $return .= '        <div class="widget-title-action">';
                $return .= '            <a class="widget-option widget-contract" title="' . esc_attr( __("Contract", "megamenu") ) . '"></a>';
                $return .= '            <span class="widget-cols"><span class="widget-num-cols">' . $item['columns'] . '</span><span class="widget-of">/</span><span class="widget-total-cols">' . $menu_item_meta['panel_columns'] . '</span></span>';
                $return .= '            <a class="widget-option widget-expand" title="' . esc_attr( __("Expand", "megamenu") ) . '"></a>';
                $return .= '            <a class="widget-option widget-action" title="' . esc_attr( __("Edit", "megamenu") ) . '"></a>';
                $return .= '        </div>';
                $return .= '        <div class="widget-title">';
                $return .= '            <h4>' .  esc_html( $item['title'] ) . '</h4>';
                $return .= '        </div>';
                $return .= '    </div>';
                $return .= '    <div class="widget-inner"></div>';
                $return .= '</div>';
            }

        } else {
            $return .= "<p class='no_widgets'>" .  __("No widgets found. Add a widget to this area using the Widget Selector (top right)") . "</p>";
        }

        $return .= "</div>";

        $tabs['mega_menu'] = array(
            'title' => __('Tab Content', 'megamenu'),
            'content' => $return
        );

        return $tabs;
    }

}

endif;