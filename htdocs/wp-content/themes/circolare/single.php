<?php get_header(); ?>
		
		<div class="content-wrapper">
			<!-- Main Content Begin -->
			<div class="main-content<?php echo (of_get_option('sidebar_alignment', "left") == "right")? " float-left" : " float-right"; ?>">
				<div class="main-content-inner" role="main">
				
					<!-- Breadcrumbs -->
					<?php get_template_part( 'breadcrumbs' ); ?>
					
					<?php if ( have_posts() ) : ?>
					<ul id="blogposts">
						<!-- Blog Entry -->
						<?php while ( have_posts() ) : the_post();
						?><li class="blogpost post-schema">
							<article itemscope="" itemtype="http://schema.org/Article">
								<div class="general-block-outer">
									<div class="general-block">
										
										<div class="blog-post-title">
											<div class="blog-date float-left heading-style">
												<?php $date_month = get_the_time('M'); $date_day =  get_the_time('d');
												?><div class="date-number"><?php echo $date_day; ?></div>
												<div class="month"><?php echo $date_month; ?></div>
												<time class="time-meta" datetime="<?php the_time('Y-m-d') ?>" itemprop="datePublished"></time>
												<time class="time-meta entry-date updated" datetime="<?php the_modified_time('d F Y') ?>"><?php the_modified_time('d F Y') ?></time>
											</div>
											<h1 class="blog-post-title-inner single-post-title"><span itemprop="name"><?php the_title() ?></span></h1>
										</div>
										
										<div class="clear"></div>								
										<?php $btheme_imageid = get_post_thumbnail_id();
										if( $btheme_imageid ) {
										$image_url = btheme_getimage($btheme_imageid);
										?><div class="blog-image">
											<img item-prop="image" src="<?php echo aq_resize($image_url, 777, null, true) ?>" alt="<?php the_permalink() ?>" />
										</div>
										<?php } ?>
										<div class="blogpost-user-icon float-left"><?php _e('by', 'circolare'); ?> <span class="vcard author"><span rel="author" class="fn"><?php the_author_link(); ?></span></span></div>
										<div class="blogpost-category-icon float-left"><?php _e('posted in', 'circolare'); ?> <span itemprop="articleSection"><?php the_category(', '); ?></span></div>
										<div class="blogpostpost-comment-icon float-left"><?php comments_popup_link(__('No comments yet', 'circolare'), __('1 Comment', 'circolare'), __('% Comments', 'circolare')); ?></div>
										<br class="clear"/>
									</div>
								</div>

								<div itemprop="articleBody"><?php the_content() ?></div>
								
								<div class="clear"></div>
						
								<?php if( has_tag() ) { ?><div class="singlepost-tags"><span itemprop="keywords"><?php the_tags() ?></span></div><?php } ?>
								
							</article>
							<div class="clear"></div>
						</li>
						<?php endwhile; ?>						
					</ul>
					
					<div id="blog_comments">
						<?php comments_template(); ?>
					</div>
					
					<?php wp_link_pages(); ?>
						
					<?php else: ?>
					<h3><?php _e("404, That page doesn't exist..", 'circolare'); ?></h3>
					<p><?php _e('Sorry, no posts matched your criteria.', 'circolare'); ?></p>
					<?php endif; ?>
				</div>
			</div>
			
			<!-- Sidebar -->
			<?php get_sidebar(); ?>
		</div>
	</div>
	
	<!-- Footer -->
	<?php get_footer(); ?>