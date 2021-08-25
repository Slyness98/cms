<footer class="footer">
 <div class="footer__logo-container">
       <img src="images/cclogo.png" class="footer__logo">
    </div>

    <div class="row footer__row">
        <div class="col-lg-6">
            <div class="footer__navigation">
                <ul class="footer__list">
                   <!--  <li class="footer__item"><a href="#" class="footer__link"><i class="fab fa-linkedin-in"></i></a></li>
                    <li class="footer__item"><a href="#" class="footer__link"><i class="fab fa-twitter"></i></a></li>
                    <li class="footer__item"><a href="#" class="footer__link"><i class="fab fa-github"></i></a></li> -->
                    <?php include "includes/shareBar.php"; ?>
                </ul>
            </div>
            
        </div><!-- ./col-lg-6 -->


        <div class="col-lg-6">
            <div class="footer__navigation__right">
                <ul class=" footer__list footer__list__right">
                  <li class="footer__item"><a href="#" class="footer__link">Privacy</a></li>
                  <li class="footer__item"><a href="#" class="footer__link">About</a></li>
                </ul>
            </div>
        </div> <!-- ./col-lg-2 -->
        
    </div>  <!-- /.row -->
</footer>

    </div> 
    <!-- /.container    this closes off container div in header file included sitewide. Do not delete. -->
    
    <script>document.addEventListener("touchstart", function(){}, true);</script>
    <!-- jQuery -->
    <script src="js/jquery.js"></script>


   
     <!-- Bootstrap Core JavaScript -->
    <script src="scss/vendors/bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
   
    <!-- Font Awesome Icons -->
    <script defer src="https://use.fontawesome.com/releases/v5.8.1/js/all.js" integrity="sha384-g5uSoOSBd7KkhAMlnQILrecXvzst9TdC09/VM+pjDTCM+1il8RHz5fKANTFFb+gQ" crossorigin="anonymous"></script>

    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/waypoints.js"> </script>
    <script src="js/validator.js"></script>
    <script src="js/owl.carousel.js"></script>
    <script src="js/lightbox.js"></script>
    <script src="js/custom.js">
   
    
    <!-- Dropdown functionality for bootstrap -->
   <!--  <script>
    $(document).ready(function () {
        $('.dropdown-toggle').dropdown();
    });
    </script>
 -->    
    <!-- Facebook API - Load Facebook SDK for JavaScript-->
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.async=true;
    js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));
</script>
  <!--   <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.3"></script> -->
    




    <script>window.twttr = (function(d, s, id) {
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
}(document, "script", "twitter-wjs"));</script>


</body>

</html>
