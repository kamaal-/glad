angular.module('glad')
  .controller('CollageShowCtrl', function($scope, $rootScope, $http, $log, CrfTokenService, $auth, Collage, Image) {
    var vm = this;
    vm.collage = $rootScope.showCollage;
    console.log(vm.collage)
  });
