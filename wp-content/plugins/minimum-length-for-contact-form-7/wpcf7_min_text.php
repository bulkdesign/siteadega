<?php
/* Tag generator */

add_action( 'admin_init', 'wpcf7_add_tag_generator_min_text', 15 );

function wpcf7_add_tag_generator_min_text() {
	if ( ! function_exists( 'wpcf7_add_tag_generator' ) )
		return;

	wpcf7_add_tag_generator( 'text', __( 'Text field', 'contact-form-7' ),
		'wpcf7-tg-pane-min-text', 'wpcf7_tg_pane_min_text' );

	wpcf7_add_tag_generator( 'email', __( 'Email', 'contact-form-7' ),
		'wpcf7-tg-pane-min-email', 'wpcf7_tg_pane_min_email' );

	wpcf7_add_tag_generator( 'url', __( 'URL', 'contact-form-7' ),
		'wpcf7-tg-pane-min-url', 'wpcf7_tg_pane_min_url' );

	wpcf7_add_tag_generator( 'tel', __( 'Telephone number', 'contact-form-7' ),
		'wpcf7-tg-pane-min-tel', 'wpcf7_tg_pane_min_tel' );
}

function wpcf7_tg_pane_min_text( $contact_form ) {
	wpcf7_tg_pane_min_text_and_relatives( 'text' );
}

function wpcf7_tg_pane_min_email( $contact_form ) {
	wpcf7_tg_pane_min_text_and_relatives( 'email' );
}

function wpcf7_tg_pane_min_url( $contact_form ) {
	wpcf7_tg_pane_min_text_and_relatives( 'url' );
}

function wpcf7_tg_pane_min_tel( $contact_form ) {
	wpcf7_tg_pane_min_text_and_relatives( 'tel' );
}

