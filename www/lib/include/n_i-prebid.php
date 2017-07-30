<script type="text/javascript" charset="utf-8">

var BID_TIMEOUT = 2000;
var initAdServerSet;

function initAdserver() {
  if (initAdServerSet) return;

  console.log("Init Adserver");
  console.log(ADTECH.config);
  (function() {      
    ADTECH.config.page = {
      protocol: 'http', 
      server: 'adserver.adtech.de', 
      network: '1502.1', 
      siteid: '670202', 
      params: { loc: '100' },
    };

    ADTECH.enqueueAd(6489219);
    ADTECH.executeQueue();

    })();
    initAdServerSet = true;
  }

setTimeout(initAdserver, BID_TIMEOUT);

(function () {
  var d = document;
  var pbs = d.createElement("script");
  pbs.type = "text/javascript";
  pbs.src = 'http://vlibs.advertising.com/prebid/adapters=smartadserver;/prebid-1.x.x.js';
  var target = d.getElementsByTagName("head")[0];
  target.insertBefore(pbs, target.firstChild);
})();


var adUnits = [{
  code: '6489219',
  sizes: [[728, 90]],
  bids: [{
    bidder: 'smartadserver',
    params: {
      domain: 'http://www8.smartadserver.com',
      siteId: '170999',
      pageId: '842325',
      formatId: '45846'      
    }
  }]
}];

var pbjs = pbjs || {};
pbjs.que = pbjs.que || [];

pbjs.que.push(function() {
  pbjs.addAdUnits(adUnits);
  pbjs.requestBids({
    timeout: 1000, // The primary timeout is set here
    bidsBackHandler: sendAdserverRequest
  });

});

/**
 * Handles each bid response that is returned.
 *
 * @param {Object} response The bid response object.
 * @param {Number} response.cpm The CPM of the bid.
 * @param {String} response.alias The alias of the bid.
 * @param {String} response.bidKey The key of the bid.
 * @param {String} response.mpAliasKey The key of the alias.
 * @param {String} response.adContainerId The id of the container associated with the bid in the DOM.
 */
function sendAdserverRequest(response) {

  console.log(response);
  var resp = response['6489219']['bids'][0];

  if (pbjs.adserverRequestSent) return;
  pbjs.adserverRequestSent = true;

  var slotName = resp.adUnitCode + '';

  var key = 'kvsmart';// + resp.bidderCode;

  //paramsObj['kv' + key] = resp.cpm + '';

  ADTECH.config.placements[slotName] = { 
    responsive : { 
      useresponsive: true, 
      bounds: [{id: 6489219, min: 0, max: 9999 }]}, 
      sizeid: '225', 
      params: { 
        alias: '', 
        target: '_blank',
        loc: '100',
        [key]: resp.cpm.toFixed(1) + ''
      }
  };
  //paramsObj['kv' + response.mpAliasKey] = response.alias;
  //ADTECH.config.placements[slotName] = {};
  ADTECH.config.placements[slotName].placement = resp.adUnitCode;

}
</script>

