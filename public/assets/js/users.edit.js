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
        bootstrapfilestyle: ['libs/bootstrap-filestyle.min'],
        cropper: ['libs/cropper.min']
    },
    shim: {
      	bootstrap: {
			deps: ["jquery"],
			exports: "jQuery.fn.popover"
		},
        bootstrapfilestyle: {
            deps: ["jquery"],
            exports: "jQuery.fn.popover"
        },
      	cropper: ['jquery']
    }
});

require([
			'jquery', 
			'bootstrap',
            'cropper',
            'bootstrapfilestyle'
		], function ($) {
	
	console.log("Loaded :)");


        $(function() {
            $(".img-container img").cropper({
                aspectRatio: 1,
                preview: ".img-preview",
                done: function(data) {
                    try {
                    val = JSON.stringify(data);
                    } catch (e) {
                        console.log(data);
                    }
                    $("#get-data-input").val(val);
                }
            });

        });
        $(".img-container img").cropper("enable");

    return {};
});