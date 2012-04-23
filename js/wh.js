var MM = {
	version : '1.0.0',
	requiredPrototypeVersion : '1.6',
	debug : false
};


MM.doAjax = function(target, params, callback, method){
	methodz = (method) ? method : 'post'
	myAjax = new Ajax.Request(
	target, {
		method: methodz,
		parameters: params,
		onComplete: function(transport){
				if (MM.debug == true) {
					alert('target = ' + target + "\n"
						+ 'params = ' + params + "\n"
						+ 'method = ' + methodz + "\n"
						+ 'result = ' + transport.responseText.stripTags()
					)
				}
				callback(transport)
		}
	});
};

/**
 * MM.onDomReady - attach JavaScript events to elements
 * before the page completely loads, but instead right
 * after the DOM is ready.
 */
Object.extend(Event, {
	onReady : function(f) {
		if(document.body) f();
		else document.observe('dom:loaded', f);
	}
});

MM.onDomReady = function(func) { Event.onReady(func);};

MM.onDomReady($('.scroll-pane').jScrollPane();)