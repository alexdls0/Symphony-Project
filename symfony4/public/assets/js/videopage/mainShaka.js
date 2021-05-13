//General AJAX

var video, ui, player, controls, config;

//Gets stored time on player load
function sgetSavedTime() {
	genericAjax('/ajax/video/videotime', { 'vid': vid }, 'get', function(json) {
		if (json.tiempo) {
			player.getMediaElement().currentTime = json.tiempo;
		}
	});
}

//Updates stored time periodically
function sstoreTime() {

	if (vid > 0) {
		//Gets current media duration
		var currentSec = player.getMediaElement().currentTime;
		//Gets total media duration
		var totalSec = player.getMediaElement().duration;

		var params = {
			'vid': vid,
			'current': currentSec,
			'total': totalSec
		}
		genericAjax('/ajax/video/savevideotime', params, 'get', function(json) {
			if (json.status == true) {
				console.log('Capsule video player:', 'Saved video position');
			}
		});
	}

}

function activateInterval() {
	var storeInverval = setInterval(sstoreTime, 10000);
};

async function init() {
	// When using the UI, the player is made automatically by the UI object.
	video = document.getElementById('thevideo');
	ui = video['ui'];
	player = ui.getPlayer();
	controls = ui.getControls();
	config = {
		controlPanelElements: [
			'play_pause',
			'mute',
			'volume',
			'spacer',
			'time_and_duration',
			'overflow_menu',
			'fullscreen'
		],
		overflowMenuButtons: [
			'quality',
			'language',
			'captions',
			'picture_in_picture'
		]
	};
	ui.configure(config);

	// Listen for error events.
	player.addEventListener('error', onPlayerErrorEvent);
	controls.addEventListener('error', onUIErrorEvent);

	// Audio language.
	player.configure('preferredAudioLanguage', userLang);

	// Try to load a manifest.
	try {
		await player.load(manifestUri);
		// This runs if the asynchronous load is successful.
		console.log('The video has now been loaded!');
		//player.getMediaElement().play();
		sgetSavedTime();
		activateInterval();
	}
	catch (error) {
		onPlayerError(error);
	}
}

function onPlayerErrorEvent(event) {
	// Extract the shaka.util.Error object from the event.
	onPlayerError(event.detail);
}

function onPlayerError(error) {
	// Handle player error
	console.log(error);
}

function onUIErrorEvent(error) {
	// Handle UI error
	console.log(error);
}

function initFailed() {
	// Handle the failure to load
	console.log('Load failed');
}

// Listen to the custom shaka-ui-loaded event, to wait until the UI is loaded.
document.addEventListener('shaka-ui-loaded', initApp);
// Listen to the custom shaka-ui-load-failed event, in case Shaka Player fails
// to load (e.g. due to lack of browser support).
document.addEventListener('shaka-ui-load-failed', initFailed);

function initApp() {
	// Install built-in polyfills to patch browser incompatibilities.
	shaka.polyfill.installAll();

	// Check to see if the browser supports the basic APIs Shaka needs.
	if (shaka.Player.isBrowserSupported()) { // Everything looks good!
		init();
	}
	else { // This browser does not have the minimum set of APIs we need.
		console.error('Browser not supported!');
	}
}
