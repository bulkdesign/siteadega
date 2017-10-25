<!-- fotos -->
<?php
	$images = get_field('galeria_de_fotos', 'option');
	
if( $images ): ?>
<div class="box-fotos">
	<div class="slider responsive galeria-fotos">
		<?php foreach( $images as $image ): ?>
			<div><img src="<?php echo $image['sizes']['large']; ?>" alt="<?php echo $image['alt']; ?>" /></div>
		<?php endforeach; ?>
	</div>
</div>
<?php endif; ?>
