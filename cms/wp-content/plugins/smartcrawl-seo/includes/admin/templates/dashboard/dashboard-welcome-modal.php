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

					<?php esc_html_e( 'Updated Schema Support', 'wds' ); ?>
				</h3>

				<div class="sui-box-body sui-content-center">
					<p class="sui-description"
					   id="<?php echo esc_attr( $id ); ?>-dialog-description">

						<?php esc_html_e( "We've updated our Schema Markup support for all the default WordPress post types and components to help you look great in search engines. We've made it easier to set up your basic configuration, take a look!", 'wds' ); ?>
					</p>

					<h4><?php esc_html_e( 'Supported Schema.org Types', 'wds' ); ?></h4>
					<ul>
						<?php foreach (
							array(
								'<strong>' . esc_html__( 'Corporate Contact.', 'wds' ) . '</strong>'   => '',
								esc_html__( '%s markup.', 'wds' )                                      => esc_html__( 'Social Media', 'wds' ),
								'<strong>' . esc_html__( 'Sitelinks Searchbox.', 'wds' ) . '</strong>' => '',
								esc_html__( '%s to markup Web Page Header.', 'wds' )                   => esc_html__( 'WPHeader', 'wds' ),
								esc_html__( '%s to markup Web Page Footer.', 'wds' )                   => esc_html__( 'WPFooter', 'wds' ),
								esc_html__( 'Blog to markup %s posts list page.', 'wds' )              => esc_html__( 'Blog', 'wds' ),
								esc_html__( 'CollectionPage to markup %s Archives.', 'wds' )           => esc_html__( 'Categories', 'wds' ),
								esc_html__( 'CollectionPage to markup %s Archives.', 'wds' )           => esc_html__( 'Tags', 'wds' ),
								esc_html__( 'ItemList to markup %s Type Archives.', 'wds' )            => esc_html__( 'Post', 'wds' ),
								esc_html__( 'AboutPage to markup the %s.', 'wds' )                     => esc_html__( 'About page', 'wds' ),
								esc_html__( 'ContactPage to markup the %s.', 'wds' )                   => esc_html__( 'Contact page', 'wds' ),
								esc_html__( '%s enable automatically on all videos embedded.', 'wds' ) => esc_html__( 'VideoObject', 'wds' ),
								esc_html__( '%s enable automatically on all audio embedded.', 'wds' )  => esc_html__( 'AudioObject', 'wds' ),
							) as $feature => $bold_part
						): ?>
							<li><small><?php printf( $feature, "<strong>{$bold_part}</strong>" ) ?></small></li>
						<?php endforeach; ?>
					</ul>

					<h4><?php esc_html_e( 'Coming Next', 'wds' ); ?></h4>
					<ul>
						<li><small><?php esc_html_e( 'Custom markup editor tool', 'wds' ); ?></small></li>
					</ul>

					<button id="<?php echo esc_attr( $id ); ?>-get-started" type="button" class="sui-button">
						<span class="sui-loading-text">
							<?php esc_html_e( 'Get It Started', 'wds' ); ?>
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
