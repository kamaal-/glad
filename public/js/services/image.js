angular.module('glad')
  .factory('Image', function($http) {
    return {
      remove: function(imageData) {
        return $http.post('/api/image/delete', imageData);
      },
      getFirst: function(collage) {
        return $http.get('/api/image', collage);
      }
    };
  });
