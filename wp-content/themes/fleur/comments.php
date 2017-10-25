<div class="mkd-comment-holder clearfix" id="comments">
	<div class="mkd-comment-number">
		<div class="mkd-comment-number-inner">
			<h3><?php comments_number(esc_html__('No Comments', 'fleur'), esc_html__(' Comments', 'fleur') . ':', esc_html__(' Comments', 'fleur') . ':'); ?></h3>
		</div>
	</div>
	<div class="mkd-comments">
		<?php if (post_password_required()) : ?>
		<p class="mkd-no-password"><?php esc_html_e('This post is password protected. Enter the password to view any comments.', 'fleur'); ?></p>
	</div>
</div>
<?php
return;
endif;
?>
<?php if (have_comments()) : ?>

	<ul class="mkd-comment-list">
		<?php wp_list_comments(array('callback' => 'fleur_mikado_comment')); ?>
	</ul>


	<?php // End Comments ?>

<?php else : // this is displayed if there are no comments so far

	if (!comments_open()) :
		?>
		<!-- If comments are open, but there are no comments. -->


		<!-- If comments are closed. -->
		<p><?php esc_html_e('Sorry, the comment form is closed at this time.', 'fleur'); ?></p>

	<?php endif; ?>
<?php endif; ?>
</div></div>
<?php
$commenter = wp_get_current_commenter();
$req = get_option('require_name_email');
$aria_req = ($req ? " aria-required='true'" : '');


$args = array(
	'id_form' => 'commentform',
	'id_submit' => 'submit_comment',
	'title_reply' => esc_html__('Leave a reply', 'fleur'),
	'title_reply_to' => esc_html__('Reply to %s', 'fleur'),
	'cancel_reply_link' => esc_html__('Cancel Reply', 'fleur'),
	'label_submit' => esc_html__('Submit', 'fleur'),
	'comment_field' => '<textarea id="comment" placeholder="' . esc_html__('Your comment...', 'fleur') . '" name="comment" cols="45" rows="8" aria-required="true"></textarea>',
	'comment_notes_before' => '',
	'comment_notes_after' => '',
	'fields' => apply_filters('comment_form_default_fields', array(
		'author' => '<div class="mkd-two-columns"><div class="mkd-two-columns-inner clearfix"><div class="mkd-column"><div class="mkd-column-inner"><input id="author" name="author" placeholder="' . esc_html__('Name', 'fleur') . '" type="text" value="' . esc_attr($commenter['comment_author']) . '"' . $aria_req . ' /></div></div>',
		'url' => '<div class="mkd-column"><div class="mkd-column-inner"><input id="email" name="email" placeholder="' . esc_html__('Email', 'fleur') . '" type="text" value="' . esc_attr($commenter['comment_author_email']) . '"' . $aria_req . ' /></div></div></div></div>'
	)));
?>
<?php if (get_comment_pages_count() > 1) {
	?>
	<div class="mkd-comment-pager">
		<p><?php paginate_comments_links(); ?></p>
	</div>
<?php } ?>
<div class="mkd-comment-form">
	<?php comment_form($args); ?>
</div>


