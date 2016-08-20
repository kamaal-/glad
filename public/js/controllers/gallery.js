angular.module('glad')
  .controller('GalleryCtrl', function($scope, $rootScope, $location, $http, $log, CrfTokenService, $auth, Collage) {

    var vm = this;

    vm.crfToken = CrfTokenService;
    vm.collages = [];

    vm.loadCollages = function() {
      Collage.getAllCollage()
        .then(
          function(response) {
            vm.collages = response.data;
            console.log(vm.collages);
          }
        );
    };

    vm.gotoCollage = function(collage) {
      $rootScope.showCollage = collage;
      $location.path( '/collage/show' );
    }
    vm.loadCollages();
  });
