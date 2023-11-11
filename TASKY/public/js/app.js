function showAlert(ref, msg, time=1000, type) {
	const divAlert = document.createElement('div');
	divAlert.classList.add('alert', 'my-3')


	if (type === 'danger') {
		divAlert.classList.add('alert-danger');
		divAlert.textContent = msg;

		document.querySelector(ref).appendChild(divAlert);

		setTimeout(() => {
			divAlert.remove();
		}, time);

		return;
	}

	divAlert.classList.add('alert-success');
	divAlert.textContent = msg;

	document.querySelector(ref).appendChild(divAlert);

	setTimeout(() => {
		divAlert.remove();
	}, time);
}
function redirect(url, time) {
	setTimeout(() => {
		window.location.href = url;
	}, time);
}