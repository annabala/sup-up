<?php
$issue_count = empty( $issue_count ) ? 0 : $issue_count;
$button_text = $issue_count > 1
	? __( 'Ignore All', 'wds' )
	: __( 'Ignore', 'wds' );
?>
<tr class="wds-controls-row">
	<td colspan="4">
		<button class="wds-ignore-all wds-disabled-during-request sui-button sui-button-ghost">
			<span class="sui-loading-text">
				<i class="sui-icon-eye-hide"
				   aria-hidden="true"></i> <?php echo esc_html( $button_text ); ?>
			</span>

			<i class="sui-icon-loader sui-loading" aria-hidden="true"></i>
		</button>
	</td>
</tr>
