<?php
include 'framework.php';
?>
<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="<?php echo $base_link.'plugins/system/yjsg/assets/'; ?>bootstrap3/css/bootstrap.min.css" />
<script type="text/javascript" src="<?php echo $base_link.'plugins/system/yjsg/assets/'; ?>src/libraries/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $base_link.'plugins/system/yjsg/assets/'; ?>bootstrap3/js/bootstrap.min.js"></script>
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
            var accid 		= $('input[name=accid]').val();
			var groups 		= $('input[name=groups]').val();
			var activetab 	= $('input[name=activetab]').val();
			
			
			if(accid ==''){
				accid ='myid';
			}
			
		  
		 var accordions ="<br/>\n";
		 	 accordions +='[yjsgacs ';
			 accordions +='id="' + accid + '"]';
			 accordions +="<br/>\n";

				for ( var i = 0; i < groups ; i++ ) {
					
					var activeacc= 0;
					
					if(i == activetab){
						
						activeacc= 1;
						
					}
					
					accordions +='[yjsgacgroup title="<?php echo JText::_('YJSG_SHORTCODES_ACCORDIONS_JS_TITLE'); ?>" active="'+activeacc+'"]<?php echo JText::_('YJSG_SHORTCODES_ACCORDIONS_JS_DESC'); ?>[/yjsgacgroup]';
					accordions +="<br/>\n";
				}


			 accordions +='[/yjsgacs]';
			 accordions +="<br/>\n";

			var findEditor = $("#editor-xtd-buttons", parent.document.body).parent().find('textarea').attr('id');
			
			if( findEditor !='undefined' ){
				window.parent.jInsertEditorText(accordions, findEditor);
			}
			
        });

    });
}(jQuery));
</script>
</head>
<body>
    <div class="container">
        <h2><?php echo JText::_('YJSG_SHORTCODES_ACCORDIONS_TITLE'); ?></h2>
        <form role="form">
            <div class="form-group">
                <label for="accid" data-toggle="tooltip" data-placement="top" title="<?php echo JText::_('YJSG_SHORTCODES_ACCORDIONS_ACCID_DESC'); ?>"><?php echo JText::_('YJSG_SHORTCODES_ACCORDIONS_ACCID_LABEL'); ?></label>
                <input type="text" class="form-control" id="accid" name="accid" placeholder="<?php echo JText::_('YJSG_SHORTCODES_ACCORDIONS_ACCID_HINT'); ?>" onClick="this.select()" />
            </div>
            <div class="form-group poster">
                <label for="groups" data-toggle="tooltip" data-placement="top" title="<?php echo JText::_('YJSG_SHORTCODES_ACCORDIONS_GROUPS_DESC'); ?>"><?php echo JText::_('YJSG_SHORTCODES_ACCORDIONS_GROUPS_LABEL'); ?></label>
                <input type="text" class="form-control" id="groups" name="groups" value="3" onClick="this.select()"/>
            </div>
            <div class="form-group">
                <label for="activetab" data-toggle="tooltip" data-placement="top" title="<?php echo JText::_('YJSG_SHORTCODES_ACCORDIONS_ACTIVETAB_DESC'); ?>"><?php echo JText::_('YJSG_SHORTCODES_ACCORDIONS_ACTIVETAB_LABEL'); ?></label>
                <input type="text" class="form-control" id="activetab" name="activetab" value="0" onClick="this.select()" />
            </div>
            <button type="submit" id="addshortcode" class="btn btn-primary"><?php echo JText::_('YJSG_SHORTCODES_ACCORDIONS_BUTTON_SUBMIT'); ?></button>
        </form>
    </div>
</body>
</html>