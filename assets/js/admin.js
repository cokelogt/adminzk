
function loadContent(url, li) {
	if (url == null) {
		$.ajax({
			url: 'modulos/home/home.php',
			success: function (data) {
				$('#root').html(data)
			}
		})
	} else {
		$.ajax({
			url: url,
			success: function (data) {
				$('#root').html(data);
				$('.linkmenu').removeClass('active');
				$('#'+li).addClass('active')
			}
		})
	}
}
loadContent();

function startTime() {
	var today = new Date();
	var hr = today.getHours();
	var min = today.getMinutes();
	var sec = today.getSeconds();
	ap = (hr < 12) ? "<span>AM</span>" : "<span>PM</span>";
	hr = (hr == 0) ? 12 : hr;
	hr = (hr > 12) ? hr - 12 : hr;
	//Add a zero in front of numbers<10
	hr = checkTime(hr);
	min = checkTime(min);
	sec = checkTime(sec);
	document.getElementById("clock").innerHTML = hr + ":" + min + ":" + sec + " " + ap;

	var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
	var days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
	var curWeekDay = days[today.getDay()];
	var curDay = today.getDate();
	var curMonth = months[today.getMonth()];
	var curYear = today.getFullYear();
	var date = curWeekDay+", "+curDay+" "+curMonth+" "+curYear;
	document.getElementById("date").innerHTML = date;

	var time = setTimeout(function(){ startTime() }, 500);
}
function checkTime(i) {
	if (i < 10) {
		i = "0" + i;
	}
	return i;
}

function sweetModal(url, wd, fc, fin, fout) {
	$.ajax({
		url: url,
		success: function (data) {
			Swal.fire({
				title: name,
				showConfirmButton: false,
				html: data,
				showCloseButton: true,
				width: wd,
				backdrop: false,
				background: '#1f1f1f',
				showClass: {
					popup: 'animate__animated ' + fin + ' animate__faster'
				},
				hideClass: {
					popup: 'animate__animated ' + fout + ' animate_faster'
				}
			});
			$('#' + fc).focus();
		}
	})
}

function sleep(ms) {
	return new Promise(resolve => setTimeout(resolve, ms));
}

function listAttendance() {
	$.ajax({
		url: 'modulos/control/pages.php?p=lista&fecha=' + $('#last_fecha').val() + '&leg=' + $('#l_legajo').val(),
		success: function (data) {
			$('#list_fichero').html(data)
		}
	})
}
function actualizar_fich() {
		Swal.fire({
				title: 'Update Attendance',
				html: '<center>Continuamos???</center>',
				showCancelButton: true,
				confirmButtonText: 'Si, Update',
				cancelButtonText: 'No, Later',
				showLoaderOnConfirm: true,
				width: 380,
				background: '#1f1f1f',
				backdrop: false,
				preConfirm: () => {
						return fetch('modulos/control/update.php')
								.then(response => {
										return response.json()
								})
				},
				allowOutsideClick: () => !Swal.isLoading()
		}).then((result) => {
				if (result.value.dif > 0) {

						Swal.fire({
								title: result.value.dif + " Rows Updated",
								background: '#3d3d3d',
								backdrop: false,
								icon: 'success',
								showCancelButton: false,
								confirmButtonColor: '#3085d6',
								confirmButtonText: 'Close'

						}).then((result) => {
								if (result.isConfirmed) {
										listAttendance();

								}
						})
				} else {
						Swal.fire({
								title: "No New Records",
								icon: "warning",
								background: '#3d3d3d',
								backdrop: false,
						})
				}
		})
}

function validIp(id) {
	const element = document.getElementById(id);
	const patronIp = new RegExp(/^(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$/gm);
	if (element.value.search(patronIp) == 0) {
		element.style.color = "#000";
	} else {
		element.style.color = "#f00";
	}
}