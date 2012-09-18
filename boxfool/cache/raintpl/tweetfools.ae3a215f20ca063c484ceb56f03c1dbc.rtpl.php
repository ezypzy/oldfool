<?php if(!class_exists('raintpl')){exit;}?><section id="tweets"></section>
<script type="text/javascript" src="/js/boxfool-tweet.js"></script>
<script type="text/javascript">
$(function() {
    var BFTweet = new TWEETFOOL(tweets,2,'boxfool');
    BFTweet.getTweets();
});
</script>
