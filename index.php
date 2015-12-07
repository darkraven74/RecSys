<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Recommender</title>
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
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico"/>
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

    <div class="row">
        <div class="column">
            <div class="ui search selection dropdown">
                <input type="hidden" name="country">

                <div class="default text">Select Film</div>
                <div class="menu">
                    <?php
                    include("filmLoader.php");
                    $i = 0;
                    foreach ($movies as $item_id => $title) {
                        echo '<div class="item" data-value="' . $item_id . '">' . $title . "</div>\n";
                        $i++;
                        if ($i > 1000) {
                            break;
                        }
                    }
                    ?>
                </div>
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
            <div class="ui search selection dropdown">
                <input type="hidden" name="country">

                <div class="default text">Select Film</div>
                <div class="menu">
                    <?php
                    include("filmLoader.php");
                    $i = 0;
                    foreach ($movies as $item_id => $title) {
                        echo '<div class="item" data-value="' . $item_id . '">' . $title . "</div>\n";
                        $i++;
                        if ($i > 1000) {
                            break;
                        }
                    }
                    ?>
                </div>
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
            <div class="ui search selection dropdown">
                <input type="hidden" name="country">

                <div class="default text">Select Film</div>
                <div class="menu">
                    <?php
                    include("filmLoader.php");
                    $i = 0;
                    foreach ($movies as $item_id => $title) {
                        echo '<div class="item" data-value="' . $item_id . '">' . $title . "</div>\n";
                        $i++;
                        if ($i > 1000) {
                            break;
                        }
                    }
                    ?>
                </div>
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
            <button class="ui button" , onclick="addFilm()">Add film</button>
            <button class="ui button" , onclick="getRecommendations()">Get recommendations</button>
            <div class="ui inline active text loader" , id="loader" , style="visibility: hidden;">Loading</div>
        </div>
    </div>


    <div class="row">
        <div class="column" , id="recs" , style="visibility: hidden;">
            <h2 class="ui header">Your recommendations</h2>
            <ol class="ui list" , id="recs_list">
            </ol>
        </div>
    </div>


</main>


<!-- build:js scripts/vendor.js -->
<!-- bower:js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/1.8.1/semantic.min.js"></script>
<script src="main.js"></script>
<!-- endbower -->
<!-- endbuild -->
</body>
</html>