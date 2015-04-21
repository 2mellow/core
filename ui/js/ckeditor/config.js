/**
 * @license Copyright (c) 2003-2014, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// config.uiColor = '#AADC6E';

	config.contentsCss = '/ui/css/font.css';
	
	config.extraPlugins = 'doksoft_image,doksoft_preview,doksoft_resize';
	
	config.filebrowserImageUploadUrl = '/ui/js/ckeditor/plugins/doksoft_uploader/uploader.php?type=Images';
	config.filebrowserImageThumbsUploadUrl = '/ui/js/ckeditor/plugins/doksoft_uploader/uploader.php?type=Images&makeThumb=true';
	config.filebrowserImageResizeUploadUrl = '/ui/js/ckeditor/plugins/doksoft_uploader/uploader.php?type=Images&resize=true';

};