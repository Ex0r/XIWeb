angular.module('xiWebApp').directive('xiServerStatus', ['ServerService', function(ServerService) {
  return {
    restrict: 'E',
    scope: {},
    templateUrl: 'dist/partials/xi-server-status.html',
    controller: function($scope) {
      $scope.serverInfo = ServerService.getServerInfo();
    }
  }
}]);
