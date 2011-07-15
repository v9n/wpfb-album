String.prototype.replaceAll = function(
    strTarget, // The substring you want to replace
    strSubString // The string you want to replace in.
    ){
    var strText = this;
    var intIndexOfMatch = strText.indexOf( strTarget );
 
    // Keep looping while an instance of the target string
    // still exists in the string.
    while (intIndexOfMatch != -1){
        // Relace out the current instance.
        strText = strText.replace( strTarget, strSubString )
 
        // Get the index of any next matching substring.
        intIndexOfMatch = strText.indexOf( strTarget );
    }
 
    // Return the updated string with ALL the target strings
    // replaced out with the new substring.
    return( strText );
}

window.wfapp = {};
(function ($) {
    window.wfapp = {
        wrap : null, 
        list : null,
        /**
         * Load Album via Ajax
         */
        load : function () {
            
        },
        
        /**
         * Generate shortcode to send to editor
         */
        genShortCode : function () {
            var shortcode = [];
            for (x in wfalbum) {            
                var pro = [
                x, '="', wfalbum[x], '"'  
                ];
                shortcode.push(pro.join('')); 
            }
            return '[' + shortcode.join(" ") + ']';        
        },
    
        insert : function () {
            var shortcode = [];
            var prop = {};
            prop.id = $('.wfalbum_item.selected', wfapp.list).attr('rel');
            prop.theme = $('#wf-plugin > option:selected', wfapp.wrap).val();
            
            for (x in prop) {
                var pro = [
                x, '="', prop[x], '"'  
                ];
                shortcode.push(pro.join('')); 
            }
            
            typeof(wfapp.fn.builder[prop.theme]!='undefined') && (pref = wfapp.fn.builder[prop.theme]()) && shortcode.push(pref);
                            
            shortcode =  ['[','wfalbum', shortcode.join(" "), ']'].join('');
            var wdw = window.dialogArguments || opener || parent || top;
            wdw.send_to_editor(shortcode);

            console.log(shortcode);
            console.log(wfapp.fn.builder);
            console.log(wfapp.fn.builder.galleria());
        },
            
        move : function () {
                
        },
            
        init : function () {
            
            var $wrap = wfapp.wrap = $('.wfalbum_wrap', '#wfalbum_form');
            var $list = wfapp.list = $('#wfalbum_list', $wrap);
            
            $('.wfalbum_item', $list).click(function () {
                $('.wfalbum_item', $list).removeClass('selected');
                $(this).addClass('selected');
            })
            
            $('#wf-inserter', $wrap).click(function () {
                wfapp.insert();
            });
            
            $('.wf-next', $wrap).click(function () {
                $('#wfalbum_container', $wrap).fadeOut('fast');
                $('#wfalbum_option', $wrap).fadeIn('fast');
            })
            $('.wf-back', $wrap).click(function () {
                $('#wfalbum_option', $wrap).fadeOut('fast');
                $('#wfalbum_container', $wrap).fadeIn('fast');
            })
            
            $('#wf-plugin').change(function () {
                var theme = $('option:selected', this).val();
                $('.wf_option_panel', $wrap).hide();
                $('.wf_option_panel#wf_option_' + theme, $wrap).show();
            })
        }
    }
    
    $(document).ready(function () {
        wfapp.init();
        $('#wfalbum_list').imagesLoaded(function () {
            $('#wfalbum_list').masonry({
                // options
                itemSelector : '.wfalbum_item'
            });
        //$('#wfalbum_form').hide();
        })
        
    })

})(jQuery)

window.wfapp.fn = {
    builder : {}
}