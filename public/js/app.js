angular.module('glad', ['ngResource', 'ngMessages', 'ngAnimate', 'toastr', 'ui.router', 'satellizer', 'ngDropzone'])
  .config(function($stateProvider, $urlRouterProvider, $authProvider) {
    $authProvider.unlinkUrl = '/auth/unlink';
    /**
     * Helper auth functions
     */
    var skipIfLoggedIn = function($q, $auth) {
      var deferred = $q.defer();
      if ($auth.isAuthenticated()) {
        deferred.reject();
      } else {
        deferred.resolve();
      }
      return deferred.promise;
    };

    var loginRequired = function($q, $location, $auth) {
      var deferred = $q.defer();
      if ($auth.isAuthenticated()) {
        deferred.resolve();
      } else {
        $location.path('/login');
      }
      return deferred.promise;
    };

    /**
     * App routes
     */
    $stateProvider
      .state('home', {
        url: '/',
        controller: 'HomeCtrl as vm',
        templateUrl: 'js/partials/home.html'
      })
      .state('collage', {
        url: '/collage',
        controller: 'CollageCtrl as vm',
        templateUrl: 'js/partials/collage.html',
        resolve: {
          loginRequired: loginRequired
        }
      })
      .state('show', {
        url: '/collage/show',
        controller: 'CollageShowCtrl as vm',
        templateUrl: 'js/partials/collage.show.html',
        resolve: {
          loginRequired: loginRequired
        }
      })
      .state('gallery', {
        url: '/gallery',
        controller: 'GalleryCtrl as vm',
        templateUrl: 'js/partials/gallery.html',
        resolve: {
          loginRequired: loginRequired
        }
      })
      .state('login', {
        url: '/login',
        templateUrl: 'js/partials/login.html',
        controller: 'LoginCtrl',
        resolve: {
          skipIfLoggedIn: skipIfLoggedIn
        }
      })
      .state('signup', {
        url: '/signup',
        templateUrl: 'partials/signup.html',
        controller: 'SignupCtrl',
        resolve: {
          skipIfLoggedIn: skipIfLoggedIn
        }
      })
      .state('logout', {
        url: '/logout',
        template: null,
        controller: 'LogoutCtrl'
      })
      .state('profile', {
        url: '/profile',
        templateUrl: 'js/partials/profile.html',
        controller: 'ProfileCtrl',
        resolve: {
          loginRequired: loginRequired
        }
      });
    $urlRouterProvider.otherwise('/');

    /**
     *  Satellizer config
     */
    $authProvider.facebook({
      clientId: '284244001948863'
    });

    $authProvider.oauth2({
      name: 'foursquare',
      url: '/auth/foursquare',
      clientId: 'MTCEJ3NGW2PNNB31WOSBFDSAD4MTHYVAZ1UKIULXZ2CVFC2K',
      redirectUri: window.location.origin || window.location.protocol + '//' + window.location.host,
      authorizationEndpoint: 'https://foursquare.com/oauth2/authenticate'
    });
  })

  .factory("CrfTokenService", function($http, CSRF_TOKEN) {
    return {
      token: CSRF_TOKEN
    };
  });
