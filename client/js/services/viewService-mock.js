angular.module('xiWebApp').service('ViewService', ['$q', function($q) {
  var viewOptions = {
    showHeader: true,
    showAuctionHouse: true,
    showBeastiary: true,
    showItems: true,
    showJobs: true,
    showSupport: true,
    showMessages: true
  }
  
  this.getViewOptions = function() {
    return viewOptions;
  }
}]);
