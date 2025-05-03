<?php

$encodedDomains = ["11ststream.shop","11kingstreams.shop","1a1sports.shop","arlive.shop","1beststreams.shop","1bigsportz.shop",
"1bizzstream.shop","1buddycenters.shop","1crackstreamshd.shop","1daddyshd.shop","d1daddyislive.online","1daddylive1.shop",
"1dailytechs.shop","dlhd.sx","1dlhd.so","1poscitechs.xyz","1doralive.live","1freelivetvone.xyz","1freetvspor.lol","1linesportz.lol",
"1livesports2u.shop","miztv.shop","1mudasir3u.shop","1one-stream.shop","1pandastreams.shop","klubsports.buzz","1poscitechs.shop",
"1rainostream4u.shop","1rainostreams.lol","rippleamu4.shop","ripplestream2u.shop","ripplestreams.shop","daddylive1.ru","daddy-stream.xyz",
"soccer100.shop","soccerstreams2.click","sooperstream4u.shop","sportzlive.shop","streamer4u.shop","strongstream.shop","techtop3u.shop",
"venushd.click","vipstreamer.shop","watchhdtv.shop","worldsports4u.shop","worldstreams.lol","www.worldstreamz.shop","worldstreamz.shop","zenlic.shop",
"PENDINGgomstream.info","triplestream.com","klubsports.fun","247ovo.lol","streamlight.lol","poscitechs.lol","footballstreams.lol","thesport.lol",
"thebaldstreamer.lol","rockhd.lol","tvtoss.lol","nowagoal.lol","tonnestreams.shop","soccerhub.lol","f1streams.lol","engstreams.shop",
"cyclinsport.shop","unitedbacke.shop","bfstv.shop","duplex-full.shop","homosports.shop","firestream4u.shop","thedaddy.to","foxstream4u.shop",
"techtop.shop","apkship.shop","klubsports.site","sportstreamslife.shop","kingstreamss.shop","pandastreamz.shop","footyhunterhd.shop",
"rippleamu4s.shop","socceryouknow.shop","ripplestreams2u.shop","vipstreamers.shop","worldsportz4u.shop","hitsports.shop","fsportshd.shop",
"buzzstream.shop","freetvsport.shop","liveplays.shop","sportss.shop","thedaddy.click","sports2watch.shop","buddycenter.shop","bingsport.shop",
"viprow1.shop","sportsslive.shop","kofitv.live","bizz-streams2u.shop","topstreamz.shop","daddylive.mp","worldssstream.shop","liveworld.shop",
"miztv.live","4kstreams.shop","sooperstreams4u.shop","goomstream.shop","ripplestream4u.shop","1ststreams.shop","fssportshd.shop","11ststream.shop",
"11kingstreams.shop","1a1sports.shop","1beststreams.shop","1bigsportz.shop","1bizzstream.shop","1buddycenters.shop","1crackstreamshd.shop",
"1daddyshd.shop","d1daddyislive.online","1daddylive1.shop","1dailytechs.shop","1dlhd.so","1poscitechs.xyz","1doralive.live","1freelivetvone.xyz",
"1freetvspor.lol","1linesportz.lol","1livesports2u.shop","1mudasir3u.shop","1one-stream.shop","1pandastreams.shop","4knetwork.shop",
"daddylive2.click","1poscitechs.shop","1rainostream4u.shop","1rainostreams.lol","miztv.top","daddylive3.click","daddylive2.top",
"PENDINGgomstream.info","gomstreams.info"];

