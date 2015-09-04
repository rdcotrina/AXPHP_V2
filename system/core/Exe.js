var Exe_ = Class.extend(function() {

    var _private = {};

    _private.root = function(m) {
        return 'app/' + m + '/views/js/';
    };

    _private.title = '';
    
    _private.breadcrumb = '';

    _private.jsArray = {};

    _private.jsArrayId = {};

    _private.createModel = function(scriptName,callback){
        var ex = scriptName.toLowerCase().search('controller');
        if(ex > 0){
            var scriptNameModel = scriptName.substr(0,scriptName.length - 10)+'Model';
            var scriptIddModel  = scriptNameModel.substr(scriptNameModel.lastIndexOf('/') + 1,150);
 
            _private.createScript(scriptIddModel, scriptNameModel, callback);
        }
    };
    
    _private.createScript = function(scriptIdd, scriptName, callback) {
        var scriptId = scriptIdd.replace(/\//g, ""); 
        var myRand   = parseInt(Math.random()*999999999999999);
        /*verificar si archivo existe*/
        var body = document.getElementsByTagName('body')[0];
        var script = document.createElement('script');
        script.type = 'text/javascript';
        script.id = 'script_' + scriptId;
        //script.async= true;
        script.src = scriptName + '.js?'+myRand;

        // then bind the event to the callback function
        // there are several events for cross browser compatibility
        //script.onreadystatechange = callback;
        script.onload = (callback !== undefined)?callback:null;

        body.appendChild(script);
        /*DESCOMENTAR CUANDO ESTE EN PRODUCCION*/
        $('#script_' + scriptId).remove();
        
    };

    _private.executeMain = function(scriptId) {
        /*verifico si existe la funcion para ejecutarla*/
        if (_private.jsArrayId[scriptId] !== undefined) {
            eval(_private.jsArrayId[scriptId] + '.main();');
        }
    };

    var _public = {};

    /*devuelve la raiz absoluta de la opcion*/
    _public.getRoot = function() {
        return _private.breadcrumb;
    };
    
    _public.getTitle = function() {
        return _private.title;
    };
    /*se ejecuta desde DB*/
    _public.run = function(scriptName, tthis) {
        var parent0 = $(tthis).parent().parent().parent().parent().parent().parent().parent().parent().parent().find('a').find('span').html();
        var parent1 = $(tthis).parent().parent().parent().parent().parent().parent().find('a').html();
        var parent2 = $(tthis).parent().parent().parent().find('a').html();

        _private.breadcrumb = parent0 + ' / ' + parent1+' / '+parent2+' / '+$(tthis).attr('title');
        _private.title = $(tthis).attr('title');


        var scriptId = scriptName;

        if (_private.jsArrayId[scriptId] === undefined) {
            _private.jsArrayId[scriptId] = scriptId;
        }

        scriptName = _private.root(scriptName) + scriptName;

        if (!_private.jsArray[scriptName]) {
            _private.jsArray[scriptName] = true;

            _private.createScript(scriptId, scriptName, function(){ _private.executeMain(scriptId); });
        } else if (_private.jsArray[scriptName]) {
            _private.executeMain(scriptId);
        }
    };

    /*para incluir archivos*/
    _public.require = function(requires,callback){
        if(requires instanceof Object === true){
            for(var i in requires){
                /*verificar si es un array*/
                if($.isArray(requires[i])){     /*cuando se requiere varios js de una opcion de APP*/
                    for(var x in requires[i]){
                        if (!_private.jsArray[requires[i][x]]) {
                            _private.jsArray[requires[i][x]] = true;
                            var scriptName = _private.root(i) + requires[i][x];
                            
                            _private.createScript(requires[i][x], scriptName,callback);
                        }
                    }
                }else{                          /*cuando se requiere un js de una opcion de APP*/
                    if (!_private.jsArray[requires[i]]) {
                        _private.jsArray[requires[i]] = true;
                        var scriptName = _private.root(i) + requires[i]; 

                        _private.createScript(requires[i], scriptName,callback);
                    }
                }

            }
        }else{  /*se envia la ruta*/
            if (!_private.jsArray[requires]) { 
                _private.jsArray[requires] = true;
                var scriptName = requires; 

                _private.createScript(requires, scriptName,callback);
            }
        }
        
    };
    
    _public.include = function(obj){
        var i = '\n\
        Exe.require({\n\
            '+obj.folder+': "'+obj.file+'View"\n\
        },function(){\n\
            Exe.require({\n\
                '+obj.folder+': "'+obj.file+'Script"\n\
            });\n\
        });';
        eval(i);
    };
    
    return _public;
    
}());
var Exe = new Exe_();