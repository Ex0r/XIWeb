angular.module('xiWebApp').directive('navBar', function($state, UserService, ViewService) {
  return {
    restrict: 'E',
    scope: {},
    templateUrl: 'dist/partials/nav-bar.html',
    controller: function($scope) {
      $scope.isNavigating = false;
      
      $scope.user = UserService.getUser();
      $scope.viewOptions = ViewService.getViewOptions();
    }
  }
});
