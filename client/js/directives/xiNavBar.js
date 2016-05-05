angular.module('xiWebApp').directive('xiNavBar', [function() {
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
