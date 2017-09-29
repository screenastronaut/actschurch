$(document).ready(function() {
	var map, infowindow;
	var markers = [];
	var markers_array = [];
	var infowindows = [];
	var userLat, userLng;

	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(showLocation);
	} else { 
		console.log('Geolocation is not supported by this browser. Please upgrade your browser');
	}

	function showLocation(position) {
		userLat = position.coords.latitude;
		userLng = position.coords.longitude;
	}

	$('.local-button').on('click', function(e) {
		e.preventDefault();
		$(this).addClass('red');
		$('.international-button').addClass('no-red');
		$('.international-button').removeClass('red');
		$('.international-services').hide();
		$('.local-services').show();
	});

	$('.international-button').on('click', function(e) {
		e.preventDefault();
		$(this).addClass('red');
		$('.local-button').addClass('no-red');
		$('.local-button').removeClass('red');
		$('.local-services').hide();
		$('.international-services').show();
	});

	$('a[href*=\\#]').on('click', function(e) {
		e.preventDefault();
		var hash = this.hash;
		$('html, body').animate({scrollTop: $(hash).offset().top}, 900);
	});

	$('.location-name').on('click', function() {
		var id = $(this).attr('id'); 

		if($('.a-' + id).is(':visible')) {
			$('.a-' + id).hide();
			$('.t-' + id).removeClass('triangle-up');
			$('.t-' + id).addClass('triangle-down');
		} else {
			$('.more-info').hide();
			$('.triangle').removeClass('triangle-up');
			$('.triangle').addClass('triangle-down');
			$('.a-' + id).show();
			$('.t-' + id).removeClass('triangle-down');
			$('.t-' + id).addClass('triangle-up');
		}
	});

	$('.question').on('click', function() {
		var id = $(this).attr('id'); 

		if($('.a-' + id).is(':visible')) {
			$('.a-' + id).hide('slow');
			$('.t-' + id).removeClass('triangle-up');
			$('.t-' + id).addClass('triangle-down');
		} else {
			$('.a-' + id).show('slow');
			$('.t-' + id).removeClass('triangle-down');
			$('.t-' + id).addClass('triangle-up');
		}
	});

	$('.sub-menu-item').on('click', function() {
		var id = $(this).attr('id');
		$('.container-fluid > div').hide();
		$('.' + id).show();
	});

	$('.tab-link').on('click', function() {
		var id = $(this).data('tab');

		var tablink = $('.tab-link');
		tablink.each(function() {
			tablink.removeClass('current-link');
		});

		$(this).addClass('current-link');

		var tabcontent = $('.tab-content');
		tabcontent.each(function() {
			tabcontent.removeClass('current-tab');
		});

		$('#' + id).addClass('current-tab');
	});

	$('#homes-city').change(function() {
		var rex = new RegExp($('#homes-city').val());
		if(rex =="/All/") {
			$('tr').show();
		} else{
			$('tr:not(.table-header)').hide();
			$('tr:not(.table-header)').filter(function() {
				return rex.test($(this).text());
			}).show();
		}
	});

	$('#storysearchform').on('submit', function(e) {
		e.preventDefault();
		var storysearch = $('#storysearch').val();
		var storydate = $('#storydate').val();
		var storycat = $('#storycat').val();

		$.ajax({
			type: 'post',
			url: storysearch1.ajaxUrl,
			data: {
				action: 'story_form_process',
				keywords: storysearch,
				date: storydate,
				category: storycat,
			},
			beforeSend: function() {
				$('.all-stories').html('');
			},
			success:function(data){
				$('.all-stories').html(data);
			},
			error: function(errorThrown){
				console.log(errorThrown);
			}
		});
	});

	$('.locate-map').on('click', function(e) {
		e.preventDefault;
		var lat = $(this).data('lat');
		var lng = $(this).data('lng');

		var latlng = new google.maps.LatLng(lat, lng);
		map.setCenter(latlng);
		map.setZoom(11);
	});

	function initMap() { 

		var userCoords = {lat: 3.0478567, lng: 101.5157253};
		// var userCoords = {lat: userLat, lng: userLng};
		map = new google.maps.Map(document.getElementById('map'), {
			zoom: 11,
			center: userCoords,
			rotateControl: false,
			streetViewControl: false,
			mapTypeControl: false,
		});

		map.mapTypes.set('styled_map', styledMapType);
		map.setMapTypeId('styled_map');

		marker = new google.maps.Marker({
			position: userCoords,
			title: 'Me',
		});
		marker.setMap(map);
		
		markers = location_markers;
		addMarkers();
	}

	google.maps.event.addDomListener( window, 'load', initMap );

	function addMarkers() {
		for(var i = 0; i < markers.length; i++ ) {
			var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
			marker = new google.maps.Marker({
				icon: '../wp-content/themes/actschurch/images/church-marker.png',
				position: position,
				title: markers[i][0],
			});
			marker.setMap(map);

			// TODO: infowindows
		}
	}

	//if in single location page
	if($('#single-map').length) {
		$marker = $('.single-marker');
		var markerLat = $marker.data('lat');
		var markerLng = $marker.data('lng');
		var html = $marker.html();

		function initSingleMap() {
			var position = {lat: markerLat, lng: markerLng};
			map1 = new google.maps.Map(document.getElementById('single-map'), {
				zoom: 16,
				center: position,
				rotateControl: false,
				streetViewControl: false,
				mapTypeControl: false,
			});

			map1.mapTypes.set('styled_map', styledMapType);
			map1.setMapTypeId('styled_map');

			var infowindow = new google.maps.InfoWindow({
				content: html
			});

			marker = new google.maps.Marker({
				position: position,
			});
			marker.addListener('click', function() {
				infowindow.open(map1, marker);
			});
			infowindow.open(map1, marker);
			marker.setMap(map1);
		}

		google.maps.event.addDomListener( window, 'load', initSingleMap );
	}
});

