/**
 * HelloTurbo Theme — Customizer Live Preview.
 * Updates CSS custom properties in real-time.
 */
(function ($) {
    'use strict';

    // Map customizer settings to CSS custom properties.
    var colorMappings = {
        'helloturbo_palette_color_0': '--helloturbo-primary',
        'helloturbo_palette_color_1': '--helloturbo-secondary',
        'helloturbo_palette_color_2': '--helloturbo-heading-color',
        'helloturbo_palette_color_3': '--helloturbo-text-color',
        'helloturbo_palette_color_4': '--helloturbo-meta-color',
        'helloturbo_palette_color_5': '--helloturbo-light-bg',
        'helloturbo_palette_color_6': '--helloturbo-white',
        'helloturbo_palette_color_7': '--helloturbo-border',
        'helloturbo_palette_color_8': '--helloturbo-border-subtle',
        'helloturbo_color_link': '--helloturbo-link',
        'helloturbo_color_link_hover': '--helloturbo-link-hover',
        'helloturbo_color_bg_site': '--helloturbo-site-bg',
        'helloturbo_color_bg_content': '--helloturbo-content-bg',
        'helloturbo_header_bg': '--helloturbo-header-bg',
        'helloturbo_menu_color': '--helloturbo-menu-color',
        'helloturbo_menu_hover_color': '--helloturbo-menu-hover',
        'helloturbo_btn_color': '--helloturbo-btn-color',
        'helloturbo_btn_bg': '--helloturbo-btn-bg',
        'helloturbo_btn_hover_color': '--helloturbo-btn-hover-color',
        'helloturbo_btn_hover_bg': '--helloturbo-btn-hover-bg'
    };

    var sizeMappings = {
        'helloturbo_body_font_size': { prop: '--helloturbo-body-size', unit: 'px' },
        'helloturbo_body_line_height': { prop: '--helloturbo-body-lh', unit: '' },
        'helloturbo_header_height': { prop: '--helloturbo-header-height', unit: 'px' },
        'helloturbo_h1_font_size': { prop: '--helloturbo-h1-size', unit: 'px' },
        'helloturbo_h2_font_size': { prop: '--helloturbo-h2-size', unit: 'px' },
        'helloturbo_h3_font_size': { prop: '--helloturbo-h3-size', unit: 'px' },
        'helloturbo_h4_font_size': { prop: '--helloturbo-h4-size', unit: 'px' },
        'helloturbo_h5_font_size': { prop: '--helloturbo-h5-size', unit: 'px' },
        'helloturbo_h6_font_size': { prop: '--helloturbo-h6-size', unit: 'px' },
        'helloturbo_btn_radius': { prop: '--helloturbo-btn-radius', unit: 'px' },
        'helloturbo_btn_font_size': { prop: '--helloturbo-btn-font-size', unit: 'px' }
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

    // Container width preset (Full Width or fixed pixel value).
    wp.customize('helloturbo_container_width', function (value) {
        value.bind(function (newval) {
            var width = (newval === 'full-width') ? '100%' : newval + 'px';
            document.documentElement.style.setProperty('--helloturbo-container', width);
        });
    });

    // Font weight bindings.
    wp.customize('helloturbo_body_font_weight', function (value) {
        value.bind(function (newval) {
            document.documentElement.style.setProperty('--helloturbo-body-weight', newval);
        });
    });

    wp.customize('helloturbo_heading_font_weight', function (value) {
        value.bind(function (newval) {
            document.documentElement.style.setProperty('--helloturbo-heading-weight', newval);
        });
    });

    wp.customize('helloturbo_heading_line_height', function (value) {
        value.bind(function (newval) {
            document.documentElement.style.setProperty('--helloturbo-heading-lh', newval);
        });
    });

    wp.customize('helloturbo_btn_font_weight', function (value) {
        value.bind(function (newval) {
            document.documentElement.style.setProperty('--helloturbo-btn-weight', newval);
        });
    });

})(jQuery);
