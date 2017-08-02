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
    (function () {
        if (!adServer.config) {
            console.error("adServer.config Object missing");
            return;
        }
        ADTECH.config.page = adServer.config;

        for (var slot in adUnitsByToken) {
            ADTECH.enqueueAd(slot);
        }

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

var pbjs = pbjs || {};
pbjs.que = pbjs.que || [];

var adUnitsByToken = lookupByToken(adUnits, 'code');

if (adUnits) {
    pbjs.que.push(function () {
        pbjs.addAdUnits(adUnits);
        pbjs.setPriceGranularity('dense');
        pbjs.bidderSettings = {
            rubicon: {
                bidCpmAdjustment : function(bidCpm){
                // adjust the bid in real time before the auction takes place
                return bidCpm * 0.80;
                }
            },
            smartadserver: {
                bidCpmAdjustment : function(bidCpm){
                // adjust the bid in real time before the auction takes place
                return bidCpm * 0.85;
                }
            }
        };
        pbjs.requestBids({
            timeout: BID_TIMEOUT, // The primary timeout is set here
            bidsBackHandler: sendAdserverRequest
        });

    });
}

/**
 * Handles bids response that is returned.
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

    console.log('adUnits', adUnitsByToken);

    for (var slot in adUnitsByToken) {

        console.log('Current slot', slot);
        var paramsObj = {
            alias: '',
            target: '_blank',
            loc: '100'
        };

        ADTECH.config.placements[slot] = {
            responsive: {
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

            paramsObj['kvhb_pb_' + bidderCode.substring(0, 5)] = targetingParams[slot]['hb_pb'];
            paramsObj['kvhb_adid_' + bidderCode.substring(0, 5)] = targetingParams[slot]['hb_adid'];
        }
        ADTECH.config.placements[slot].params = paramsObj;
    }

    initAdserver();
}

