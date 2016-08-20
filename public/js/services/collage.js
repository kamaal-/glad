angular.module('glad')
  .factory('Collage', function($http) {
    return {
      getAllCollage: function() {
        return $http.get('/api/collage/list');
      },
      saveCollage: function(collageData) {
        return $http.post('/api/collage', collageData);
      },
      getCollage: function() {
        return $http.get('/api/collage');
      },
      updateCollage: function(collageData) {
        return $http.put('/api/collage', collageData);
      }
    };
  });
