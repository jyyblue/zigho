(()=>{function t(e){return t="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t},t(e)}function e(t,e){for(var n=0;n<e.length;n++){var o=e[n];o.enumerable=o.enumerable||!1,o.configurable=!0,"value"in o&&(o.writable=!0),Object.defineProperty(t,r(o.key),o)}}function n(t,e,n){return(e=r(e))in t?Object.defineProperty(t,e,{value:n,enumerable:!0,configurable:!0,writable:!0}):t[e]=n,t}function r(e){var n=function(e,n){if("object"!==t(e)||null===e)return e;var r=e[Symbol.toPrimitive];if(void 0!==r){var o=r.call(e,n||"default");if("object"!==t(o))return o;throw new TypeError("@@toPrimitive must return a primitive value.")}return("string"===n?String:Number)(e)}(e,"string");return"symbol"===t(n)?n:String(n)}var o=function(){function t(){var e=this;!function(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}(this,t),n(this,"isDownloading",!1),n(this,"$wrapper",$(".project-import")),this.$wrapper.on("submit","#project-import-form",(function(t){e.submit(t)})).on("click",".download-template",(function(t){e.download(t)}))}var r,o,a;return r=t,(o=[{key:"submit",value:function(t){t.preventDefault();var e=$(t.currentTarget),n=new FormData(e.get(0)),r=e.find("button[type=submit]"),o=this.$wrapper.find("#failures-list"),a=this.$wrapper.find(".alert");$.ajax({url:e.attr("action"),type:e.attr("method"),data:n,processData:!1,contentType:!1,dataType:"json",beforeSend:function(){r.prop("disabled",!0).addClass("button-loading"),a.hide(),o.hide(),o.find("tbody").html("")},success:function(t){if(a.show(),t.error){Botble.showError(t.message);var n="";_.map(t.data,(function(t){n+="<tr>\n                            <td>".concat(t.row,"</td>\n                            <td>").concat(t.attribute,"</td>\n                            <td>").concat(t.errors.join(", "),"</td>\n                        </tr>")})),o.show(),o.find("tbody").html(n),a.removeClass("alert-success").addClass("alert-danger").html(t.message)}else a.removeClass("alert-danger").addClass("alert-success").html(t.data.message),Botble.showSuccess(t.message);e.get(0).reset()},error:function(t){Botble.handleError(t)},complete:function(){r.prop("disabled",!1),r.removeClass("button-loading")}})}},{key:"download",value:function(t){var e=this;if(t.preventDefault(),!this.isDownloading){var n=$(t.currentTarget),r=n.data("extension"),o=n.html();$.ajax({url:n.data("url"),method:"POST",data:{extension:r},xhrFields:{responseType:"blob"},beforeSend:function(){n.html(n.data("downloading")),n.addClass("text-secondary"),e.isDownloading=!0},success:function(t){var e=document.createElement("a"),r=window.URL.createObjectURL(t);e.href=r,e.download=n.data("filename"),document.body.append(e),e.click(),e.remove(),window.URL.revokeObjectURL(r)},error:function(t){Botble.handleError(t)},complete:function(){setTimeout((function(){n.html(o),n.removeClass("text-secondary"),e.isDownloading=!1}),500)}})}}}])&&e(r.prototype,o),a&&e(r,a),Object.defineProperty(r,"prototype",{writable:!1}),t}();$((function(){return new o}))})();