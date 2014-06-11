requirejs.config({
    enforceDefine: true,
    paths: {
        jquery: [
            '//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min',
            'libs/jquery.min'
        ],
        /*jqueryui: [
            '//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min',
            'libs/jquery.min'
        ],*/
        bootstrap: [
            '//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min',
            'libs/bootstrap.min'
        ],
        fullcalendar: [
            '//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.0.0/fullcalendar.min',
            'libs/fullcalendar.min'
        ],
        moment: [
            '//cdnjs.cloudflare.com/ajax/libs/moment.js/2.6.0/moment.min',
            'libs/moment.min'
        ],
        lazyload: [
            '//cdnjs.cloudflare.com/ajax/libs/jquery.lazyload/1.9.1/jquery.lazyload.min',
            'libs/jquery.lazyload.min'
        ],
        cropper: ['libs/cropper.min']
    },
    shim: {
      	/*jqueryui: ['jquery'],*/
      	bootstrap: {
			deps: ["jquery"],
			exports: "jQuery.fn.popover"
		},
      	fullcalendar: ['jquery'],
      	lazyload: {
			deps: ["jquery"],
			exports: "jQuery.fn.popover"
		},
      	cropper: ['jquery']
    }
});

require([
			'jquery', 
			'bootstrap', 
			'fullcalendar', 
			'moment', 
			'lazyload', 
			'cropper'
		], function ($) {
	
	console.log("Loaded :)");    
    
    return {};
});