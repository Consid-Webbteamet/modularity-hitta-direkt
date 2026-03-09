<?php

declare(strict_types=1);

if (!function_exists('acf_add_local_field_group')) {
    return;
}

acf_add_local_field_group([
    'key' => 'group_modularity_hitta_direkt_settings',
    'title' => __('Hitta direkt', 'modularity-hitta-direkt'),
    'fields' => [
        [
            'key' => 'field_hitta_direkt_editor_info',
            'label' => __('Instruktion', 'modularity-hitta-direkt'),
            'name' => '',
            'type' => 'message',
            'message' => __('Lägg till 1 till 5 genvägar. Länktexten visas som etikett under cirkeln.', 'modularity-hitta-direkt'),
            'new_lines' => 'wpautop',
            'esc_html' => 0,
        ],
        [
            'key' => 'field_hitta_direkt_items',
            'label' => __('Länkar', 'modularity-hitta-direkt'),
            'name' => 'items',
            'type' => 'repeater',
            'required' => 1,
            'instructions' => __('Varje rad blir en klickbar cirkel.', 'modularity-hitta-direkt'),
            'layout' => 'row',
            'button_label' => __('Lägg till länk', 'modularity-hitta-direkt'),
            'min' => 1,
            'max' => 5,
            'collapsed' => 'field_hitta_direkt_item_link',
            'sub_fields' => [
                [
                    'key' => 'field_hitta_direkt_item_icon',
                    'label' => __('Ikon', 'modularity-hitta-direkt'),
                    'name' => 'icon',
                    'type' => 'icon',
                    'required' => 1,
                    'default_value' => '',
                    'wrapper' => [
                        'width' => '25',
                        'class' => '',
                        'id' => '',
                    ],
                ],
                [
                    'key' => 'field_hitta_direkt_item_color',
                    'label' => __('Färg', 'modularity-hitta-direkt'),
                    'name' => 'color',
                    'type' => 'select',
                    'required' => 1,
                    'choices' => [
                        'orange' => __('Orange', 'modularity-hitta-direkt'),
                        'red' => __('Röd', 'modularity-hitta-direkt'),
                        'green' => __('Grön', 'modularity-hitta-direkt'),
                        'purple' => __('Lila', 'modularity-hitta-direkt'),
                        'blue' => __('Blå', 'modularity-hitta-direkt'),
                    ],
                    'default_value' => 'blue',
                    'return_format' => 'value',
                    'allow_null' => 0,
                    'multiple' => 0,
                    'ui' => 1,
                    'ajax' => 0,
                    'placeholder' => '',
                    'wrapper' => [
                        'width' => '25',
                        'class' => '',
                        'id' => '',
                    ],
                ],
                [
                    'key' => 'field_hitta_direkt_item_link',
                    'label' => __('Länk till sida', 'modularity-hitta-direkt'),
                    'name' => 'link',
                    'type' => 'link',
                    'required' => 1,
                    'return_format' => 'array',
                    'wrapper' => [
                        'width' => '50',
                        'class' => '',
                        'id' => '',
                    ],
                ],
            ],
        ],
    ],
    'location' => [
        [
            [
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'mod-hitta-direkt',
            ],
        ],
        [
            [
                'param' => 'block',
                'operator' => '==',
                'value' => 'acf/hitta-direkt',
            ],
        ],
    ],
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => true,
    'description' => '',
    'show_in_rest' => 0,
]);
