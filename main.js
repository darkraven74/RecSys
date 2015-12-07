$(document).ready(function () {
    onPageLoad();
});

function onPageLoad() {
    $('.ui.dropdown').dropdown();
    $('.ui.rating').rating();
    $('ui.loader').loader();
}

function addFilm() {
    $.get('filmRatingItem.php', function (data) {
        var newNode = document.createElement('div');
        newNode.setAttribute("class", "row");
        newNode.innerHTML = data;
        document.getElementById("table").insertBefore(newNode,
            document.getElementById("button"));
        onPageLoad();
    });
}

function getRecommendations() {
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
        function (data) {
            document.getElementById("loader").style.visibility = "hidden";
            var arr = JSON.parse(data);
            for (var i = 0; i < arr.length; i++) {
                var newNode = document.createElement('li');
                newNode.innerHTML = arr[i];
                document.getElementById("recs_list").appendChild(newNode);
            }
        });
}

