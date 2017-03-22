<div class="posts__item posts__item_second">
    <div class="posts__item-img">
    	<?php
    	$w = 320; $h = 200;
    	if ( kama_thumb_src() ) {
    	    echo '<img src="'.kama_thumb_src('w='.$w.'&h='.$h).'" width="'.$w.'" height="'.$h.'" alt="'.get_the_title().'" />';    
    	} else {
    	    echo '<img src="'.get_stylesheet_directory_uri().'/images/no-photo.jpg" width="'.$w.'" height="'.$h.'" alt="Изображение для публикации не задано">';
    	} ?>
	    <div class="post-info post-info_loop">
			<div class="post-info__comment"><?php echo get_comments_number(); ?></div>
    		<time class="post-info__time" datetime="<?php the_time('Y-m-d') ?>"><?php the_time('d.m.Y') ?></time>
	    </div>
    </div>
    <div class="posts__item-title">
		<a href="<?php the_permalink() ?>"><?php the_title() ?></a>
	</div>
    <div class="posts__item-content">
        <?php if ($excerpt_or_content == 1) {
            global $more;
            $more = 0;
            echo wp_trim_words(get_the_excerpt(), 20, '...');
        }
        else {
            if ( get_post_meta(get_the_ID(), '_yoast_wpseo_metadesc', true) ) {
                echo wp_trim_words(get_post_meta(get_the_ID(), '_yoast_wpseo_metadesc', true), 20, '...');
            }
            else {
                echo wp_trim_words(get_the_excerpt(), 20, '...');
            }
        } ?>
    </div>
</div>