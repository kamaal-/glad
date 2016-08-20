angular.module('glad')
  .controller('HomeCtrl', function($scope, $http, $log, CrfTokenService, $auth) {

    var vm = this;

    vm.crfToken = CrfTokenService;

    vm.isAuthenticated = function() {
      return $auth.isAuthenticated();
    }


  });
