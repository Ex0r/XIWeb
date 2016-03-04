angular.module('xiWebApp').service('ViewService', function($q) {
  var viewOptions = {
    showHeader: true,
    showAuctionHouse: true,
    showBeastiary: true,
    showItems: true,
    showSupport: true,
    showMessages: true
  }
  
  this.getViewOptions = function() {
    return viewOptions;
  }
});
