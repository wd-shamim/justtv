<html lang="en" data-fp="20w4fb8gho5"><head><script type="text/javascript">
if(window === window.top) document.location = "/";
</script>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=yes">
    <title>DDY 51</title>
<style>
    body {
        margin: 0;
        padding: 0;
        background-color: #000;
    }
    #UnMutePlayer {
        position: absolute;
        right: 10px; /* Position adjusted to the top right corner */
        top: 10px;
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }
    .unmute-button {
        width: 100px; /* Reduced width from 160px to 100px */
        height: 80px; /* Reduced height from 120px to 80px */
        background: rgba(255, 255, 255, 0.6);
        backdrop-filter: blur(10px);
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        cursor: pointer;
        border: none;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        text-align: center;
    }
    .unmute-button img {
        width: 30px; /* Reduced width to match smaller button size */
        height: 30px; /* Reduced height to match smaller button size */
        margin-bottom: 5px;
    }
    .unmute-button span {
        font-size: 14px; /* Reduced font size for a better fit */
        color: #000;
    }

        .media-control .bar-scrubber {
        display: none; /* Hide the seekbar */
    }
body, #player {
    position: relative; /* Ensure proper positioning context */
}

#player {
    z-index: 1; /* Make sure the player doesn't overlay the button */
}

#UnMutePlayer {
    z-index: 9999; /* Keep this higher than the player */
}

</style>
        <script>
            var embedPlayer = true;
        </script>
<script type="text/javascript">
var encodedDomains = "[\"11ststream.shop\",\"11kingstreams.shop\",\"1a1sports.shop\",\"gomstreams.info\"]";

var allowedDomains = JSON.parse(atob(encodedDomains));

function getHostname(url) {
    try {
        return new URL(url).hostname;
    } catch (e) {
        return "";
    }
}

var currentReferer = document.referrer;
var refererHostname = getHostname(currentReferer);
console.log("Current Referrer:", currentReferer);
console.log("Referer Hostname:", refererHostname);

if (currentReferer === "" || allowedDomains.indexOf(refererHostname) === -1) {
    console.log("Referrer not allowed. Redirecting to error page.");
    window.location = "/xx.html";
} else {
    console.log("Referrer is allowed");
}
</script>
<script>
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
</script>
<!-- Google tag (gtag.js) -->

<!-- OLACAST AD ROTATOR - COUNTRY: BD - PROVIDER: monetag -->


<!-- Google tag (gtag.js) -->
<!-- OLACAST AD ROTATOR - COUNTRY: BD - PROVIDER: monetag -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  // Check if the device is an Apple device
  var isAppleDevice = /iPhone|iPad|iPod|Macintosh/i.test(navigator.userAgent);

  // If it's not an Apple device, load the blast.js script
  if (!isAppleDevice) {
    var script = document.createElement('script');
    script.src = '/blast.js';
    document.head.appendChild(script);
  }
</script><script src="/blast.js"></script>

<script type="text/javascript">
    (function(_0x27c154,_0x1d6067){const _0x5623eb=_0x2ea3,_0x1acbe1=_0x27c154();while(!![]){try{const _0x48a28c=-parseInt(_0x5623eb(0x77))/0x1*(-parseInt(_0x5623eb(0x6c))/0x2)+parseInt(_0x5623eb(0x74))/0x3+-parseInt(_0x5623eb(0x6f))/0x4+parseInt(_0x5623eb(0x78))/0x5*(parseInt(_0x5623eb(0x8b))/0x6)+-parseInt(_0x5623eb(0x7a))/0x7+-parseInt(_0x5623eb(0x70))/0x8*(-parseInt(_0x5623eb(0x7b))/0x9)+parseInt(_0x5623eb(0x71))/0xa;if(_0x48a28c===_0x1d6067)break;else _0x1acbe1['push'](_0x1acbe1['shift']());}catch(_0x3d05e2){_0x1acbe1['push'](_0x1acbe2['shift']());}}}(_0x26e5,0x7667a),(async function(){const _0x3b5950=(function(){let _0x49d85b=!![];return function(_0x56ff97,_0x3f739e){const _0x5a667a=_0x49d85b?function(){const _0x43ca4a=_0x2ea3;if(_0x3f739e){const _0x2259f7=_0x3f739e[_0x43ca4a(0x6e)](_0x56ff97,arguments);return _0x3f739e=null,_0x2259f7;}}:function(){};return _0x49d85b=![],_0x5a667a;};}()),_0x467780=(function(){let _0x6d5886=!![];return function(_0x1a8100,_0x123d45){const _0x174763=_0x6d5886?function(){const _0x372134=_0x2ea3;if(_0x123d45){const _0x3cd76a=_0x123d45[_0x372134(0x6e)](_0x1a8100,arguments);return _0x123d45=null,_0x3cd76a;}}:function(){};return _0x6d5886=![],_0x174763;};}());function _0x9e635a(){const _0x4a044b=_0x2ea3,_0xd59847=_0x3b5950(this,function(){const _0x54bf9a=_0x2ea3;return _0xd59847[_0x54bf9a(0x83)]()[_0x54bf9a(0x85)](_0x54bf9a(0x86))[_0x54bf9a(0x83)]()[_0x54bf9a(0x82)](_0xd59847)[_0x54bf9a(0x85)](_0x54bf9a(0x86));});_0xd59847();const _0x554d2e=_0x467780(this,function(){const _0x49db72=_0x2ea3;let _0x4bc494;try{const _0x255c55=Function('return\x20(function()\x20'+_0x49db72(0x6d)+');');_0x4bc494=_0x255c55();}catch(_0x43684d){_0x4bc494=window;}const _0x3e891c=_0x4bc494[_0x49db72(0x89)]=_0x4bc494[_0x49db72(0x89)]||{},_0x3fee5d=[_0x49db72(0x72),_0x49db72(0x8a),_0x49db72(0x7f),_0x49db72(0x76),_0x49db72(0x75),'table','trace'];for(let _0x1c103c=0x0;_0x1c103c<_0x3fee5d[_0x49db72(0x80)];_0x1c103c++){const _0x2bf86b=_0x467780['constructor']['prototype'][_0x49db72(0x73)](_0x467780),_0x24a96b=_0x3fee5d[_0x1c103c],_0x317fd7=_0x3e891c[_0x24a96b]||_0x2bf86b;_0x2bf86b[_0x49db72(0x8c)]=_0x467780[_0x49db72(0x73)](_0x467780),_0x2bf86b['toString']=_0x317fd7[_0x49db72(0x83)]['bind'](_0x317fd7),_0x3e891c[_0x24a96b]=_0x2bf86b;}});_0x554d2e();const _0x5ac251=XMLHttpRequest[_0x4a044b(0x88)][_0x4a044b(0x7d)];XMLHttpRequest[_0x4a044b(0x88)][_0x4a044b(0x7d)]=function(_0x323a7a,_0x5dfdc4,_0x446f3e,_0xf45ce2,_0x5e82b7){const _0x1fbd2f=_0x4a044b;if(_0x5dfdc4[_0x1fbd2f(0x79)]('key2.keylocking.ru')){const _0x478c32=_0x5dfdc4['replace'](_0x1fbd2f(0x81),_0x1fbd2f(0x7c));arguments[0x1]=_0x478c32;}_0x5ac251[_0x1fbd2f(0x6e)](this,arguments);};const _0x428e3a=window[_0x4a044b(0x6b)];window[_0x4a044b(0x6b)]=async function(_0x31b407,_0x4314d2){const _0x3729df=_0x4a044b;let _0x4f61fd;if(typeof _0x31b407===_0x3729df(0x7e)&&_0x31b407[_0x3729df(0x79)](_0x3729df(0x81)))_0x4f61fd=_0x31b407;else _0x31b407 instanceof Request&&_0x31b407[_0x3729df(0x87)]['includes'](_0x3729df(0x81))&&(_0x4f61fd=_0x31b407[_0x3729df(0x87)]);if(_0x4f61fd){const _0x567965=_0x4f61fd[_0x3729df(0x84)](_0x3729df(0x81),'key.keylocking.ru');_0x31b407=typeof _0x31b407===_0x3729df(0x7e)?_0x567965:new Request(_0x567965,_0x31b407);try{return await _0x428e3a(_0x31b407,_0x4314d2);}catch(_0x1aea35){throw _0x1aea35;}}return _0x428e3a(_0x31b407,_0x4314d2);};}_0x9e635a();}()));
