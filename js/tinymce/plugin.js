(function() {
    tinymce.PluginManager.add('bimg_mce_button', function( editor, url ) {
        editor.addButton( 'bimg_mce_button', {
            title: 'BIMG Shortcodes',
            icon: 'icon dashicons-lightbulb',
            type: 'menubutton',
            menu: [
            {
                text: 'Separator',
                icon: 'icon dashicons-minus',
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
                icon: 'icon dashicons-index-card',
                menu: [
                {
                    text: 'Initialize Tabs',
                    icon: 'icon dashicons-hammer',
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
                    icon: 'icon dashicons-plus',
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
