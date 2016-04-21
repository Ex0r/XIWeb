angular.module('xiWebApp').filter('serverStatus', function() {
  return function(input) {
    switch (input) {
      case 0:
        return "Online";
      case 1:
      default:
        return "Offline";
    }
  };
});
