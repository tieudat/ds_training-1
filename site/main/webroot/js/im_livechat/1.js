
            

            
                document.addEventListener("DOMContentLoaded", function(event) {
                    
                    odoo.define('web.session', function (require) {
                        var Session = require('web.Session');
                        var modules = odoo._modules;
                        return new Session(undefined, "http://erp2019.daisangroup.vn", {modules:modules, use_cors: false});
                    });
                    

                    odoo.define('im_livechat.livesupport', function (require) {
            
                        var rootWidget = require('root.widget');
                        var im_livechat = require('im_livechat.im_livechat');
                        var button = new im_livechat.LivechatButton(
                            rootWidget,
                            "http://erp2019.daisangroup.vn",
                            {"button_text": "C\u00f3 c\u00e2u h\u1ecfi? H\u00e3y ch\u00e1t v\u1edbi ch\u00fang t\u00f4i.", "input_placeholder": false, "channel_id": 1, "channel_name": "daisan.vn", "default_username": "Kh\u00e1ch", "default_message": "Xin ch\u00e0o, T\u00f4i gi\u00fap g\u00ec \u0111\u01b0\u1ee3c cho b\u1ea1n?"}
                        );
                        button.appendTo($('body'));
                        window.livechat_button = button;
            
                    });
                });
            
        