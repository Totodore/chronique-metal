// get all HTML file in folder:
// find . -type f -name '*.html' -print

this.wimpyConfigs = this.wimpyConfigs || {}
this.wimpyConfigs.assetsPath = "../";

var pages = [
	 "index.html"
, "API-quick-reference.html"
, "amazon-s3.html"
, "api-addListener.html"
, "api-appendPlaylist-1.html"
, "api-appendPlaylist-2.html"
, "api-appendPlaylist-3.html"
, "api-downloadHandler.html"
, "api-enableControls-and-disableControls.html"
, "api-getPlaying.html"
, "api-getPlaylist.html"
, "api-getStatus.html"
, "api-linkHandler-alt.html"
, "api-linkHandler.html"
, "api-onReady-1.html"
, "api-onReady-2-option.html"
, "api-onReady-3-args.html"
, "api-onReady-4-global-wimpy.html"
, "api-removePlaylistItems.html"
, "api-setAnimate.html"
, "api-setPlaylist.html"
, "api-setSkin-1.html"
, "api-setSkin-2.html"
, "button-api-getButton.html"
, "button-api-pause-rewind.html"
, "button-api-play-pause-stop.html"
, "button-api-setMedia.html"
, "button-api-setSize.html"
, "button-api-setVolume.html"
, "button-css-image.html"
, "button-elements.html"
, "button-limit.html"
, "button-list.html"
, "button-loop.html"
, "button-multi-styles.html"
, "button-onClick.html"
, "button-simple.html"
, "button-text-via-css.html"
, "button-text-via-option.html"
, "button-width-height.html"
, "coverart-logic.html"
, "encrypted-filenames.html"
, "eq1.html"
, "eq2.html"
, "fake-eq.html"
, "fullscreen-button.html"
, "fullscreen-web-app.html"
, "iframe-test.html"
, "inchworm.html"
, "media-flac.html"
, "media-playlist-embedded-json.html"
, "media-playlist-simple.html"
, "media-podcast-opml.html"
, "media-podcast.html"
, "media-single-file-WAV.html"
, "media-single-file.html"
, "multiple-players-4.html"
, "multiple-players-ALL.html"
, "new-wimpyplayer-direct-to-body.html"
, "new-wimpyplayer-target.html"
, "option-autoAdvance-disabled.html"
, "option-autoPlay.html"
, "option-coverArt.html"
, "option-disableControls.html"
, "option-disableFlash.html"
, "option-downloadEnable-via-option.html"
, "option-downloadEnable-via-playlist.html"
, "option-getid3.html"
, "option-glyphs.html"
, "option-id.html"
, "option-infoFormat.html"
, "option-infoScroll.html"
, "option-infoSpeed.html"
, "option-inline.html"
, "option-limitPlaytime.html"
, "option-linkEnable-via-option.html"
, "option-linkEnable-via-playlist.html"
, "option-loop-off.html"
, "option-loop-one-fullscreen.html"
, "option-loop-one.html"
, "option-loop-playlist.html"
, "option-numberTracks.html"
, "option-playlist-tooltip.html"
, "option-plugFirst.html"
, "option-plugPlaylist.html"
, "option-random.html"
, "option-responsive-1.html"
, "option-responsive-2.html"
, "option-responsive-size-1.html"
, "option-responsive-size-2.html"
, "option-responsive-size-fullscreen.html"
, "option-sort-easy-view.html"
, "option-sort.html"
, "option-speed.html"
, "option-startOnTrack.html"
, "option-startUpText.html"
, "option-timeFormat.html"
, "option-volume.html"
, "option-width-height-css.html"
, "option-width-height.html"
, "player-centering.html"
, "player-position-fixed.html"
, "playlist-in-playlist.html"
, "playlist-javascript.html"
, "playlist-json-p.html"
, "playlist-json.html"
, "playlist-txt.html"
, "playlist-xml.html"
, "restore-position.html"
, "scroll-text.html"
, "search1.html"
, "search2.html"
, "tricks-embedded-skin.html"
, "tricks-extra-data.html"
, "tricks-play-from-external-button.html"
, "tricks-playlist-interaction.html"
, "tricks-rating.html"
, "tricks-search-2.html"
, "tricks-search.html"
, "tricks-social-media-buttons.html"
, "tricks-stop-all-players.html"
, "width-height-change-directly.html"
, "width-height-with-responsive.html"
, "wimpy.php-api.html"
, "wimpyCssPlayer1.html"
, "wimpyCssPlayer2.html"
, "wimpyCssPlayer3.html"
, "wimpyCssPlayer4.html"
];




