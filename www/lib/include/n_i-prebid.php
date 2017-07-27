<script type="text/javascript" charset="utf-8">
//ADTECH.config.page = { protocol: 'http', server: 'adserver.adtech.de', network: '1502.1', siteid: '670202', params: { loc: '100' }};
//ADTECH.config.placements[5008877] = { responsive : { useresponsive: true, bounds: [{id: 6035346, min: 0, max: 499 }, {id: 5008877, min: 500, max: 9999 }]}, sizeid: '225', params: { alias: '', target: '_blank' }};

(function () {
  var d = document;
  var pbs = d.createElement("script");
  pbs.type = "text/javascript";
  pbs.src = 'http://vlibs.advertising.com/prebid/adapters=smartadserver;/prebid-1.x.x.js';
  var target = d.getElementsByTagName("head")[0];
  target.insertBefore(pbs, target.firstChild);
})();


var adUnits = [{
  code: '5008877',
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

function sendAdserverRequest() {
  if (pbjs.adserverRequestSent) return;
  pbjs.adserverRequestSent = true;
  googletag.cmd.push(function() {
    pbjs.que.push(function() {
      pbjs.setTargetingForGPTAsync();
      googletag.pubads().refresh();
    });
  });
}

</script>

