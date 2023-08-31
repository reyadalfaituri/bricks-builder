// Dark Mode For Bricks Builder Design Sytem Child Theme
// Recodended to be loaded at the header

document.addEventListener('DOMContentLoaded', function() {
  // Create the cookie object
  var cookieStorage = {
    setCookie: function(key, value, time, path) {
      var expires = new Date();
      expires.setTime(expires.getTime() + time);
      var pathValue = '';
      if (typeof path !== 'undefined') {
        pathValue = 'path=' + path + ';';
      }
      document.cookie = key + '=' + value + ';' + pathValue + 'expires=' + expires.toUTCString();
    },
    getCookie: function(key) {
      var keyValue = document.cookie.match('(^|;) ?' + key + '=([^;]*)(;|$)');
      return keyValue ? keyValue[2] : null;
    },
    removeCookie: function(key) {
      document.cookie = key + '=; Max-Age=0; path=/';
    }
  };

  var darkModeToggle = document.querySelector('.gs_toggle_mode');

  function gs_toggle_mode_State() {
    darkModeToggle.classList.toggle('active');
    if (darkModeToggle.classList.contains('active')) {
      document.body.classList.add('dark-mode');
      cookieStorage.setCookie('gs_toggle_mode_state', 'true', 2628000000, '/');
    } else {
      document.body.classList.remove('dark-mode');
      setTimeout(function() {
        cookieStorage.removeCookie('gs_toggle_mode_state');
      }, 100);
    }
  }

  darkModeToggle.addEventListener('click', gs_toggle_mode_State);

  // Check Storage. Display user preference
  if (cookieStorage.getCookie('gs_toggle_mode_state')) {
    document.body.classList.add('dark-mode');
    darkModeToggle.classList.add('active');
  }
});

