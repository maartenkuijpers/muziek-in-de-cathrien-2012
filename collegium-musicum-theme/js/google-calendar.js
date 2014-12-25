/* Google Calendar JSON: http://www.google.com/calendar/feeds/grasperk%40gmail.com/public/full?alt=json
 * by Maarten Kuijpers (c) July 2012
 */
var imagePath = "wp-content/themes/collegiummusicum/";

var months = new Array();
months[0] = new Array("januari", "februari", "maart", "april", "mei", "juni", "juli", "augustus", "september", "oktober", "november", "december");
var previousMonth = 0;
var previousYear = 0;
var weekday = new Array("Zondag", "Maandag", "Dinsdag", "Woensdag", "Donderdag", "Vrijdag", "Zaterdag");

function getGoogleDate(whenString) {
	whenString = whenString.toString();
	var year = whenString.substr(0, 4);
	var month = whenString.substr(5, 2);
	var day = whenString.substr(8, 2);
	var hour = whenString.substr(11, 2);
	var minute = whenString.substr(14, 2);
	return new Date(year, month - 1, day, hour, minute, 0);
}

$(document).ready(function () {
	$.getJSON("https://www.google.com/calendar/feeds/0ufavfijfqbprcv6vgrs1qgatc%40group.calendar.google.com/public/full?alt=json-in-script&callback=?&orderby=starttime&max-results=6&singleevents=true&sortorder=ascending&futureevents=true", function (json) {
		if (typeof json.feed.entry !== "undefined") {
			$.each(json.feed.entry, function (i, event) {
				var eventDate = getGoogleDate(event.gd$when[0].startTime);
				var eventDateEnd = getGoogleDate(event.gd$when[0].endTime);

				var year = eventDate.getFullYear();
				var month = eventDate.getMonth();
				var day = event.gd$when[0].startTime.substring(8, 10);

				var eventDayOfWeek = weekday[eventDate.getDay()];
				var eventTime = eventDate.getHours() + '.' + (eventDate.getMinutes() < 10 ? '0' : '') + eventDate.getMinutes();
				eventTime += '-' + eventDateEnd.getHours() + '.' + (eventDateEnd.getMinutes() < 10 ? '0' : '') + eventDateEnd.getMinutes();

				var htmlEvent;
				htmlEvent = '<div class="agenda">';
				if (event.gd$where[0].valueString != "") {
					htmlEvent += '<a href="' + event.gd$where[0].valueString + '">';
				}
				htmlEvent += '<div class="event">';

				/* Insert month, if changing */
				if ((previousMonth != month) || (previousYear != year)) {
					htmlEvent += '<div class="month">' + months[0][month] + '&nbsp;' + year + '</div>';
					previousYear = year;
					previousMonth = month;
				}
				htmlEvent += '<div class="month">';

				/* Insert matching logo for this event */
				if (event.title.$t.search("OrgelMuziek") != -1) {
					htmlEvent += '<img src="' + imagePath + 'images/logos/Event_OrgelMuziekInDeCathrien.png" alt="OrgelMuziek in de Cathrien">';
				} else if (event.title.$t.search("KamerMuziek") != -1) {
					htmlEvent += '<img src="' + imagePath + 'images/logos/Event_KamerMuziekInDeCathrien.png" alt="KamerMuziek in de Cathrien">';
				} else if (event.title.$t.search("KoorMuziek") != -1) {
					htmlEvent += '<img src="' + imagePath + 'images/logos/Event_KoorMuziekInDeCathrien.png" alt="KoorMuziek in de Cathrien">';
				} else if (event.title.$t.search("Muziek") != -1) {
					htmlEvent += '<img src="' + imagePath + 'images/logos/Event_MuziekInDeCathrien.png" alt="Muziek in de Cathrien">';
				}
				htmlEvent += '</div>';

				htmlEvent += '<div class="day">' + day + '</div>';
				htmlEvent += '<div class="description">' + eventDayOfWeek + ' ' + eventTime + '</div><br>';
				htmlEvent += '<div class="title">' + event.title.$t + '</div><br>';
				htmlEvent += '&nbsp;<div class="description">' + event.content.$t + '</div>';
				htmlEvent += '</div>';
				if (event.gd$where[0].valueString != "") {
					htmlEvent += '</a>';
				}
				htmlEvent += '<div class="separator"></div>';
				htmlEvent += '</div>';
				$("#agenda").append(htmlEvent);
			});
		}
		else
			$("#agenda").append('<p>NO EVENTS</p>');
	});
});
