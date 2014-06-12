jQuery(document).ready(function($) {
    $.fn.keyDropDown = function() {           
        $('li', this).hover(function() {
            $('ul:first', this).stop().show();

        }, function() {
            $('ul:first', this).stop().hide();

        });

        $('li a', this).focus(function() {
            $(this).parent().parent().find('ul').hide();
            $(this).parent().find('ul:first').show();
        });   
    }
        
    if ($(document).width() > '760') {
        $('ul.dropdown').keyDropDown();  

    }

    $('ul.dropdown li').hover(function() {			
        $(this).addClass('hover');
        $('ul:first',this).css('display', 'block');
    }, function() {
        $(this).removeClass('hover');
        $('ul:first',this).css('display', 'none');
    });	

    $('.navmenu.bereichsmenu').prepend('<div class="menu-icon bereichsmenu"><span>Menu</span></div>');
    $('.menu-icon.bereichsmenu').click(function() {						
        $('.bereichsmenu ul.dropdown').slideToggle();
        $(this).toggleClass("active");	
    });	

    $('.navmenu.tecmenu').prepend('<div class="menu-icon tecmenu"><span>Menu</span></div>');
    $('.menu-icon.tecmenu').click(function() {						
        $('.tecmenu ul.dropdown').slideToggle();
        $(this).toggleClass("active");	
    });	

    var $toggleMenu = $('ul.dropdown .sub > a');
    $toggleMenu.click(function(e) {
        if ($(document).width() <= '760') {
            e.preventDefault();
        }
        var $this = $(this);
        $this.toggleClass('current').next('ul').toggleClass('current');
    });	

    $('table').wrap('<div class="overflow-x">');
    
    $('.jquery_tabs').accessibleTabs();
});
