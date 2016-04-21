angular.module('xiWebApp').factory('xiWebService', ['$q', function($q) {
  var service = {};
  
  var user = {
    email: '',
    userName: 'anonymous',
    isAuth: false,
    messages: [
      { messageId: 1, senderId: 1, sender: "Other User", body: "This is the message body.", status: 0 },
      { messageId: 2, senderId: 1, sender: "Other User", body: "This is the second message body.", status: 1 },
      { messageId: 3, senderId: 1, sender: "Other User", body: "This is the third message body.", status: 1 }
    ],
    getNewMessageCount: function() {
      return _.filter(this.messages, function(message) {
        return message.status == 1;
      }).length;
    }
  }
  
  var options = {
    view: {
      showAuctionHouse: true,
      showBeastiary: true,
      showItems: true,
      showJobs: true,
      showSupport: true,
      showMessages: true
    },
    language: 'en_US'
  }
  
  var serverInfo = {
    ip: "127.0.0.1",
    status: 1
  }
  
  // Batch functions
  service.getData = function() {
      var deferred = $q.defer();
      
      var data = {
          user: user,
          options: options,
          serverInfo: serverInfo
      }
      
      deferred.resolve(data);
      
      return deferred.promise;
  };
  
  // User functions
  service.getUserData = function() {
    var deferred = $q.defer();
    
    deferred.resolve(user);
    
    return deferred.promise;
  };
  
  service.login = function(email, password) {
      var deferred = $q.defer();
      
      user.email = email;
      user.userName = 'User';
      user.isAuth = true;
      
      deferred.resolve(0);
      
      return deferred.promise;
  };
  
  service.forgotPassword = function(email) {
      var deferred = $q.defer();
      
      deferred.resolve(0);
      
      return deferred.promise;
  };
  
  service.registerAccount = function(userName, email, password) {
      var deferred = $q.defer();
      
      user.email = email;
      user.userName = userName;
      user.isAuth = true;
      
      deferred.resolve(0);
      
      return deferred.promise;
  };
  
  // Options functions
  service.getOptions = function() {
    var deferred = $q.defer();
    
    deferred.resolve(options);
    
    return deferred.promise;  
  };
  
  service.setOption = function(type, option, value) {
    var deferred = $.defer();
    
    switch(type) {
        case 0:     // View
          options[type][option] = value;
          break;
        case 1:     // Language
         options[type] = value;
          break;
    }
    
    deferred.resolve(0);
    
    return deferred.promise();
  };
  
  // Server Status functions
  service.getServerInfo = function() {
    var deferred = $q.defer();
    
    deferred.resolve(serverInfo);
    
    return deferred.promise;
  };
  
  return service;
}]);