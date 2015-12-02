<div class="column">
    <div class="ui search selection dropdown">
        <input type="hidden" name="country">

        <div class="default text">Select Film</div>
        <div class="menu">
            <?php
            include("filmLoader.php");
            foreach ($movies as $item_id => $title) {
                echo '<div class="item" data-value="' . $item_id . '">' . $title . "</div>\n";
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


