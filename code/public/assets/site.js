(function() {
    var map;

    // http://jsfiddle.net/xgJ2e/2/
    var hsv2rgb = function(h, s, v) {
        // adapted from http://schinckel.net/2012/01/10/hsv-to-rgb-in-javascript/
        var rgb, i, data = [];
        if (s === 0) {
            rgb = [v,v,v];
        } else {
            h = h / 60;
            i = Math.floor(h);
            data = [v*(1-s), v*(1-s*(h-i)), v*(1-s*(1-(h-i)))];
            switch(i) {
                case 0:
                    rgb = [v, data[2], data[0]];
                    break;
                case 1:
                    rgb = [data[1], v, data[0]];
                    break;
                case 2:
                    rgb = [data[0], v, data[2]];
                    break;
                case 3:
                    rgb = [data[0], data[1], v];
                    break;
                case 4:
                    rgb = [data[2], data[0], v];
                    break;
                default:
                    rgb = [v, data[0], data[1]];
                    break;
            }
        }
        return '#' + rgb.map(function(x){
                return ("0" + Math.round(x*255).toString(16)).slice(-2);
            }).join('');
    };

    var currentStep = 0,
		stepTime,
		trajects = [],
        trajectStrokes = [];

    var updateTrajectColor = function(step) {
		var time;
        for(var offset in trajects) {
            // just basic calculation based on traveltime, average seems to be aroung 1500 for the longest route.
            // However, it is all random at the moment, so good calculation is not included
            var val = Math.min(100, trajects[offset].statuses[step].traveltime / 15);
			// convert to hue
            var h= Math.floor((100 - val) * 120 / 100);

			// update the matching stroke with the new color
            trajectStrokes[offset].setOptions({strokeColor: hsv2rgb(h, 0.7, 1)});

			// get the time of the status
			// I know, the time isn't always the same for all trajects, but should be close enough to ignore
			time = moment(trajects[offset].statuses[step].measuredAt);
        }

		return time;
    };

    var initMap = function () {
        // create a map, centered in NH
        map = new google.maps.Map($('.map').first()[0], {
            zoom: 12,
            center: {lat: 52.363079563304, lng: 4.900892147824},
            mapTypeId: 'roadmap'
        });

        $.getJSON('/api/data', function(data) {
            for(var offset in data) {
                var elem = data[offset];

                var trajectStroke = new google.maps.Polyline({
                    path: elem.geometry,
                    geodesic: true,
                    strokeColor: '#000000',
                    strokeOpacity: 1,
                    strokeWeight: 4
                });

                trajects.push(elem);
                trajectStrokes.push(trajectStroke);
                trajectStroke.setMap(map);
            }
			stepTime = updateTrajectColor(0);

			// create the slider
			var slider = $(document.createElement('input')).attr('type', 'hidden');
			$('.map').after(slider);
			var ticks = [];
			var max = data[0].statuses.length - 1;
			for (var i = 0; i <= max; i++) {
				ticks.push(i);
			}
			slider.slider({
				min: 0,
				max: max,
				step: 1,
				value: 0,
				reversed : true,
				tooltip: 'always',
				ticks: ticks,
				formatter: function(value) {
					if(currentStep != value) {
						stepTime = updateTrajectColor(value);
						currentStep = value;
					}
					return stepTime.format('HH:mm');
				}
			});
        });
    };
    window.initMap = initMap;
})();