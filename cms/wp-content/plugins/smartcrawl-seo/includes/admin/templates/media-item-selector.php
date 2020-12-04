<?php
$option_name = empty( $_view['option_name'] ) ? '' : $_view['option_name'];

$id = empty( $id ) ? '' : $id;
$value = empty( $value ) ? '' : $value;
$field = empty( $field ) ? 'id' : $field; // 'url' or 'id'

$file_name = '';
$url = '';
if ( ! empty( $value ) ) {
	if ( $field === 'url' ) {
		$url = $value;
	} else {
		$media_item = wp_get_attachment_image_src( $value, 'full' );
		$url = isset( $media_item[0] ) ? $media_item[0] : '';
	}

	if ( $url ) {
		$url_parts = explode( '/', $url );
		$file_name = array_pop( $url_parts );
	}
}
?>

<div id="<?php echo esc_attr( $id ); ?>"
     class="sui-upload <?php echo empty( $url ) ? '' : 'sui-has_file'; ?>"
     data-field="<?php echo esc_attr( $field ); ?>">

	<input type="hidden"
	       name="<?php echo esc_attr( $option_name ); ?>[<?php echo esc_attr( $id ); ?>]"
	       value="<?php echo esc_attr( $value ); ?>"
	/>
	<div class="sui-upload-image" aria-hidden="true">
		<div class="sui-image-mask"></div>
		<div role="button"
		     class="sui-image-preview"
		     style="background-image: url('<?php echo esc_attr( $url ); ?>');">
		</div>
	</div>

	<button class="sui-upload-button">
		<i class="sui-icon-upload-cloud" aria-hidden="true"></i> <?php esc_html_e( 'Upload file', 'wds' ); ?>
	</button>

	<div class="sui-upload-file">
		<span><?php echo esc_html( $file_name ); ?></span>

		<button aria-label="<?php esc_attr_e( 'Remove file', 'wds' ); ?>">
			<i class="sui-icon-close" aria-hidden="true"></i>
		</button>
	</div>
</div>
