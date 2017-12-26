<?php

Customify_Customizer_Layout_Builder()->register_builder( 'header', new Customify_Builder_Header() );

class Customify_Builder_Header  extends  Customify_Customizer_Builder_Panel{
    public $id = 'header';

    function get_config(){
        return array(
            'id'         => $this->id,
            'title'      => __( 'Header Builder', 'customify' ),
            'control_id' => 'header_builder_panel',
            'panel'      => 'header_settings',
            'section'    => 'header_builder_panel',
            'devices' => array(
                'desktop'   => __( 'Desktop', 'customify' ),
                'mobile'    => __( 'Mobile/Tablet', 'customify' ),
            ),
        );
    }

    function get_rows_config(){
        return array(
            'top' =>  __( 'Header Top', 'customify' ),
            'main' =>  __( 'Header Main', 'customify' ),
            'bottom' =>  __( 'Header Bottom', 'customify' ),
            'sidebar' =>  __( 'Mobile Sidebar', 'customify' ),
        );
    }

    function customize( ){

        $fn = 'customify_customize_render_header';
        $config = array(
            array(
                'name' => 'header_settings',
                'type' => 'panel',
                'theme_supports' => '',
                'title' => __( 'Header', 'customify' ),
            ),

            array(
                'name' => 'header_builder_panel',
                'type' => 'section',
                'panel' => 'header_settings',
                'title' => __( 'Header Builder', 'customify' ),
            ),

            array(
                'name' => 'header_builder_panel',
                'type' => 'js_raw',
                'section' => 'header_builder_panel',
                'theme_supports' => '',
                'title' => __( 'Header Builder', 'customify' ),
                'selector' => '#masthead',
                'render_callback' => $fn,
                'container_inclusive' => true
            ),
        );

        return $config;
    }

