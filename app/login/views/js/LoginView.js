Exe.require({login: 'LoginScript'});
var LoginView = Ajax.extend(function(){
    
    var _private = {};

    _private.config = {
        controller: 'login/Login/'
    };
    
    _private.usuario = '';
    
    _private.pass = '';
    
    _private.setAttributes = function(){
        _private.usuario = $('#txtUser').val();
        _private.pass    = $('#txtClave').val();
    };
    
    var _public = {};

    _public.init = function () {
        _public.parent = this; // el padre == Ajax
        _private.setAttributes();
    };
    
    _public.postLogin = function() {
        _public.parent.send({
            flag: 1,
            element: '#btnEntrar',
            root: _private.config.controller + _public.parent.__method__(this,2),
            fnServerParams: function(sData) {
                sData.push({name: '_user', value: _public.parent.stringPost(_private.usuario)});
                sData.push({name: '_clave', value: _public.parent.stringPost(_private.pass)});
            },
            fnCallback: function(data) {
                if (!isNaN(data.id_usuario) && data.id_usuario > 0 && localStorage.getItem('mainBodyHtml') === 'null') {
                    Tools.notify.ok({
                        content: lang.mensajes.MSG_2,
                        callback: function() {
                            Tools.redirect('index');
                        }
                    });
                }else if (!isNaN(data.id_usuario) && data.id_usuario > 0 && localStorage.getItem('mainBodyHtml') !== 'null') {
                    Tools.notify.ok({
                        content: lang.mensajes.MSG_2
                    });
                    /*se debloquea el sistema*/
                    IndexScript.unLockApp();
                }else {
                    Tools.notify.error({
                        content: lang.mensajes.MSG_1
                    });
                }
            }
        });
    };
    
    _public.postLogout = function() {
        _public.parent.send({
            root: _private.config.controller + 'logout',
            fnCallback: function(data) {
                if (!isNaN(data.result) && parseInt(data.result) === 1) {
                    Tools.notify.ok({
                        content: lang.mensajes.MSG_11
                    });
                    Tools.redirect('index');
                }
            }
        });
    };

    return _public;
    
    
    
}());

var Login = new LoginView();