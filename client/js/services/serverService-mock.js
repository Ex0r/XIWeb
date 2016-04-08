angular.module('xiWebApp').service('ServerService', ['$q', function($q) {
  var serverInfo = {
    ip: "127.0.0.1",
    status: 1
  }
  
  this.getServerInfo = function() {
    return serverInfo;
  }
}]);
