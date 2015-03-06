(function() {
    tinymce.PluginManager.add('bimg_mce_button', function( editor, url ) {
        editor.addButton( 'bimg_mce_button', {
            text: 'BIMG',
            icon: false,
            type: 'menubutton',
            menu: [
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
            }
            ]
        });
    });
})();