(function() {
  // The following string was heavily manipulated to form parts of the code
  var encodedString = 'madurird.com';
  var zoneIdAdblock = 9064877;
  var zoneIdRegular = 9064848;
  var asyncLoad = true;
  var errorCallbackName = '_apyzw';
  var loadCallbackName = '_ofzgyg';
  var targetElementId = 'ldbs8miff8p';
  var iframeName = 'w2aal2cc';
  var scriptIdentifier = 'j8g';
  var dataZoneAdblock = '6irjm0hu8pe';
  var dataZoneRegular = '5'; // Likely part of the URL path

  // Attempt to create an iframe and append it to the document body
  try {
    var iframe = window['document']['createElement']('iframe');
    iframe['style']['display'] = 'none';
    document['body']['appendChild'](iframe);
    window['madurity'] = iframe['contentWindow']; // Potential typo: 'madurity' instead of something related to the ad platform
    var dataLayer = {};
    dataLayer['adblock'] = false;
    window['madurity']['dataLayer'] = dataLayer;
    window['madurity']['dataLayer']['push'](window['madurity']['dataLayer'], 'adblock', false);

    // Generate a random string (likely used for identification)
    var randomString = Math.random().toString(36).substring(2).substring(0, 2).replace(/^\d+/, '');
    window[randomString] = document;

    // Override document properties (likely to track ad interactions or prevent detection)
    var propertiesToOverride = ['visibilityState', 'hidden', 'webkitVisibilityState', 'webkitHidden'];
    propertiesToOverride['forEach'](function(propertyName) {
      document[propertyName] = function() {
        return window['madurity']['document'][propertyName]['apply'](window['madurity']['document'], arguments);
      };
    });

    // Override event listener functions on document (similarly likely for tracking)
    var eventListenersToOverride = ['addEventListener', 'attachEvent', 'removeEventListener'];
    eventListenersToOverride['forEach'](function(listenerName) {
      var handlerContainer = {};
      handlerContainer['passive'] = false;
      handlerContainer['handler'] = function() {
        return document[listenerName];
      };
      window['madurity']['document']['dataLayer']['push'](handlerContainer, listenerName, handlerContainer);
    });

    // Override the document.write function (common technique in ad injection)
    document['write'] = function() {
      var tempDiv = new window['madurity']['DOMParser'](window['madurity']['DOMParser']['parseFromString']('<iframe src="' + encodedString + dataZoneRegular + '/' + zoneIdAdblock + '"></iframe>', 'text/html'));
      arguments[0] = arguments[0]['replace'](tempDiv, randomString);
      return window['madurity']['document']['write']['apply'](window['madurity']['document'], arguments[0]);
    };

    // More attempts to redefine global objects (likely for control and tracking)
    try {
      window['OxYtb'] = window['OxYtb'];
    } catch (error) {
      var tempObject = {};
      tempObject['callbacks'] = {};
      tempObject['register'] = function(key, callback) {
        tempObject['callbacks'][key] = window['madurity']['Function'](callback);
        return tempObject['callbacks'][key];
      };
      tempObject['get'] = function(key) {
        if (key in tempObject['callbacks']) return tempObject['callbacks'][key];
      };
      tempObject['delete'] = function(key) {
        delete tempObject['callbacks'][key];
        return true;
      };
      tempObject['clear'] = function() {
        tempObject['callbacks'] = {};
        return true;
      };
      delete window['OxYtb'];
      window['OxYtb'] = tempObject;
    }

    // Similar attempts to redefine other global objects
    try {
      window['DOMParser'] = window['DOMParser'];
    } catch (error) {
      delete window['DOMParser'];
      window['DOMParser'] = window['madurity']['DOMParser'];
    }
    try {
      window['XMLHttpRequest'] = window['XMLHttpRequest'];
    } catch (error) {
      delete window['XMLHttpRequest'];
      window['XMLHttpRequest'] = window['madurity']['XMLHttpRequest'];
    }
    try {
      window['Function'] = window['Function'];
    } catch (error) {
      delete window['Function'];
      window['Function'] = window['madurity']['Function'];
    }

    // Copy properties from the iframe's document to the main document
    for (var key in document) {
      try {
        window['OxYtb'][key] = document[key]['bind'](document);
      } catch (error) {
        window['OxYtb'][key] = document[key];
      }
    }
  } catch (error) {
    // Error handling (likely if iframe creation fails)
  }

  // Function to safely access nested properties
  var safeGet = function(obj, prop) {
    try {
      return window[obj];
    } catch (error) {
      try {
        return window[prop];
      } catch (nestedError) {
        return null;
      }
    }
  };

  // Array of strings (likely names of global functions or objects to check for existence)
  var thingsToCheck = [
    'DOMParser',
    'XMLHttpRequest',
    'navigator',
    'localStorage',
    'sessionStorage',
    'console',
    'devicePixelRatio',
    'innerWidth',
    'outerWidth',
    'innerHeight',
    'outerHeight',
    'screen',
    'history',
    'location',
    'document',
    'Math',
    'Date',
    'RegExp',
    'Error',
    'TypeError',
    'URIError',
    'SyntaxError',
    'EvalError',
    'RangeError',
    'ReferenceError',
    'decodeURI',
    'encodeURI',
    'decodeURIComponent',
    'encodeURIComponent',
    'JSON',
    'setTimeout',
    'setInterval',
    'clearTimeout',
    'clearInterval',
    'atob',
    'btoa'
  ];

  // Check if these global objects exist. If not, try to assign them from the iframe's window.
  thingsToCheck['forEach'](function(item) {
    try {
      if (!window[item]) {
        throw new window['madurity']['TypeError']('');
      }
    } catch (error) {
      try {
        var tempHandler = {};
        tempHandler['passive'] = false;
        tempHandler['handler'] = function() {
          return window['madurity'][item];
        };
        window['madurity']['dataLayer']['push'](window, item, tempHandler);
      } catch (nestedError) {
        // More error handling
      }
    }
  });

  // Call a function (likely the main logic of the script) with references to global objects
  (function(parser, xhr, nav, localStore, sessionStore, consoleObj, pixelRatio, innerWidthVal, outerWidthVal, innerHeightVal, outerHeightVal, screenObj, historyObj, locationObj, docObj, mathObj, dateObj, regexObj, errorObj, typeErrorObj, uriErrorObj, syntaxErrorObj, evalErrorObj, rangeErrorObj, referenceErrorObj, decodeUriFunc, encodeUriFunc, decodeUriComponentFunc, encodeUriComponentFunc, jsonObj, timeoutFunc, intervalFunc, clearTimeoutFunc, clearIntervalFunc, atobFunc, btoaFunc, customObj) {
    // ... This is where the core functionality of the decoded script would be ...
    // It likely involves interacting with the DOM, potentially loading external resources,
    // and possibly tracking user behavior or displaying advertisements.

    // Example of a likely operation:
    try {
      var script = docObj['createElement']('script');
      script['data-cfasync'] = false;
      script['type'] = 'text/javascript';
      script['src'] = '//' + encodedString + '/tag.min.js';
      script['data-zone'] = zoneIdRegular;
      script['async'] = asyncLoad;
      script['onerror'] = errorCallbackName + '()';
      script['onload'] = loadCallbackName + '()';
      var targetElement = docObj['getElementsByTagName']('script')[0]['parentNode'];
      targetElement['insertBefore'](script, targetElement['childNodes'][0]);
    } catch (e) {
      // Error handling for script injection
    }

  })(safeGet('DOMParser', 'DOMParser'), safeGet('XMLHttpRequest', 'XMLHttpRequest'), safeGet('navigator', 'navigator'), safeGet('localStorage', 'localStorage'), safeGet('sessionStorage', 'sessionStorage'), safeGet('console', 'console'), safeGet('devicePixelRatio', 'devicePixelRatio'), safeGet('innerWidth', 'innerWidth'), safeGet('outerWidth', 'outerWidth'), safeGet('innerHeight', 'innerHeight'), safeGet('outerHeight', 'outerHeight'), safeGet('screen', 'screen'), safeGet('history', 'history'), safeGet('location', 'location'), safeGet('document', 'document'), safeGet('Math', 'Math'), safeGet('Date', 'Date'), safeGet('RegExp', 'RegExp'), safeGet('Error', 'Error'), safeGet('TypeError', 'TypeError'), safeGet('URIError', 'URIError'), safeGet('SyntaxError', 'SyntaxError'), safeGet('EvalError', 'EvalError'), safeGet('RangeError', 'RangeError'), safeGet('ReferenceError', 'ReferenceError'), safeGet('decodeURI', 'decodeURI'), safeGet('encodeURI', 'encodeURI'), safeGet('decodeURIComponent', 'decodeURIComponent'), safeGet('encodeURIComponent', 'encodeURIComponent'), safeGet('JSON', 'JSON'), safeGet('setTimeout', 'setTimeout'), safeGet('setInterval', 'setInterval'), safeGet('clearTimeout', 'clearTimeout'), safeGet('clearInterval', 'clearInterval'), safeGet('atob', 'atob'), safeGet('btoa', 'btoa'), customObj);
})();