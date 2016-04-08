angular.module('xiWebApp').directive('xiNavBar', ['$state', 'UserService', 'ViewService', function($state, UserService, ViewService) {
  return {
    restrict: 'E',
    scope: {},
    templateUrl: 'dist/partials/xi-nav-bar.html',
    controller: function($scope) {
      $scope.isNavigating = false;
      
      $scope.user = UserService.getUser();
      $scope.viewOptions = ViewService.getViewOptions();
    }
  }
}]);
