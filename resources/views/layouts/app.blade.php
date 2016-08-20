<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">

    <!-- Styles -->
    <link href="//cdn.jsdelivr.net/animatecss/3.2.0/animate.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/app.css" media="screen">

</head>
<body ng-app="glad">
  <div class="main main__shadow">
    <div ui-view style="height: calc(100% - 27px)"></div>

    <footer class="main--footer footer">
      <a class="footer--link footer--link__left" href="#">Privacy Policy</a>
      <a class="footer--link footer--link__right" href="#">Terms &amp; Conditions</a>
    </footer>
  </div>

    <!-- JavaScripts -->

    <!-- Third-party Libraries -->
    <script src="/js/vendor/angular.min.js"></script>

    <script src="/js/vendor/dropzone.js"></script>
    <script src="/js/vendor/angular-dropzone.js"></script>
    <script src="/js/vendor/angular-animate.min.js"></script>
    <script src="/js/vendor/angular-messages.min.js"></script>
    <script src="/js/vendor/angular-resource.min.js"></script>
    <script src="/js/vendor/angular-sanitize.min.js"></script>
    <script src="/js/vendor/angular-ui-router.min.js"></script>
    <script src="/js/vendor/angular-toastr.tpls.min.js"></script>
    <script src="/js/vendor/satellizer.min.js"></script>

    <!-- Application Code -->
    <script src="/js/app.js"></script>
    <script src="/js/directives/passwordStrength.js"></script>
    <script src="/js/directives/passwordMatch.js"></script>
    <script src="/js/controllers/home.js"></script>
    <script src="/js/controllers/collage.js"></script>
    <script src="/js/controllers/collage.show.js"></script>
    <script src="/js/controllers/login.js"></script>
    <script src="/js/controllers/signup.js"></script>
    <script src="/js/controllers/logout.js"></script>
    <script src="/js/controllers/profile.js"></script>
    <script src="/js/controllers/gallery.js"></script>
    <script src="/js/controllers/navbar.js"></script>
    <script src="/js/services/account.js"></script>
    <script src="/js/services/collage.js"></script>
    <script src="/js/services/image.js"></script>
    <script>
        angular.module("glad").constant("CSRF_TOKEN", '{{ csrf_token() }}');
    </script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