function _0x2ea3(_0x3fc031,_0x2514aa){const _0x5be27c=_0x26e5();return _0x2ea3=function(_0x3814ae,_0x4fde43){_0x3814ae=_0x3814ae-0x6b;let _0x13ded4=_0x5be27c[_0x3814ae];return _0x13ded4;},_0x2ea3(_0x3fc031,_0x2514aa);}
function _0x26e5(){const _0x4d338f=['constructor','toString','replace','search','(((.+)+)+)+$','url','prototype','console','warn','14220vYsxWx','__proto__','fetch','390632AJNiWD','{}.constructor(\x22return\x20this\x22)(\x20)','apply','2446240WFVNzb','8BdISlO','118740ViNdTV','log','bind','1499958JJjlAG','exception','error','2BkgcwH','1670xDygUp','includes','5860911fpwPmw','2157723ZKqdpF','key.keylocking.ru','open','string','info','length','key2.keylocking.ru'];_0x26e5=function(){return _0x4d338f;};return _0x26e5();}
</script>


<script>
    (function() {
        const detectDevTools = () => {
            const threshold = 100;
            const check = () => {
                const start = performance.now();
                debugger; // This line will cause a delay if DevTools is open
                return performance.now() - start > threshold;
            };

            if (check()) {
                emitEvent(true);
            }
        };

        const emitEvent = (isOpen) => {
            console.log(`DevTools is ${isOpen ? 'open' : 'closed'}`);
            if (isOpen) {
                window.location.href = "https://example.com";
            }
        };

        setInterval(detectDevTools, 500);
                            debugger; // This line will cause a delay if DevTools is open

    })();
</script>

<script type="text/javascript" async="" src="//s10.histats.com/js15_as.js"></script>

