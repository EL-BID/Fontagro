

			<div class="row contpaso paso8">
				<div class="col-md-12">               
			   		<div class="card ">
						<div class="card-header card-header-rose card-header-text">
							<div class="card-text">
								<h4 class="card-title"><?=$textos['paso_8']?></h4>
							</div>
						</div>
				 		<div class="card-body ">
						 	<div class="row">
								<div class="col-12">
									<div class="form-group">
										<label for="evidencia_capacidad" class="bmd-label-floating"> <?=$textos['evidencia_capacidad']?> *</label>
										<label class="form-control"><?=$perfil['evidencia_capacidad']?></label>
										<small>
										<?=$textos['evidencia_capacidad_descripcion']?>
										</small>
									</div>
								</div>
								<div class="col-12">
									<div class="form-group">
										<label for="evidencia_articulacion" class="bmd-label-floating"> <?=$textos['evidencia_articulacion']?> *</label>
										<label class="form-control"><?=$perfil['evidencia_articulacion']?></label>
										<small>
										<?=$textos['evidencia_articulacion_descripcion']?> 
										</small>
									</div>
								</div>
								<div class="col-12">
									<div class="form-group">
										<label for="evidencia_mecanismos" class="bmd-label-floating"> <?=$textos['evidencia_mecanismos']?> *</label>
										<label class="form-control"><?=$perfil['evidencia_mecanismos']?></label>
										<small>
										<?=$textos['evidencia_mecanismos_descripcion']?> 
										</small>
									</div>
								</div>
								<div class="col-12">
									<div class="form-check mr-auto pt-2">
										<label class="form-check-label">
											<input class="form-check-input" disabled type="checkbox" value="1" id="evidencia_compromiso" name="evidencia_compromiso" <?=empty($perfil['evidencia_compromiso'])?'':'checked'?> required> <?=$textos['evidencia_compromiso']?>										
											<span class="form-check-sign" id="evidencia_compromiso"><span class="check"></span></span>
										</label>										
									</div>									
								</div>
							</div>
							  
						
				 		</div>
			   		</div>
			 	</div><!-- col-md-12 -->
			</div><!-- row paso8 -->