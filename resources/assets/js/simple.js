_App = (function() {
  _onLoaded = function () {
      alert('Hello Word');
  }

  return {
    _onLoaded: _onLoaded
  }
})();

_App._onLoaded();
