/* Rounded corners Notifications */
function round_default_noti(message) {
	Lobibox.notify('default', {
		pauseDelayOnHover: true,
		size: 'normal',
		rounded: true,
		delayIndicator: false,
		continueDelayOnInactiveTab: false,
		position: 'top right',
		msg: message
	});
}

function round_info_noti(message) {
	Lobibox.notify('info', {
		pauseDelayOnHover: true,
		size: 'normal',
		rounded: true,
		icon: 'bx bx-info-circle',
		delayIndicator: false,
		continueDelayOnInactiveTab: false,
		position: 'top right',
		msg: message
	});
}

function round_warning_noti(message) {
	Lobibox.notify('warning', {
		pauseDelayOnHover: true,
		size: 'normal',
		rounded: true,
		delayIndicator: false,
		icon: 'bx bx-error',
		continueDelayOnInactiveTab: false,
		position: 'top right',
		msg: message
	});
}

function round_error_noti(message) {
	Lobibox.notify('error', {
		pauseDelayOnHover: true,
		size: 'normal',
		rounded: true,
		delayIndicator: false,
		icon: 'bx bx-x-circle',
		continueDelayOnInactiveTab: false,
		position: 'top right',
		msg: message
	});
}

function round_success_noti(message) {
	Lobibox.notify('success', {
		pauseDelayOnHover: true,
		size: 'normal',
		rounded: true,
		icon: 'bx bx-check-circle',
		delayIndicator: true,
		continueDelayOnInactiveTab: false,
		position: 'top right',
		msg: message,
	});
}