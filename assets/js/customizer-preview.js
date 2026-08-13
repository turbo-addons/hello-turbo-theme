/**
 * Turbo Theme — Customizer Live Preview.
 * Updates CSS custom properties in real-time.
 */
(function ($) {
    'use strict';

    // Map customizer settings to CSS custom properties.
    var colorMappings = {
        'turbo_palette_color_0': '--turbo-primary',
        'turbo_palette_color_1': '--turbo-secondary',
        'turbo_palette_color_2': '--turbo-heading-color',
        'turbo_palette_color_3': '--turbo-text-color',
        'turbo_palette_color_4': '--turbo-meta-color',
        'turbo_palette_color_5': '--turbo-light-bg',
        'turbo_palette_color_6': '--turbo-white',
        'turbo_palette_color_7': '--turbo-border',
        'turbo_palette_color_8': '--turbo-border-subtle',
        'turbo_color_link': '--turbo-link',
        'turbo_color_link_hover': '--turbo-link-hover',
        'turbo_color_bg_site': '--turbo-site-bg',
        'turbo_color_bg_content': '--turbo-content-bg',
        'turbo_header_bg': '--turbo-header-bg',
        'turbo_menu_color': '--turbo-menu-color',
        'turbo_menu_hover_color': '--turbo-menu-hover',
        'turbo_btn_color': '--turbo-btn-color',
        'turbo_btn_bg': '--turbo-btn-bg',
        'turbo_btn_hover_color': '--turbo-btn-hover-color',
        'turbo_btn_hover_bg': '--turbo-btn-hover-bg'
    };

    var sizeMappings = {
        'turbo_body_font_size': { prop: '--turbo-body-size', unit: 'px' },
        'turbo_body_line_height': { prop: '--turbo-body-lh', unit: '' },
        'turbo_container_width': { prop: '--turbo-container', unit: 'px' },
        'turbo_header_height': { prop: '--turbo-header-height', unit: 'px' },
        'turbo_h1_font_size': { prop: '--turbo-h1-size', unit: 'px' },
        'turbo_h2_font_size': { prop: '--turbo-h2-size', unit: 'px' },
        'turbo_h3_font_size': { prop: '--turbo-h3-size', unit: 'px' },
        'turbo_h4_font_size': { prop: '--turbo-h4-size', unit: 'px' },
        'turbo_h5_font_size': { prop: '--turbo-h5-size', unit: 'px' },
        'turbo_h6_font_size': { prop: '--turbo-h6-size', unit: 'px' },
        'turbo_btn_radius': { prop: '--turbo-btn-radius', unit: 'px' },
        'turbo_btn_font_size': { prop: '--turbo-btn-font-size', unit: 'px' }
    };

    // Bind color settings.
    $.each(colorMappings, function (setting, property) {
        wp.customize(setting, function (value) {
            value.bind(function (newval) {
                document.documentElement.style.setProperty(property, newval);
            });
        });
    });

    // Bind size settings.
    $.each(sizeMappings, function (setting, config) {
        wp.customize(setting, function (value) {
            value.bind(function (newval) {
                document.documentElement.style.setProperty(config.prop, newval + config.unit);
            });
        });
    });

    // Font weight bindings.
    wp.customize('turbo_body_font_weight', function (value) {
        value.bind(function (newval) {
            document.documentElement.style.setProperty('--turbo-body-weight', newval);
        });
    });

    wp.customize('turbo_heading_font_weight', function (value) {
        value.bind(function (newval) {
            document.documentElement.style.setProperty('--turbo-heading-weight', newval);
        });
    });

    wp.customize('turbo_heading_line_height', function (value) {
        value.bind(function (newval) {
            document.documentElement.style.setProperty('--turbo-heading-lh', newval);
        });
    });

    wp.customize('turbo_btn_font_weight', function (value) {
        value.bind(function (newval) {
            document.documentElement.style.setProperty('--turbo-btn-weight', newval);
        });
    });

})(jQuery);
