<?php 
require('header.php'); ?>
<div class="content-wrapper">
	<main class="content">
		<?php
		if (have_posts()) { 
			while (have_posts()) { the_post(); 
				?>
				<article class="post single">
					<h1 class="single__title"><?php the_title(); ?></h1>
					<div class="entry">
						<?php the_content(); 
						edit_post_link('Редактировать', '<p>', '</p>'); ?>
					</div>
				</article>
				<?php 
				if ( comments_open() ) { 
					?>
					<aside class="comments-block">
						<?php comments_template(); ?>
					</aside>
					<?php 
				}
			} ?>
			<?php 
		} else { 
			?>
			<div class="single">
				<h1>Страница 404</h1>
				<p>Такой страницы не существует. Возможно, Вы некорректно набрали адрес страницы или перешли по неправильной ссылке на наш сайт.</p>
				<p>В любом случае не расстраивайтесь, у нас много полезной и актуальной информации. Посетите интересующий Вас раздел сайта:</p>
				<ul>
					<?php wp_list_categories('use_desc_for_title=0&title_li=0'); ?>
				</ul>
			</div>
			<?php 
		} ?>
	</main>	
	<?php 
	require('sidebar.php'); ?>
</div><!-- /.content-wrapper -->
<?php require('footer.php'); ?>