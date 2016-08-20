angular.module('glad')
  .controller('CollageCtrl', function($scope, $http, $log, CrfTokenService, $auth, Collage, Image) {

    var vm = this;

    vm.createCollage = function() {
      Collage.getCollage()
        .then(function(response) {
          vm.collage = response.data;
          console.log(vm.collage);
        })
        .catch(function(response) {
          toastr.error(response.data.message, response.status);
        });
    };

    self.collage = {
      name : 'My Collage'
    };
    vm.crfToken = CrfTokenService;

    vm.dzAddedFile = function( file ) {
      $log.log( file );
    };

    vm.dzError = function( file, errorMessage ) {
      $log.log(errorMessage);
    };

    vm.publish = function() {
      Collage.updateCollage(vm.collage)
        .then(function(response) {
          console.log(vm.collage);
        })
        .catch(function(response) {
          toastr.error(response.data.message, response.status);
        });
    };

    vm.removeFile = function( file ) {
      $log.log(file);
      var data = {
        id: file.name
      }
      Image.remove(data)
        .then(
          function(response) {
            if(response.data.error === false){
              file.previewTemplate.remove();
            }
          }
        )
        .catch(
          function(error) {
            console.log(error);
          }
        )
    };

    vm.dropzoneConfig = {
      url: 'api/image/upload',
      parallelUploads: 100,
      maxFilesize: 8,
      addRemoveLinks: true,
      dictRemoveFile: 'Remove',
      removedfile: vm.removeFile,
      dictFileTooBig: 'Image is bigger than 8MB',
      headers: {
        'Authorization': 'Bearer ' + $auth.getToken() // auth check
      }
    };
    vm.createCollage();
  });
