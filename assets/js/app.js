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
        loaded : false,
        /**
         * Show form and switch to album selecting screen
         */
        showForm : function () {
            $('#wfalbum_option', wfapp.wrap).hide();
            $('#wfalbum_container', wfapp.wrap).show();
            !wfapp.loaded && wfapp.load();
        }, 
        
        /**
         * Load Album via Ajax
         */
        load : function () {
            $('#wfalbum_list', wfapp.wrap).html('Loading...');
            
            $.ajax({
                'url' : wfalbum.ajaxurl,
                data : {
                    'action' : 'wf_load_albums'
                },
                success: function (data) {
                    $('#wfalbum_list', wfapp.wrap).html(data);
                    wfapp.selectedAlbum();
                    wfapp.loaded = true;
                }
            })
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
            
            typeof(wfapp.fn.builder[prop.theme])!='undefined' && (pref = wfapp.fn.builder[prop.theme]()) && shortcode.push(pref);
                            
            shortcode =  ['[','wfalbum ', shortcode.join(" "), ']'].join('');
            var wdw = window.dialogArguments || opener || parent || top;
            wdw.send_to_editor(shortcode);

            console.log(shortcode);
            console.log(wfapp.fn.builder);
            console.log(wfapp.fn.builder.galleria());
        },
            
        init : function () {
            $('#media_wf_album').length && $('#media_wf_album').colorbox({  
                width:"80%", 
                inline:true, 
                height: '560px',
                href:"#wfalbum_form"
            });
            
            var $wrap = wfapp.wrap = $('.wfalbum_wrap', '#wfalbum_form');
            var $list = wfapp.list = $('#wfalbum_list', $wrap);
                
            $('.wf-next', $wrap).click(function () {
                //Choose a album first
                //???
                $('#wfalbum_container', $wrap).fadeOut('fast');
                $('#wfalbum_option', $wrap).fadeIn('fast');
            })
            
            $('#wf-inserter', $wrap).click(function () {
                wfapp.insert();
            });
            
            $('.wf-back', $wrap).click(function () {
                $('#wfalbum_option', $wrap).fadeOut('fast');
                $('#wfalbum_container', $wrap).fadeIn('fast');
            })
            
            $('#wf-plugin').change(function () {
                var theme = $('option:selected', this).val();
                $('.wf_option_panel', $wrap).hide();
                $('.wf_option_panel#wf_option_' + theme, $wrap).show();
            })
            
            $('#wf-clear-cache, #media_wf_album').click(function (e) {
                e.preventDefault();
                wfapp.showForm();
            })
            
        },
        
        selectedAlbum : function () {
            $('.wfalbum_item > a', wfapp.list).click(function (e) {
                e.preventDefault();
                $('.wfalbum_item', wfapp.list).removeClass('selected');
                $(this).parent().addClass('selected');
            })
          
        }
    }
    
    $(document).ready(function () {
        wfapp.init();
    })

})(jQuery)

window.wfapp.fn = {
    builder : {}
}