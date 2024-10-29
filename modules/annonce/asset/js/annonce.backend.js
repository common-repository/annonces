/**
 * Initialise l'objet annonce dans le namespace eoFrameworkStarter.
 * Permet d'éviter les conflits entre les différents plugins utilisant EO-Framework.
 *
 * Ce fichier JS est une base pour utiliser du JS avec EO-Framework.
 * En lançant la commande "npm start", GULP vas écouter les fichiers *.backend.js et
 * vas s'occuper de les assembler dans le fichier backend.min.js.
 *
 * EO-Framework appel automatiquement la méthode "init" à l'initilisation de certains *pages*
 * du backadmin de WordPress. Ces pages doivent être définis dans le tableau "insert_scripts_page" dans le fichier *.config.json
 * principales de votre plugin.
 * @see https://github.com/Eoxia/task-manager/blob/master/task-manager.config.json pour un exemple
 *
 * @since 2.0.0
 */
window.eoxiaJS.annonces.annonce = {};

/**
 * La méthode "init" est appelé automatiquement par la lib JS de Eo-Framework
 *
 * @since 2.0.0
 * @return {void}
 */
window.eoxiaJS.annonces.annonce.init = function() {
	window.eoxiaJS.annonces.annonce.initMap();
	window.eoxiaJS.annonces.annonce.event();
};

window.eoxiaJS.annonces.annonce.event = function() {
};

/**
 * Init Google Map
 *
 * @since 2.0.0
 * @return {void}
 */
window.eoxiaJS.annonces.annonce.initMap = function() {
	var $map = jQuery( '#annonces-map-wrapper' );

	jQuery( $map ).each(function() {
		window.eoxiaJS.annonces.annonce.createMap( jQuery( this ) );
	});
}

/**
 * Create map and markers
 *
 * @since  2.0.0
 * @param  {Array} map Map wrapper
 * @return {void}
 */
window.eoxiaJS.annonces.annonce.createMap = function( map ) {
	if ( map == undefined || map.length == 0 ) return;

	var $map = map;
	// var france = {lat: 48.856614, lng: 2.352222};
	var $markers = jQuery( $map ).find( 'marker' );
	var myLatlng = new google.maps.LatLng($markers.attr('lat'),$markers.attr('lng'));
	var $listMarker = [];
	var $htmlMarker = [];
	var args = {
		zoom: 8,
		center: myLatlng,
		fullscreenControl: false,
	};
	var $gMap = new google.maps.Map( jQuery( $map ).find( '#annonces-google-map' )[0], args );


	jQuery( $markers ).each(function() {
		var marker = window.eoxiaJS.annonces.annonce.createMarker( $gMap, jQuery( this ) );
		var infoWindow = window.eoxiaJS.annonces.annonce.createInfoWindow( jQuery( this ) );

		if ( jQuery( this ).html().length != 0 ) {
			marker.addListener('click', function() {
				infoWindow.open($map, marker);
			});
		}

		$listMarker.push( marker );
		$htmlMarker.push( jQuery( this ) );
	});

	jQuery( '.annonces-taxonomies .taxonomy-label' ).on( 'click', function() {
		if ( jQuery( this ).hasClass( 'active' ) ) {
			window.eoxiaJS.annonces.annonce.displayMapMarkers( $htmlMarker, $listMarker, null, jQuery( this ).attr( 'data-id' ).split( ',' ) );
			jQuery( this ).removeClass( 'active' );
			jQuery( this ).next('.taxonomies-child').find( '.taxonomy-label' ).removeClass( 'active' );
		} else {
			window.eoxiaJS.annonces.annonce.displayMapMarkers( $htmlMarker, $listMarker, $gMap, jQuery( this ).attr( 'data-id' ).split( ',' ) );
			jQuery( this ).addClass( 'active' );
			jQuery( this ).next('.taxonomies-child').find( '.taxonomy-label' ).addClass( 'active' );
		}

	});
};

/**
 * Create marker
 *
 * @since  2.0.0
 * @param  {Array} map Map
 * @param  {Array} marker Map marker
 * @return {void}
 */
window.eoxiaJS.annonces.annonce.createMarker = function( map, marker ) {
	var $map = map;
	var $marker = marker;
	var myLatLng = {lat: Number( $marker.attr('lat') ), lng: Number( $marker.attr('lng') )};
	if ( $marker.attr('pin') != undefined ) {
		var iconUrl = annonces_data.url + '/modules/annonce/asset/img/pin-' + $marker.attr('pin') + '.png'; /** annonces_data is obtained with php enqueue */
	} else {
		var iconUrl = annonces_data.url + '/modules/annonce/asset/img/pin-red.png';
	}

	return new google.maps.Marker({
		position: myLatLng,
		map: $map,
		animation: google.maps.Animation.DROP,
		icon: iconUrl,
	});
};

/**
 * Create infowindow
 *
 * @since  2.0.0
 * @param  {Array} marker Map marker
 * @return {void}
 */
window.eoxiaJS.annonces.annonce.createInfoWindow = function( marker ) {
	var $marker = marker;

	return new google.maps.InfoWindow({
		content: $marker.html()
	});
};

/**
 * Display or Hide markers
 *
 * @since  2.0.0
 * @param  {Array} htmlMarker Array with the marker html
 * @param  {Array} listMarkers Array with the google marker
 * @param  {Array} map Map
 * @return {void}
 */
window.eoxiaJS.annonces.annonce.displayMapMarkers = function( htmlMarker, listMarkers, map, listTaxId ) {
	for (var i = 0; i < listMarkers.length; i++) {
		var taxonomies = htmlMarker[i].attr( 'taxonomy' ).split( ',' );
		/** Loop over all markers */
		taxonomies.forEach(function(tax) {
			/** Loop over all chosen taxonomies */
			listTaxId.forEach(function(id) {
				if ( tax == id ) {
					listMarkers[i].setMap(map);
				}
			});
		});
	}
}
