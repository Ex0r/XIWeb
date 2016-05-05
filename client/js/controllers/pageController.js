angular.module('xiWebApp').controller('PageController', ['$scope', '$state', '$timeout', 'locale', 'xiWebService', function($scope, $state, $timeout, locale, XiWebService) {
    var dataLoadTimerPromise = null;
    
    $scope.initialLoad = true;
    $scope.languageSet = false;
    
    $scope.loadPageData = function() {
      XiWebService.getData().then(function(data) {
        $scope.user = data.user;
        $scope.options = data.options;
        $scope.serverInfo = data.serverInfo;
        
        if ($scope.initialLoad) {
          $scope.initialLoad = false;
          locale.setLocale($scope.options.language);
          
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
    
    // $scope.$on('languageSet', function() {
    //   $scope.languageSet = true;
    // });
    
    load();
}]);
