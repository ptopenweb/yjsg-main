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
			var tabtype 	= $('select[name=tabtype]').val();
            var tabid 		= $('input[name=tabid]').val();
			var tabs 		= $('input[name=tabs]').val();
			var activetab 	= $('input[name=activetab]').val();
			
			
			if(tabid ==''){
				tabid ='myid';
			}
			
		  
		 var addtabs ="<br/>\n";
		 	 addtabs +='[yjsgstabs ';
			 addtabs +='id="' + tabid + '" ';
			 addtabs +='type="' + tabtype + '"]';
			 addtabs +="<br/>\n";

				for ( var i = 0; i < tabs ; i++ ) {
					
					var activetablink= 0;
					
					if(i == activetab){
						
						activetablink= 1;
						
					}
					
					addtabs +='[yjsgstabsgroup title="<?php echo JText::_('YJSG_SHORTCODES_TABS_JS_TITLE'); ?>" active="'+activetablink+'"]<?php echo JText::_('YJSG_SHORTCODES_TABS_JS_DESC'); ?>[/yjsgstabsgroup]';
					addtabs +="<br/>\n";
				}


			 addtabs +='[/yjsgstabs]';
			 addtabs +="<br/>\n";

			var findEditor = $("#editor-xtd-buttons", parent.document.body).parent().find('textarea').attr('id');
			
			if( findEditor !='undefined' ){
				window.parent.jInsertEditorText(addtabs, findEditor);
			}
			
        });

    });
}(jQuery));
</script>
</head>
<body>
    <div class="container">
        <h2><?php echo JText::_('YJSG_SHORTCODES_TABS_TITLE'); ?></h2>
        <form role="form">
            <div class="form-group">
                <label for="tabtype" for="title" data-toggle="tooltip" data-placement="top" title="<?php echo JText::_('YJSG_SHORTCODES_TABS_TABTYPE_DESC'); ?>"><?php echo JText::_('YJSG_SHORTCODES_TABS_TABTYPE_LABEL'); ?></label>
                <select class="form-control" id="tabtype" name="tabtype">
                    <option value="tabnav" selected><?php echo JText::_('YJSG_SHORTCODES_TABS_TABTYPE_OPTION_NAV'); ?></option>
                    <option value="tabpills"><?php echo JText::_('YJSG_SHORTCODES_TABS_TABTYPE_OPTION_PILLS'); ?></option>
					<option value="tabsleft"><?php echo JText::_('YJSG_SHORTCODES_TABS_TABTYPE_OPTION_LEFT'); ?></option>
					<option value="tabsright"><?php echo JText::_('YJSG_SHORTCODES_TABS_TABTYPE_OPTION_RIGHT'); ?></option>
					<option value="tabscentered"><?php echo JText::_('YJSG_SHORTCODES_TABS_TABTYPE_OPTION_CENTERED'); ?></option>
                </select>
            </div>
            <div class="form-group">
                <label for="tabid" for="title" data-toggle="tooltip" data-placement="top" title="<?php echo JText::_('YJSG_SHORTCODES_TABS_TABID_DESC'); ?>"><?php echo JText::_('YJSG_SHORTCODES_TABS_TABID_LABEL'); ?></label>
                <input type="text" class="form-control" id="tabid" name="tabid" placeholder="<?php echo JText::_('YJSG_SHORTCODES_TABS_TABID_HINT'); ?>" onClick="this.select()" />
            </div>
            <div class="form-group poster">
                <label for="tabs" for="title" data-toggle="tooltip" data-placement="top" title="<?php echo JText::_('YJSG_SHORTCODES_TABS_TABS_DESC'); ?>"><?php echo JText::_('YJSG_SHORTCODES_TABS_TABS_LABEL'); ?></label>
                <input type="text" class="form-control" id="tabs" name="tabs" value="3" onClick="this.select()"/>
            </div>
            <div class="form-group">
                <label for="activetab" data-toggle="tooltip" data-placement="top" title="<?php echo JText::_('YJSG_SHORTCODES_TABS_ACTIVETAB_DESC'); ?>"><?php echo JText::_('YJSG_SHORTCODES_TABS_ACTIVETAB_LABEL'); ?></label>
                <input type="text" class="form-control" id="activetab" name="activetab" value="0" onClick="this.select()" />
            </div>
            <button type="submit" id="addshortcode" class="btn btn-primary"><?php echo JText::_('YJSG_SHORTCODES_TABS_BUTTON_SUBMIT'); ?></button>
        </form>
    </div>
</body>
</html>