angular.module('xiWebApp').directive('xiNavBar', ['$state', function($state) {
  return {
    restrict: 'E',
    scope: {
      user: '=?',
      viewOptions: '=?'
    },
    templateUrl: 'dist/partials/xi-nav-bar.html',
    controller: function($scope) {
      $scope.isNavigating = false;
    }
  }
}]);
