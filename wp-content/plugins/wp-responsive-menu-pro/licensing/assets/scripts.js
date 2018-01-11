jQuery(function($){
    //Activate license key
    $('#mg-license').submit(function(e){
        e.preventDefault();
        var license = $('#mg-license-key').val();
        if(license!=''){
            $('.mg-loading').show();
            var data = $('#mg-license').serializeArray();
            $.post(ajaxurl, data, function(response){
                response = JSON.parse(response);
                $('.mg-msg').remove();
                $('div.mg-wrap>.mg-content')
                .before('<div class="mg-msg '+response.status+'"> <p>'+response.message+'</p> </div>');
                if( response.status !== 'error' ){
                    $('.mg-box').addClass('valid');
                    $('.mg-box-status.mg-box-status-locked').removeClass('mg-box-status-locked');
                    href = $('.mg-box-status svg use').attr('xlink:href').replace('locked','unlocked');
                    $('.mg-box-status svg use').attr('xlink:href', href);
                }
                $('.mg-loading').hide();
            });
        }
    });
    //Deactivate license key
    $('#mg-deactivate-license').submit(function(e){
        e.preventDefault();
        $('.mg-loading').show();
        var data = $('#mg-deactivate-license').serializeArray();
        $.post(ajaxurl, data, function(response){
            response = JSON.parse(response);
            $('.mg-msg').remove();
            $('div.mg-wrap>.mg-content')
            .before('<div class="mg-msg '+response.status+'"> <p>'+response.message+'</p> </div>');
            if( response.status !== 'error' ){
                $('.mg-box').removeClass('valid');
                $('.mg-box-status').addClass('mg-box-status-locked');
                href = $('.mg-box-status svg use').attr('xlink:href').replace('unlocked','locked');
                $('.mg-box-status svg use').attr('xlink:href', href);
            }           
            $('.mg-loading').hide();
        });
    });
});