/* 
 *  A venture of Axcoto http://axcoto.com
 *  by Vincent Nguyen <info@axcoto.com>
 */
wfapp.fn.builder.galleria = function() {
    return (function () {
        var prep = $('#wf_prep_form_galleria').serialize();
        return prep.replaceAll('&', ' ');
    })(jQuery)
}

