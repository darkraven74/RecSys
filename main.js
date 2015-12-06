$(document).ready(function () {
    onPageLoad();
});

function onPageLoad() {
    $('.ui.dropdown').dropdown();
    $('.ui.rating')
        .rating({
            onRate: getRating
        })
    ;
    $('ui.loader').loader();
}

function getRating() {
    var currentRating = $('.ui.rating').rating('get rating');
    var selection = $('.ui.dropdown').dropdown('get value');
    //document.getElementById("button").innerHTML += '<i class="icon"></i>';
    document.getElementById("status").innerHTML = "rating: " + currentRating + " selected: " + selection;
    //alert('Current rating is: ' + currentRating);
}


function addFilm() {
    $.get('filmRatingItem.php', function (data) {
        var newNode = document.createElement('div');
        newNode.setAttribute("class", "row")
        newNode.innerHTML = data;
        document.getElementById("table").insertBefore(newNode,
            document.getElementById("button"));
        onPageLoad();
    });
}

function getRecommendations() {
    getRating();
    document.getElementById("recs").style.visibility = "visible";
    document.getElementById("loader").style.visibility = "visible";
    var recs_list_node = document.getElementById("recs_list");
    while (recs_list_node.firstChild) {
        recs_list_node.removeChild(recs_list_node.firstChild);
    }
    var film_ids_list = $('.ui.dropdown').dropdown('get value');
    var ratings_list = $('.ui.rating').rating('get rating');
    $.post("recommendationsMaker.php",
        {
            film_ids: film_ids_list.join(),
            ratings: ratings_list.join()
        },
        function (data, status) {
            document.getElementById("loader").style.visibility = "hidden";
            var arr = JSON.parse(data);
            for (var i = 0; i < arr.length; i++) {
                var newNode = document.createElement('li');
                newNode.innerHTML = arr[i];
                document.getElementById("recs_list").appendChild(newNode);
            }
            //alert("Data: " + data + "\nStatus: " + status);

        });
}

