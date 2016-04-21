angular.module('xiWebApp').factory('optionService', ['xiWebService', function(XiWebService) {
  var service = {};
  
  // TODO: Needed?
  this.viewOptionValues = {
    HEADER: 'showHeader',
    AUCTION_HOUSE: 'showAuctionHouse',
    BEASTIARY: 'showBeastiary',
    ITEMS: 'showItems',
    JOBS: 'showJobs',
    SUPPORT: 'showSupport',
    MESSAGES: 'showMessages'
  }
  
  service.setOption = function(type, option, value) {
    if (!type) {
      alert('A type must be specified!');
      return;
    }
    
    switch(type) {
      case 0:   // View
        if (!option) {
          alert('An option must be specified to set a \'view\' option');
          return;
        }
        break;
      case 1:   // Language
        break;
      default:
        break;
    }
    
    XiWebService.setOption(type, option, value).then(function(status) {
      alert('Option successfully changed.');
    }, function(error) {
      alert('Unable to change option.');
    });
  }
}]);
