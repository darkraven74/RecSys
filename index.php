<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Title</title>
    <meta name="description" content="">
    <meta name=viewport content="width=device-width, initial-scale=1">
    <meta name="mobile-web-app-capable" content="yes">

    <!-- build:css styles/vendor.css -->
    <!-- bower:css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/1.8.1/semantic.min.css"/>
    <!-- endbower -->
    <!-- endbuild -->
    <link href='//fonts.googleapis.com/css?family=Open+Sans:400,700,300&subset=latin,vietnamese' rel='stylesheet'
          type='text/css'>

    <!-- build:css styles/main.css -->
    <link rel="stylesheet" href="main.css">
    <!-- endbuild -->
</head>
<body>


<nav class="ui fixed menu inverted navbar">
    <a href="" class="brand item">Film recommender</a>
</nav> <!-- end nav -->

<main class="ui page grid" , id="table">


    <div class="row">
        <div class="column">
            <div id="status">status:</div>
        </div>
    </div>


    <div class="row">
        <div class="column">
            <h2 class="ui header">Your favourite films</h2>
        </div>
    </div>

    <?php
    include("filmLoader.php");
    ?>

    <div class="row">
        <div class="column">
            <div class="ui search">
                <div class="ui icon input">
                    <input class="prompt" type="text" placeholder="Search film...">
                    <i class="search icon"></i>
                </div>
                <div class="results"></div>
            </div>
            <br>
            Rating:
            <div class="ui star rating">
                <i class="icon"></i>
                <i class="icon"></i>
                <i class="icon"></i>
                <i class="icon"></i>
                <i class="icon"></i>
            </div>
            <div class="ui divider"></div>
        </div>

    </div>


    <div class="row">
        <div class="column">
            <div class="ui search">
                <div class="ui icon input">
                    <input class="prompt" type="text" placeholder="Search film...">
                    <i class="search icon"></i>
                </div>
                <div class="results"></div>
            </div>
            <br>
            Rating:
            <div class="ui star rating">
                <i class="icon"></i>
                <i class="icon"></i>
                <i class="icon"></i>
                <i class="icon"></i>
                <i class="icon"></i>
            </div>
            <div class="ui divider"></div>
        </div>

    </div>





    <div class="row" , id="button">
        <div class="column">
            <button class="ui button" , onclick="foo()">Add film</button>
            <button class="ui button" , onclick="onOk()">Get recommendations</button>
        </div>
    </div>


    <div class="row">
        <div class="column" , id="recs" , style="visibility: hidden;">
            <h2 class="ui header">Your recommendations</h2>

            <div class="ui inline active text loader" , id="loader">Loading</div>
            <ol class="ui list">
                <li>Signing Up</li>
                <li>User Benefits</li>
                <li>User Types</li>
                <li>Deleting Your Account</li>
            </ol>


        </div>
    </div>


</main>


<!-- build:js scripts/vendor.js -->
<!-- bower:js -->
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/1.8.1/semantic.min.js"></script>
<script src="main.js"></script>
<!-- endbower -->
<!-- endbuild -->
</body>
</html>