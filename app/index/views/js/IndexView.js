Exe.require({index: 'IndexScript'});
var IndexView = Ajax.extend(function(){
    
    var _private = {};

    _private.config = {
        controller: 'index/Index/'
    };
    
    var _public = {};

    _public.init = function () {
        _public.parent = this; // el padre == Ajax
    };
    
    _public.potChangeRol = function(idRol) {
        _public.parent.send({
            gifProcess: true,
            root: _private.config.controller + 'changeRol',
            fnServerParams: function(sData) {
                sData.push({name: '_idRol', value: idRol});
            },
            fnCallback: function() {
                Tools.redirect('index');
            }
        });
    };
    
    _public.inactividad = function() {
        _public.parent.send({
            dataType: 'html',
            gifProcess: true,
            root: _private.config.controller + 'lock',
            fnCallback: function(data) {
                Index.setApp(data);                
            }
        });
    };
    
    return _public;
    
}());

var Index = new IndexView();

//Index.inactividad()