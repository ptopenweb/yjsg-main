<?php
require 'framework.php';
?>
<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="<?php echo $base_link.'plugins/system/yjsg/'; ?>assets/bootstrap3/css/bootstrap.min.css" />
<script type="text/javascript" src="<?php echo $base_link.'plugins/system/yjsg/'; ?>assets/src/libraries/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $base_link.'plugins/system/yjsg/'; ?>assets/bootstrap3/js/bootstrap.min.js"></script>
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
            var mediatype 	= $('select[name=mediatype]').val();
            var medialink 	= $('input[name=link]').val();
            var poster 		= $('input[name=poster]').val();
            var width 		= $('input[name=width]').val();
            var height 		= $('input[name=height]').val();
			var resp 		= $('select[name=responsive]').val();
			
			  if (mediatype !='audio' && width == '') {
				  
				  width = '640';
				  
			  }else if(mediatype =='audio'){
				  
				   width = '';
			  }

			  if (mediatype !='audio' && height == '') {
				  
				  height = '360';
				  
			  }else if(mediatype =='audio'){
				  
				  height = '';
			  }
			  
			  if (mediatype !='html5') {
				  
				   poster =''; 
			  }
			
			var mediaid = 'yjsg_media' + Math.floor((Math.random()*888)+1);
			var mediashortcode = '[yjsgmedia link="' + medialink + '" poster="' + poster + '" width="' + width + '" height="' + height + '" resp="'+resp+'" id="'+mediaid+'"]';
			
			if (medialink == '') {
				alert('<?php echo JText::_('YJSG_SHORTCODES_MEDIA_JS_ALERT'); ?>');
				return;
				
			}
			var findEditor = $("#editor-xtd-buttons", parent.document.body).parent().find('textarea').attr('id');
			
			if( findEditor !='undefined' ){
				window.parent.jInsertEditorText(mediashortcode, findEditor);
			}
			
        });
        $('select[name=mediatype]').change(function () {
            if ($(this).val() == 'html5') {
                $('.poster').removeClass('hide');
            } else {
                $('.poster').addClass('hide');
            }
			
            if ($(this).val() == 'audio') {
                $('.sizes').addClass('hide');
            } else {
                $('.sizes').removeClass('hide');
            }
			
        });
		

		
    });
}(jQuery));
</script>
</head>
<body>
    <div class="container">
        <h2><?php echo JText::_('YJSG_SHORTCODES_MEDIA_TITLE'); ?></h2>
        <form role="form">
            <div class="form-group">
                <label for="mediatype" data-toggle="tooltip" data-placement="top" title="<?php echo JText::_('YJSG_SHORTCODES_MEDIA_MEDIATYPE_DESC'); ?>"><?php echo JText::_('YJSG_SHORTCODES_MEDIA_MEDIATYPE_LABEL'); ?></label>
                <select class="form-control" id="mediatype" name="mediatype">
                    <option value="html5" selected><?php echo JText::_('YJSG_SHORTCODES_MEDIA_MEDIATYPE_OPTION_HTML5'); ?></option>
                    <option value="vimeo"><?php echo JText::_('YJSG_SHORTCODES_MEDIA_MEDIATYPE_OPTION_VIMEO'); ?></option>
                    <option value="youtube"><?php echo JText::_('YJSG_SHORTCODES_MEDIA_MEDIATYPE_OPTION_YOUTUBE'); ?></option>
					<option value="audio"><?php echo JText::_('YJSG_SHORTCODES_MEDIA_MEDIATYPE_OPTION_AUDIO'); ?></option>
                </select>
            </div>
            <div class="form-group">
                <label for="link" data-toggle="tooltip" data-placement="top" title="<?php echo JText::_('YJSG_SHORTCODES_MEDIA_LINK_DESC'); ?>"><?php echo JText::_('YJSG_SHORTCODES_MEDIA_LINK_LABEL'); ?></label>
                <input type="text" class="form-control" id="link" name="link" placeholder="<?php echo JText::_('YJSG_SHORTCODES_MEDIA_LINK_HINT'); ?>" onClick="this.select()" />
            </div>
            <div class="form-group poster">
                <label for="poster" data-toggle="tooltip" data-placement="top" title="<?php echo JText::_('YJSG_SHORTCODES_MEDIA_POSTER_DESC'); ?>"><?php echo JText::_('YJSG_SHORTCODES_MEDIA_POSTER_LABEL'); ?></label>
                <input type="text" class="form-control" id="poster" name="poster" placeholder="<?php echo JText::_('YJSG_SHORTCODES_MEDIA_POSTER_HINT'); ?>" onClick="this.select()" />
            </div>
			 <div class="form-inline">
            <div class="form-group sizes">
                <label for="width" data-toggle="tooltip" data-placement="top" title="<?php echo JText::_('YJSG_SHORTCODES_MEDIA_WIDTH_DESC'); ?>"><?php echo JText::_('YJSG_SHORTCODES_MEDIA_WIDTH_LABEL'); ?></label>
                <input type="text" class="form-control" id="width" name="width" placeholder="<?php echo JText::_('YJSG_SHORTCODES_MEDIA_WIDTH_HINT'); ?>" onClick="this.select()" />
            </div>
            <div class="form-group sizes">
                <label for="height" data-toggle="tooltip" data-placement="top" title="<?php echo JText::_('YJSG_SHORTCODES_MEDIA_HEIGHT_DESC'); ?>"><?php echo JText::_('YJSG_SHORTCODES_MEDIA_HEIGHT_LABEL'); ?></label>
                <input type="text" class="form-control" id="height" name="height" placeholder="<?php echo JText::_('YJSG_SHORTCODES_MEDIA_HEIGHT_HINT'); ?>" onClick="this.select()" />
            </div>
            <div class="form-group">
                <label for="responsive" data-toggle="tooltip" data-placement="top" title="<?php echo JText::_('YJSG_SHORTCODES_MEDIA_RESPONSIVE_DESC'); ?>"><?php echo JText::_('YJSG_SHORTCODES_MEDIA_RESPONSIVE_LABEL'); ?></label>
                <select class="form-control" id="responsive" name="responsive">
                    <option value="yes" selected>Yes</option>
                    <option value="no">no</option>
                </select>
            </div>
			 </div><br/>
            <button type="submit" id="addshortcode" class="btn btn-primary"><?php echo JText::_('YJSG_SHORTCODES_MEDIA_BUTTON_SUBMIT'); ?></button>
        </form>
    </div>
</body>
</html>