<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Keputusan Pengajuan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Pengajuan</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <?php if ($this->session->userdata('success')) {
        ?>
            <div class="alert alert-success alert-dismissible mt-3">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> Alert!</h5>
                <?= $this->session->userdata('success') ?>
            </div>
        <?php
        } ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-8">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Informasi Pengajuan Barang</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Nama Barang</th>
                                        <th class="text-center">Tanggal Pengajuan</th>
                                        <th class="text-center">Total Pengajuan</th>
                                        <th class="text-center">Atas Nama Pengaju</th>
                                        <th class="text-center">Status Pengajuan</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($pengajuan as $key => $value) {
                                    ?>
                                        <tr>
                                            <td class="text-center"><?= $no++ ?></td>
                                            <td class="text-center"><?= $value->nama_barang ?></td>
                                            <td class="text-center"><?= $value->tgl_pengajuan ?></td>
                                            <td class="text-center"><?= $value->total_pengajuan ?></td>
                                            <td class="text-center"><?= $value->nama_user ?></td>
                                            <td class="text-center"><?php if ($value->status_pengajuan == '0') {
                                                                    ?>
                                                    <span class="badge badge-warning">Menunggu Konfirmasi Mitra Perhutani</span>
                                                <?php
                                                                    } else if ($value->status_pengajuan == '1') {
                                                ?>
                                                    <span class="badge badge-info">Asset Keputusan</span>
                                                <?php
                                                                    } else if ($value->status_pengajuan == '2') {
                                                ?>
                                                    <span class="badge badge-success">Selesai</span>
                                                <?php
                                                                    } else {
                                                ?>
                                                    <span class="badge badge-danger">Ditolak!</span>
                                                <?php
                                                                    } ?>
                                            </td>
                                            <td class="text-center">
                                                <?php
                                                if ($value->status_pengajuan == '0') {
                                                ?>
                                                    <div class="btn-group">
                                                        <a href="<?= base_url('Admin/cKelolaData/deletebarang/' . $value->id_pengajuan) ?>" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                                        <button type="button" data-toggle="modal" data-target="#keputusan<?= $value->id_pengajuan ?>" class="btn btn-warning"><i class="fas fa-edit"></i></button>
                                                    </div>
                                                <?php
                                                } else if ($value->status_pengajuan == '1') {
                                                ?>
                                                    <button type="button" data-toggle="modal" data-target="#asset<?= $value->id_pengajuan ?>" class="btn btn-warning"><i class="fas fa-edit"></i></button>

                                                <?php
                                                } else if ($value->status_pengajuan == '2') {
                                                ?>
                                                    <button type="button" data-toggle="modal" data-target="#detail<?= $value->id_pengajuan ?>" class="btn btn-info"><i class="fas fa-info"></i></button>
                                                <?php
                                                }
                                                ?>

                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Nama Barang</th>
                                        <th class="text-center">Tanggal Pengajuan</th>
                                        <th class="text-center">Total Pengajuan</th>
                                        <th class="text-center">Atas Nama Pengaju</th>
                                        <th class="text-center">Status Pengajuan</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<?php
foreach ($pengajuan as $key => $value) {
?>
    <div class="modal fade" id="keputusan<?= $value->id_pengajuan ?>">
        <div class="modal-dialog">
            <form action="<?= base_url('kepaladesa/ckeputusan/keputusan/' . $value->id_pengajuan) ?>" method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Keputusan Pengajuan Barang</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Mitra Perhutani Mengkonfirmasi Pengajuan?</p>
                        <div class="form-group">
                            <input type="radio" name="acc" value="4">
                            <label class="text-danger"> Tolak Pengajuan!</label>
                        </div>
                        <div class="form-group">
                            <input type="radio" name="acc" value="1">
                            <label class="text-success"> Konfirmasi Pengajuan</label>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </form>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php
}
?>
<?php
foreach ($pengajuan as $key => $value) {
?>
    <div class="modal fade" id="asset<?= $value->id_pengajuan ?>">
        <div class="modal-dialog">
            <form action="<?= base_url('kepaladesa/ckeputusan/asset_keputusan/' . $value->id_pengajuan) ?>" method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Asset Keputusan</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Masukkan Asset Keputusan</p>
                        <div class="form-group">
                            <label> Tanggal Keputusan</label>
                            <input type="text" name="tgl" value="<?= date('Y-m-d') ?>" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label> Nama Asset</label>
                            <input type="text" name="asset" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </form>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php
}
?>
<?php
foreach ($detail as $key => $value) {
?>
    <div class="modal fade" id="detail<?= $value->id_pengajuan ?>">
        <div class="modal-dialog">
            <form action="<?= base_url('kepaladesa/ckeputusan/asset_keputusan/' . $value->id_pengajuan) ?>" method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Asset Keputusan</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Informasi Keputusan Asset</p>
                        <strong><?= $value->tgl_kep ?></strong>
                        <h5><?= $value->nama_asset_kep ?></h5>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </form>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php
}
?>


<!-- /.modal -->