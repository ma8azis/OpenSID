<script>
	$(function() {
		var keyword = <?= $keyword ?>;
		$("#cari").autocomplete({
			source: keyword,
			maxShowItems: 10,
		});
	});
</script>
<div class="content-wrapper">
	<section class="content-header">
		<h1>Data Janda</h1>
		<ol class="breadcrumb">
			<li><a href="<?= site_url('hom_sid') ?>"><i class="fa fa-home"></i> Home</a></li>
			<li class="active">Daftar Janda</li>
		</ol>
	</section>
	<section class="content" id="maincontent">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-info">
					<div class="box-header with-border">
						<a href="<?= site_url('janda/form') ?>" class="btn btn-social btn-flat btn-success btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Tambah Data"><i class="fa fa-plus"></i> Tambah</a>
						<a href="<?= site_url('janda/cetak') ?>" class="btn btn-social btn-flat bg-purple btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Cetak Data" target="_blank"><i class="fa fa-print "></i> Cetak</a>
						<a href="<?= site_url('janda/excel') ?>" class="btn btn-social btn-flat bg-navy btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Unduh Data" target="_blank"><i class="fa  fa-download"></i> Unduh</a>
					</div>
					<div class="box-body">
						<div class="row">
							<div class="col-sm-12">
								<div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
									<form id="mainform" name="mainform" action="" method="post">
										<div class="row">
											<div class="col-sm-12">
												<div class="box-tools">
													<div class="input-group input-group-sm pull-right">
														<input name="cari" id="cari" class="form-control" placeholder="Cari..." type="text" value="<?= html_escape($cari) ?>" onkeypress="if (event.keyCode == 13){$('#'+'mainform').attr('action','<?= site_url('janda/search') ?>');$('#'+'mainform').submit();};">
														<div class="input-group-btn">
															<button type="submit" class="btn btn-default" onclick="$('#'+'mainform').attr('action','<?= site_url("janda/search") ?>');$('#'+'mainform').submit();"><i class="fa fa-search"></i></button>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-12">
												<div class="table-responsive">
													<table class="table table-bordered table-striped dataTable table-hover">
														<thead class="bg-gray disabled color-palette">
															<tr>
																<th><input type="checkbox" id="checkall" /></th>
																<th>No</th>
																<th>Aksi</th>
																<th width="25%">Nama Janda</th>
															</tr>
														</thead>
														<tbody>
															<?php
															$total = 0;
															foreach ($main as $data) :
																?>
																<tr>
																	<td><input type="checkbox" name="id_cb[]" value="<?= $data['id'] ?>" /></td>
																	<td class="no_urut"><?= $data['no'] ?></td>
																	<td nowrap>
																		<a href="<?= site_url("janda/sub_rw/$data[id]") ?>" class="btn bg-purple btn-flat btn-sm" title="Rincian Sub Wilayah"><i class="fa fa-list"></i></a>
																		<a href="<?= site_url("janda/form/$data[id]") ?>" class="btn bg-orange btn-flat btn-sm" title="Ubah"><i class="fa fa-edit"></i></a>
																		<?php if ($this->CI->cek_hak_akses('h')) : ?>
																			<a href="#" data-href="<?= site_url("janda/delete/$data[id]") ?>" class="btn bg-maroon btn-flat btn-sm" title="Hapus" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash-o"></i></a>
																		<?php endif; ?>
																		<div class="btn-group">
																			<a href="<?= site_url("janda/ajax_janda_maps/$data[id]") ?>" type="button" class="btn btn-social btn-flat btn-info btn-sm"><i class='fa fa-globe'></i> Peta</a>
																		</div>
																	</td>
																	<td><?= strtoupper($data['nama']) ?></td>
																</tr>
															<?php
																$total += 1;
															endforeach;
															?>
														</tbody>
														<tfoot>
															<tr>
																<th colspan="3"><label>TOTAL</label></th>
																<th class="bilangan"><?= $total ?></th>
															</tr>
														</tfoot>
													</table>
												</div>
											</div>
										</div>
									</form>
									<div class="row">
										<div class="col-sm-6">
											<div class="dataTables_length">
												<form id="paging" action="<?= site_url("janda") ?>" method="post" class="form-horizontal">
													<label>
														Tampilkan
														<select name="per_page" class="form-control input-sm" onchange="$('#paging').submit()">
															<option value="20" <?php selected($per_page, 20); ?>>20</option>
															<option value="50" <?php selected($per_page, 50); ?>>50</option>
															<option value="100" <?php selected($per_page, 100); ?>>100</option>
														</select>
														Dari
														<strong><?= $paging->num_rows ?></strong>
														Total Data
													</label>
												</form>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="dataTables_paginate paging_simple_numbers">
												<ul class="pagination">
													<?php if ($paging->start_link) : ?>
														<li><a href="<?= site_url("janda/index/$paging->start_link/$o") ?>" aria-label="First"><span aria-hidden="true">Awal</span></a></li>
													<?php endif; ?>
													<?php if ($paging->prev) : ?>
														<li><a href="<?= site_url("janda/index/$paging->prev/$o") ?>" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
													<?php endif; ?>
													<?php for ($i = $paging->start_link; $i <= $paging->end_link; $i++) : ?>
														<li <?= jecho($p, $i, "class='active'") ?>><a href="<?= site_url("janda/index/$i/$o") ?>"><?= $i ?></a></li>
													<?php endfor; ?>
													<?php if ($paging->next) : ?>
														<li><a href="<?= site_url("janda/index/$paging->next/$o") ?>" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
													<?php endif; ?>
													<?php if ($paging->end_link) : ?>
														<li><a href="<?= site_url("janda/index/$paging->end_link/$o") ?>" aria-label="Last"><span aria-hidden="true">Akhir</span></a></li>
													<?php endif; ?>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class='modal fade' id='confirm-delete' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
							<div class='modal-dialog'>
								<div class='modal-content'>
									<div class='modal-header'>
										<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
										<h4 class='modal-title' id='myModalLabel'><i class='fa fa-exclamation-triangle text-red'></i> Konfirmasi</h4>
									</div>
									<div class='modal-body btn-info'>
										Apakah Anda yakin ingin menghapus data ini?
									</div>
									<div class='modal-footer'>
										<button type="button" class="btn btn-social btn-flat btn-warning btn-sm" data-dismiss="modal"><i class='fa fa-sign-out'></i> Tutup</button>
										<a class='btn-ok'>
											<button type="button" class="btn btn-social btn-flat btn-danger btn-sm" id="ok-delete"><i class='fa fa-trash-o'></i> Hapus</button>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="box box-info">
					<div class="box-header with-border">
						<h3>Pemetaan Janda</h3>
					</div>
					<div class="box-body">
						<div class="row">
							<div class="col-sm-12">
								<div class="col-md-12" id="map" style="height: 500px;padding: 0; margin: 0;"></div>
								<script type="text/javascript">
									var map = L.map('map', {
										center: [-7.311741278388231, 111.89800500869752],
										zoom: 14
									});
									map.scrollWheelZoom.disable();

									L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
										maxZoom: 20,
										attribution: 'Pemerintah Kabupaten Bojonegoro',
										id: 'mapbox.light'
									}).addTo(map);
									var Icon = L.icon({
										iconUrl: '<?php echo base_url('assets/images/maps/bunga.png') ?>',
										iconSize: [40, 40], // size of the icon
									});
									<?php foreach ($main as $data) {
										if ($data['nama'] != '') { ?>
											L.marker([<?php echo $data['lat']; ?>, <?php echo $data['lng']; ?>], {
												icon: Icon
											}).addTo(map).bindPopup("<?php echo $data['nama']; ?>");
									<?php }
									} ?>
								</script>
							</div>
						</div>
						<div class='modal fade' id='confirm-delete' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
							<div class='modal-dialog'>
								<div class='modal-content'>
									<div class='modal-header'>
										<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
										<h4 class='modal-title' id='myModalLabel'><i class='fa fa-exclamation-triangle text-red'></i> Konfirmasi</h4>
									</div>
									<div class='modal-body btn-info'>
										Apakah Anda yakin ingin menghapus data ini?
									</div>
									<div class='modal-footer'>
										<button type="button" class="btn btn-social btn-flat btn-warning btn-sm" data-dismiss="modal"><i class='fa fa-sign-out'></i> Tutup</button>
										<a class='btn-ok'>
											<button type="button" class="btn btn-social btn-flat btn-danger btn-sm" id="ok-delete"><i class='fa fa-trash-o'></i> Hapus</button>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<script src="<?= base_url() ?>assets/js/validasi.js"></script>
<script src="<?= base_url() ?>assets/js/jquery.validate.min.js"></script>