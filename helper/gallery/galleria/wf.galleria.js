/* 
 *  A venture of Axcoto http://axcoto.com
 *  by Vincent Nguyen <info@axcoto.com>
 */
wfapp.fn.builder.galleria = function() {
    return (function ($) {
        optionForm = $('#wf_prep_form_galleria');
        var prep = [];
        
        //TEXT FIELDS
        var pros = ['width', 'height', 'autoplay', 'carouselSpeed', 'imageMargin', 'lightboxFadeSpeed', 'overlayOpacity', 'transitionSpeed'];
        //pros.prototype.
        for (var i=0; i<pros.length; i++) {
            p = pros[i];
            if (value = $('input[name=' + p + ']', optionForm).val()) {
                prep[p] = value;
            }   
        }
        
        //DROPDOWN
        if (value = $('select[name=easing] > option:selected', optionForm).val()) {
            prep['easing'] = value
        }
        
        if (value = $('select[name=imageCrop] > option:selected', optionForm).val()) {
            if (value=='true') {
                prep['imageCrop'] = true;
            } else {
                prep['imageCrop'] = value;
            }
        }
        
        //CHECKBOX
        if (value = $('select[name=transition] > option:selected', optionForm).val()) {
            prep['easing'] = value
        }
        
        if (value = $('input[name=imagePan]:checked', optionForm).length) {
            prep['imagePan'] = true
        }
        
        if (value = $('input[name=lightbox]:checked', optionForm).length) {
            prep['imagePan'] = true
        }
        
        if (value = $('input[name=showInfo]:checked', optionForm).length) {
            prep['showInfo'] = false
        }
        
        if (value = $('input[name=showCounter]:checked', optionForm).length) {
            prep['showCounter'] = false
        }
        
        if (value = $('input[name=showImagenav]:checked', optionForm).length) {
            prep['showImagenav'] = false
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