    function row_config(  $section = false, $section_name = false ){

        if ( ! $section ) {
            $section  = 'header_top';
        }
        if ( ! $section_name ) {
            $section_name = __( 'Header Top', 'customify' );
        }

        $selector = '#cb-row--'.str_replace('_', '-', $section );

        $fn = 'customify_customize_render_header';
        $selector_all = '#masthead';

        $config  = array(
            array(
                'name' => $section,
                'type' => 'section',
                'panel' => 'header_settings',
                'theme_supports' => '',
                'title' => $section_name,
            ),

            array(
                'name' => $section.'_layout',
                'type' => 'select',
                'section' => $section,
                'title' => __( 'Layout', 'customify' ),
                'selector' => $selector,
                'css_format' => 'html_class',
                'render_callback' => $fn,
                'default' => 'layout-full-contained',
                'choices' => array(
                    'layout-full-contained' =>  __( 'Full width - Contained', 'customify' ),
                    'layout-fullwidth' =>  __( 'Full Width', 'customify' ),
                    'layout-contained' =>  __( 'Contained', 'customify' ),
                )
            ),

            array(
                'name' => $section.'_height',
                'type' => 'slider',
                'section' => $section,
                'theme_supports' => '',
                'device_settings' => false,
                'max' => 250,
                //'selector' => $selector.' .customify-grid, '.$selector,
                'selector' => $selector.' .customify-grid',
                'css_format' => 'min-height: {{value}};',
                'title' => __( 'Height', 'customify' ),
            ),

            array(
                'name' => $section.'_background',
                'type' => 'group',
                'section'     => $section,
                'title'          => __( 'Background', 'customify' ),
                'live_title_field' => 'title',
                'field_class' => 'customify-background-control',
                'selector' => $selector,
                'css_format' => 'background',
                'device_settings' => false,
                'default' => array(

                ),
                'fields' => array(
                    array(
                        'name' => 'color',
                        'type' => 'color',
                        'label' => __( 'Color', 'customify' ),
                    ),
                    array(
                        'name' => 'image',
                        'type' => 'image',
                        'label' => __( 'Image', 'customify' ),
                    ),
                    array(
                        'name' => 'cover',
                        'type' => 'checkbox',
                        'required' => array( 'image', 'not_empty', ''),
                        'checkbox_label' => __( 'Background cover', 'customify' ),
                    ),
                    array(
                        'name' => 'position',
                        'type' => 'select',
                        'label' => __( 'Background Position', 'customify' ),
                        'required' => array( 'image', 'not_empty', ''),
                        'choices' => array(
                            'default'       => __( 'Position', 'customify' ),
                            'center'        => __( 'Center', 'customify' ),
                            'top_left'      => __( 'Top Left', 'customify' ),
                            'top_right'     => __( 'Top Right', 'customify' ),
                            'top_center'    => __( 'Top Center', 'customify' ),
                            'bottom_left'   => __( 'Bottom Left', 'customify' ),
                            'bottom_center' => __( 'Bottom Center', 'customify' ),
                            'bottom_right'  => __( 'Bottom Right', 'customify' ),
                        ),
                    ),

                    array(
                        'name' => 'repeat',
                        'type' => 'select',
                        'label' => __( 'Background Repeat', 'customify' ),
                        'required' => array(
                            array('image', 'not_empty', ''),
                            // array('style', '!=', 'cover' ),
                        ),
                        'choices' => array(
                            'default' => __( 'Repeat', 'customify' ),
                            'no-repeat' => __( 'No-repeat', 'customify' ),
                            'repeat-x' => __( 'Repeat Horizontal', 'customify' ),
                            'repeat-y' => __( 'Repeat Vertical', 'customify' ),
                        ),
                    ),

                    array(
                        'name' => 'attachment',
                        'type' => 'select',
                        'label' => __( 'Background Attachment', 'customify' ),
                        'required' => array(
                            array('image', 'not_empty', '')
                        ),
                        'choices' => array(
                            'default' => __( 'Attachment', 'customify' ),
                            'scroll' => __( 'Scroll', 'customify' ),
                            'fixed' => __( 'Fixed', 'customify' )
                        ),
                    ),

                )
            ),

        );

        return $config;

    }
    function row_sidebar_config( $section , $section_name ){
        $selector = '#mobile-header-panel-inner';

        $config  = array(
            array(
                'name' => $section,
                'type' => 'section',
                'panel' => 'header_settings',
                'theme_supports' => '',
                'title'          => $section_name,
            ),

            array(
                'name' => $section.'_padding',
                'type' => 'css_ruler',
                'section' => $section,
                'selector' => $selector,
                'css_format' => array(
                    'top' => 'padding-top: {{value}};',
                    'right' => 'padding-right: {{value}};',
                    'bottom' => 'padding-bottom: {{value}};',
                    'left' => 'padding-left: {{value}};',
                ),
                'title' => __( 'Padding', 'customify' ),
            ),

            array(
                'name' => $section.'_background',
                'type' => 'group',
                'section' => $section,
                'title' => __( 'Background', 'customify' ),
                'description' => __( 'This is description',  'customify' ),
                'live_title_field' => 'title',
                'field_class' => 'customify-background-control',
                'selector' => '#mobile-header-panel',
                'css_format' => 'background',
                'default' => array(

                ),
                'fields' => array(
                    array(
                        'name' => 'color',
                        'type' => 'color',
                        'label' => __( 'Color', 'customify' ),
                        'device_settings' => false,
                    ),
                    array(
                        'name' => 'image',
                        'type' => 'image',
                        'label' => __( 'Image', 'customify' ),
                    ),
                    array(
                        'name' => 'cover',
                        'type' => 'checkbox',
                        'required' => array( 'image', 'not_empty', ''),
                        'checkbox_label' => __( 'Background cover', 'customify' ),
                    ),
                    array(
                        'name' => 'position',
                        'type' => 'select',
                        'label' => __( 'Background Position', 'customify' ),
                        'required' => array( 'image', 'not_empty', ''),
                        'choices' => array(
                            'default'       => __( 'Position', 'customify' ),
                            'center'        => __( 'Center', 'customify' ),
                            'top_left'      => __( 'Top Left', 'customify' ),
                            'top_right'     => __( 'Top Right', 'customify' ),
                            'top_center'    => __( 'Top Center', 'customify' ),
                            'bottom_left'   => __( 'Bottom Left', 'customify' ),
                            'bottom_center' => __( 'Bottom Center', 'customify' ),
                            'bottom_right'  => __( 'Bottom Right', 'customify' ),
                        ),
                    ),

                    array(
                        'name' => 'repeat',
                        'type' => 'select',
                        'label' => __( 'Background Repeat', 'customify' ),
                        'required' => array(
                            array('image', 'not_empty', ''),
                        ),
                        'choices' => array(
                            'default' => __( 'Repeat', 'customify' ),
                            'no-repeat' => __( 'No-repeat', 'customify' ),
                            'repeat-x' => __( 'Repeat Horizontal', 'customify' ),
                            'repeat-y' => __( 'Repeat Vertical', 'customify' ),
                        ),
                    ),

                    array(
                        'name' => 'attachment',
                        'type' => 'select',
                        'label' => __( 'Background Attachment', 'customify' ),
                        'required' => array(
                            array('image', 'not_empty', ''),
                            array('cover', '!=', '1' ),
                        ),
                        'choices' => array(
                            'default' => __( 'Attachment', 'customify' ),
                            'scroll' => __( 'Scroll', 'customify' ),
                            'fixed' => __( 'Fixed', 'customify' )
                        ),
                    ),

                )
            ),

        );
        return $config;
    }
}
