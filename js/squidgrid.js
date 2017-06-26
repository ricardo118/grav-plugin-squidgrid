/**
 * Created by Ricardo on 27/05/2017.
 */

$( document ).ready(function() {

    $('.sg-image').closest('.form-field.grid').removeClass('hidden');
    $('.sg-text').closest('.form-field.grid').addClass('hidden');
    $('.sg-extras').closest('.form-field.grid').addClass('hidden');

    var squidgrid = $("ul[data-collection-holder='header.squidgrid.grid']");
    var spacer = $(squidgrid).find('.form-spacer');
    $(spacer).css('cursor', 'pointer');

    $(spacer).click(function(){
        $('.sg-extras').closest('.form-field.grid').toggleClass('hidden');
    });

    $("input[type=radio]").click(function(){
        var textTypes = 'text';
        var imageTypes = 'image';
        var bothTypes = 'both';
        var currValue = $(this).attr('value');

        switch(currValue) {
            case textTypes:
                $('.sg-text').closest('.form-field.grid').removeClass('hidden');
                $('.sg-image').closest('.form-field.grid').addClass('hidden');
                break;
            case imageTypes:
                $('.sg-image').closest('.form-field.grid').removeClass('hidden');
                $('.sg-text').closest('.form-field.grid').addClass('hidden');
                break;
            case bothTypes:
                $('.sg-text').closest('.form-field.grid').removeClass('hidden');
                $('.sg-image').closest('.form-field.grid').removeClass('hidden');
                break;
            default:
                $('.sg-image').closest('.form-field.grid').removeClass('hidden');
                $('.sg-text').closest('.form-field.grid').addClass('hidden');
                break;
        }
    });
});