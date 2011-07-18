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
        showForm : function (force) {
            $('#wfalbum_option', wfapp.wrap).hide();
            $('#wfalbum_container', wfapp.wrap).show();
            if (typeof(force)=='undefined') {
                !wfapp.loaded && wfapp.load();
            } else {
                wfapp.load(force);
            }
            
        }, 
        
        /**
         * Only case we call this is on Auth form! At that time, 2 tasks have done!
         * 1.open Facebook app for authorizing!
         * 2.Close/Hide colorbox form
         * After authorized, user closes facebook, back to WP page, and show the form again!
         * But because the form is loaded before, so wfapp will not load this form again, - The reason for this is to speed up plugin, not need to reload data everytime form shows up-
         * & still show auth form which loaded before!
         * So, we set wfapp.loaded to false to force wfapp reload data via AJAX instead of just showing form
         * 
         */
        close : function () {
            wfapp.loaded = false;
            $.colorbox.close();
        },
        
        /**
         * Load Album via Ajax
         * @augments boolean true or false to force clean cache and get fresh data
         */
        load : function (force) {
            $('#wfalbum_list', wfapp.wrap).html(["<img alt='Loading...' src='", wfalbum.pluginUrl, 'assets/images/spin.gif', '\' />'].join(''));
            
            $.ajax({
                'url' : wfalbum.ajaxurl,
                data : {
                    'action' : 'wf_load_albums',
                    'force' : force==undefined? 0:1
                },
                success: function (data) {
                    $('#wfalbum_list', wfapp.wrap).html(data);
                    wfapp.selectedAlbum();
                    wfapp.loaded = true;
                }
            })
        },
        
        /**
         * Gen& Insert shortcode
         */
        insert : function () {
            var shortcode = [];
            var prop = {};
            prop.id = $('.wfalbum_item.selected', wfapp.list).attr('rel');
            prop.theme = $('#wf-plugin > option:selected', wfapp.wrap).val();
            
            if (!prop.theme || prop.theme==0 || prop.theme=='0') {
                alert('Please choose a display type first');
                return false;
            }
            
            typeof(wfapp.fn.builder[prop.theme])!='undefined' && (pref = wfapp.fn.builder[prop.theme]()) && (prop.pref = pref);

            for (x in prop) {
                var pro = [
                x, '="', prop[x], '"'  
                ];
                shortcode.push(pro.join('')); 
            }
                                        
            shortcode =  ['[','wfalbum ', shortcode.join(" "), ']'].join('');
            var wdw = window.dialogArguments || opener || parent || top;
            wdw.send_to_editor(shortcode);
            $.colorbox.close();
        },
            
        init : function () {
            $('#media_wf_album').length && $('#media_wf_album').colorbox({  
                width:"900px", 
                inline:true, 
                height: '560px',
                href:"#wfalbum_form",
                onLoad: window['wfapp']['showForm']
            })
            
            var $wrap = wfapp.wrap = $('.wfalbum_wrap', '#wfalbum_form');
            var $list = wfapp.list = $('#wfalbum_list', $wrap);
                
            $('.wf-next', $wrap).click(function (e) {
                e.preventDefault();
                //Choose a album first
                if ($('.wfalbum_item.selected', $list).length==0) {
                    alert('You need to select an album first')
                    return false;
                }
                $('#wfalbum_container', $wrap).fadeOut('fast');
                $('#wfalbum_option', $wrap).fadeIn('fast');
            })
            
            $('#wf-inserter', $wrap).click(function (e) {
                e.preventDefault();
                wfapp.insert();
            });
            
            $('.wf-back', $wrap).click(function (e) {
                e.preventDefault();
                $('#wfalbum_option', $wrap).fadeOut('fast');
                $('#wfalbum_container', $wrap).fadeIn('fast');
            })
            
            $('#wf-plugin').change(function () {
                var theme = $('option:selected', this).val();
                $('.wf_option_panel', $wrap).hide();
                $('.wf_option_panel#wf_option_' + theme, $wrap).show();
            })
            
            $('#wf-clear-cache').click(function (e) {
                e.preventDefault();
                wfapp.showForm(1);
            })
            
            
        },
        
        selectedAlbum : function () {
            $('.wfalbum_item > a, .wfalbum_item > span', wfapp.list).click(function (e) {
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