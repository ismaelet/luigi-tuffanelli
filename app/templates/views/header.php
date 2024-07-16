<header class="<?= $header['color'] ?> <?= $header['floating'] ? 'floating' : '' ?> <?= $header['sticky'] ? 'sticky' : '' ?>">

	<div id="h-content">

		<div class="background bgr"></div>

		<div id="h-bars">

			<!-- Left bar -->
			<div class="h-bar">

				<!-- Logo -->
				<?php if ($header['logo']) { ?>

					<a href="<?= html_link() ?>" id="h-logo" class="icon-box">
						<?= icon_embed(__LOGO__ . 'logo') ?>
					</a>

				<?php } ?>

				<!-- Name -->
				<?php if ($header['name-bar']) { ?>

					<div class="name-box">
						
						<a href="<?= html_link() ?>">
							<h2 class="name desk1024"><?= $h_name ?></h2>
						</a>

						<a href="<?= html_link() ?>">
							<h2 class="name mob1024"><?= $h_name_m ?></h2>
						</a>

					</div>

				<?php } ?>
				
			</div>

			<!-- Middle bar -->
			<div class="h-bar"></div>

			<!-- Right bar -->
			<div class="h-bar">

				<?php if (!$header['force-mob']) { ?>

					<!-- Links -->
					<nav id="h-links" class="desk1024 inlb">

						<?php foreach ($header['links'] as $h_link) {

							if (!isset($h_link['mobile']) || !$h_link['mobile']) { ?>

								<!-- Link -->
								<div class="link">

									<a href="<?= $h_link['url'];?>">
										<p class="title <?= $view->loc == $h_link['loc'] ? 'active' : '' ?>">
											<?= $h_link['title'] ?>
											<?= isset($h_link['drop']) ? '<span class="ddown-icon">&#x25BC;</span>' : '' ?>
										</p>
									</a>

									<?php if (isset($h_link['drop'])) {?>

										<!-- Dropdown menu -->
										<div class="ddown-menu bgr-c1">

											<?php foreach ($h_drop[$h_link['drop']] as $h_drop_link) { ?>
												<a href="<?= $h_drop_link[1];?>">
													<p class="ddown-link"><?= $h_drop_link[0];?></p>
												</a>
											<?php } ?>

										</div>

									<?php } ?>

								</div>

							<?php } ?>
						
						<?php } ?>

					</nav>

				<?php } ?>

				<!-- Language icon -->
				<?php if ($header['lang-bar'] && sysData('multi_lang')) {?>

					<div id="h-lang-icon" class="inlb">

						<div class="img" <?= icon_css('languages/'.sysData('lang')) ?>></div>

					</div>

				<?php } ?>

				<!-- Theme switch -->
				<?php if ($header['theme-switch']) { ?>

					<div class="theme-switch">
						
						<div class="light-icon icon-box" data-theme="light">
							<?= icon_embed('sun') ?>
						</div>

						<div class="dark-icon icon-box" data-theme="dark">
							<?= icon_embed('moon') ?>
						</div>

					</div>

				<?php } ?>

				<!-- Cart icon -->
				<?php if ($header['cart']) { ?>

					<a href="<?= html_link('cart') ?>" <?= $this->header_color == 'light' ? background_image(__ICONS__.'buy/bag_blk.png') : background_image(__ICONS__.'buy/bag_wht.png') ?> id="h-cart" class="bag">
						<p class="num"><?= $user->cart_count ?></p>
					</a>

				<?php } ?>

				<!-- Mobile menu icon -->
				<input type="checkbox" id="h-mob-open" class="hidden" onclick="$('header').toggleClass('open');">

				<label id="h-mob-icon" class="<?= $header['force-mob'] ? '' : 'mob1024' ?>" for="h-mob-open">
					<div class="line-box">
						<div class="line"></div>
					</div>
					<div class="line-box">
						<div class="line"></div>
					</div>
					<div class="line-box">
						<div class="line"></div>
					</div>
				</label>

			</div>

			<!-- Mobile menu -->
			<div id="h-mob-menu" class="hanging-menu <?= $header['force-mob'] ? '' : 'mob1024' ?>" onClick="$('#h-mob-open').click();">

				<div class="background bgr"></div>

				<!-- Links -->
				<div id="h-mob-links">

					<?php foreach ($header['links'] as $h_link) { ?>

						<!-- Link -->
						<label class="link">

							<input type="checkbox" class="hidden">

							<a <?= isset($h_link['drop']) ? '' : 'href="'.$h_link['url'].'"' ?>>
								<p class="title txt-upp">
									<?= $h_link['title'] ?>
									<?= isset($h_link['drop']) ? '<span class="h-dropM-ico">&#x25BC;</span>' : '' ?>
								</p>
							</a>


							<?php if (isset($h_link['drop'])) {?>

								<!-- Dropdown menu -->
								<div class="ddown-menu">

									<?php foreach ($h_drop[$h_link['drop']] as $h_drop_link) {?>

										<p class="ddown-link txt-wht-h bgr-c3-h">
											<a href="<?= $h_drop_link[1];?>">
												<?= $h_drop_link[0];?>
											</a>
										</p>

									<?php } ?>
								</div>

							<?php } ?>

						</label>
						
					<?php } ?>

				</div>
			</div>

			<!-- Language menu -->
			<?php if ($header['lang-bar'] && sysData('multi_lang')) {?>
				<div id="h-lang-menu" class="hanging-menu">

					<div class="box">
						<?php foreach (sysData('lang_all') as $key => $langM) { ?>

							<div class="grid language <?= sysData('lang') == $langM[1] ? 'active' : '' ?>">
								
								<div class="">

									<div class="img" <?= icon_css('languages/'.$langM[1]) ?>></div>
									
								</div>

								<p class="name"><?= $langM[0] ?></p>
							</div>

						<?php } ?>
					</div>

				</div>
			<?php } ?>

		</div>

	</div>

</header>