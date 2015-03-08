(function() {
    tinymce.PluginManager.add('bimg_mce_button', function( editor, url ) {
        editor.addButton( 'bimg_mce_button', {
            title: 'BIMG Shortcodes',
            icon: 'icon dashicons-lightbulb',
            type: 'menubutton',
            menu: [
            {
                text: 'Button',
                onclick: function() {
                    editor.windowManager.open( {
                        title: 'Insert Button Shortcode',
                        body: [
                        {
                            type: 'textbox',
                            name: 'id',
                            label: 'ID'
                        },
                        {
                            type: 'textbox',
                            name: 'class',
                            label: 'Class'
                        },
                        {
                            type: 'textbox',
                            name: 'text',
                            label: 'Button Text'
                        },
                        {
                            type: 'textbox',
                            name: 'url',
                            label: 'Button URL'
                        },
                        {
                            type: 'textbox',
                            name: 'textcolor',
                            label: 'Text Color'
                        },
                        {
                            type: 'textbox',
                            name: 'color',
                            label: 'Button Color'
                        },
                        {
                            type: 'listbox',
                            name: 'shape',
                            label: 'Shape',
                            'values': [
                                { text: 'Rounded', value: 'rounded' },
                                { text: 'Square', value: 'square' }
                            ]
                        },
                        {
                            type: 'listbox',
                            name: 'size',
                            label: 'Size',
                            'values': [
                                { text: 'Small', value: 'small' },
                                { text: 'Medium', value: 'medium' },
                                { text: 'Large', value: 'large' }
                            ]
                        },
                        {
                            type: 'radio',
                            name: 'border',
                            label: 'Border'
                        },
                        ],
                        onsubmit: function( e ) {
                            editor.insertContent(
                                    '[bimg_button id="' + e.data.id +
                                    '" class="' + e.data.class +
                                    '" text="' + e.data.text +
                                    '" url="' + e.data.url +
                                    '" text_color="' + e.data.textcolor +
                                    '" button_color="' + e.data.color +
                                    '" shape="' + e.data.shape +
                                    '" size="' + e.data.size +
                                    '" border="' + e.data.border +
                                    '"]');
                        }
                    });
                }
            },
            {
                text: 'Separator',
                onclick: function() {
                    editor.windowManager.open( {
                        title: 'Insert Separator Shortcode',
                        body: [
                        {
                            type: 'textbox',
                            name: 'id',
                            label: 'ID'
                        },
                        {
                            type: 'textbox',
                            name: 'class',
                            label: 'Class'
                        }
                        ],
                        onsubmit: function( e ) {
                            editor.insertContent( '[bimg_separator id="' + e.data.id + '" class="' + e.data.class + '"]');
                        }
                    });
                }
            },
            {
                text: 'Tabs',
                menu: [
                {
                    text: 'Initialize Tabs',
                    onclick: function() {
                        editor.windowManager.open( {
                            title: 'Insert Tabs Shortcode',
                            body: [
                            {
                                type: 'textbox',
                                name: 'id',
                                label: 'ID (Required)'
                            },
                            {
                                type: 'textbox',
                                name: 'class',
                                label: 'Class'
                            },
                                {
                                    type: 'textbox',
                                    name: 'title',
                                    label: 'Title of First Tab'
                                }
                            ],
                            onsubmit: function( e ) {
                                editor.insertContent( '[bimg_tabs id="' + e.data.id + '" class="' + e.data.class + '"][tab title="' + e.data.title + '"][/tab][/bimg_tabs]' );
                            }
                        });
                    }
                },
                {
                    text: 'Add Tab',
                    onclick: function() {
                        editor.windowManager.open( {
                            title: 'Insert Additional Tab',
                            body: [
                            {
                                type: 'textbox',
                                name: 'title',
                                label: 'Title'
                            }
                            ],
                            onsubmit: function( e ) {
                                editor.insertContent( '[tab title="' + e.data.title + '"][/tab]' );
                            }
                        });
                    }
                }
                ]
            }
            ]
        });
    });
})();
