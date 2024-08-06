/******/ (() => { // webpackBootstrap
/*!*********************************************************!*\
  !*** ./platform/themes/flex-home/assets/js/wishlist.js ***!
  \*********************************************************/
;
(function ($) {
  'use strict';

  var __ = function __(key) {
    window.trans = window.trans || {};
    return window.trans[key] !== 'undefined' && window.trans[key] ? window.trans[key] : key;
  };
  $(document).ready(function () {
    setWishListCount();
    $(document).on('click', '.add-to-wishlist', function (e) {
      e.preventDefault();
      var currentTarget = $(e.currentTarget);
      var cookieName = currentTarget.data('type') === 'property' ? 'wishlist' : 'project_wishlist';
      var id = currentTarget.data('id');
      var wishCookies = decodeURIComponent(getCookie(cookieName));
      var arrWList = [];
      if (id != null && id !== 0 && id !== undefined) {
        // Case 1: Wishlist cookies are undefined
        if (wishCookies === undefined || wishCookies == null || wishCookies === '') {
          arrWList.push({
            id: id
          });
          currentTarget.find('i').removeClass('far fa-heart').addClass('fas fa-heart');
          Theme.showSuccess(__('Added to wishlist successfully!'));
          setCookie(cookieName, JSON.stringify(arrWList), 60);
        } else {
          var item = {
            id: id
          };
          arrWList = JSON.parse(wishCookies);
          var index = arrWList.map(function (e) {
            return e.id;
          }).indexOf(item.id);
          if (index === -1) {
            arrWList.push(item);
            clearCookies(cookieName);
            setCookie(cookieName, JSON.stringify(arrWList), 60);
            currentTarget.find('i').removeClass('far fa-heart').addClass('fas fa-heart');
            Theme.showSuccess(__('Added to wishlist successfully!'));
          } else {
            arrWList.splice(index, 1);
            clearCookies(cookieName);
            setCookie(cookieName, JSON.stringify(arrWList), 60);
            currentTarget.find('i').removeClass('fas fa-heart').addClass('far fa-heart');
            Theme.showSuccess(__('Removed from wishlist successfully!'));
          }
        }
      }
      var countWishlist = JSON.parse(getCookie(cookieName)).length;
      $('.wishlist-count').text(countWishlist);
      setWishListCount();
    });
    function setWishListCount() {
      var propertyCookieName = 'wishlist';
      var projectCookieName = 'project_wishlist';
      var propertyWishListCookies = JSON.parse(decodeURIComponent(getCookie(propertyCookieName)) || '[]');
      var projectWishListCookies = JSON.parse(decodeURIComponent(getCookie(projectCookieName)) || '[]');
      $('.wishlist-count').text(propertyWishListCookies.length + projectWishListCookies.length);
      if (!!propertyWishListCookies) {
        propertyWishListCookies.map(function (item) {
          $(".add-to-wishlist[data-type=\"property\"][data-id=\"".concat(item.id, "\"]")).find('i').removeClass('far fa-heart').addClass('fas fa-heart');
        });
      }
      if (!!projectWishListCookies) {
        projectWishListCookies.map(function (item) {
          $(".add-to-wishlist[data-type=\"project\"][data-id=\"".concat(item.id, "\"]")).find('i').removeClass('far fa-heart').addClass('fas fa-heart');
        });
      }
    }
    function setCookie(cname, cvalue, exdays) {
      var d = new Date();
      var siteUrl = window.siteUrl;
      if (!siteUrl.includes(window.location.protocol)) {
        siteUrl = window.location.protocol + siteUrl;
      }
      var url = new URL(siteUrl);
      d.setTime(d.getTime() + exdays * 24 * 60 * 60 * 1000);
      var expires = 'expires=' + d.toUTCString();
      document.cookie = cname + '=' + cvalue + '; ' + expires + '; path=/' + '; domain=' + url.hostname;
    }
    function getCookie(cname) {
      var name = cname + '=';
      var ca = document.cookie.split(';');
      for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
          c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
          return c.substring(name.length, c.length);
        }
      }
      return '';
    }
    function clearCookies(name) {
      var siteUrl = window.siteUrl;
      if (!siteUrl.includes(window.location.protocol)) {
        siteUrl = window.location.protocol + siteUrl;
      }
      var url = new URL(siteUrl);
      document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:01 GMT; path=/' + '; domain=' + url.hostname;
    }
  });
})(jQuery);
/******/ })()
;