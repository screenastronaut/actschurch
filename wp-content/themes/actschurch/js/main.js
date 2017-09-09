$(document).ready(function() {
	var map, infowindow;
	var markers = [];
	var markers_array = [];
	var infowindows = [];

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
				// $('.all-stories').append('<img src="/harihasanah/wp-content/themes/hasanah/images/ajax-loader.gif" class="ajax-loading">');
			},
			success:function(data){
				$('.all-stories').html(data);
			},
			error: function(errorThrown){
				console.log(errorThrown);
			}
		});
	});

	function initMap() {
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
			{name: 'Styled Map'});

		var malaysia = {lat: 3.06043, lng: 101.59327};
		map = new google.maps.Map(document.getElementById('map'), {
			zoom: 12,
			center: malaysia,
			rotateControl: false,
			streetViewControl: false,
			mapTypeControl: false,
		});

		map.mapTypes.set('styled_map', styledMapType);
		map.setMapTypeId('styled_map');
		
		markers = location_markers;
		addMarkers();
	}

	google.maps.event.addDomListener( window, 'load', initMap );

	function addMarkers() {
		for(var i = 0; i < markers.length; i++ ) {
			var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
			marker = new google.maps.Marker({
				position: position,
				title: markers[i][0],
			});
			marker.setMap(map);

			// TODO: infowindows
		}
	}
});

