/* 
 *  A venture of Axcoto http://axcoto.com
 *  by Vincent Nguyen <info@axcoto.com>
 */
wfapp.fn.builder.coin = function() {
    return (function ($) {
        optionForm = $('#wf_prep_form_coin');
        var prep = [];
        
        //TEXT FIELDS
        var pros = ['width', 'height', 'spw', 'sph', 'delay', 'sDelay', 'opacity', 'titleSpeed'];
        //pros.prototype.
        for (var i=0; i<pros.length; i++) {
            p = pros[i];
            if (value = $('input[name=' + p + ']', optionForm).val()) {
                prep[p] = value;
            }   
        }
        
        //DROPDOWN
        if (value = $('select[name=effect] > option:selected', optionForm).val()) {
            prep['effect'] = value
        }
                
        //CHECKBOX
        pros = ['navigation', 'links', 'hoverPause'];
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

