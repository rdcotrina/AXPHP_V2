var IndexScript = IndexView.extend(function(){
    
    var _private = {};

    var _public = {};
    
    _public.init = function () {
        _public.parent = this; // el padre == IndexView
    };
    
    _public.setApp = function(data){
        /*se verifica si navegador soorta Storage*/
        if(typeof(Storage) !== "undefined") {
            /*se guarda contenido de app*/
            localStorage.setItem("mainBodyHtml", $('#mainBodyHtml').html());
        } else {
            alert('Su navegador es antiguo...!');
        }

        $('#mainBodyHtml').html(data);
        $(document).off('mousemove');
    };
    
    _public.unLockApp = function(){
        $('#mainBodyHtml').html(localStorage.getItem('mainBodyHtml'));
        localStorage.setItem('mainBodyHtml',null);
    };
    
    return _public;
    
}());
var IndexScript = new IndexScript();