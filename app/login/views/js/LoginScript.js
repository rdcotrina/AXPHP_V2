var LoginScript = LoginView.extend(function(){
    
    var _private = {};

    var _public = {};
    
    _public.init = function () {
        _public.parent = this; // el padre == LoginView
    };
    
    return _public;
    
}());

var LoginScript = new LoginScript();

