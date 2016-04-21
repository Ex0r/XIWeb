angular.module('xiWebApp').directive('xiServerStatus', [function() {
  return {
    restrict: 'E',
    scope: {
      serverInfo: '=?'
    },
    templateUrl: 'dist/partials/xi-server-status.html',
    controller: function($scope) {
    }
  }
}]);