function highlight(el){
	//var elems = document.links;
	var elems = document.querySelectorAll('a');
	
	for(var i=0; i<elems.length; i++){
		elems[i].parentNode.className = "list notActive";
	}
	
	el.parentNode.className = "list amActive";

}

function pageReady(){
	window.writeMenu();
	writePageCode();
}

function writePageCode(){
	var elem = document.getElementById("pageWrapper");
	if(elem){
		var output = trim(unescape(elem.innerHTML));

		output = output.replace(/\=\"\"/g, "");
		
		output = output.replace(/\&#10;/g, "\n");
		output = output.replace(/\&#9;/g, "\t");
		
		
		
		output = output.replace(/<p>&nbsp;<\/p>/g, "");
		output = output.replace(/&quot;/g, '"');
		
		//JSON need doubl quotes, but browser &apos; '  
		// single quotes thereby making output render bad code.
		//
		// Starts with brackets
		output = output.replace(/\=\"\[/g, "='[");
		output = output.replace(/\]\"/g, "]'");
		//
		// Starts with curly brackets
		output = output.replace(/\=\"\{/g, "='{");
		output = output.replace(/\}\"/g, "}'");
		
		// Replace any players created with new wimpyPlayer
		output = output.replace(/\<\/script\>\<div[\s\S]+(\<\/div\>)/gm, "\<\/script\>");
		
	
		output = output.replace(/\<\!\-\- Description [\s\S]+/gm, "");
	
		output = trim(output);
		//output = output.replace('</p><p>&nbsp;</p><p>', "");
	
		// Prepare for pretty printing
		output = output.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');

		// Prettify
		if(window.prettyPrintOne){
			output = window.prettyPrintOne(output, null, true);
		}
	
		// Inject new code
		var preTag = document.createElement("pre");
		preTag.className = "prettyprint lang-html";
		preTag.innerHTML = output;
	
		elem.appendChild(preTag);
	}
	
	
}

var core_trim = String.prototype.trim;

// Following from jquery
// Make sure we trim BOM and NBSP (here's looking at you, Safari 5.0 and IE)
var rtrim = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g;

// Use native String.trim function wherever possible
var trim = core_trim && !core_trim.call("\uFEFF\xA0") ? 
	
		function( text ) {
			return text == null ? "" : core_trim.call( text );
		} :

		// Otherwise use our own trimming functionality
		function( text ) {
			return text == null ? "" : ( text + "" ).replace( rtrim, "" );
		};

function writeMenu(){
	
	var menu = document.getElementById("mainMenu");
	
	if(menu){
		var loc = window.location.href;
		var Aloc = loc.replace("\\", "/").split("/");
		var thisPage = Aloc.pop();

		var activeElementID = null;
		var html = '<p class="list"><a href="http://www.wimpyplayer.com"><strong>www.wimpyplayer.com</strong></a></p>';
		for(var i=0; i<pages.length;  i++){
			var item = pages[i];
			var itemID = "i" + i;
			var active = " notActive";
			if(item == thisPage){
				active = " amActive";
				activeElementID = itemID;
			}
		
		
			html += '<p class="list' + active + '"><a id="' + itemID + '" href="' + item + '" onclick="highlight(this)">' + item + '</a></p>' + "\n";
		}
	
	
		menu.innerHTML = html;
	
		if(activeElementID){
			var el = document.getElementById(activeElementID);
		    el.scrollIntoView(true);
		}
	}
	
}


// -----------------------------
// Display object to page
// -----------------------------
var objIterations = 0;
var objIterationsMax = 50;
function processObject(obj){
	objIterations++;
	var out = "";
	for (var prop in obj){
		var item = obj[prop];
		if(typeof item == 'object'){
			if(objIterations > objIterationsMax){
				return out;
			} else {
				out += processObject(item) + "<br>";
			}
		} else {
			out += prop + " : " + obj[prop] + "<br>";
		}
	}
	return out;
}
var didShowYet = 0;
function showObject(obj, elemID, append, title){
	objIterations = 0;
	var out = typeof obj == "string" ? obj : obj.type ? obj.toString() : processObject(obj);
	var elem = document.getElementById(elemID || "output");
	var existing = "";
	if(append && didShowYet){
		existing = "<br /><br />" + elem.innerHTML;
	}
	var underline = "------------";
	if(title){
		underline = "";
		for(var i=0; i<title.length; i++){
			underline += "-";
		}
	}
	elem.innerHTML = "<strong>" + title + "</strong><br />" + underline + "<br />" + out + existing;
	didShowYet = 1;
}



