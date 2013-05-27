jQuery(document).ready(function($)
{
    $.fn.keyDropDown = function()
    {           
        $('li',this).hover(function(){
            $('ul:first',this).stop().show();

        }, function(){
            $('ul:first',this).stop().hide();

        });

        $('li a',this).focus(function(){
            $(this).parent().parent().find('ul').hide();
            $(this).parent().find('ul:first').show();
        });   
    }
    
    $(window).resize(function()
    {
        if ($(document).width() > '760')
        {
            $('.rrze-hlist').find('ul ul').hide();
            
            $('.rrze-hlist').keyDropDown();
        }
        else
        {
            $('.rrze-hlist').find('ul ul').show();
            
            $('.rrze-hlist li').hover(function()
            {
                $('ul:first',this).stop().show();

            }, function(){
                $('ul:first',this).stop().show();

            });

            $('.rrze-hlist li a').focus(function()
            {
                $(this).parent().parent().find('ul').show();
                $(this).parent().find('ul:first').show();
            });   
            
        }

    });
    
    if ($(document).width() > '760')
    {
        $('.rrze-hlist').keyDropDown();  

    }

});
