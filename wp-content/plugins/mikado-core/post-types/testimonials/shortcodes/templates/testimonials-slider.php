<div id="mkd-testimonials<?php echo esc_attr($current_id.mt_rand(100000, 1000000)) ?>" class="mkd-testimonial-content <?php echo esc_attr($testimonial_type); ?>">
	<div class="mkd-testimonial-content-inner">
		<div class="mkd-testimonial-text-holder">
			<div class="mkd-testimonial-text-inner <?php echo esc_attr($light_class); ?>">
				<h5 class="mkd-testimonial-text"><?php echo trim($text) ?></h5>
				<?php if($show_author == "yes") { ?>
					<div class="mkd-testimonial-author">
						<h4 class="mkd-testimonial-author-text <?php echo esc_attr($light_class); ?>"><?php echo esc_attr($author) ?></h4>
						<?php if($show_position == "yes" && $job !== '') { ?>
							<span class="mkd-testimonials-job <?php echo esc_attr($light_class); ?>"><?php echo esc_attr($job) ?></span>
						<?php } ?>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
