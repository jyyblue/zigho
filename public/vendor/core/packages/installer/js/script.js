(()=>{"use strict";function t(e){return t="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t},t(e)}function e(e,n){for(var r=0;r<n.length;r++){var o=n[r];o.enumerable=o.enumerable||!1,o.configurable=!0,"value"in o&&(o.writable=!0),Object.defineProperty(e,(i=o.key,u=void 0,u=function(e,n){if("object"!==t(e)||null===e)return e;var r=e[Symbol.toPrimitive];if(void 0!==r){var o=r.call(e,n||"default");if("object"!==t(o))return o;throw new TypeError("@@toPrimitive must return a primitive value.")}return("string"===n?String:Number)(e)}(i,"string"),"symbol"===t(u)?u:String(u)),o)}var i,u}(new(function(){function t(){!function(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}(this,t)}var n,r,o;return n=t,(r=[{key:"init",value:function(){var t=document.getElementById("error_alert"),e=document.getElementById("close_alert");e&&t&&(e.onclick=function(){t.style.display="none"})}}])&&e(n.prototype,r),o&&e(n,o),Object.defineProperty(n,"prototype",{writable:!1}),t}())).init()})();