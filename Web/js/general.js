

 async function initMap() {
	// Request needed libraries.
	const { Map } = await google.maps.importLibrary("maps");
	const { AdvancedMarkerElement, PinElement } = await google.maps.importLibrary(
		"marker",
	);
    
	const map = new Map(document.getElementById("map"), {
		center: { lat: 39.45981568859527, lng:-0.4702914165885419 },
		zoom: 14,
		mapId: "4504f8b37365c3d0",
	});

	//Marker custom image
	const markerIcon = document.createElement("img");
	markerIcon.src = "/data/assets/marker.png";
  
	marker = new AdvancedMarkerElement({
		map,
		position: { lat: 39.45981568859527, lng:-0.4702914165885419 },
		title: "Yo estoy aquí",
		content: markerIcon
	}); 

}

	var card_place;
	var card_place_title;
	var card_place_image;
	var card_place_speech;
	var card_place_description;

var marker;

// Geolocation functions
let id;
let target;
let options;
//const accuracy = 0.1;
const accuracy = 0.0005;

target = {
  latitude: 0,
  longitude: 0,
};

options = {
  enableHighAccuracy: true,
  timeout: 5000,
  maximumAge: 0,
};

function error(err) {
  console.warn(`ERROR(${err.code}): ${err.message}`);
}
function success(pos) {
	const crd = pos.coords;
  
	// Geolocation temporal test
	// View: https://docs.redgps.com/books/preguntas-frecuentes/page/precision-de-coordenadas
	/*
	let latText = document.getElementById("latitude");
	let longText = document.getElementById("longitude");
	latText.innerText = crd.latitude.toFixed(5);
	longText.innerText = crd.longitude.toFixed(5);	
*/

	//Change marker
	marker.position = {lat: crd.latitude,  lng: crd.longitude};

	place2show = checkNearPlace(crd.latitude,crd.longitude);
	//console.log(place2show);
	if (place2show) {
		showPlace(place2show);
		navigator.geolocation.clearWatch(id);
	}
}


window.addEventListener("load", function() {
	console.log("window loaded");
	initMap(); 

	//var log = document.getElementById("log");
		
	card_place = document.getElementById("cardPlace");
	//console.log(card_place);
	card_place_title = document.querySelector(".card-place-title");
	card_place_image = document.querySelector(".card-place-image");
	card_place_speech = document.querySelector(".card-place-speech");
	card_place_description = document.querySelector(".card-place-description");



	// Init navigation
	id = navigator.geolocation.watchPosition(success, error, options);	
});


function showPlace(place2show){
	console.log(place2show);
	
	var audio = document.getElementById('audio');
	var source = document.getElementById('audioSource');
    source.src =  "/data/audio/place_" + place2show.place_id + ".mp3";
	
	
	card_place_title.innerHTML = place2show.place_title;
	card_place_image.innerHTML = "<img src=\"/data/img/place_" + place2show.place_id + ".jpg\">";
	card_place_description.innerHTML = place2show.place_description;
	
	card_place.style.display = "flex";
	
	audio.load(); //call this to just preload the audio without playing
	audio.addEventListener("load",()=>{this.play()}); //call this to play the song right away
};

	
function checkNearPlace(lat,lng){
	//console.log(places);
	let found = false;
	places.forEach((place)=>{
		if (place.place_latitude>(lat-accuracy) && place.place_latitude<(lat+accuracy) && place.place_longitude>(lng-accuracy) && place.place_longitude<(lng+accuracy)){
			found = place;
			return true;
		}
	})
	return found;
};

function closeCard(){
	card_place.style.display = "none";
}		
