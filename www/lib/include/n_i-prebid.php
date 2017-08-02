<script type="text/javascript" charset="utf-8">

var BID_TIMEOUT = 1000;
var initAdServerSet;

function lookupByToken(array, token) {
  var lookup = [];
  for (var i = 0, len = array.length; i < len; i++) {
      lookup[array[i][token]] = array[i];
  }
  return lookup;
}

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
      params: { 
        loc: '100',
        /*
        Add HERE custom key/value params
        kv_vdi: 'and the best is...',
        kv_jb: 'and the winner is...'
        */
      },
    };

    ADTECH.enqueueAd(6489219);
    ADTECH.enqueueAd(6490489);
    ADTECH.enqueueAd(6494071);
    ADTECH.executeQueue();

    })();
    initAdServerSet = true;
  }

(function () {
  var d = document;
  var pbs = d.createElement("script");
  pbs.type = "text/javascript";
  pbs.src = 'http://vlibs.advertising.com/prebid/adapters=smartadserver,rubicon;/prebid-1.x.x.js';
  var target = d.getElementsByTagName("head")[0];
  target.insertBefore(pbs, target.firstChild);
})();

var adUnits = [
  {
    code: '6494071',
    bounds: [
      {id: 6494072, min: 0, max: 768 },
      {id: 6494071, min: 769, max: 9999 },
    ],
    sizeid: '16',
    bids: []  
  },
  {
    code: '6489219',
    fif: { usefif: true },
    sizes: [[728, 90], [970, 90], [970, 250]],
    bounds: [
      {id: 6493810, min: 0, max: 768 },
      {id: 6489219, min: 769, max: 9999 },
    ],
    sizeid: '225', 
    bids: [
      {
        bidder: 'smartadserver',
        params: {
          domain: 'http://www8.smartadserver.com',
          siteId: '170999',
          pageId: '842325',
          formatId: '45846'      
        }
      }, 
      {
        bidder: 'rubicon',
        params: {
          accountId: '14794',
          siteId: '83734',
          zoneId: '395240'
        }
      }
    ]},
  {
    code: '6490489',
    fif: { usefif: true },
    sizes: [[300, 600], [300, 250]],
    bounds: [
      {id: 6494025, min: 0, max: 768 },
      {id: 6490489, min: 769, max: 9999 },
    ],
    sizeid: '170', 
    bids: [
      {
        bidder: 'smartadserver',
        params: {
          domain: 'http://www8.smartadserver.com',
          siteId: '170999',
          pageId: '842325',
          formatId: '45838'      
        }
      }, 
      {
        bidder: 'rubicon',
        params: {
          accountId: '14794',
          siteId: '83734',
          zoneId: '395240'
        }
      }
    ]}
  ];

var pbjs = pbjs || {};
pbjs.que = pbjs.que || [];

pbjs.que.push(function() {
  pbjs.addAdUnits(adUnits);
  //pbjs.enableSendAllBids();
  pbjs.requestBids({
    timeout: BID_TIMEOUT, // The primary timeout is set here
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
function sendAdserverRequest(bidResponses) {

  var targetingParams = pbjs.getAdserverTargeting();
  var responses = pbjs.getBidResponses()
  console.log('All bid responses', responses);
  console.log('Targeting parameters from all ad units', targetingParams);

  if (pbjs.adserverRequestSent) return;
  pbjs.adserverRequestSent = true;

  var adUnitsByToken = lookupByToken(adUnits, 'code');
  console.log('adUnits', adUnitsByToken);

  for (var slot in adUnitsByToken) {

      console.log('Current slot', slot);
      var paramsObj = {
        alias: '', 
        target: '_blank',
        loc: '100'
      };
      
      ADTECH.config.placements[slot] = {
        responsive : { 
          useresponsive: true, 
        }
      };

      if (adUnitsByToken[slot].fif) {
        ADTECH.config.placements[slot].fif = adUnitsByToken[slot].fif;
      }

      if (adUnitsByToken[slot].bounds) {
        ADTECH.config.placements[slot].responsive.bounds = adUnitsByToken[slot].bounds;
      }

      if (adUnitsByToken[slot].sizeid) {
        ADTECH.config.placements[slot].sizeid = adUnitsByToken[slot].sizeid;
      }

      if (targetingParams.hasOwnProperty(slot)) {
        var bidderCode = targetingParams[slot]['hb_bidder'];

        paramsObj['kvhb_pb_' + bidderCode.substring(0,5)] = targetingParams[slot]['hb_pb'];
        paramsObj['kvhb_adid_' + bidderCode.substring(0,5)] = targetingParams[slot]['hb_adid'];
      }
      ADTECH.config.placements[slot].params = paramsObj;
  }

  initAdserver();
}
</script>

