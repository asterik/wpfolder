<?php 
require('header.php'); ?>
<div class="content-wrapper">
	<main class="content">
		<?php
		if (have_posts()) { 
			while (have_posts()) { the_post(); ?>
				<article class="single">
					<?php
					$title_img = get_post_meta( $post->ID, 'title_img', true ); 
					if($title_img) { 
						?>
						<div class="title-img">
							<?php echo kama_thumb_img("src=".$title_img."&w=660&h=300&class=h1_img&alt=". get_the_title() .""); ?>
							<h1 class="single__title"><?php the_title(); ?></h1>
						</div>
						<?php 
					} else {
						?>
						<h1 class="single__title"><?php the_title(); ?></h1>
						<?php
					}					
					the_content(); 
					edit_post_link('Редактировать', '<p>', '</p>'); ?>
				</article>
				<?php 
				$post_id = get_the_ID();
				$category_post = get_the_category($post_id);
				$category_post_id = $category_post[0]->term_id;
				?>
				<ul class="breadcrumbs breadcrumbs_single">
					<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="home" href="<?php bloginfo('url'); ?>" itemprop="url"><span itemprop="title"><?php echo $bread_crumbs_home; ?></span></a></li>
					<?php if($category_post[0]->category_parent){ ?>
					<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="<?php echo get_category_link($category_post[0]->category_parent); ?>" itemprop="url"><span itemprop="title"><?php echo get_cat_name($category_post[0]->category_parent) ?></span></a></li>
					<?php } ?>
					<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="<?php echo get_category_link($category_post[0]->term_id ); ?>" itemprop="url"><span itemprop="title"><?php echo $category_post[0]->cat_name; ?></span></a></li>
				</ul>
				<div class="post-meta">
					<?php if (function_exists('the_ratings')) { 
						?>
						<div class="post-rating">
							<div class="post-rating__title">Оценка статьи:</div>
							<?php the_ratings(); ?>
						</div>
						<?php 
					} ?>
					<div class="post-share">
						<div class="post-share__title">Поделиться с друзьями:</div>
						<script type="text/javascript" src="//yastatic.net/share2/share.js" charset="utf-8" async="async"></script><div class="ya-share2" data-services="vkontakte,facebook,odnoklassniki,gplus,twitter" data-counter=""></div>
					</div>
				</div>
				<?php 
				if (function_exists( 'perelink_after_content') ) {
				    ob_start();
				    perelink_after_content();
				    $perelink_content = ob_get_contents();
				    ob_end_clean();
				    
				    if ($perelink_content) { ?>
				    <div class="title"><span>Похожие публикации</span></div>
				    <div class="yarpp-related">
				        <ul class="related">
				        	<?php 
				        	if ( class_exists('PerelinkPlugin') ) {
		                        PerelinkPlugin::getAfterText();
		                    } ?>
				        </ul>
				    </div>
				    <?php 
					} else { 
				    	if ( function_exists('related_posts') ) {
					        ob_start();
					        related_posts(); 
					        $yarpp_content = ob_get_contents();
					        ob_end_clean();

					        $pos = strpos($yarpp_content, 'yarpp-related-none');
					        
					        if (!$pos) echo $yarpp_content;
						}	
					}
				} else {
				    if ( function_exists( 'related_posts') ) {
				    	ob_start();
				        related_posts(); 
				        $yarpp_content = ob_get_contents();
				        ob_end_clean();

				        $pos = strpos($yarpp_content, 'yarpp-related-none');

				        if (!$pos) echo $yarpp_content;
				    }
				} 
			} 
			if ( comments_open() ) { 
				?>
				<aside class="comments-block">
					<?php comments_template(); ?>
				</aside>
				<?php 
			} 
		} else { 
			?>
			<div class="single">
				<h2>Не найдено</h2>
				<p>Извините, по вашему запросу ничего не найдено.</p>
			</div>
			<?php 
		} ?>
	</main>	
	<?php 
	require('sidebar.php'); ?>
</div><!-- /.content-wrapper -->
<?php require('footer.php'); ?>
