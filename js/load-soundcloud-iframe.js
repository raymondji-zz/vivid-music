var numTracks;
var songLoaded;

/*Variables to hold iframes for soundcloud tracks*/
var currentSong;
var nextSong;
var prevSong;

/*Variable to hold affected location*/
var targetLocation;

/*Variables to hold info about the currently playing track*/  
var currentId;
var currentTrackNum;
var currentSongLink;

/*Variables to hold HTML structures*/
var readCurrentButton;
var playNextButton;
var playPrevButton;
var musicPlayer;

/*Arrays to store data from posts*/
var postIdList = [];
var postLinkList = [];
var postSCList = "";


function readOrNot() {
	songLoaded = true;
	if (songLoaded) {
		readCurrentButton.style.color = "";
		readCurrentButton.style.cursor = "pointer";
	}
}

function playCurrent() {
	currentId = this.dataset.currentPostId;
	currentSong = this.dataset.currentSoundcloud;
	targetLocation.innerHTML = currentSong;	

	for (var i = 0; i < postIdList.length; i++) {
		if (postIdList[i] == currentId) {
			currentTrackNum = i;
			break;
		}
	}

	readOrNot();
	updateMusicButtons();
}

function playNext() {
	targetLocation.innerHTML = nextSong;
	if (currentTrackNum < numTracks) {
		currentTrackNum ++;
	}
	else {
		currentTrackNum = 0;
	}
	
	readOrNot();
	updateMusicButtons();
}


function playPrevious() {
	targetLocation.innerHTML = prevSong;	
	/*Update current track data*/
	if (currentTrackNum > 0) {
		currentTrackNum --;
	}
	else {
		currentTrackNum = numTracks;
	}

	readOrNot();
	updateMusicButtons();
}

function updateMusicButtons() {
	/*Update previous and next songs*/
	if (currentTrackNum > 0) {
		prevSong = postSCList[currentTrackNum - 1];
	}
	else {
		prevSong = postSCList[numTracks];
	}
	if (currentTrackNum < numTracks) {
		nextSong = postSCList[currentTrackNum + 1];
	}
	else {
		nextSong = postSCList[0];
	}
	currentSongLink = postLinkList[currentTrackNum];
	readCurrentButton.href = postLinkList[currentTrackNum];
}

jQuery(document).ready(init);

function init() {
	songLoaded = false;
	currentTrackNum = -1;
	currentId = "";
	targetLocation = document.getElementById('load-sc-iframe');

	/*Initialize HTML Structures*/
	readCurrentButton = document.getElementById('read-current');
	musicPlayer = document.getElementById('music-player');
	playPrevButton = document.getElementById('play-prev');
	playNextButton = document.getElementById('play-next');

	/*Initialize data arrays*/
	var str = musicPlayer.dataset.postLinks;
	str = str.substring(0, str.length - 1);
	postLinkList = str.split(",");

	str = musicPlayer.dataset.postSoundclouds;
	str = str.substring(0, str.length - 1);
	postSCList = str.split(",");

	str = musicPlayer.dataset.postIds;
	str = str.substring(0, str.length - 1);
	postIdList = str.split(",");

	numTracks = postSCList.length - 1;
	readCurrentButton.style.color = "#eee";
	readCurrentButton.style.cursor = "default";

	/*Initialize iframe containers*/
	nextSong = postSCList[currentTrackNum + 1];
	prevSong = postSCList[numTracks];

	/*Deleguate event listeners*/
	jQuery( "body" ).on( 'click',  'button.sc-iframe-link', playCurrent);
	jQuery( "body" ).on( 'click', 'button#play-prev', playPrevious);
	jQuery( "body" ).on( 'click', 'button#play-next', playNext);
}