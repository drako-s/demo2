
    navbar = $('.navbar-nav'),
    navbarHeight = 80,
    // All list items
    navbarItems = navbar.find('li > a');

$(document).ready(function(){

  //Smooth scrooling to anchor or redirect to link if anchor doesnt exists
  navbarItems.click(function(e){
    e.preventDefault();
    //hide dropdown menu
    $('#navbarScroll').removeClass('show');
    navbarItems.removeClass('active');
    $(this).addClass('active');
    var href = $(this).attr('href');    
    
    window.scrollTo({
      top: document.querySelector(href).offsetTop - navbarHeight,
      behavior: 'smooth',
      
    });
    
    
  });
});
    
    
