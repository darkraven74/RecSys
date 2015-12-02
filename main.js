var content2 = [
    {title: 'Andorra'},
    {title: 'Bahrain'},
    {title: 'Burundi'}
];

var content = [
    {title: 'G'},
    {title: 'GG'},
    {title: 'AAA'}
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
});

function onPageLoad() {
    $('.ui.dropdown').dropdown();
    $('.ui.rating')
        .rating({
            onRate: getRating
        })
    ;
    $('.ui.loader').loader();
    fillSearchField();
}

function fillSearchField() {
    $('.ui.search')
        .search({
            searchFields: ['title'],
            source: content2,
            type: 'standard',
            searchFullText: false
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
    $.get('filmRating.php', function (data) {
        var newNode = document.createElement('div');
        newNode.setAttribute("class", "row")
        newNode.innerHTML = data;
        document.getElementById("table").insertBefore(newNode,
            document.getElementById("button"));
        onPageLoad();




    });
    onPageLoad();

}

function onOk() {
    document.getElementById("recs").style.visibility = "visible";
}



$('.ui.search')
    .search({
        searchFields: ['title'],
        source: content2,
        type: 'standard',
        searchFullText: false
    })
;


