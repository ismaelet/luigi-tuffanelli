<div class="curriculum" id="curriculum">

	<div class="main-wrap">
	
		<div class="curriculum-areas grid2">
			
			<?php foreach ($curriculum as $key => $area) { ?>

				<div class="curriculum-area">
					
					<h2 class="section-title load ld-bot ld-del1"><?= $area['title'] ?></h2>

					<div class="curriculum-wrapper" id="curriculum-wrapper-<?= $key ?>">

						<div class="curriculum-experiences">

							<?php foreach ($area['experiences'] as $i => $experience) { ?>

								<div class="curriculum-experience">
									<h3 class="load ld-bot ld-del2"><?= $experience[0] ?></h3>
									<p class="load ld-bot ld-del3"><?= $experience[1] ?></p>
								</div>

							<?php } ?>

						</div>

						<p class="read-more place-cenX" data-target="curriculum-wrapper-<?= $key ?>"></p>

					</div>

				</div>

				<?php if ($key == 2) { ?>
					<div class="curriculum-line"></div>
				<?php } ?>

			<?php } ?>

		</div>

	</div>

	<div class="publications mar-t-3 pad-v-3" id="publications">

		<div class="main-wrap">
		
			<div class="curriculum-areas">
				
				<div class="curriculum-area">
					
					<h2 class="section-title load ld-bot ld-del1">Pubblicazioni</h2>
					<p class="txt-1rem mar-b-2 load ld-bot ld-del2">Suddivise in base alle sei direttrici sopra elencate.</p>

					<div class="curriculum-wrapper" id="publications-wrapper">

						<div class="curriculum-experiences">

							<?php foreach ($publications as $publication) { ?>

								<div class="curriculum-experience load ld-bot ld-del3">
									<h3 class="load ld-bot ld-del3"><?= $publication[0] ?></h3>
									<p class="load ld-bot ld-del4"><?= $publication[1] ?></p>
								</div>

							<?php } ?>

						</div>

						<p class="read-more place-cenX" data-target="publications-wrapper"></p>

					</div>

				</div>

			</div>

		</div>

	</div>

</div>