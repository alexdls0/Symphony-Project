<?php
get_header();
?>
	<body>
		<!--
		<div id="notfound">
			<div class="notfound-bg"></div>
			<div class="notfound">
				<div class="notfound-404">
					<h1>404</h1>
				</div>
				<h2>Oops! Page not found</h2>
				<section class="searchform">
	    			<?php //get_search_form() ?>
				</section>
				<a class="enlace404" href="<?php  ?>">Back to the site</a>
			</div>
		</div>
		-->
		<div class="loader" data-delay="3">
			<div class="spinner">
				<div class="double-bounce1"></div>
				<div class="double-bounce2"></div>
			</div>
		</div>
		<div class="container-404" style="overflow: hidden;">
			<div id="videoPlayer" class="thumbnail-post-single full-wh"  style="background-image: url();" 
			data-property="{ 
	                videoURL: 'https://www.youtube.com/watch?v=_oEKgfawEJQ',
	                containment: 'self',
	                autoPlay:true, 
	                mute:true, 
	                startAt:0, 
	                opacity:1,
	                showControls: false,
	                useOnMobile: false,
	                highres: 'highres'
	            }">
	            
	        </div>
	        <div class="bg-fade">
             <div class="item-info align-right">
                <div class="title-div">
                    <h1 class="title cpost-title align-right">
                        are you lost?
                    </h1>
                </div>
                <div class="search-container">
                	<input class="search-404" type="text" name="s" form="searchForm" placeholder="4.8.15.16.23.42">
                	<input type="submit" class="do-search" form="searchForm" value="&rarr;">
                </div>
                <p class="explain">
                	The numbers 4, 8, 15, 16, 23 and 42 frequently recurred in Lost have an important meaning.
                	Start your new search by clicking on the numbers and type whatever you want to search.
                </p>
                <form action="<?php echo get_site_url(); ?>" name="searchForm" id="searchForm"></form>
             </div>
            </div>
		</div>
	<?php
	get_footer();
	?>