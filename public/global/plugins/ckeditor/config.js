/**
 * @license Copyright (c) 2003-2019, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	config.language = 'vi';
    config.contentsCss = 'https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap';

    config.font_names = config.font_names + 'Montserrat 1/Montserrat;';
    config.font_names = config.font_names + 'Montserrat /Montserrat;';

    config.extraPlugins = 'lineheight';
    config.line_height = "4px;8px;12px;16px;20px;24px;28px;32px;36px;40px;";
};



