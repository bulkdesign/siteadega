<div class="mkd-two-columns-66-33 clearfix">
	<div class="mkd-column1">
		<div class="mkd-column-inner">
			<?php
			echo fleur_mikado_get_ptf_masonry_layout();
			?>
		</div>
	</div>
	<div class="mkd-column2">
		<div class="mkd-column-inner">
			<div class="mkd-portfolio-info-holder">
				<?php
				//get portfolio content section
				fleur_mikado_portfolio_get_info_part('content');
				?>
				<div class="mkd-portfolio-author-box">
					<?php
					//get portfolio custom fields section
					fleur_mikado_portfolio_get_info_part('custom-fields');

					//get portfolio author section
					fleur_mikado_portfolio_get_info_part('author');

					//get portfolio date section
					fleur_mikado_portfolio_get_info_part('date');

					//get portfolio tags section
					fleur_mikado_portfolio_get_info_part('tags');

					//get portfolio share section
					fleur_mikado_portfolio_get_info_part('social');
					?>
				</div>
			</div>
		</div>
	</div>
</div>