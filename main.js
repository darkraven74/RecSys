var content2 = [
    {title: 'Andorra'},
    {title: 'Bahrain'},
    {title: 'Burundi'}
];

for (var i = 0; i < movie_titles2.length; i++) {
    content2.push({title: movie_titles2[i]});
}


/*for (i = 0; i < 27279; i++) {
    var cur = "" + i;
    content2.push({title: cur});
}*/

$(document).ready(function () {

    onPageLoad();
    $('ui.loader').loader();


});

function onPageLoad() {
    $('.ui.dropdown').dropdown();
    $('.ui.rating')
        .rating({
            onRate: getRating
        })
    ;
}

function getRating() {
    var currentRating = $('.ui.rating').rating('get rating');
    var selection = $('.ui.dropdown').dropdown('get value');
    var selection2 = $('.ui.search').search('get value');
    //document.getElementById("button").innerHTML += '<i class="icon"></i>';
    document.getElementById("status").innerHTML = "rating: " + currentRating + " selected: " + selection
    + "selected2: " + selection2;
    //alert('Current rating is: ' + currentRating);
}


function foo() {
    var text = '\
        <div class="column">\
        <div>Film 3</div>\
        <div class="ui star rating">\
        <i class="icon"></i>\
        <i class="icon"></i>\
        <i class="icon"></i>\
        <i class="icon"></i>\
        <i class="icon"></i>\
        </div>\
        </div>';
    var newNode = document.createElement('div');
    newNode.setAttribute("class", "row")
    newNode.innerHTML = text;
    //document.getElementById("button").parentNode.insertBefore(newNode, document.getElementById("button"));

    $.get('filmRating.php', function (data) {
        var newNode = document.createElement('div');
        newNode.setAttribute("class", "row")
        newNode.innerHTML = data;
        document.getElementById("table").insertBefore(newNode,
            document.getElementById("button"));
        onPageLoad();

    });
}

function onOk() {
    document.getElementById("recs").style.visibility = "visible";
}



$('.ui.search')
    .search({
        source: content2
    })
;


