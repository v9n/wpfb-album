/* 
 *  A venture of Axcoto http://axcoto.com
 *  by Vincent Nguyen <info@axcoto.com>
 */
wfapp.fn.builder.nivo = function() {
    return (function ($) {
        optionForm = $('#wf_prep_form_nivo');
        var prep = [];
        
        //TEXT FIELDS
        var pros = ['width', 'height', 'slice', 'boxCols', 'boxRows', 'animSpeed', 'pauseTime', 'captionOpacity', 'prevText', 'nextText'];
        //pros.prototype.
        for (var i=0; i<pros.length; i++) {
            p = pros[i];
            if (value = $('input[name=' + p + ']', optionForm).val()) {
                prep[p] = value;
            }   
        }
        
        //DROPDOWN
        if (value = $('select[name=theme] > option:selected', optionForm).val()) {
            prep['theme'] = value
        }
        
        if (value = $('select[name=effect] > option:selected', optionForm).val()) {
            prep['effect'] = value;
        }
        
        //CHECKBOX
        pros = ['directionNav', 'directionNavHide', 'controlNav', 'controlNavThumbs', 'keyboardNav', 'pauseOnHover', 'manualAdvance'];
        //pros.prototype.
        for (var i=0; i<pros.length; i++) {
            p = pros[i];    
            if (value = $('input[name=' + p + ']:checked', optionForm).val()) {
                if (value==1 || value=='true') {
                    prep[p] = 'true';
                } else {
                    prep[p] = 'false';
                }
            }
        }
        
        shortcode = [];
        for (x in prep) {
            var pro = [
            x, '=', prep[x], ''  
            ];
            shortcode.push(pro.join('')); 
        }
            
        return shortcode.join(' ');
        
    })(jQuery)
}

