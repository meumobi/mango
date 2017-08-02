<script type="text/javascript" charset="utf-8">

(function () {
  var d = document;
  var pbs = d.createElement("script");
  pbs.type = "text/javascript";
  pbs.src = 'http://www.mango-surf.com/lib/js/hb_ams-lib.js';
  var target = d.getElementsByTagName("head")[0];
  target.insertBefore(pbs, target.firstChild);
})();

var adServer = {};

adServer.config = {
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
  }
};

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


</script>

