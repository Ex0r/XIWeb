angular.module('xiWebApp').controller('PageController', ['$scope', '$state', '$timeout', 'xiWebService', function($scope, $state, $timeout, XiWebService) {
    var dataLoadTimerPromise = null;
    
    $scope.initialLoad = true;
    
    $scope.loadPageData = function() {
      XiWebService.getData().then(function(data) {
        $scope.user = data.user;
        $scope.options = data.options;
        $scope.serverInfo = data.serverInfo;
        
        if ($scope.initialLoad) {
          $scope.initialLoad = false;
          if (!$scope.user.isAuth) {
            $state.go('login');
          } else {
            $state.go('index');
          }
        }
        
        dataLoadTimerPromise = $timeout($scope.loadPageData, 10000);
      }, function(error) {
        console.log('Failed to load data. Error:' + error);
      });
    }
    
    function load() {
      $timeout.cancel(dataLoadTimerPromise);
      $scope.loadPageData();
    }
    
    load();
}]);
