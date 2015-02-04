<?php
require 'framework.php';
?>
<!doctype html>
<html>
<head>
<base target="_parent" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/redmond/jquery-ui.css" />
<link rel="stylesheet" href="<?php echo $base_link	.'plugins/system/yjsg/'; ?>assets/bootstrap3/css/bootstrap.min.css" />
<script type="text/javascript" src="<?php echo $base_link.'plugins/system/yjsg/'; ?>assets/src/libraries/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo $base_link.'plugins/system/yjsg'; ?>assets/bootstrap3/js/bootstrap.min.js"></script>
<script type="text/javascript">
(function ($) {
    $(document).ready(function () {
				
		$('[data-toggle=tooltip]').tooltip({
		  	container: 'body',
			trigger:'click'// bug on hover
		 });
		 
		 $('select,input').on('mouseenter', function (event) {
			 
			 var label = $('label[for="'+$(this).attr('id')+'"]');
			 
			 label.trigger('click');
			 
		 }).on('mouseleave', function (event) {
			  var label = $('label[for="'+$(this).attr('id')+'"]');
			label.trigger('click');
		 });
		
        $('#addshortcode').click(function (event) {
            event.preventDefault();
             
			var radius 			= $('select[name=radius]').val();
			var fadeto 			= $('input[name=fadeto]').val();
			var fadespeed 		= $('input[name=fadespeed]').val();
			var effect 			= $('select[name=effect]').val();
            var group 			= $('select[name=group]').val();
			var hideptitle 		= $('select[name=hideptitle]').val();
            var type 			= $('select[name=type]').val();
            var title 			= $('input[name=title]').val();
			var alink 			= $('input[name=alink]').val();
			var target 			= $('select[name=target]').val();
			var imagelink 		= $('input[name=imagelink]').val();
			var lightbox 		= $('select[name=lightbox]').val();
			var lightboximage 	= $('input[name=lightboximage]').val();
			
			var imageeffectclass = type + radius +  group + lightbox + hideptitle;
			
			
			var effectparams = effect;
			
			if (effect == 'fade' && ( fadeto !='' || fadespeed!='') ) {
				
				effectparams ='fade|'+fadeto+'|'+fadespeed+'';
			}
			
			if (lightboximage !=''){
				
				alink = lightboximage;
				
			}

			
		 var imageeffect ='[yjsgimgs ';
		 	 imageeffect +='image="' + imagelink + '" ';
			 imageeffect +='class="' + imageeffectclass.trim() + '" ';
			 imageeffect +='title="' + title + '" ';
			 imageeffect +='link="' + alink + '" ';
			 imageeffect +='target="' + target + '" ';
			 imageeffect +='effect="' + effectparams + '"]';
			
			
			if (effect == 'fade' && ( fadeto =='' || fadespeed=='') ) {
				alert('<?php echo JText::_('YJSG_SHORTCODES_IMAGES_JS_ALERTFADE'); ?>');
				return;
				
			}
			
			if (imagelink == '' || (lightbox !='' && lightboximage == '' )) {
				alert('<?php echo JText::_('YJSG_SHORTCODES_IMAGES_JS_ALERTIMAGE'); ?>');
				return;
				
			}
						
			var findEditor = $("#editor-xtd-buttons", parent.document.body).parent().find('textarea').attr('id');
			
			if( findEditor !='undefined' ){
				window.parent.jInsertEditorText(imageeffect, findEditor);
			}
			
        });
		

		var sadmin ='';
        var iframe = $('<iframe frameborder="0" marginwidth="0" marginheight="0" allowfullscreen></iframe>');
        var dialog = $("<div></div>").append(iframe).appendTo("body").dialog({
            autoOpen: false,
            modal: true,
            resizable: false,
            width: "auto",
            height: "auto",
            draggable: false,
            open: function () {
                $('.ui-widget-overlay').css({
                    'background-image': 'none',
                    'background-color': '#000000',
                    'position': 'fixed'
                });
            },
            close: function () {
                iframe.attr("src", "");
                $('.ui-widget-overlay').css('position', 'absolute');
            },
            buttons: {
                "Close": function () {
                    $(this).dialog("close");
                }
            }
        });
        window.jInsertFieldValue = function (value, id) {
            var element = $('#' + id);
            element.val(value);
            element.trigger('change');
        }
        window.yjsgCloseModal = function (getElem) {
            dialog.dialog('close');
        };
		
		var siteroot 	= window.parent.siteroot;
		var imagemedia 	= window.parent.imagemedia;
		
		
		
        $('.add_image').on('click', function (event) {
            event.preventDefault();
			var element = $(this).parent().find('input').attr('id');
            var src = siteroot + sadmin + imagemedia + element + '&folder=';   
            var title = 'Add image';
            iframe.attr({
                width: 600,
                height: 450,
                src: src
            });
            dialog.dialog("option", "title", title).dialog("open");

        });
		
		
        $('select[name=type]').change(function () {
            if ($(this).val() == 'yjt_polaroid') {
                $('.group,.hideptitle').removeClass('hide');
            } else {
                $('.group,.hideptitle').addClass('hide');
            }
        });
		
        $('select[name=effect]').change(function () {
            if ($(this).val() == 'fade') {
                $('.efade').removeClass('hide');
            } else {
                $('.efade').addClass('hide');
            }
        });
		
        $('select[name=lightbox]').change(function () {
            if ($(this).val() != '') {
                $('.lighboximage').removeClass('hide');
				$('.alink').addClass('hide');
				$('.atarget').addClass('hide');
            } else {
                $('.lighboximage').addClass('hide');
				$('.alink').removeClass('hide');
				$('.atarget').removeClass('hide');
            }
        });
		
    });
	
}(jQuery));
</script>
</head>
<body>
	<div class="container">
		<h2><?php echo JText::_('YJSG_SHORTCODES_IMAGES_TITLE'); ?></h2><br/>
		<form role="form">
		<div class="form-inline">
			<div class="form-group">
				<label for="type" data-toggle="tooltip" data-placement="top" title="<?php echo JText::_('YJSG_SHORTCODES_IMAGES_TYPE_DESC'); ?>"><?php echo JText::_('YJSG_SHORTCODES_IMAGES_TYPE_LABEL'); ?></label>
				<select class="form-control" id="type" name="type">
					<option value="" selected><?php echo JText::_('YJSG_SHORTCODES_IMAGES_TYPE_OPTION_DEFAULT'); ?></option>
					<option value="yjt_polaroid"><?php echo JText::_('YJSG_SHORTCODES_IMAGES_TYPE_OPTION_POLAROID'); ?></option>
					<option value="bthin"><?php echo JText::_('YJSG_SHORTCODES_IMAGES_TYPE_OPTION_BTHIN'); ?></option>
					<option value="bthick"><?php echo JText::_('YJSG_SHORTCODES_IMAGES_TYPE_OPTION_BTHICK'); ?></option>
					<option value="bspace"><?php echo JText::_('YJSG_SHORTCODES_IMAGES_TYPE_OPTION_BSPACE'); ?></option>
					<option value="bspacethick"><?php echo JText::_('YJSG_SHORTCODES_IMAGES_TYPE_OPTION_BSPACETHICK'); ?></option>
				</select>
			</div>
				
				<div class="form-group group hide">
					<label for="group" data-toggle="tooltip" data-placement="top" title="<?php echo JText::_('YJSG_SHORTCODES_IMAGES_GROUP_DESC'); ?>"><?php echo JText::_('YJSG_SHORTCODES_IMAGES_GROUP_LABEL'); ?></label>
					<select class="form-control" id="group" name="group">
						<option value="" selected><?php echo JText::_('YJSG_NO'); ?></option>
						<option value=" yjt_group"><?php echo JText::_('YJSG_YES'); ?></option>
					</select>
				</div>
				
				<div class="form-group hideptitle hide">
					<label for="hideptitle" data-toggle="tooltip" data-placement="top" title="<?php echo JText::_('YJSG_SHORTCODES_IMAGES_HIDEPTITLE_DESC'); ?>"><?php echo JText::_('YJSG_SHORTCODES_IMAGES_HIDEPTITLE_LABEL'); ?></label>
					<select class="form-control" id="hideptitle" name="hideptitle">
						<option value="" selected><?php echo JText::_('YJSG_NO'); ?></option>
						<option value=" yjt_hideptitle"><?php echo JText::_('YJSG_YES'); ?></option>
					</select>
				</div>
				
			<div class="form-group">
					<label for="radius" data-toggle="tooltip" data-placement="top" title="<?php echo JText::_('YJSG_SHORTCODES_IMAGES_RADIUS_DESC'); ?>"><?php echo JText::_('YJSG_SHORTCODES_IMAGES_RADIUS_LABEL'); ?></label>
					<select class="form-control" id="radius" name="radius">
						<option value=" " selected><?php echo JText::_('JNONE'); ?></option>
						<option value=" radiusb2">2px</option>
						<option value=" radiusb3">3px</option>
						<option value=" radiusb4">4px</option>
						<option value=" radiusb5">5px</option>
						<option value=" radiusb6">6px</option>
						<option value=" radiusb7">7px</option>
						<option value=" radiusb8">8px</option>
						<option value=" radiusb9">9px</option>
						<option value=" radiusb10">10px</option>
					</select>
				</div>
					</div>
					<br/>
			<div class="form-inline">
				<div class="form-group">
					<label for="effect" data-toggle="tooltip" data-placement="top" title="<?php echo JText::_('YJSG_SHORTCODES_IMAGES_EFFECT_DESC'); ?>"><?php echo JText::_('YJSG_SHORTCODES_IMAGES_EFFECT_LABEL'); ?></label>
					<select class="form-control" id="effect" name="effect">
						<option value="none" selected><?php echo JText::_('JNONE'); ?></option>
						<option value="morph"><?php echo JText::_('YJSG_SHORTCODES_IMAGES_EFFECT_OPTION_MORPH'); ?></option>
						<option value="tilt"><?php echo JText::_('YJSG_SHORTCODES_IMAGES_EFFECT_OPTION_TILT'); ?></option>
						<option value="fade"><?php echo JText::_('YJSG_SHORTCODES_IMAGES_EFFECT_OPTION_FADE'); ?></option>
					</select>
				</div>
				<div class="form-group">
					<label for="lightbox" data-toggle="tooltip" data-placement="top" title="<?php echo JText::_('YJSG_SHORTCODES_IMAGES_LIGHTBOX_DESC'); ?>"><?php echo JText::_('YJSG_SHORTCODES_IMAGES_LIGHTBOX_LABEL'); ?></label>
					<select class="form-control" id="lightbox" name="lightbox">
						<option value="" selected><?php echo JText::_('YJSG_NO'); ?></option>
						<option value=" yjsg-lightbox"><?php echo JText::_('YJSG_SHORTCODES_IMAGES_LIGHTBOX_OPTION_SINGLE'); ?></option>
						<option value=" yjsg-lightbox-items"><?php echo JText::_('YJSG_SHORTCODES_IMAGES_LIGHTBOX_OPTION_GALLERY'); ?></option>
					</select>
				</div>
				<div class="form-group efade hide">
					<label for="fadeto" title="<?php echo JText::_('YJSG_SHORTCODES_IMAGES_FADETO_DESC'); ?>"><?php echo JText::_('YJSG_SHORTCODES_IMAGES_FADETO_LABEL'); ?></label>
					<input type="text" class="form-control" id="fadeto" name="fadeto" placeholder="<?php echo JText::_('YJSG_SHORTCODES_IMAGES_FADETO_HINT'); ?>" onClick="this.select()" />
				</div>
				<div class="form-group efade hide">
					<label for="fadespeed" title="<?php echo JText::_('YJSG_SHORTCODES_IMAGES_FADESPEED_DESC'); ?>"><?php echo JText::_('YJSG_SHORTCODES_IMAGES_FADESPEED_LABEL'); ?></label>
					<input type="text" class="form-control" id="fadespeed" name="fadespeed" placeholder="<?php echo JText::_('YJSG_SHORTCODES_IMAGES_FADESPEED_HINT'); ?>" onClick="this.select()" />
				</div>


				


				
			</div><br/>
			<div class="form-group">
				<label for="title" data-toggle="tooltip" data-placement="top" title="<?php echo JText::_('YJSG_SHORTCODES_IMAGES_TITLE_DESC'); ?>"><?php echo JText::_('YJSG_SHORTCODES_IMAGES_TITLE_LABEL'); ?></label>
				<input type="text" class="form-control" id="title" name="title" placeholder="<?php echo JText::_('YJSG_SHORTCODES_IMAGES_TITLE_HINT'); ?>" onClick="this.select()" />
			</div>
			<div class="form-group alink">
				<label for="alink" data-toggle="tooltip" data-placement="top" title="<?php echo JText::_('YJSG_SHORTCODES_IMAGES_ALINK_DESC'); ?>"><?php echo JText::_('YJSG_SHORTCODES_IMAGES_ALINK_LABEL'); ?></label>
				<input type="text" class="form-control" id="alink" name="alink" placeholder="<?php echo JText::_('YJSG_SHORTCODES_IMAGES_ALINK_HINT'); ?>" onClick="this.select()" />
			</div>
				<div class="form-group atarget">
					<label for="target" data-toggle="tooltip" data-placement="top" title="<?php echo JText::_('YJSG_SHORTCODES_IMAGES_TARGET_DESC'); ?>"><?php echo JText::_('YJSG_SHORTCODES_IMAGES_TARGET_LABEL'); ?></label>
					<select class="form-control" id="target" name="target">
						<option value="" selected><?php echo JText::_('YJSG_SHORTCODES_IMAGES_TARGET_OPTION_SAME'); ?></option>
						<option value="blank"><?php echo JText::_('YJSG_SHORTCODES_IMAGES_TARGET_OPTION_NEW'); ?></option>
					</select>
				</div>
			<br />
			<div class="form-inline">
				<div class="form-group">
					<label for="imagelink" data-toggle="tooltip" data-placement="top" title="<?php echo JText::_('YJSG_SHORTCODES_IMAGES_IMAGELINK_DESC'); ?>"><?php echo JText::_('YJSG_SHORTCODES_IMAGES_IMAGELINK_LABEL'); ?></label>
					<input type="text" class="form-control" id="imagelink" name="imagelink" placeholder="<?php echo JText::_('YJSG_SHORTCODES_IMAGES_IMAGELINK_HINT'); ?>" onClick="this.select()" />
				</div>
				<a id="addimage" class="btn btn-primary add_image"><?php echo JText::_('YJSG_SHORTCODES_IMAGES_IMAGELINK_BUTTON'); ?></a>
			</div>
			<br />
			
			<div class="form-inline lighboximage hide">
				<div class="form-group">
					<label for="lightboximage" data-toggle="tooltip" data-placement="top" title="<?php echo JText::_('YJSG_SHORTCODES_IMAGES_LIGHTBOXIMAGE_DESC'); ?>"><?php echo JText::_('YJSG_SHORTCODES_IMAGES_LIGHTBOXIMAGE_LABEL'); ?></label>
					<input type="text" class="form-control" id="lightboximage" name="lightboximage" placeholder="<?php echo JText::_('YJSG_SHORTCODES_IMAGES_LIGHTBOXIMAGE_HINT'); ?>" onClick="this.select()" />
				</div>
				<a id="addlightboximage" class="btn btn-primary add_image"><?php echo JText::_('YJSG_SHORTCODES_IMAGES_LIGHTBOXIMAGE_BUTTON'); ?></a>
			</div>
			
			<br />
			<br />
			<button type="submit" id="addshortcode" class="btn btn-primary"><?php echo JText::_('YJSG_SHORTCODES_IMAGES_BUTTON_SUBMIT'); ?></button>
		</form>
	</div>
</body>
</html>