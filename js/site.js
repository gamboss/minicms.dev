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
