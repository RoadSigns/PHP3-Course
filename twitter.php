<?php

include 'classes/Twitter.php';

$search = isset($_GET['search']) ? $_GET['search'] : '';

$twitter = new Twitter;
$tweetsArray = $twitter->getTweets();

?>
<style type='text/css'>
.tweets {
    width:850px;
    padding: 10px;
}
.tweet {
    border: 1px solid grey;
    width:250px;
    float:left;
    margin: 5px;
    padding: 5px;
    height: 300px;
    overflow:hidden;
}
.tweet h3 {
    margin: 3px;
}
a, a:hover {
    color: #333;
}
.tweet img {
    max-width:100%;
}
</style>

<?php if($tweetsArray){ ?>

<div class='tweets'>

    <h1>Twitter Search</h1>
    
    <form name="" action="" method="get" class="form-inline">
        <input name="search" type="text" value='<?=$search ?>' placeholder="@username #hashtag or search" required class="form-control input-lg" style="width:300px" />
        <button class="button btn-lg">Go</button>
    </form>
    
<?php foreach($tweetsArray as $tweet){  ?>

    <a href='<?=$tweet->link ?>' title='Open this tweet in Twitter' target='_blank'>

    <div class='tweet'>

        <img src='<?=$tweet->profile->image ?>' />
        <br>

        <h3><?=$tweet->profile->name ?></h3>
        <p><?=$tweet->profile->username ?></p>
        <hr>

        <?php if($tweet->media) { ?>
        <img src='<?=$tweet->media->url ?>'  /><br>
        <?php } ?>

        <p><?=$tweet->tweet ?></p>

        <p><?=$tweet->timestamp ?></p>
        
    </div>

    </a>

<?php } ?>

    <div style="clear:left"></div>
    
</div>

<?php } ?>
    
    
