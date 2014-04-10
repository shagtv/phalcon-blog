
var Profile = {
	check: function(id) {
		if ($.trim($("#" + id)[0].value) == '') {
			$("#" + id)[0].focus();
			$("#" + id + "_alert").show();

			return false;
		}
		;

		return true;
	},
	validate: function() {
		if (SignUp.check("name") == false) {
			return false;
		}
		if (SignUp.check("email") == false) {
			return false;
		}
		$("#profileForm")[0].submit();
	}
};

var SignUp = {
	check: function(id) {
		if ($.trim($("#" + id)[0].value) == '') {
			$("#" + id)[0].focus();
			$("#" + id + "_alert").show();

			return false;
		}
		;

		return true;
	},
	validate: function() {
		if (SignUp.check("name") == false) {
			return false;
		}
		if (SignUp.check("username") == false) {
			return false;
		}
		if (SignUp.check("email") == false) {
			return false;
		}
		if (SignUp.check("password") == false) {
			return false;
		}
		if ($("#password")[0].value != $("#repeatPassword")[0].value) {
			$("#repeatPassword")[0].focus();
			$("#repeatPassword_alert").show();

			return false;
		}
		$("#registerForm")[0].submit();
	}
}

$(function() {
	$("#registerForm .alert").hide();
	$("div.profile .alert").hide();

	var tooltips = $("[title]").tooltip();
	$("input[type=submit],input[type=button]")
			.button()
			.click(function(event) {
				if (this.hasAttribute('action')) {
					location.href = this.getAttribute('action');
				}
			});

	$('.fancybox').fancybox();

	$('#timestamp-converter').click(function() {
		var timestamp = parseInt($('#timestamp').val());
		if (timestamp) {
			var date = new Date(timestamp * 1000);
			var day = date.getDay() + 1;
			if (day < 10) {
				day = '0' + day;
			}
			var month = date.getMonth() + 1;
			if (month < 10) {
				month = '0' + month;
			}
			var minuts = date.getMinutes();
			if (minuts < 10) {
				minuts = '0' + minuts;
			}
			var seconds = date.getSeconds();
			if (seconds < 10) {
				seconds = '0' + seconds;
			}
			$('#datetime').val(day + '.' + month + '.' + date.getFullYear() + ' ' + date.getHours() + ':' + minuts + ':' + seconds);
		}
	});

	$('#timestamp-reset').click(function() {
		$('#timestamp').val('');
		$('#datetime').val('');
	});

});