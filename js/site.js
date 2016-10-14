//Get data from json file
$.getJSON( "json/admin_list.json", function( data ) {

	var getData = [];
	$('#data').tmpl(data).appendTo('#adminList')
	for (var i = 0; i < data.length; i++) {
		getData = data[i].admin_name;
		/*if (test == 'admin') {
			alert('qwe');
		}*/
	}
		
})

//add admin button into modal form from index.php
$("#add_admin_form").submit(function(e) {
    var login = $('#admin_name').val();
	var password = $('#admin_password').val();

	data_request = 'postLogin=' + login + '&postPassword=' + password;
    $.ajax({
            type: 'POST',
            url: '/ajax.php',
            'data': data_request,
            success: function(res) {
                var r = JSON.parse(res);
                if (r.error == null) {
                    $('#msg').html(r.message);
                    $('#admin_name').val('');
                    $('#admin_password').val('')
                }
                else {
                    $('#msg').html(r.error);
                }
            },
            error:function(res) {
                  alert("Произошел сбой!");
            }
    });
    e.preventDefault();
});

//sign up button into form from manager.php
$(".form-auth").submit(function(e) {
    var auth_login = $('#auth_login').val();
    var auth_password = $('#auth_password').val();

    data_request = 'authLogin=' + auth_login + '&authPassword=' + auth_password;
    $.ajax({
            type: 'POST',
            url: '/auth_ajax.php',
            'data': data_request,
            success: function(res) {
                var r = JSON.parse(res);
                if (r.auth_error == null) {
                    window.location.href = "http://minicms.dev:1025/index.php";
                }
                else {
                    $('#msg').html(r.auth_error);
                }
            },
            error:function(res) {
                  alert("Произошел сбой!");
            }
    });
    e.preventDefault();
});

//add dynamic new partner form
$("#add_block_partner").click(function(e) {
    e.preventDefault();

    $('#counter').val(function(i, val) { return +val+1 });
    var count = $("#counter").val();

    $(".new_partners_block").append('<!— BEGIN of item —>');

    //form creator
    var a = '<form method="post" enctype="multipart/form-data" class="form_add_partner" id="block' + count +'">';
        var b = '<h3>Партнер' + ' ' + count + '</h3>';

        var c = '<div class="clear_fix">';
            var d = '<label for="company_name">Наименование компании</label>';
            var e = '<input type="text" maxlength="50" name="company_name" id="company_name" required="true">';
        var f = '</div>';

        var g = '<div class="clear_fix">';
            var h = '<label for="company_url">Ссылка на сайт компании</label>';
            var i = '<input type="text" name="company_url" id="company_url" required="true">';
        var j = '</div>';

        var k = '<div class="clear_fix">';
            var l = '<label for="upload_image">Загрузите логотип компании</label>';
            var m = '<input type="file" name="upload_image" id="upload_image" required="true">';
        var n = '</div>';

        var o = '<div id="msg"></div>';

        var p = '<div class="clear_fix">';
            var q = '<input type="submit" name="upload" value="Загрузить">';
        var r = '</div>';
    var s = '</form>';

    $(".new_partners_block").append(a + b + c + d + e + f + g + h + i + j + k + l + m + n + o + p + q + r + s);
    $(".new_partners_block").append('<input type="submit" name="delete_block" id="delete_block' + count +'" value="Удалить">');
    $(".new_partners_block").append('<!— END of item —>');

    $('.new_partners_block').on('click', "#delete_block" + count, function() {
        $('#block' + count).remove();
        $('#delete_block' + count).remove();
    }); 
});
