jQuery(document).ready(function($){

/*==========================================
    Collapse or Uncollapse Left Menu
============================================*/
function collapsed_menu(){
    var collapseState = $('.hold-transition').data('menustate');
    var sendingData;

    $('.sidebar-toggle').on('click', function(){
        //alert(collapseState);
        if( collapseState == 'collapsed' ){
            sendingData = 0;
        }
        else if( collapseState == 'not-collapsed' ){
            sendingData = 1;
        }
          $.ajax({
                type: 'POST',
                url: 'inc/pages/pages_insert_info.php',
                data: { sendingData:sendingData },
                success: function(data){
                    console.log('Successfull');
                },
                error: function(data){
                    console.log('Error in sending request');
                }
           });
        });
}
    collapsed_menu();


/*==========================================
    Sidebar Menu - Add "active" Class
============================================*/
    var navbarUrl = window.location.pathname;
    var currentPage = navbarUrl.split('/')[3];

    $('.nav li a').removeClass('active');
    $('a[href="'+ currentPage +'"]').addClass('active');


/*==========================================
    Add Class "active" in Current Page
============================================*/
    var url         = window.location.pathname; 
    var cleanerUrl  = url.split("/");
    var urlWithPhp  = cleanerUrl[cleanerUrl.length-1];
        //alert(urlWithPhp);
    $('.nav li a').each(function() {
        var href        = $(this).attr('href');
        var cleanHref   = href.split("?");
        var hrefWithPhp = cleanHref[cleanHref.length-2];
        if( urlWithPhp == ''){
            hrefWithPhp = 'index.php';
            href = 'index.php';
            urlWithPhp = 'index.php';
            $(this).addClass('active');
        }
        if( urlWithPhp == hrefWithPhp || urlWithPhp == href ){
            $(this).addClass('active');
        }
    });



/*==========================================
    Sidebar Collapsed Menu - Show On Hover
============================================*/
    $('.sidebar-menu li a').hover(function(){
        $('.sidebar-menu li a').removeClass('show-indented-anchor');
        $(this).addClass('show-indented-anchor');
    });


/*==========================================
    Init Left Side Menu Options
============================================*/
    function init() {
        $.unilinkLM.pushMenu = {
            activate: function(element) {
                var screenSize = $.unilinkLM.options.screenSizes;
                $(element).on("click", function(element) {
                    $('.sidebar-menu').addClass('collapse-sidebar');
                    element.preventDefault(),
                    $(window).width() > screenSize.sm - 1 ? $("body").hasClass("sidebar-collapse") ? $("body").removeClass("sidebar-collapse").trigger("expanded.pushMenu") : $("body").addClass("sidebar-collapse").trigger("collapsed.pushMenu") : $("body").hasClass("sidebar-open") ? $("body").removeClass("sidebar-open").removeClass("sidebar-collapse").trigger("collapsed.pushMenu") : $("body").addClass("sidebar-open").trigger("expanded.pushMenu")
                }), 
                $(".content-wrapper").click(function() {
                    $(window).width() <= screenSize.sm - 1 && $("body").hasClass("sidebar-open") && $("body").removeClass("sidebar-open")
                }), 
                ($.unilinkLM.options.sidebarExpandOnHover || $("body").hasClass("fixed") && $("body").hasClass("sidebar-mini")) && this.expandOnHover()
            },
        }
    }

    $.unilinkLM = {}, 
    $.unilinkLM.options = {
        sidebarToggleSelector: "[data-toggle='offcanvas']",
        screenSizes: {
            xs: 480,
            sm: 768,
            md: 992,
            lg: 1200
        }
    }, $(function() {
        var element = $.unilinkLM.options;
        init(), 
       $.unilinkLM.pushMenu.activate(element.sidebarToggleSelector), element.enableBSToppltip && $("body").tooltip({
            selector: element.BSTooltipSelector
        })
    });

});