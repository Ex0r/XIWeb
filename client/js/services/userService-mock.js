angular.module('xiWebApp').service('UserService', ['$q', function($q) {
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
  
  this.getUser = function() {
    return user;
  }
    
  this.login = function(email, password) {
    if (!email || !password)
      return;
    
    user.isAuth = true;
    
    // Route to index
  }
  
  this.forgotPassword = function(email) {
    if (!email)
      return;
  }
  
  this.register = function(userName, email, password) {
    if (!userName || !email || !password)
      return;
    
    user.email = email;
    user.userName = userName;
    user.isAuth = true;
    
    // Route to index
  }
}]);
