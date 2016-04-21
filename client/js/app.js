angular.module('xiWebApp', ['ui.router']);

angular.module('xiWebApp').config(function($stateProvider, $urlRouterProvider) {
  $urlRouterProvider.otherwise('/');

  $stateProvider
    .state('index', {
      url: '/',
      templateUrl: 'dist/partials/index.html',
      controller: 'PageController'
    })
    .state('login', {
      url: '/login',
      templateUrl: 'dist/partials/login.html',
      controller: 'PageController'
    })
    .state('register', {
      url: '/register',
      templateUrl: 'dist/partials/register.html',
      controller: 'PageController'
    });
});