function wpcf7_tg_pane_min_text_and_relatives( $type = 'text' ) {
	if ( ! in_array( $type, array( 'email', 'url', 'tel' ) ) )
		$type = 'text';

	if (!empty($args)) {
		$args = wp_parse_args( $args, array() );
		$type = $args['id'];
	} else {
		$args = array(
			'content' => ''
			);
		$type = '';
	}
	
	if ( ! in_array( $type, array( 'email', 'url', 'tel' ) ) ) {
		$type = 'text';
	}

	if ( 'text' == $type ) {
		$description = __( "Generate a form-tag for a single-line plain text input field. For more details, see %s.", 'contact-form-7' );
	} elseif ( 'email' == $type ) {
		$description = __( "Generate a form-tag for a single-line email address input field. For more details, see %s.", 'contact-form-7' );
	} elseif ( 'url' == $type ) {
		$description = __( "Generate a form-tag for a single-line URL input field. For more details, see %s.", 'contact-form-7' );
	} elseif ( 'tel' == $type ) {
		$description = __( "Generate a form-tag for a single-line telephone number input field. For more details, see %s.", 'contact-form-7' );
	}

	$desc_link = wpcf7_link( __( 'http://contactform7.com/text-fields/', 'contact-form-7' ), __( 'Text Fields', 'contact-form-7' ) );
?>
<div class="control-box">
<fieldset>
<legend><?php echo sprintf( esc_html( $description ), $desc_link ); ?></legend>

<table class="form-table">
<tbody>
	<tr>
	<th scope="row"><?php echo esc_html( __( 'Field type', 'contact-form-7' ) ); ?></th>
	<td>
		<fieldset>
		<legend class="screen-reader-text"><?php echo esc_html( __( 'Field type', 'contact-form-7' ) ); ?></legend>
		<label><input type="checkbox" name="required" /> <?php echo esc_html( __( 'Required field', 'contact-form-7' ) ); ?></label>
		</fieldset>
	</td>
	</tr>

	<tr>
	<th scope="row"><label for="<?php echo esc_attr( $args['content'] . '-name' ); ?>"><?php echo esc_html( __( 'Name', 'contact-form-7' ) ); ?></label></th>
	<td><input type="text" name="name" class="tg-name oneline" id="<?php echo esc_attr( $args['content'] . '-name' ); ?>" /></td>
	</tr>

	<tr>
	<th scope="row"><label for="<?php echo esc_attr( $args['content'] . '-values' ); ?>"><?php echo esc_html( __( 'Default value', 'contact-form-7' ) ); ?></label></th>
	<td><input type="text" name="values" class="oneline" id="<?php echo esc_attr( $args['content'] . '-values' ); ?>" /><br />
	<label><input type="checkbox" name="placeholder" class="option" /> <?php echo esc_html( __( 'Use this text as the placeholder of the field', 'contact-form-7' ) ); ?></label></td>
	</tr>

<?php if ( in_array( $type, array( 'text', 'email', 'url' ) ) ) : ?>
	<tr>
	<th scope="row"><?php echo esc_html( __( 'Akismet', 'contact-form-7' ) ); ?></th>
	<td>
		<fieldset>
		<legend class="screen-reader-text"><?php echo esc_html( __( 'Akismet', 'contact-form-7' ) ); ?></legend>

<?php if ( 'text' == $type ) : ?>
		<label>
			<input type="checkbox" name="akismet:author" class="option" />
			<?php echo esc_html( __( "This field requires author's name", 'contact-form-7' ) ); ?>
		</label>
<?php elseif ( 'email' == $type ) : ?>
		<label>
			<input type="checkbox" name="akismet:author_email" class="option" />
			<?php echo esc_html( __( "This field requires author's email address", 'contact-form-7' ) ); ?>
		</label>
<?php elseif ( 'url' == $type ) : ?>
		<label>
			<input type="checkbox" name="akismet:author_url" class="option" />
			<?php echo esc_html( __( "This field requires author's URL", 'contact-form-7' ) ); ?>
		</label>
<?php endif; ?>

		</fieldset>
	</td>
	</tr>
<?php endif; ?>

	<tr>
	<th scope="row"><label for="<?php echo esc_attr( $args['content'] . '-id' ); ?>"><?php echo esc_html( __( 'Id attribute', 'contact-form-7' ) ); ?></label></th>
	<td><input type="text" name="id" class="idvalue oneline option" id="<?php echo esc_attr( $args['content'] . '-id' ); ?>" /></td>
	</tr>

	<tr>
	<th scope="row"><label for="<?php echo esc_attr( $args['content'] . '-class' ); ?>"><?php echo esc_html( __( 'Class attribute', 'contact-form-7' ) ); ?></label></th>
	<td><input type="text" name="class" class="classvalue oneline option" id="<?php echo esc_attr( $args['content'] . '-class' ); ?>" /></td>
	</tr>

	<tr>
		<th><?php echo esc_html( __( 'Size', 'contact-form-7' ) ); ?></th>
		<td>(<?php echo esc_html( __( 'optional', 'contact-form-7' ) ); ?>)
		<input type="number" name="size" class="numeric oneline option" min="1" /></td>
	</tr>

	<tr>
	<th><?php echo esc_html( __( 'Maxlength', 'contact-form-7' ) ); ?></th>
	<td>(<?php echo esc_html( __( 'optional', 'contact-form-7' ) ); ?>)
		<input type="number" name="maxlength" class="numeric oneline option" min="1" />
	</td>
	</tr>

	<tr>
	<th><?php echo esc_html( __( 'MinLength', 'contact-form-7' ) ); ?></th>
	<td>(<?php echo esc_html( __( 'optional', 'contact-form-7' ) ); ?>)
		<input type="number" name="minlength" class="numeric oneline option" /></td>
	</tr>

</tbody>
</table>
</fieldset>
</div>

<div class="insert-box">
	<input type="text" name="<?php echo $type; ?>" class="tag code" readonly="readonly" onfocus="this.select()" />

	<div class="submitbox">
	<input type="button" class="button button-primary insert-tag" value="<?php echo esc_attr( __( 'Insert Tag', 'contact-form-7' ) ); ?>" />
	</div>

	<br class="clear" />

	<p class="description mail-tag"><label for="<?php echo esc_attr( $args['content'] . '-mailtag' ); ?>"><?php echo sprintf( esc_html( __( "To use the value input through this field in a mail field, you need to insert the corresponding mail-tag (%s) into the field on the Mail tab.", 'contact-form-7' ) ), '<strong><span class="mail-tag"></span></strong>' ); ?><input type="text" class="mail-tag code hidden" readonly="readonly" id="<?php echo esc_attr( $args['content'] . '-mailtag' ); ?>" /></label></p>
</div>
<?php
}
?>