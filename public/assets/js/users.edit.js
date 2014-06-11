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
        icheck: [
            '//cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.1/icheck.min',
            'libs/icheck.min'
        ],
        bootstrapfilestyle: ['libs/bootstrap-filestyle.min'],
        cropper: ['libs/cropper.min']
    },
    shim: {
      	bootstrap: {
			deps: ["jquery"],
			exports: "jQuery.fn.popover"
		},
        icheck: {
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
            'icheck',
            'cropper',
            'bootstrapfilestyle'
		], function ($) {
	
	console.log("Loaded :)");

    $(document).ready(function(){  

        $('input.input-blue').iCheck({
            /*labelHover: false,
            cursor: true,*/
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%'
        });

        $('input.input-green').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
            increaseArea: '20%'
        });

        $('input.input-grey').iCheck({
            checkboxClass: 'icheckbox_square-grey',
            radioClass: 'iradio_square-grey',
            increaseArea: '20%'
        });

        $('input.input-red').iCheck({
            checkboxClass: 'icheckbox_square-red',
            radioClass: 'iradio_square-red',
            increaseArea: '20%'
        });
    
    });
    
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