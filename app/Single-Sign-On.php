<link rel="stylesheet" href="../templates/vendor/bootstrap/css/bootstrap.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
<link rel="stylesheet" href="../templates/vendor/bootstrap-social/bootstrap-social.css">


<?php
echo "Prashant";
?>

<div align="center" style="width: 360px;">
<input autofocus="" class="form-control input-lg" id="email" name="email" type="email" value="">
<input autocomplete="off" class="form-control" id="password" name="password" type="password" value="">

<button class="btn btn-primary">Create Account</button>

<a href="" class="btn btn-block btn-social btn-google"><i class="fa fa-google" aria-hidden="true"></i>Sign in with Google</a>

<a href="" class="btn btn-block btn-social btn-facebook"><i class="fa fa-facebook" aria-hidden="true"></i>Sign in with Facebook</a>

<a href="" class="btn btn-block btn-social btn-twitter"><i class="fa fa-twitter" aria-hidden="true"></i>Sign in with Twitter</a>

<a href="" class="btn btn-block btn-social btn-instagram"><i class="fa fa-instagram" aria-hidden="true"></i>Sign in with Instagram</a>

<a href="" class="btn btn-block btn-social btn-tumblr"><i class="fa fa-tumblr" aria-hidden="true"></i>Sign in with Tumblr</a>


</div>
<div
  class="fb-like"
  data-share="true"
  data-width="450"
  data-show-faces="true">
</div>

<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '713987942143126',
      xfbml      : true,
      version    : 'v2.10'
    });
    FB.AppEvents.logPageView();
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>