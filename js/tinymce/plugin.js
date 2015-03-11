(function() {
    tinymce.PluginManager.add('bimg_mce_button', function( editor ) {
        editor.addButton( 'bimg_mce_button', {
            title: 'BIMG Shortcodes',
            icon: 'icon dashicons-lightbulb',
            type: 'menubutton',
            menu: [
                {
                    text: 'Accordion',
                    menu: [
                        {
                            text: 'Initialize Accordion',
                            onclick: function() {
                                editor.windowManager.open( {
                                    title: 'Insert Accordion Shortcode',
                                    body: [
                                        {
                                            type: 'listbox',
                                            name: 'icon',
                                            label: 'Icon',
                                            'values': [
                                                {text: 'None', value: 'false'},
                                                {text: 'Arrow', value: 'arrow'},
                                                {text: 'Circled Arrow', value: 'circle-arrow'},
                                                {text: 'Carat', value: 'carat'},
                                                {text: 'Plus/Minus', value: 'plus'},
                                                {text: 'Circled Plus/Minus', value: 'circle-plus'},
                                                {text: 'Triangle', value: 'triangle'},
                                                {text: 'Circled Triangle', value: 'circle-triangle'},
                                                {text: 'Question Mark', value: 'question'}
                                            ]
                                        },
                                        {
                                            type: 'listbox',
                                            name: 'heightstyle',
                                            label: 'Height Style',
                                            'values': [
                                                {text: 'Relative toggle height', value: 'content'},
                                                {text: 'Equal toggle height', value: 'auto'},
                                                {text: 'Fill container', value: 'fill'},
                                            ]
                                        },
                                        {
                                            type: 'radio',
                                            name: 'collapsible',
                                            label: 'Collapsible Toggles?'
                                        },
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
                                            label: 'Title of First Toggle'
                                        }
                                    ],
                                    onsubmit: function( e ) {
                                        if( e.data.id === '') {
                                            editor.windowManager.alert('You must specify an ID.');
                                            return false;
                                        }
                                        if( e.data.title === '') {
                                            editor.windowManager.alert('A toggle without a title would be confusing, no?');
                                            return false;
                                        }
                                        editor.insertContent(
                                            '[bimg_accordion id="' + e.data.id +
                                                '" class="' + e.data.class +
                                                '" icon="' + e.data.icon +
                                                '" height_style="' + e.data.heightstyle +
                                                '" collapsible="' + e.data.collapsible +
                                                '"][toggle title="' + e.data.title +
                                                '"][/toggle][/bimg_accordion]' );
                                    }
                                });
                            }
                        },
                        {
                            text: 'Add Toggle',
                            onclick: function() {
                                editor.windowManager.open( {
                                    title: 'Insert Additional Toggle',
                                    body: [
                                        {
                                            type: 'textbox',
                                            name: 'title',
                                            label: 'Title'
                                        }
                                    ],
                                    onsubmit: function( e ) {
                                        if( e.data.title === '') {
                                            editor.windowManager.alert('A toggle without a title would be confusing, no?');
                                            return false;
                                        }
                                        editor.insertContent( '[toggle title="' + e.data.title + '"][/toggle]' );
                                    }
                                });
                            }
                        }
                    ]
                },
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
                                    type: 'listbox',
                                    name: 'style',
                                    label: 'Button Style',
                                    'values': [
                                        {text: 'Default', value: 'standard'},
                                        {text: 'Primary', value: 'primary'},
                                    ]
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
                                }
                            ],
                            onsubmit: function( e ) {
                                editor.insertContent(
                                    '[bimg_button id="' + e.data.id +
                                        '" class="' + e.data.class +
                                        '" style="' + e.data.style +
                                        '" url="' + e.data.url +
                                        '"]' + e.data.text + '[/bimg_button]');
                            }
                        });
                    }
                },
                {
                    text: 'Grid',
                    menu: [
                        {
                            text: 'Add Row',
                            onclick: function() {
                                editor.windowManager.open( {
                                    title: 'Insert Row Shortcode',
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
                                            type: 'radio',
                                            name: 'equal',
                                            label: 'Equal Height Columns?'
                                        }
                                    ],
                                    onsubmit: function( e ) {
                                        if( e.data.id === '' && e.data.equal === true ) {
                                            editor.windowManager.alert('You must specify an ID to use equal height columns.');
                                            return false;
                                        }
                                        editor.insertContent(
                                            '[bimg_row id="' + e.data.id +
                                                '" class="' + e.data.class +
                                                '" equal="' + e.data.equal +'"][/bimg_row]' );
                                    }
                                });
                            }
                        },
                        {
                            text: 'Add Column',
                            onclick: function() {
                                editor.windowManager.open( {
                                    title: 'Insert Column Shortcode',
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
                                            name: 'columns',
                                            label: 'Columns in Row (1-12)'
                                        },
                                        {
                                            type: 'textbox',
                                            name: 'width',
                                            label: 'Column Width (1-12)'
                                        }
                                    ],
                                    onsubmit: function( e ) {
                                        var range = new Array('1','2','3','4','5','6','7','8','9','10','11','12','13');
                                        if(!(e.data.columns in range)) {
                                            editor.windowManager.alert('"Columns in Row" must be an integer between 1 and 12.');
                                            return false;
                                        }
                                        if(!(e.data.width in range)) {
                                            editor.windowManager.alert('"Column Width" must be an integer between 1 and 12.');
                                            return false;
                                        }
                                        editor.insertContent(
                                            '[bimg_col id="' + e.data.id +
                                                '" class="' + e.data.class +
                                                '" columns="' + e.data.columns +
                                                '" width="' + e.data.width + '"][/bimg_col]' );
                                    }
                                });
                            }
                        }
                    ]
                },
                {
                    text: 'Image',
                    onclick: function() {
                        editor.windowManager.open( {
                            title: 'Insert Image Shortcode',
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
                                    name: 'img_url',
                                    label: 'Image URL'
                                },
                                {
                                    type: 'textbox',
                                    name: 'alt',
                                    label: 'Description'
                                },
                                {
                                    type: 'radio',
                                    name: 'scale',
                                    label: 'Scale Image?'
                                },
                                {
                                    type: 'textbox',
                                    name: 'url',
                                    label: 'External URL'
                                },
                                {
                                    type: 'listbox',
                                    name: 'target',
                                    label: 'Open URL In:',
                                    'values': [
                                        {text: 'None', value: false},
                                        {text: 'Same Tab/Window', value: '_self'},
                                        {text: 'New Tab/Window', value: '_blank'},
                                    ]
                                }
                            ],
                            onsubmit: function( e ) {
                                if( e.data.img_url === '') {
                                    editor.windowManager.alert('You must specify an Image URL.');
                                    return false;
                                }
                                if( e.data.alt === '') {
                                    editor.windowManager.alert('Be nice and write a Description.');
                                    return false;
                                }
                                editor.insertContent(
                                    '[bimg_image id="' + e.data.id +
                                        '" class="' + e.data.class +
                                        '" img_url="' + e.data.img_url +
                                        '" alt="' + e.data.alt +
                                        '" scale="' + e.data.scale +
                                        '" url="' + e.data.url +
                                        '" target="' + e.data.target + '"]');
                            }
                        });
                    }
                },
                {
                    text: 'Section',
                    onclick: function() {
                        editor.windowManager.open( {
                            title: 'Insert Section Shortcode',
                            body: [
                                {
                                    type: 'textbox',
                                    name: 'heading',
                                    label: 'Heading'
                                },
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
                                editor.insertContent( '[bimg_section heading="' + e.data.heading + '" id="' + e.data.id + '" class="' + e.data.class + '"][/bimg_section]');
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
                                        if( e.data.id === '') {
                                            editor.windowManager.alert('You must specify an ID.');
                                            return false;
                                        }
                                        if( e.data.title === '') {
                                            editor.windowManager.alert('A tab without a title would be confusing, no?');
                                            return false;
                                        }
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
                                        if( e.data.title === '') {
                                            editor.windowManager.alert('A tab without a title would be confusing, no?');
                                            return false;
                                        }
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
