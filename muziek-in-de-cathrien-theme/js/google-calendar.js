/* Google Calendar
 * by Maarten Kuijpers (c) July 2012
 */
var imagePath = "";
// Uncomment following 3 lines when wordpress is not installed in root of site (e.g. http://muziekindecathrien.local/wordpress/wp-content etc)
//if (location.host.substr(-5) == "local")
//    var imagePath = "/wp-content/themes/muziekindecathrien/";
//else
var imagePath = location.protocol + "//" + location.host + "/wp-content/themes/muziekindecathrien/";

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

function getGoogleCalendarApiV3Url(daysInThePast, maxResults) {
    daysInThePast = typeof daysInThePast !== 'undefined' ? daysInThePast : 3;
    maxResults = typeof maxResults !== 'undefined' ? maxResults : 6;

    // This is a working url:
    // https://www.googleapis.com/calendar/v3/calendars/0ufavfijfqbprcv6vgrs1qgatc%40group.calendar.google.com/events?key=AIzaSyDmkaa5RlthfZGRKoYgqMJDEQWBd5ULuuU&maxResults=6&timeMin=2014-11-01T18:19:25-03:00&singleEvents=true&orderBy=startTime
    // Parameters:
    // key=AIzaSyDmkaa5RlthfZGRKoYgqMJDEQWBd5ULuuU
    // maxResults=6
    // timeMin=2014-11-01T18:19:25-03:00
    // singleEvents=true
    // orderBy=startTime
    // "orderBy" requires to have "singleEvents" set to true.

    var apiUrl = "https://www.googleapis.com/calendar/v3/calendars/";
    var gCalendarId = "0ufavfijfqbprcv6vgrs1qgatc@group.calendar.google.com";
    var googleCalendarV3 = apiUrl + gCalendarId + "/events";

    var key = "AIzaSyDmkaa5RlthfZGRKoYgqMJDEQWBd5ULuuU";

    var startDate = new Date();
    startDate.setDate(startDate.getDate() - daysInThePast);
    var timeMin = startDate.toJSON();

    var orderBy = "startTime";
    var singleEvents = "true";

    // Construct URL
    googleCalendarV3 += "?key=" + key + "&maxResults=" + maxResults + "&timeMin=" + timeMin + "&orderBy=" + orderBy + "&singleEvents=" + singleEvents;
    return googleCalendarV3;
}

$(document).ready(function () {
    var googleCalendarV3 = getGoogleCalendarApiV3Url(3, 6);
    $.getJSON(googleCalendarV3, function (json) {
        if (typeof json.items !== "undefined") {
            $.each(json.items, function (i, event) {
                var eventDate = getGoogleDate(event.start.dateTime);
                var eventDateEnd = getGoogleDate(event.end.dateTime);

                var year = eventDate.getFullYear();
                var month = eventDate.getMonth();
                var day = event.start.dateTime.substring(8, 10);

                var eventDayOfWeek = weekday[eventDate.getDay()];
                var eventTime = eventDate.getHours() + '.' + (eventDate.getMinutes() < 10 ? '0' : '') + eventDate.getMinutes();
                eventTime += '-' + eventDateEnd.getHours() + '.' + (eventDateEnd.getMinutes() < 10 ? '0' : '') + eventDateEnd.getMinutes();

                var htmlEvent;
                htmlEvent = '<div class="agenda">';
                if (event.location != "") {
                    htmlEvent += '<a href="' + event.location + '">';
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
                if (event.summary.search("OrgelMuziek") != -1) {
                    htmlEvent += '<img src="' + imagePath + 'images/logos/Event_OrgelMuziekInDeCathrien.png" alt="OrgelMuziek in de Cathrien">';
                } else if (event.summary.search("KamerMuziek") != -1) {
                    htmlEvent += '<img src="' + imagePath + 'images/logos/Event_KamerMuziekInDeCathrien.png" alt="KamerMuziek in de Cathrien">';
                } else if (event.summary.search("KoorMuziek") != -1) {
                    htmlEvent += '<img src="' + imagePath + 'images/logos/Event_KoorMuziekInDeCathrien.png" alt="KoorMuziek in de Cathrien">';
                } else if (event.summary.search("Muziek") != -1) {
                    htmlEvent += '<img src="' + imagePath + 'images/logos/Event_MuziekInDeCathrien.png" alt="Muziek in de Cathrien">';
                }
                htmlEvent += '</div>';

                htmlEvent += '<div class="day">' + day + '</div>';
                htmlEvent += '<div class="description">' + eventDayOfWeek + ' ' + eventTime + '</div><br>';
                htmlEvent += '<div class="title">' + event.summary + '</div><br>';
                htmlEvent += '&nbsp;<div class="description">' + event.description + '</div>';
                htmlEvent += '</div>';
                if (event.location != "") {
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