var styledMapType = new google.maps.StyledMapType(
	[
	{
		"featureType": "water",
		"elementType": "geometry.fill",
		"stylers": [
		{
			"color": "#d3d3d3"
		}
		]
	},
	{
		"featureType": "transit",
		"stylers": [
		{
			"color": "#808080"
		},
		{
			"visibility": "off"
		}
		]
	},
	{
		"featureType": "road.highway",
		"elementType": "geometry.stroke",
		"stylers": [
		{
			"visibility": "on"
		},
		{
			"color": "#b3b3b3"
		}
		]
	},
	{
		"featureType": "road.highway",
		"elementType": "geometry.fill",
		"stylers": [
		{
			"color": "#ffffff"
		}
		]
	},
	{
		"featureType": "road.local",
		"elementType": "geometry.fill",
		"stylers": [
		{
			"visibility": "on"
		},
		{
			"color": "#ffffff"
		},
		{
			"weight": 1.8
		}
		]
	},
	{
		"featureType": "road.local",
		"elementType": "geometry.stroke",
		"stylers": [
		{
			"color": "#d7d7d7"
		}
		]
	},
	{
		"featureType": "poi",
		"elementType": "geometry.fill",
		"stylers": [
		{
			"visibility": "on"
		},
		{
			"color": "#ebebeb"
		}
		]
	},
	{
		"featureType": "administrative",
		"elementType": "geometry",
		"stylers": [
		{
			"color": "#a7a7a7"
		}
		]
	},
	{
		"featureType": "road.arterial",
		"elementType": "geometry.fill",
		"stylers": [
		{
			"color": "#ffffff"
		}
		]
	},
	{
		"featureType": "road.arterial",
		"elementType": "geometry.fill",
		"stylers": [
		{
			"color": "#ffffff"
		}
		]
	},
	{
		"featureType": "landscape",
		"elementType": "geometry.fill",
		"stylers": [
		{
			"visibility": "on"
		},
		{
			"color": "#efefef"
		}
		]
	},
	{
		"featureType": "road",
		"elementType": "labels.text.fill",
		"stylers": [
		{
			"color": "#696969"
		}
		]
	},
	{
		"featureType": "administrative",
		"elementType": "labels.text.fill",
		"stylers": [
		{
			"visibility": "on"
		},
		{
			"color": "#737373"
		}
		]
	},
	{
		"featureType": "poi",
		"elementType": "labels.icon",
		"stylers": [
		{
			"visibility": "off"
		}
		]
	},
	{
		"featureType": "poi",
		"elementType": "labels",
		"stylers": [
		{
			"visibility": "off"
		}
		]
	},
	{
		"featureType": "road.arterial",
		"elementType": "geometry.stroke",
		"stylers": [
		{
			"color": "#d6d6d6"
		}
		]
	},
	{
		"featureType": "road",
		"elementType": "labels.icon",
		"stylers": [
		{
			"visibility": "off"
		}
		]
	},
	{},
	{
		"featureType": "poi",
		"elementType": "geometry.fill",
		"stylers": [
		{
			"color": "#dadada"
		}
		]
	}
	],
	{name: 'Styled Map'}
	);

// function showLocation
// $.ajax({
// 	type:'POST',
// 	url:whereyouat.ajaxUrl,
// 	data: {
// 		action: 'getlocation',
// 		lat: latitude,
// 		lng: longitude,
// 	},
// 	success:function(msg){
// 		if(msg){
// 			console.log(msg);
// 		} else{
// 			console.log('error');
// 		}
// 	}
// });