<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="mkd-post-content">
        <div class="mkd-post-text">
            <div class="mkd-post-text-inner">
                <div class="mkd-post-title">
                    <h2>
                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo '"'.esc_html(get_post_meta(get_the_ID(), "mkd_post_quote_text_meta", true)).'"'; ?></a>
                    </h2>
                    <span class="quote_author"><?php the_title(); ?></span>
                </div>
            </div>
        </div>
		<div class="mkd-post-mark">
			<span aria-hidden="true" class="icon_quotations"></span>
		</div>
    </div>
</article>