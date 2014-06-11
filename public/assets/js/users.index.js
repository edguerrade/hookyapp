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
        datatables: [
            '//cdn.datatables.net/1.10.0/js/jquery.dataTables'
        ],
        datatablesBT: [
            '//cdn.datatables.net/plug-ins/be7019ee387/integration/bootstrap/3/dataTables.bootstrap'
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
        datatables: {
            deps: ["jquery"],
            exports: "jQuery.fn.popover"
        },
        datatablesBT: {
            "deps": ['jquery', 'datatables', 'bootstrap']
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
            'datatables',  
			'lazyload', 
			'bootstrapfilestyle'
		], function ($) {
	
	console.log("Loaded :)");    
    
    //var oTable;
    $(document).ready(function() {
        
        $('#usertable').dataTable();
        /*$('#example').removeClass( 'display' )
        .addClass('table table-striped table-bordered');
        
        $('#example').dataTable( {
            "pagingType": "full_numbers",
            "processing": true,
            "serverSide": true,
            "ajax":  root+"/users/indexDt"
        });*/
        /*oTable = $('#example').dataTable( {
            "sPaginationType": "bootstrap",
            "bProcessing": true,
            "bServerSide": true,
            "ajax": root+"/users/indexDt",
        });*/
    });

    $(function() {
		$("img.lazy").lazyload();
	});
    
    return {};
});