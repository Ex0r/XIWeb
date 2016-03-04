angular.module('xiWebApp', ['ui.router']);

angular.module('xiWebApp').config(function($stateProvider, $urlRouterProvider) {
  $urlRouterProvider.otherwise('/');

  $stateProvider
    .state('index', {
      url: '/',
      templateUrl: 'dist/partials/index.html',
      controller: function($scope, user) {
        $scope.user = user;
        $scope.theme = 'default';
      },
      resolve: {
        user: function(UserService) { 
          return UserService.getUser();
        }
      }
    })
    .state('login', {
      url: '/login',
      templateUrl: 'dist/partials/login.html',
      controller: function($scope, user) {
        $scope.user = user;
        $scope.theme = 'default';
      },
      resolve: {
        user: function(UserService) { 
          return UserService.getUser();
        }
      }
    })
    .state('register', {
      url: '/register',
      templateUrl: 'dist/partials/register.html',
      controller: function($scope, user) {
        $scope.user = user;
        $scope.theme = 'default';
      },
      resolve: {
        emails: function(UserService) {
          return UserService.getUser();
        }
      }
    });
});