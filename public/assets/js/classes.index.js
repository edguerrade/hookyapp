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
        selectize: ['libs/selectize.min']
    },
    shim: {
      	bootstrap: {
			deps: ["jquery"],
            selectize: ["jquery"],
			exports: "jQuery.fn.popover"
		}
    }
});

require([
			'jquery', 
			'bootstrap',
            'selectize'
		], function ($) {
	
	console.log("Loaded :)");    
    console.log(root);

    $(function () {
        $('.tree li:has(ul)').addClass('parent_li').find(' > span').attr('title', 'Collapse this branch');
        $('.tree li.parent_li > span').on('click', function (e) {
            var children = $(this).parent('li.parent_li').find(' > ul > li');
            if (children.is(":visible")) {
                children.hide('fast');
                $(this).attr('title', 'Expand this branch').addClass('glyphicon-plus-sign').removeClass('glyphicon-minus-sign');
            } else {
                children.show('fast');
                $(this).attr('title', 'Collapse this branch').addClass('glyphicon-minus-sign').removeClass('glyphicon-plus-sign');
            }
            e.stopPropagation();
        });
    });

    $(document).ready(function(){
        $('#searchbox').selectize({
            valueField: 'url',
            labelField: 'name',
            searchField: ['name', 'description'],
            maxOptions: 15,
            options: [],
            create: false,
            render: {
                option: function(item, escape) {
                    
                    return '<div>' +
                        (item.icon ? '<img src="'+ root +'/'+ item.icon +'" with="50" height="50" class="img-circle">' : '<span class="glyphicon glyphicon glyphicon-book"></span>') +
                        (item.name ? '<span class="name"><strong> ' + escape(item.name) + '</strong></span>' : '') +
                        // (item.email ? '<span class="email"> ' + escape(item.email) + '</span>' : '') +
                        (item.description ? '<br><span class="description">' + escape(item.description) + '</span>' : '') +
                    '</div>';
                }
            },
            optgroups: [
                {value: 'classe', label: 'Classes'},
                {value: 'tutorial', label: 'Tutorials'},
                {value: 'user', label: 'Users'}
            ],
            optgroupField: 'class',
            optgroupOrder: ['user','tutorial','classe'],
            load: function(query, callback) {
                if (!query.length) return callback();
                $.ajax({
                    url: root+'/api/search',
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        q: query
                    },
                    error: function() {
                        callback();
                    },
                    success: function(res) {
                        callback(res.data);
                    }
                });
            },
            onChange: function(){
                window.location = this.items[0];
            }
        });
    });
    
    return {};
});