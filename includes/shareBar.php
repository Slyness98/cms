
	<!-- <li class="share-item"> -->
		<!-- FACEBOOK -->
		<!-- <div class="fb-share-button" data-href="https://blog.contrivingcoder.com/" data-layout="button" data-size="small"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fblog.contrivingcoder.com%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore"></a></div>
	</li>
	<li class="share-item">	 -->
		<!-- TWITTER -->
		<!-- <a class="twitter-share-button"
		   href="https://twitter.com/intent/tweet?text=<?php echo substr($post_content,0,250);?>?hashtags=ContrivingCoder,Development">
		Tweet
		</a> -->

<!-- 		<a class="twitter-share-button"
  href="https://twitter.com/intent/tweet?text=<?php echo substr($post_content,0,250)."...";?>"
  data-size="small"
  data-text="custom share text"
  data-url="https://dev.twitter.com/web/tweet-button"
  data-hashtags="example,demo"
  data-via="twitterdev"
  data-related="twitterapi,twitter"> -->
  
<!--   <a href="https://twitter.com/intent/tweet" class="twitter-share-button btn-o" data-url="https://blog.contrivingcoder.com" data-via="SethLyness" data-hashtags="ContrivingCoder,Development,Web Development,Blog" data-lang="en" data-size="medium"  data-text="A Web Development blog helping aspiring and experienced developers alike to better understand the various practices, complications, and tools of our field..." data-show-count="false"> -->
	<!-- <a class="twitter popup" href="http://twitter.com/share?url=https%3A%2F%2Fblog.contrivingcoder.com&text=A%20blog%20aiding%20new%20(and%20old)%20web%20developers%20in%20understanding%20contemporary%20development%20practices%2C%20tools%2C%20and%20concepts%2E&hashtags=ContrivingCoder%2CWeb%20Development" target="tweetFrame"><i class="fab fa-twitter"></i></a>

	<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
	</li> -->
<!-- AddToAny BEGIN -->
<div class="a2a_kit a2a_kit_size_32 a2a_default_style">
<a class="a2a_button_facebook"></a>
<a class="a2a_button_twitter"></a>
<a class="a2a_button_linkedin"></a>
</div>
<script>
var a2a_config = a2a_config || {};
a2a_config.templates = a2a_config.templates || {};

a2a_config.templates.facebook = {
    app_id: "2472621809636664",
    description: <?php echo substr($post_content, 0, 150); ?>

};

a2a_config.templates.linkedin = {
    text: "Check out: ${title} @ ${link}"
};

a2a_config.templates.twitter = {
    text: "Reading:  ${link} from ${title}",
    related: "AddToAny,Twitter"
};


</script>
<script async src="https://static.addtoany.com/menu/page.js"></script>
<!-- AddToAny END -->