requirejs.config({
    enforceDefine: true,
    paths: {
        jquery: [
            '//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min',
            'libs/jquery.min'
        ],
        bootstrap: [
            '//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min',
            'libs/bootstrap.min'
        ],
        lazyload: [
            '//cdnjs.cloudflare.com/ajax/libs/jquery.lazyload/1.9.1/jquery.lazyload.min',
            'libs/jquery.lazyload.min'
        ],
        bootstrapfilestyle: ['libs/bootstrap-filestyle.min']
    },
    shim: {
      	bootstrap: {
			deps: ["jquery"],
			exports: "jQuery.fn.popover"
		},
      	lazyload: {
			deps: ["jquery"],
			exports: "jQuery.fn.popover"
		},
        bootstrapfilestyle: {
            deps: ["jquery"],
            exports: "jQuery.fn.popover"
        }
    }
});

require([
			'jquery', 
			'bootstrap',  
			'lazyload', 
			'bootstrapfilestyle'
		], function ($) {
	
	console.log("Loaded :)");    
    
    $(function() {
		$("img.lazy").lazyload();
	});
    
    return {};
});