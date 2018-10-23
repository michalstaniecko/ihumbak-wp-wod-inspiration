<header class="bg-primary">
	<div class="  container-fluid-stop ">
		<nav class="navbar navbar-expand-lg navbar-dark ">
			<a class="navbar-brand" href="<?= home_url() ?>">WOD<br/><small>Inspiration</small></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
			        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse " id="navbarSupportedContent">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item">
						<a class="nav-link" href="/lista-wodow"><?= __( 'WOD List', 'wod' ) ?></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="/tabela"><?= __( 'WOD Table', 'wod' ) ?></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="/lista-cwiczen"><?= __( 'Exercises List', 'wod' ) ?></a>
					</li>
					<?php if ( is_user_logged_in() ): ?>
						<li class="nav-item">
							<a class="nav-link" href="/dodaj-wod"><?= __( 'Add WOD', 'wod' ) ?></a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="/dodaj-cwiczenie"><?= __( 'Add Exercise', 'wod' ) ?></a>
						</li>
						<li class="nav-item">
							<a class="nav-link"
							   href="<?php echo wp_logout_url( get_permalink() ); ?>"><?= __( 'Logout', 'wod' ) ?></a>
						</li>
					<?php endif; ?>
				</ul>
			</div>
		</nav>
	</div>
</header>
<?php get_template_part( 'partials/message' ); ?>
