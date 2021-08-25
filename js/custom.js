/*======= NAVBAR TRANSPARENT TO SOLID  =======*/

$(document).ready(function() {
  $(window).scroll(function() {
    if($(this).scrollTop() > 300) {
      $('.navbar').addClass('solid');
    }else {
      $('.navbar').removeClass('solid');
    }
  });
});

/*========== CLOSE MOBILE NAV ON CLICK ==========*/

$(document).ready(function () { //when document loads completely.
    $(document).click(function (event) { //click anywhere
        var clickover = $(event.target); //get the target element where you clicked
        var _opened = $(".navbar-collapse").hasClass("show"); //check if element with 'navbar-collapse' class has a class called show. Returns true and false.
        if (_opened === true && !clickover.hasClass("navbar-toggler")) { // if _opened is true and clickover(element we clicked) doesn't have 'navbar-toggler' class
            $(".navbar-toggler").click(); //toggle the navbar; close the navbar menu in mobile.
        }
    });
});


/*========= SMOOTH SCROLLING DOWN PAGE SECTIONS ==== */

  $(function() {
    $('a[href*="#"]:not([href="#"])').click(function() {

      //pathname replacement, while checking for matching hostname, explicitely allows scrolling to sections from an external page link rather than just internal
      if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
        var target = $(this.hash);
        target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
        if (target.length) {
          $('html, body').animate({
            scrollTop: target.offset().top
          }, 0);
          return false;
        }
      }
    });
});


/*========== BOUNCING DOWN ARROW ==========*/
$(document).ready(function(){
$(window).scroll(function(){ //browser scroll 
    $(".arrow").css("opacity", 1 - $(window).scrollTop() / 250); //set opacity css from 1 to -(negative) infinity of element with class 'arrow'
  //250 is fade pixels
  });
});


// //   Dropdown functionality for bootstrap 

$(document).ready(function() {
        $('.dropdown-toggle').dropdown();
    });

let mql = window.matchMedia("(max-width: 767px)");
if(mql.matches) {
    $("a[class='resources-link']").not("a[class='paginationLink']").click(function(event){
     event.preventDefault();
     event.stopImmediatePropagation();
    $(this).unbind('click').click();
    });
}



   
// function paginateArticles(){
//   location.hash = "paginationReload";
//   document.getElementById("paginationReload").innerHTML = location.hash;

//   $('a[href*="#"]')
//   // Remove links that don't actually link to anything
//   .not('a[href="#"]')
//   .not('[href="#0"]')
//   .not('[class="resources-link"]')
//   .click(function(event) {
//       $().ready(function() {
        //   $("#paginationReload").load("index.php?page={$i}#paginationReload");
//       });
//   });
// }
   
   
 function paginateArticles(newLocation)
{
window.location = newLocation;
return false;
} 
    //Twitter API For Basic Platform Integrated Functions, from https://developer.twitter.com/en/docs/twitter-for-websites/javascript-api/guides/set-up-twitter-for-websites 
    window.twttr = (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0],
        t = window.twttr || {};
      if (d.getElementById(id)) return t;
      js = d.createElement(s);
      js.id = id;
      js.src = "https://platform.twitter.com/widgets.js";
      fjs.parentNode.insertBefore(js, fjs);

      t._e = [];
      t.ready = function(f) {
        t._e.push(f);
      };

      return t;
    }(document, "script", "twitter-wjs"));


    // $(document).ready(function() {
    //     document.getElementById("widget").setAttribute("style", "display:block;");
    // });