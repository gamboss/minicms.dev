$.getJSON( "json/admin_list.json", function( data ) {

	var getData = [];
	$('#data').tmpl(data).appendTo('#adminList')
	for (var i = 0; i < data.length; i++) {
		getData = data[i].admin_name;
/*		if (test == 'admin') {
			alert('qwe');
		}*/
	}
		
})

//$(".modal-body form").submit(function(e) {
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
