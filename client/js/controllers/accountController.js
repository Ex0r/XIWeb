angular.module('xiWebApp').controller('AccountController', ['$scope', '$state', 'userService', function($scope, $state, UserService) {
  $scope.login = function(user) {
    if (!user.email || !user.password)
      return;
      
    UserService.login(user.email, user.password);
  }
}]);