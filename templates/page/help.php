<div class="wrap">

    <div id="icon-fontbird" class="icon32"><br /></div>
    <h2>Help</h2>

        <div class="container">
        <h3 class="center alt">&ldquo;Font Bird&rdquo; Documentation by &ldquo;Vinh Nguyen&rdquo; v1.0</h3>
        <hr>

        <h1 class="center">&ldquo;Font Bird&rdquo;</h1>

        <div class="borderTop">
            <div class="span-6 colborder info prepend-1">
                <p class="prepend-top">
                    <strong>
					Created: 02/20/2011<br>
					By: Vinh Nguyen<br>
					Email: <a href="mailto:info@axcoto.com">info@axcoto.com</a><br />
					Website: <a href="http://support.axcoto.com">http://support.axcoto.com</a>
                    </strong>
                </p>
            </div><!-- end div .span-6 -->

            <div class="span-12 last">
                <p class="prepend-top append-0">Thank you for purchasing my plugin. If you have any questions that are beyond the scope of this help file, please feel free to email info@axcoto.com
            </div>
        </div><!-- end div .borderTop -->

        <hr>

        <h2 id="toc" class="alt">Table of Contents</h2>
        <ol class="alpha">
            <li><a href="#whatIsIt">What is Font Bird? </a></li>
            <li><a href="#install">How to Install</a></li>
            <li><a href="#using">How to Use</a></li>
            <li><a href="#about">Change About Page</a></li>
        </ol>


        <hr>

        <h3 id="whatIsIt"><strong>A) What's Font BirdFont Bird? </strong> - <a href="#toc">top</a></h3>
        <p>
            FontBird, Easy to change any fonts on your Wordpress site
<br />
FontBird is a WordPress plugin which let users upload .ttf or .otf font then change any font of WordPress theme to it!
User doesn't to code any extra CSS, no longer worry about converting EOT font for IE! All are automatic!
User can upload as many as font they want, and define many rules to use many font at the same time

        </p>

                <h4>Feature:</h4>
        <ul>
            <li>Upload many fonts at the same time!</li>
            <li>Automatic convert .ttf or .otf font to .eot font for IE!</li>
            <li>Support unlimited collections! A collection is a set of fonts definetion - include definition of font family& font size(optional)! You can easily switch between these collections! Example, you can have a collection with
Harabara Font for Header, Comic_Book for Post Title! Also you have an other collection with Lobster font for Header, Arial for Post title! Then you can easily make active a collection to use its definition! Think about it like Themes of WordPress! You can have many theme in system and make default a theme anytime you want!</li>
            <li>Unlimited definitions in collection! Example, you are a designer, you know CSS quite much, and you want to add hundreds font definition for your site</li>
        </ul>


        <h3 id="install"><strong>B) How to Install</strong> - <a href="#toc">top</a></h3>
        <h4>Steps to install:</h4>
        <ul>
            <li>Download ZIP file from Envato after purchasing!</li>
            <li>Upload to WordPress, active the plugin</li>
            <li>Chmod 777 for folder assets/fonts in plugin folder! This is the place font will be uploaded too</li>
            <li>Upload Font</li>
            <li>Create collection, add rules!</li>
            <li>Active a collection to use it! You can active other collection as you want</li>
            <li>
		More detail document is included when purchasing!
            </li>
        </ul>

        <h3 id="using"><strong>C) How to use? </strong> - <a href="#toc">top</a></h3>
        <p>
        The first, you need to add font to Font Bird! Select menu Font Bird &gt; Add font!
    Click Add Font button on the right, then select as many as font file you want! Font Bird alow you
    to upload .ttf or .otf font! It automatically generate .eot font for IE! T
		</p>

    <p class="note">To generate .eot font from .otf file, your hosting must have ZipArchive! Most of hosting have this module! If your
    hosting doesn't have it, maybe it's the time for you to select another hosting provider</p>

    After uploading font, you can click Font Bird &gt; Manage Font to see a completed font list!

    Next, go to menu Font Bird &gt; Ford Bird! You will see collections! What is collections?
    <p class="note">
        Collection is the set of rules which you defined! Rules is the combination of a selector a font family, and a font size! Selector
        is the way find the element on your website to apply the rule! In your HTML code, you see the thing such as: &lt;h1&gt;, &lt;h2&gt;,
        &lt;h3&gt;, &lt;span&gt;...This is simple selector to define an specific element!
        You can use class and id to select more element! For examples, to select title element of a post, you can use
        .post .posttitle,...
    </p>

    <p>
        So, you fill in a selector, select a font family, type a font size (you can leave this field empty)!
    </p>

    <p>
    Once you create collection, you need to active a collection! Think of about theme in WordPress, you have many theme, and you must active a theme to use
    it! For Font Bird, you have many collections, and you must active a collection for it! To active a collection, you have two ways:
    </p>
    <h2>1. Click on the green check icon:  </h2><br />
    <p>
    <img src="<?php echo AxcotoFontBird::singleton()->pluginUrl?>assets/help/active.png" alt="how to active a collection"/>
    Once activated, collection has a small yellow ribbon on the left!
    </p>
    <h2>2. Open a collection, then click Set as Default:  <br />
    </h2><br />

    <img src="<?php echo AxcotoFontBird::singleton()->pluginUrl?>assets/help/2.png" alt="how to active a collection"/>
    

	<p>
	It sounds complex when writing but easy when you do it! Look at below video!
	</p>
	<iframe src="http://player.vimeo.com/video/20145622" width="760" height="318" frameborder="0"></iframe>
    <p>
    You should <a href="http://vimeo.com/20145622">see in HD on vimeo</a> for a better version! Thank you! <a href="http://vimeo.com/20145622">http://vimeo.com/20145622</a>
    </p>

	<br /><br />
	<h3 id="abou	t"><strong>D)</strong> How to change about page text - <a href="#top">top</a></h3>
	<p>
	I understand you spent your hard-earn money on this product and maybe don't want to see an about page with text which promotes our
	service! In that case, you can change theme very very easy via editting directly file templates/page/about.php in fontbird plugin folder!
	It's just a normal HTML file, you can edit it with Dreamweaver or any editor which you're good with it! Just need to remember say it with name about.php
	when finishing editting!
	</p>


                <hr>
                <p>Once again, thank you so much for purchasing this application.</p>
                <p> I'd be glad to help you if you have any questions relating to this application such as how to select an element on your site,...
                    I don't guarantees anything, but I'll do my best to assist.
                </p>

                <p class="append-bottom alt large"><strong>Vinh Nguyen</strong></p>
                <p><a href="#toc">Go To Table of Contents</a></p>

                <hr class="space">
                </div><!-- end div .container -->


    <div style="clear: both"></div>
</div>