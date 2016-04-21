angular.module('xiWebApp').controller('PageController', ['$scope', '$state', 'xiWebService', function($scope, $state, XiWebService) {
    $scope.loadPageData = function() {
      XiWebService.getData().then(function(data) {
        $scope.user = data.user;
        $scope.options = data.options;
        $scope.serverInfo = data.serverInfo;
        
        if (!$scope.user.isAuth) {
          $state.go('login');
        } else {
          $state.go('index');
        }
      }, function(error) {
        alert('Failed to load data.');
      });
    }
    
    function load() {
      $scope.loadPageData();
    }
    
    load();
}]);