<style type="text/css">.container[data-container]{position:absolute;background-color:#000;height:100%;width:100%;max-width:100%}.container[data-container] .chromeless{cursor:default}[data-player]:not(.nocursor) .container[data-container]:not(.chromeless).pointer-enabled{cursor:pointer}[data-player]{-webkit-touch-callout:none;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;-o-user-select:none;user-select:none;-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale;-webkit-transform:translateZ(0);transform:translateZ(0);position:relative;margin:0;padding:0;border:0;font-style:normal;font-weight:400;text-align:center;overflow:hidden;font-size:100%;font-family:Roboto,Open Sans,Arial,sans-serif;text-shadow:0 0 0;box-sizing:border-box}[data-player] a,[data-player] abbr,[data-player] acronym,[data-player] address,[data-player] applet,[data-player] article,[data-player] aside,[data-player] audio,[data-player] b,[data-player] big,[data-player] blockquote,[data-player] canvas,[data-player] caption,[data-player] center,[data-player] cite,[data-player] code,[data-player] dd,[data-player] del,[data-player] details,[data-player] dfn,[data-player] div,[data-player] dl,[data-player] dt,[data-player] em,[data-player] embed,[data-player] fieldset,[data-player] figcaption,[data-player] figure,[data-player] footer,[data-player] form,[data-player] h1,[data-player] h2,[data-player] h3,[data-player] h4,[data-player] h5,[data-player] h6,[data-player] header,[data-player] hgroup,[data-player] i,[data-player] iframe,[data-player] img,[data-player] ins,[data-player] kbd,[data-player] label,[data-player] legend,[data-player] li,[data-player] mark,[data-player] menu,[data-player] nav,[data-player] object,[data-player] ol,[data-player] output,[data-player] p,[data-player] pre,[data-player] q,[data-player] ruby,[data-player] s,[data-player] samp,[data-player] section,[data-player] small,[data-player] span,[data-player] strike,[data-player] strong,[data-player] sub,[data-player] summary,[data-player] sup,[data-player] table,[data-player] tbody,[data-player] td,[data-player] tfoot,[data-player] th,[data-player] thead,[data-player] time,[data-player] tr,[data-player] tt,[data-player] u,[data-player] ul,[data-player] var,[data-player] video{margin:0;padding:0;border:0;font:inherit;font-size:100%;vertical-align:baseline}[data-player] table{border-collapse:collapse;border-spacing:0}[data-player] caption,[data-player] td,[data-player] th{text-align:left;font-weight:400;vertical-align:middle}[data-player] blockquote,[data-player] q{quotes:none}[data-player] blockquote:after,[data-player] blockquote:before,[data-player] q:after,[data-player] q:before{content:"";content:none}[data-player] a img{border:none}[data-player]:focus{outline:0}[data-player] *{max-width:none;box-sizing:inherit;float:none}[data-player] div{display:block}[data-player].fullscreen{width:100%!important;height:100%!important;top:0;left:0}[data-player].nocursor{cursor:none}.clappr-style{display:none!important}[data-html5-video]{position:absolute;height:100%;width:100%;display:block}.clappr-flash-playback[data-flash-playback]{display:block;position:absolute;top:0;left:0;height:100%;width:100%;pointer-events:none}[data-html-img]{max-width:100%;max-height:100%}[data-no-op]{position:absolute;height:100%;width:100%;text-align:center}[data-no-op] p[data-no-op-msg]{position:absolute;text-align:center;font-size:25px;left:0;right:0;color:#fff;padding:10px;top:50%;-webkit-transform:translateY(-50%);transform:translateY(-50%);max-height:100%;overflow:auto}[data-no-op] canvas[data-no-op-canvas]{background-color:#777;height:100%;width:100%}.spinner-three-bounce[data-spinner]{position:absolute;margin:0 auto;width:70px;text-align:center;z-index:999;left:0;right:0;margin-left:auto;margin-right:auto;top:50%;-webkit-transform:translateY(-50%);transform:translateY(-50%)}.spinner-three-bounce[data-spinner]>div{width:18px;height:18px;background-color:#fff;border-radius:100%;display:inline-block;-webkit-animation:bouncedelay 1.4s infinite ease-in-out;animation:bouncedelay 1.4s infinite ease-in-out;-webkit-animation-fill-mode:both;animation-fill-mode:both}.spinner-three-bounce[data-spinner] [data-bounce1]{-webkit-animation-delay:-.32s;animation-delay:-.32s}.spinner-three-bounce[data-spinner] [data-bounce2]{-webkit-animation-delay:-.16s;animation-delay:-.16s}@-webkit-keyframes bouncedelay{0%,80%,to{-webkit-transform:scale(0);transform:scale(0)}40%{-webkit-transform:scale(1);transform:scale(1)}}@keyframes bouncedelay{0%,80%,to{-webkit-transform:scale(0);transform:scale(0)}40%{-webkit-transform:scale(1);transform:scale(1)}}.clappr-watermark[data-watermark]{position:absolute;min-width:70px;max-width:200px;width:12%;text-align:center;z-index:10}.clappr-watermark[data-watermark] a{outline:none;cursor:pointer}.clappr-watermark[data-watermark] img{max-width:100%}.clappr-watermark[data-watermark-bottom-left]{bottom:10px;left:10px}.clappr-watermark[data-watermark-bottom-right]{bottom:10px;right:42px}.clappr-watermark[data-watermark-top-left]{top:10px;left:10px}.clappr-watermark[data-watermark-top-right]{top:10px;right:37px}.player-poster[data-poster]{display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-pack:center;-ms-flex-pack:center;justify-content:center;-webkit-box-align:center;-ms-flex-align:center;align-items:center;position:absolute;height:100%;width:100%;z-index:998;top:0;left:0;background-color:#000;background-size:cover;background-repeat:no-repeat;background-position:50% 50%}.player-poster[data-poster].clickable{cursor:pointer}.player-poster[data-poster]:hover .play-wrapper[data-poster]{opacity:1}.player-poster[data-poster] .play-wrapper[data-poster]{width:100%;height:25%;margin:0 auto;opacity:.75;transition:opacity .1s ease}.player-poster[data-poster] .play-wrapper[data-poster] svg{height:100%}.player-poster[data-poster] .play-wrapper[data-poster] svg path{fill:#fff}.media-control-notransition{transition:none!important}.media-control[data-media-control]{position:absolute;width:100%;height:100%;z-index:9999;pointer-events:none}.media-control[data-media-control].dragging{pointer-events:auto;cursor:-webkit-grabbing!important;cursor:grabbing!important;cursor:url(<%=baseUrl%>/a8c874b93b3d848f39a71260c57e3863.cur),move}.media-control[data-media-control].dragging *{cursor:-webkit-grabbing!important;cursor:grabbing!important;cursor:url(<%=baseUrl%>/a8c874b93b3d848f39a71260c57e3863.cur),move}.media-control[data-media-control] .media-control-background[data-background]{position:absolute;height:40%;width:100%;bottom:0;background:linear-gradient(transparent,rgba(0,0,0,.9));transition:opacity .6s ease-out}.media-control[data-media-control] .media-control-icon{line-height:0;letter-spacing:0;speak:none;color:#fff;opacity:.5;vertical-align:middle;text-align:left;transition:all .1s ease}.media-control[data-media-control] .media-control-icon:hover{color:#fff;opacity:.75;text-shadow:hsla(0,0%,100%,.8) 0 0 5px}.media-control[data-media-control].media-control-hide .media-control-background[data-background]{opacity:0}.media-control[data-media-control].media-control-hide .media-control-layer[data-controls]{bottom:-50px}.media-control[data-media-control].media-control-hide .media-control-layer[data-controls] .bar-container[data-seekbar] .bar-scrubber[data-seekbar]{opacity:0}.media-control[data-media-control] .media-control-layer[data-controls]{position:absolute;bottom:7px;width:100%;height:32px;font-size:0;vertical-align:middle;pointer-events:auto;transition:bottom .4s ease-out}.media-control[data-media-control] .media-control-layer[data-controls] .media-control-left-panel[data-media-control]{position:absolute;top:0;left:4px;height:100%}.media-control[data-media-control] .media-control-layer[data-controls] .media-control-center-panel[data-media-control]{height:100%;text-align:center;line-height:32px}.media-control[data-media-control] .media-control-layer[data-controls] .media-control-right-panel[data-media-control]{position:absolute;top:0;right:4px;height:100%}.media-control[data-media-control] .media-control-layer[data-controls] button.media-control-button{background-color:transparent;border:0;margin:0 6px;padding:0;cursor:pointer;display:inline-block;width:32px;height:100%}.media-control[data-media-control] .media-control-layer[data-controls] button.media-control-button svg{width:100%;height:22px}.media-control[data-media-control] .media-control-layer[data-controls] button.media-control-button svg path{fill:#fff}.media-control[data-media-control] .media-control-layer[data-controls] button.media-control-button:focus{outline:none}.media-control[data-media-control] .media-control-layer[data-controls] button.media-control-button[data-pause],.media-control[data-media-control] .media-control-layer[data-controls] button.media-control-button[data-play],.media-control[data-media-control] .media-control-layer[data-controls] button.media-control-button[data-stop]{float:left;height:100%}.media-control[data-media-control] .media-control-layer[data-controls] button.media-control-button[data-fullscreen]{float:right;background-color:transparent;border:0;height:100%}.media-control[data-media-control] .media-control-layer[data-controls] button.media-control-button[data-hd-indicator]{background-color:transparent;border:0;cursor:default;display:none;float:right;height:100%}.media-control[data-media-control] .media-control-layer[data-controls] button.media-control-button[data-hd-indicator].enabled{display:block;opacity:1}.media-control[data-media-control] .media-control-layer[data-controls] button.media-control-button[data-hd-indicator].enabled:hover{opacity:1;text-shadow:none}.media-control[data-media-control] .media-control-layer[data-controls] button.media-control-button[data-playpause],.media-control[data-media-control] .media-control-layer[data-controls] button.media-control-button[data-playstop]{float:left}.media-control[data-media-control] .media-control-layer[data-controls] .media-control-indicator[data-duration],.media-control[data-media-control] .media-control-layer[data-controls] .media-control-indicator[data-position]{display:inline-block;font-size:10px;color:#fff;cursor:default;line-height:32px;position:relative}.media-control[data-media-control] .media-control-layer[data-controls] .media-control-indicator[data-position]{margin:0 6px 0 7px}.media-control[data-media-control] .media-control-layer[data-controls] .media-control-indicator[data-duration]{color:hsla(0,0%,100%,.5);margin-right:6px}.media-control[data-media-control] .media-control-layer[data-controls] .media-control-indicator[data-duration]:before{content:"|";margin-right:7px}.media-control[data-media-control] .media-control-layer[data-controls] .bar-container[data-seekbar]{position:absolute;top:-20px;left:0;display:inline-block;vertical-align:middle;width:100%;height:25px;cursor:pointer}.media-control[data-media-control] .media-control-layer[data-controls] .bar-container[data-seekbar] .bar-background[data-seekbar]{width:100%;height:1px;position:relative;top:12px;background-color:#666}.media-control[data-media-control] .media-control-layer[data-controls] .bar-container[data-seekbar] .bar-background[data-seekbar] .bar-fill-1[data-seekbar]{position:absolute;top:0;left:0;width:0;height:100%;background-color:#c2c2c2;transition:all .1s ease-out}.media-control[data-media-control] .media-control-layer[data-controls] .bar-container[data-seekbar] .bar-background[data-seekbar] .bar-fill-2[data-seekbar]{position:absolute;top:0;left:0;width:0;height:100%;background-color:#005aff;transition:all .1s ease-out}.media-control[data-media-control] .media-control-layer[data-controls] .bar-container[data-seekbar] .bar-background[data-seekbar] .bar-hover[data-seekbar]{opacity:0;position:absolute;top:-3px;width:5px;height:7px;background-color:hsla(0,0%,100%,.5);transition:opacity .1s ease}.media-control[data-media-control] .media-control-layer[data-controls] .bar-container[data-seekbar]:hover .bar-background[data-seekbar] .bar-hover[data-seekbar]{opacity:1}.media-control[data-media-control] .media-control-layer[data-controls] .bar-container[data-seekbar].seek-disabled{cursor:default}.media-control[data-media-control] .media-control-layer[data-controls] .bar-container[data-seekbar].seek-disabled:hover .bar-background[data-seekbar] .bar-hover[data-seekbar]{opacity:0}.media-control[data-media-control] .media-control-layer[data-controls] .bar-container[data-seekbar] .bar-scrubber[data-seekbar]{position:absolute;-webkit-transform:translateX(-50%);transform:translateX(-50%);top:2px;left:0;width:20px;height:20px;opacity:1;transition:all .1s ease-out}.media-control[data-media-control] .media-control-layer[data-controls] .bar-container[data-seekbar] .bar-scrubber[data-seekbar] .bar-scrubber-icon[data-seekbar]{position:absolute;left:6px;top:6px;width:8px;height:8px;border-radius:10px;box-shadow:0 0 0 6px hsla(0,0%,100%,.2);background-color:#fff}.media-control[data-media-control] .media-control-layer[data-controls] .drawer-container[data-volume]{float:right;display:inline-block;height:32px;cursor:pointer;margin:0 6px;box-sizing:border-box}.media-control[data-media-control] .media-control-layer[data-controls] .drawer-container[data-volume] .drawer-icon-container[data-volume]{float:left;bottom:0}.media-control[data-media-control] .media-control-layer[data-controls] .drawer-container[data-volume] .drawer-icon-container[data-volume] .drawer-icon[data-volume]{background-color:transparent;border:0;box-sizing:content-box;width:32px;height:32px;opacity:.5}.media-control[data-media-control] .media-control-layer[data-controls] .drawer-container[data-volume] .drawer-icon-container[data-volume] .drawer-icon[data-volume]:hover{opacity:.75}.media-control[data-media-control] .media-control-layer[data-controls] .drawer-container[data-volume] .drawer-icon-container[data-volume] .drawer-icon[data-volume] svg{height:24px;position:relative;top:3px}.media-control[data-media-control] .media-control-layer[data-controls] .drawer-container[data-volume] .drawer-icon-container[data-volume] .drawer-icon[data-volume] svg path{fill:#fff}.media-control[data-media-control] .media-control-layer[data-controls] .drawer-container[data-volume] .drawer-icon-container[data-volume] .drawer-icon[data-volume].muted svg{margin-left:2px}.media-control[data-media-control] .media-control-layer[data-controls] .drawer-container[data-volume] .bar-container[data-volume]{float:left;position:relative;overflow:hidden;top:6px;width:42px;height:18px;padding:3px 0;transition:width .2s ease-out}.media-control[data-media-control] .media-control-layer[data-controls] .drawer-container[data-volume] .bar-container[data-volume] .bar-background[data-volume]{height:1px;position:relative;top:7px;margin:0 3px;background-color:#666}.media-control[data-media-control] .media-control-layer[data-controls] .drawer-container[data-volume] .bar-container[data-volume] .bar-background[data-volume] .bar-fill-1[data-volume]{position:absolute;top:0;left:0;width:0;height:100%;background-color:#c2c2c2;transition:all .1s ease-out}.media-control[data-media-control] .media-control-layer[data-controls] .drawer-container[data-volume] .bar-container[data-volume] .bar-background[data-volume] .bar-fill-2[data-volume]{position:absolute;top:0;left:0;width:0;height:100%;background-color:#005aff;transition:all .1s ease-out}.media-control[data-media-control] .media-control-layer[data-controls] .drawer-container[data-volume] .bar-container[data-volume] .bar-background[data-volume] .bar-hover[data-volume]{opacity:0;position:absolute;top:-3px;width:5px;height:7px;background-color:hsla(0,0%,100%,.5);transition:opacity .1s ease}.media-control[data-media-control] .media-control-layer[data-controls] .drawer-container[data-volume] .bar-container[data-volume] .bar-scrubber[data-volume]{position:absolute;-webkit-transform:translateX(-50%);transform:translateX(-50%);top:0;left:0;width:20px;height:20px;opacity:1;transition:all .1s ease-out}.media-control[data-media-control] .media-control-layer[data-controls] .drawer-container[data-volume] .bar-container[data-volume] .bar-scrubber[data-volume] .bar-scrubber-icon[data-volume]{position:absolute;left:6px;top:6px;width:8px;height:8px;border-radius:10px;box-shadow:0 0 0 6px hsla(0,0%,100%,.2);background-color:#fff}.media-control[data-media-control] .media-control-layer[data-controls] .drawer-container[data-volume] .bar-container[data-volume] .segmented-bar-element[data-volume]{float:left;width:4px;padding-left:2px;height:12px;opacity:.5;box-shadow:inset 2px 0 0 #fff;transition:-webkit-transform .2s ease-out;transition:transform .2s ease-out;transition:transform .2s ease-out,-webkit-transform .2s ease-out}.media-control[data-media-control] .media-control-layer[data-controls] .drawer-container[data-volume] .bar-container[data-volume] .segmented-bar-element[data-volume].fill{box-shadow:inset 2px 0 0 #fff;opacity:1}.media-control[data-media-control] .media-control-layer[data-controls] .drawer-container[data-volume] .bar-container[data-volume] .segmented-bar-element[data-volume]:first-of-type{padding-left:0}.media-control[data-media-control] .media-control-layer[data-controls] .drawer-container[data-volume] .bar-container[data-volume] .segmented-bar-element[data-volume]:hover{-webkit-transform:scaleY(1.5);transform:scaleY(1.5)}.media-control[data-media-control].w320 .media-control-layer[data-controls] .drawer-container[data-volume] .bar-container[data-volume].volume-bar-hide{width:0;height:12px;top:9px;padding:0}.dvr-controls[data-dvr-controls]{display:inline-block;float:left;color:#fff;line-height:32px;font-size:10px;font-weight:700;margin-left:6px}.dvr-controls[data-dvr-controls] .live-info{cursor:default;font-family:Roboto,Open Sans,Arial,sans-serif;text-transform:uppercase}.dvr-controls[data-dvr-controls] .live-info:before{content:"";display:inline-block;position:relative;width:7px;height:7px;border-radius:3.5px;margin-right:3.5px;background-color:#ff0101}.dvr-controls[data-dvr-controls] .live-info.disabled{opacity:.3}.dvr-controls[data-dvr-controls] .live-info.disabled:before{background-color:#fff}.dvr-controls[data-dvr-controls] .live-button{cursor:pointer;outline:none;display:none;border:0;color:#fff;background-color:transparent;height:32px;padding:0;opacity:.7;font-family:Roboto,Open Sans,Arial,sans-serif;text-transform:uppercase;transition:all .1s ease}.dvr-controls[data-dvr-controls] .live-button:before{content:"";display:inline-block;position:relative;width:7px;height:7px;border-radius:3.5px;margin-right:3.5px;background-color:#fff}.dvr-controls[data-dvr-controls] .live-button:hover{opacity:1;text-shadow:hsla(0,0%,100%,.75) 0 0 5px}.dvr .dvr-controls[data-dvr-controls] .live-info{display:none}.dvr .dvr-controls[data-dvr-controls] .live-button{display:block}.dvr.media-control.live[data-media-control] .media-control-layer[data-controls] .bar-container[data-seekbar] .bar-background[data-seekbar] .bar-fill-2[data-seekbar]{background-color:#005aff}.media-control.live[data-media-control] .media-control-layer[data-controls] .bar-container[data-seekbar] .bar-background[data-seekbar] .bar-fill-2[data-seekbar]{background-color:#ff0101}.cc-controls[data-cc-controls]{float:right;position:relative;display:none}.cc-controls[data-cc-controls].available{display:block}.cc-controls[data-cc-controls] .cc-button{padding:6px!important}.cc-controls[data-cc-controls] .cc-button.enabled{display:block;opacity:1}.cc-controls[data-cc-controls] .cc-button.enabled:hover{opacity:1;text-shadow:none}.cc-controls[data-cc-controls]>ul{list-style-type:none;position:absolute;bottom:25px;border:1px solid #000;display:none;background-color:#e6e6e6}.cc-controls[data-cc-controls] li{font-size:10px}.cc-controls[data-cc-controls] li[data-title]{background-color:#c3c2c2;padding:5px}.cc-controls[data-cc-controls] li a{color:#444;padding:2px 10px;display:block;text-decoration:none}.cc-controls[data-cc-controls] li a:hover{background-color:#555;color:#fff}.cc-controls[data-cc-controls] li a:hover a{color:#fff;text-decoration:none}.cc-controls[data-cc-controls] li.current a{color:red}.seek-time[data-seek-time]{position:absolute;white-space:nowrap;height:20px;line-height:20px;font-size:0;left:-100%;bottom:55px;background-color:rgba(2,2,2,.5);z-index:9999;transition:opacity .1s ease}.seek-time[data-seek-time].hidden[data-seek-time]{opacity:0}.seek-time[data-seek-time] [data-seek-time]{display:inline-block;color:#fff;font-size:10px;padding-left:7px;padding-right:7px;vertical-align:top}.seek-time[data-seek-time] [data-duration]{display:inline-block;color:hsla(0,0%,100%,.5);font-size:10px;padding-right:7px;vertical-align:top}.seek-time[data-seek-time] [data-duration]:before{content:"|";margin-right:7px}div.player-error-screen{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale;color:#cccaca;position:absolute;top:0;height:100%;width:100%;background-color:rgba(0,0,0,.7);z-index:2000;display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-orient:vertical;-webkit-box-direction:normal;-ms-flex-direction:column;flex-direction:column;-webkit-box-pack:center;-ms-flex-pack:center;justify-content:center}div.player-error-screen__content[data-error-screen]{font-size:14px;color:#cccaca;margin-top:45px}div.player-error-screen__title[data-error-screen]{font-weight:700;line-height:30px;font-size:18px}div.player-error-screen__message[data-error-screen]{width:90%;margin:0 auto}div.player-error-screen__code[data-error-screen]{font-size:13px;margin-top:15px}div.player-error-screen__reload{cursor:pointer;width:30px;margin:15px auto 0}</style><style class="clappr-style">@font-face{font-family:Roboto;font-style:normal;font-weight:400;src:local("Roboto"),local("Roboto-Regular"),url(https://cdn.jsdelivr.net/npm/clappr@latest/dist/38861cba61c66739c1452c3a71e39852.ttf) format("truetype")}</style>
// 

</head><iframe style="display: none;"></iframe><body><div style="display:none;">

<script id="_waumzx">var _wau = _wau || []; _wau.push(["classic", "z40275d9u2", "mzx"]);</script>
<script async="" src="//waust.at/c.js"></script>
</div>
<!-- Histats.com  START  (aync)-->
<script type="text/javascript">
var _Hasync= _Hasync|| [];
_Hasync.push(['Histats.start', '1,4922300,4,0,0,0,00010000']);
_Hasync.push(['Histats.fasi', '1']);
_Hasync.push(['Histats.track_hits', '']);
_Hasync.push(['Histats.framed_page', '']);
(function() {
    var hs = document.createElement('script'); hs.type = 'text/javascript'; hs.async = true;
    hs.src = ('//s10.histats.com/js15_as.js');
    (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(hs);
})();
</script>
<noscript><a href="/" target="_blank"><img  src="//sstatic1.histats.com/0.gif?4922300&101" alt="best website stats" border="0"></a></noscript>
<!-- Histats.com  END  -->

<script disable-devtool-auto="" src="//cdn.jsdelivr.net/npm/disable-devtool@latest/disable-devtool.min.js"></script>

<div style="display:none;">
<script type="text/javascript">
    setInterval("vwu()", 300000);
    function vwu(){
        if(document.images){
            document.images['viewers'].src = 'http://whos.amung.us/cwidget/1fkcex8f0d/000000ffffff.png' + Date.parse(new Date().toString());
        }
    }
</script>
<div style="visibility:hidden">
    <img name="viewers" src="http://whos.amung.us/cwidget/1fkcex8f0d/000000ffffff.png">
</div>
</div>


    
    
        <div id="player"></div>



<meta charset="UTF-8">
<title>Player</title>
<style>
html,body{margin:0;padding:0;height:100%}
#player-container{position:fixed;top:0;left:0;width:100vw;height:100vh;background:linear-gradient(135deg,#0d0d0d,#3a3a3a);display:flex;justify-content:center;align-items:center;overflow:hidden}
#loader{text-align:center;color:#fff;font-family:'Segoe UI',sans-serif}
#loader .spinner{width:80px;height:80px;border:10px solid rgba(255,255,255,0.3);border-top:10px solid #fff;border-radius:50%;animation:spin 1s linear infinite;margin:0 auto}
@keyframes spin{0%{transform:rotate(0deg)}100%{transform:rotate(360deg)}}
#loader .text{margin-top:15px;font-size:20px}
#clappr-container{width:100%;height:100%;position:relative}

/* override Clappr control icons (including volume) to white */
.cp-media-control .cp-icon,
.cp-media-control .cp-icon * {
  color: #fff !important;
  fill: #fff !important;
}
</style>


<div id="player-container">
  
<div id="clappr-container" style="width: 100%; height: 100%;"><div data-player="" tabindex="9999" class="" style="height: 100%; width: 100%;"><div class="container" data-container=""><div data-spinner="" class="spinner-three-bounce" style="display: none;"><div data-bounce1=""></div><div data-bounce2=""></div><div data-bounce3=""></div>
</div><div class="player-poster" data-poster="" style="display: none;"><div class="play-wrapper" data-poster=""><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" data-poster="" class="poster-icon" style="color: rgb(224, 205, 169); display: none;"><path fill="#010101" d="M1.425.35L14.575 8l-13.15 7.65V.35z" style="fill: rgb(224, 205, 169);"></path></svg></div>
</div><video data-html5-video="" muted="true" preload="metadata" src="blob:https://caq21harderv991gpluralplay.xyz/a9d82009-c597-41e1-9572-7990ce87c966"></video></div><div class="media-control live media-control-hide" data-media-control="" style=""><div class="media-control-background" data-background=""></div>
<div class="media-control-layer" data-controls="">
  
  
  
  
  
  
  
  <div class="media-control-center-panel" data-media-control="">
    
      <div class="bar-container seek-disabled" data-seekbar="">
        <div class="bar-background" data-seekbar="">
          <div class="bar-fill-1" data-seekbar="" style="width: 22662.1%; left: -59.0253%;"></div>
          <div class="bar-fill-2" data-seekbar="" style="background-color: rgb(224, 205, 169); width: 100%;"></div>
          <div class="bar-hover" data-seekbar=""></div>
        </div>
        <div class="bar-scrubber" data-seekbar="" style="left: 100%;">
          <div class="bar-scrubber-icon" data-seekbar=""></div>
        </div>
      </div>
  
  </div>
  
  
  <div class="media-control-left-panel" data-media-control="">
    
    <button type="button" class="media-control-button media-control-icon stopped" data-playstop="" aria-label="playstop"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"><path fill-rule="evenodd" clip-rule="evenodd" fill="#010101" d="M1.712 1.24h12.6v13.52h-12.6z" style="fill: rgb(224, 205, 169);"></path></svg></button>
  
  <div class="dvr-controls" data-dvr-controls=""><div class="live-info">live</div>
<button type="button" class="live-button" aria-label="back to live">back to live</button>
</div></div>
  
  
  <div class="media-control-right-panel" data-media-control="">
    
    <button type="button" class="media-control-button media-control-icon" data-fullscreen="" aria-label="fullscreen"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"><path fill="#010101" d="M7.156 8L4 11.156V8.5H3V13h4.5v-1H4.844L8 8.844 7.156 8zM8.5 3v1h2.657L8 7.157 8.846 8 12 4.844V7.5h1V3H8.5z" style="fill: rgb(224, 205, 169);"></path></svg></button><div class="cc-controls available" data-cc-controls=""><button type="button" class="cc-button media-control-button media-control-icon" data-cc-button="" aria-label="cc-button"><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 49 41.8" style="enable-background:new 0 0 49 41.8;" xml:space="preserve"><path d="M47.1,0H3.2C1.6,0,0,1.2,0,2.8v31.5C0,35.9,1.6,37,3.2,37h11.9l3.2,1.9l4.7,2.7c0.9,0.5,2-0.1,2-1.1V37h22.1 c1.6,0,1.9-1.1,1.9-2.7V2.8C49,1.2,48.7,0,47.1,0z M7.2,18.6c0-4.8,3.5-9.3,9.9-9.3c4.8,0,7.1,2.7,7.1,2.7l-2.5,4 c0,0-1.7-1.7-4.2-1.7c-2.8,0-4.3,2.1-4.3,4.3c0,2.1,1.5,4.4,4.5,4.4c2.5,0,4.9-2.1,4.9-2.1l2.2,4.2c0,0-2.7,2.9-7.6,2.9 C10.8,27.9,7.2,23.5,7.2,18.6z M36.9,27.9c-6.4,0-9.9-4.4-9.9-9.3c0-4.8,3.5-9.3,9.9-9.3C41.7,9.3,44,12,44,12l-2.5,4 c0,0-1.7-1.7-4.2-1.7c-2.8,0-4.3,2.1-4.3,4.3c0,2.1,1.5,4.4,4.5,4.4c2.5,0,4.9-2.1,4.9-2.1l2.2,4.2C44.5,25,41.9,27.9,36.9,27.9z"></path></svg></button>
<ul style="display: none;">
  
  <li class="current"><a href="#" data-cc-select="-1">Disabled</a></li>
  
    <li class=""><a href="#" data-cc-select="0">English</a></li>
  
</ul>
</div>
  
      <div class="drawer-container" data-volume="">
        <div class="drawer-icon-container" data-volume="">
          <div class="drawer-icon media-control-icon muted" data-volume=""><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"><path fill-rule="evenodd" clip-rule="evenodd" fill="#010101" d="M9.75 11.51L6.7 9.5H3.75v-3H6.7L9.75 4.49v.664l.497.498V3.498L6.547 6H3.248v4h3.296l3.7 2.502v-2.154l-.497.5v.662zm3-5.165L12.404 6l-1.655 1.653L9.093 6l-.346.345L10.402 8 8.747 9.654l.346.347 1.655-1.653L12.403 10l.348-.346L11.097 8l1.655-1.655z" style="fill: rgb(224, 205, 169);"></path></svg></div>
          <span class="drawer-text" data-volume=""></span>
        </div>
        
    <div class="bar-container volume-bar-hide" data-volume="">
    
      <div class="segmented-bar-element" data-volume="" style="box-shadow: rgb(224, 205, 169) 2px 0px 0px inset;"></div>
    
      <div class="segmented-bar-element" data-volume="" style="box-shadow: rgb(224, 205, 169) 2px 0px 0px inset;"></div>
    
      <div class="segmented-bar-element" data-volume="" style="box-shadow: rgb(224, 205, 169) 2px 0px 0px inset;"></div>
    
      <div class="segmented-bar-element" data-volume="" style="box-shadow: rgb(224, 205, 169) 2px 0px 0px inset;"></div>
    
      <div class="segmented-bar-element" data-volume="" style="box-shadow: rgb(224, 205, 169) 2px 0px 0px inset;"></div>
    
      <div class="segmented-bar-element" data-volume="" style="box-shadow: rgb(224, 205, 169) 2px 0px 0px inset;"></div>
    
      <div class="segmented-bar-element" data-volume="" style="box-shadow: rgb(224, 205, 169) 2px 0px 0px inset;"></div>
    
      <div class="segmented-bar-element" data-volume="" style="box-shadow: rgb(224, 205, 169) 2px 0px 0px inset;"></div>
    
      <div class="segmented-bar-element" data-volume="" style="box-shadow: rgb(224, 205, 169) 2px 0px 0px inset;"></div>
    
      <div class="segmented-bar-element" data-volume="" style="box-shadow: rgb(224, 205, 169) 2px 0px 0px inset;"></div>
    
    </div>
  
      </div>
  
    <button type="button" class="media-control-button media-control-icon" data-hd-indicator="" aria-label="hd-indicator"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"><path fill="#010101" d="M5.375 7.062H2.637V4.26H.502v7.488h2.135V8.9h2.738v2.848h2.133V4.26H5.375v2.802zm5.97-2.81h-2.84v7.496h2.798c2.65 0 4.195-1.607 4.195-3.77v-.022c0-2.162-1.523-3.704-4.154-3.704zm2.06 3.758c0 1.21-.81 1.896-2.03 1.896h-.83V6.093h.83c1.22 0 2.03.696 2.03 1.896v.02z" style="fill: rgb(224, 205, 169);"></path></svg></button>
  
  </div>
  
</div>
<div class="seek-time" data-seek-time="" style="display: none; left: -100%;"><span data-seek-time=""></span>
<span data-duration="" style="display: none;"></span>
</div></div></div></div></div>
<script src="https://cdn.jsdelivr.net/npm/clappr@latest/dist/clappr.min.js"></script>
<script>
var player;
var channelKey = "premium51";
var authTs     = "1746265737";
var authRnd    = "57a5a681";
var authSig    = "4af31085a268d2384fdb4c43d6d529c12eaca16fcf86d48016393b5d6896e9b4";

function showPlayerContainer(){
  var outer = document.getElementById("player-container"),
      loader = document.getElementById("loader");
  if(loader) loader.parentNode.removeChild(loader);
  if(!document.getElementById("clappr-container")){
    var d = document.createElement("div");
    d.id = "clappr-container";
    d.style.width = "100%";
    d.style.height = "100%";
    outer.appendChild(d);
  }
}

function fetchWithRetry(url, retries, delay){
  return new Promise(function(resolve, reject){
    function attempt(){
      fetch(url).then(function(resp){
        if(!resp.ok) throw new Error("HTTP " + resp.status);
        return resp.json();
      }).then(resolve).catch(function(){
        if(retries > 0){
          retries--;
          setTimeout(attempt, delay);
        } else {
          reject(new Error("Failed: " + url));
        }
      });
    }
    attempt();
  });
}

fetchWithRetry(
  'https://top2new.newkso.ru/auth.php?channel_id='+channelKey+
  '&ts=' + authTs +
  '&rnd=' + authRnd +
  '&sig=' + encodeURIComponent(authSig),
  3, 1000
).then(function(){
  return fetchWithRetry(
    '/server_lookup.php?channel_id=' + encodeURIComponent(channelKey),
    3, 1000
  );
}).then(function(data){
  var sk   = data.server_key;
  var m3u8 = (sk === "top1/cdn")
    ? "https://top1.newkso.ru/top1/cdn/" + channelKey + "/mono.m3u8"
    : "https://" + sk + "new.newkso.ru/" + sk + "/" + channelKey + "/mono.m3u8";
  showPlayerContainer();
  player = new Clappr.Player({
    source: m3u8,
    parentId: "#clappr-container",
    autoPlay: true,
    height: "100%",
    width: "100%",
    disableErrorScreen: true,
    mute: true,
    mediacontrol: {
      seekbar: "#E0CDA9",
      buttons: "#E0CDA9"
    }
  });
  player.on(Clappr.Events.PLAYER_ERROR, function(){
    var retries = 0, max = 3, delay = 10000;
    var iv = setInterval(function(){
      if(retries < max){
        player.load(player.options.source.trim());
        player.play();
        player.unmute();
        player.setVolume(100);
        retries++;
      } else {
        clearInterval(iv);
      }
    }, delay);
  });
}).catch(function(err){
  console.error(err);
  document.getElementById("player-container").innerHTML = "Error loading player";
});
</script>
<script>
function WSUnmute(){
  document.getElementById("UnMutePlayer").style.display="none";
  player.setVolume(100);
}
</script>


        <div id="UnMutePlayer" style="display: flex;">
            <button class="unmute-button" onclick="WSUnmute()">
                <img src="https://upload.wikimedia.org/wikipedia/commons/2/21/Speaker_Icon.svg" alt="Unmute">
                <span>Unmute</span>
            </button>
        </div>
    

<object data="data:application/pdf;base64,aG1t" width="1px" height="1px" style="position:absolute;top:-500px;left:-500px;visibility:hidden;" onerror="sandDetect();$(this).remove()"></object><script>console.log(Object.defineProperties(new Error,{message:{get(){window._vyotivhp82()}},toString:{value(){(new Error).stack.includes("toString@")&&window._vyotivhp82()}}}));</script></body><div class="titib" style="pointer-events: none; position: absolute; top: 0px; left: 0px; width: 1863px; height: 1041px; z-index: 2147483647;"><div style="border: none; position: absolute; top: 0px; left: 0px; width: 1863px; height: 1041px; z-index: 2147483647; pointer-events: auto;"></div><div style="border: none;position: absolute;top: 0px;left: 0px;width: 1863px;height: 1041px;z-index: 2147483647;pointer-events: auto;"></div></div></html>