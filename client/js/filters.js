angular.module('xiWebApp').filter('serverStatus', function() {
  return function(input) {
    switch (input) {
      case 0:
        return "common.SERVER_STATUS_ONLINE";
      case 1:
      default:
        return "common.SERVER_STATUS_OFFLINE";
    }
  };
});
