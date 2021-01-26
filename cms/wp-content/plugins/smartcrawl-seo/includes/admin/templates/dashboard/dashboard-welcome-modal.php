<?php $id = 'wds-welcome-modal'; ?>

<div class="sui-modal sui-modal-md">
	<div role="dialog"
	     id="<?php echo esc_attr( $id ); ?>"
	     class="sui-modal-content <?php echo esc_attr( $id ); ?>-dialog"
	     aria-modal="true"
	     aria-labelledby="<?php echo esc_attr( $id ); ?>-dialog-title"
	     aria-describedby="<?php echo esc_attr( $id ); ?>-dialog-description">

		<div class="sui-box" role="document">
			<div class="sui-box-header sui-flatten sui-content-center sui-spacing-top--40">
				<div class="sui-box-banner" role="banner" aria-hidden="true">
					<img src="<?php echo esc_attr( SMARTCRAWL_PLUGIN_URL ); ?>assets/images/graphic-upgrade-header-schema.svg"/>
				</div>

				<button class="sui-button-icon sui-button-float--right" data-modal-close
				        id="<?php echo esc_attr( $id ); ?>-close-button"
				        type="button">
					<i class="sui-icon-close sui-md" aria-hidden="true"></i>
					<span class="sui-screen-reader-text"><?php esc_html_e( 'Close this dialog window', 'wds' ); ?></span>
				</button>

				<h3 class="sui-box-title sui-lg"
				    id="<?php echo esc_attr( $id ); ?>-dialog-title">

					<?php esc_html_e( 'NEW: Add & Customize Schema Types', 'wds' ); ?>
				</h3>

				<div class="sui-box-body sui-content-center">
					<p class="sui-description"
					   id="<?php echo esc_attr( $id ); ?>-dialog-description">
						<span>
							<?php esc_html_e( "Another highly-requested feature to help search engines better understand your site’s content and increase your visibility on search.", 'wds' ); ?>
						</span>

						<span>
							<small><strong><?php esc_html_e( "You can now add and customize a range of schema types with SmartCrawl’s new Schema Type Builder.", 'wds' ); ?></strong></small>
						</span>

						<span>
							<?php esc_html_e( 'By default, selected schema types are fully automated for you - however, the new builder also allows you to fine-tune each type to suit your site’s requirements if needed.', 'wds' ); ?>
						</span>
					</p>

					<h4><?php esc_html_e( 'New supported schema types:', 'wds' ); ?></h4>
					<ul>
						<?php foreach (
							array(
								esc_html__( 'Article', 'wds' ),
								esc_html__( 'Event', 'wds' ),
								esc_html__( 'Product', 'wds' ),
								esc_html__( 'WooCommerce Product', 'wds' ),
								esc_html__( 'FAQ Page', 'wds' ),
								esc_html__( 'How To', 'wds' ),
							) as $feature
						): ?>
							<li><small><?php echo esc_html( $feature ); ?></small></li>
						<?php endforeach; ?>
					</ul>

					<ul>
						<li><small><?php esc_html_e( 'And many more coming soon!', 'wds' ); ?></small></li>
					</ul>

					<button id="<?php echo esc_attr( $id ); ?>-get-started" type="button" class="sui-button">
						<span class="sui-loading-text">
							<?php esc_html_e( 'Get Started', 'wds' ); ?>
						</span>
						<i class="sui-icon-loader sui-loading" aria-hidden="true"></i>
					</button>
				</div>
			</div>
		</div>

		<a id="<?php echo esc_attr( $id ); ?>-skip"
		   href="#">

			<?php esc_html_e( 'Skip This', 'wds' ); ?>
		</a>
	</div>
</div>
