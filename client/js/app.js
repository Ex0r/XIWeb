angular.module('xiWebApp', ['ui.router', 'ngLocalize']);

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

angular.module('xiWebApp').service('localeConf', ['xiWebService', function(XiWebService) {
  return {
    basePath: XiWebService.rootUrl + 'dist/locales',
    defaultLocale: 'en_US',
    sharedDictionary: 'common',
    fileExtension: '.json',
    persistSelection: false,
    observableAttrs: new RegExp('^data-(?!ng-|i18n)'),
    delimiter: '::'
  };
}]);

// Add other language codes here to support more languages
angular.module('xiWebApp').value('localeSupported', [
  'en_US',
  'Coverage'
]);

angular.module('xiWebApp').value('localeFallbacks', {
  'en': 'en_US',
  'cov': 'Coverage'
})

