angular.module('xiWebApp').factory('userService', ['xiWebService', function(XiWebService) {
  var service = {};
  
  service.login = function(email, password) {
    if (!email || !password) {
      alert('Cannot leave email or password blank!');
      return;
    } 
    
    XiWebService.login(email, password).then(function(status) {
      alert('Login successful!');
    }, function(error) {
      alert('Login failed!');
    });
  }
  
  service.forgotPassword = function(email) {
    if (!email) {
      alert('Cannot leave email blank!');
      return;
    }
    
    XiWebService.forgotPassword(email).then(function(status) {
      alert('Password has been reset, check your email.');
    }, function(error) {
      alert('Unable to reset password')
    });
  }
  
  service.registerAccount = function(userName, email, password) {
    if (!userName || !email || !password) {
      alert('Cannot leave user name, email or password blank!');
      return;
    }
    
    XiWebService.registerAccount(userName, email, password).then(function(status) {
      alert('Account registered successfully!');
    }, function(error) {
      alert('Unable to create account');
    });
  }
  
  return service;
}]);
