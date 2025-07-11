<?php include __DIR__ . '/partials/inicio-doc.part.php' ?>
<?php include __DIR__ . '/partials/nav.part.php' ?>

<!-- Principal Content Start -->
<div id="partners">
	<div class="container">
		<div class="col-xs-12 col-sm-8 col-sm-push-2">
			<h1>Asociados</h1>
			<hr>

			<!-- Muestra el mensaje de que todo ha ido bien o el error correspondiente -->
			<?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
				<div class="alert alert-<?= empty($errores) ? 'info' : 'danger'; ?> alert-dismissibre" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">x</span>
					</button>
					<?php if (empty($errores)): ?>
						<p> <?= $mensaje ?> </p>
					<?php else : ?>
						<ul>
							<?php foreach ($errores as $error) : ?>
								<li><?= $error ?></li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
				</div>
			<?php endif; ?>
			
			<form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?= $_SERVER['PHP_SELF'] ?>">
				<div class="form-group">
					<div class="col-xs-12">
						<label class="label-control">Nombre</label>
						<input class="form-control-file" type="text" id="nombre" name="nombre">
					</div>
				</div>
				<div class="form-group">
				<div class="col-xs-12">
                        <label class="label-control">Logo</label>
                        <input class="form-control-file" type="file" id="logo" name="logo">
                    </div>
				</div>
				<div class="form-group">
				<div class="col-xs-12">
                        <label class="label-control">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion"></textarea>
                        <button class="pull-right btn btn-lg sr-button">ENVIAR</button>
                    </div>
				</div>
			</form>
			<hr class="divider">
			<div class="imagenes_galeria">
				<table class="table">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Nombre</th>
							<th scope="col">Logo</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($asociados as $asociado):?>
							<tr>
								<th scope="row"><?=$asociado->getId()?></th>
								<td><?=$asociado->getNombre()?></td>
								<td>
									<img src="<?=$asociado->getUrlLogo()?>" 
									alt="<?=$asociado->getDescripcion()?>"
									title="<?=$asociado->getDescripcion()?>"
									width="100px">
								</td>
							</tr>
						<?php endforeach;?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<!-- Principal Content Start -->

<?php include __DIR__ . '/partials/fin-doc.part.php' ?>