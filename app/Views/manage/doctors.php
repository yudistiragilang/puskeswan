<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Manage Doctors</h1>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i><span>Report</span></a>
            </div>

            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <?php if (!empty(session()->getFlashdata('error'))) : ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?php echo session()->getFlashdata('error'); ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty(session()->getFlashdata('nik_ada'))) : ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?php echo session()->getFlashdata('nik_ada'); ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty(session()->getFlashdata('error_insert'))) : ?>
                        <div class="card mb-4 py-3 border-left-warning">
                            <div class="card-body">
                                <?php echo session()->getFlashdata('error_insert'); ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty(session()->getFlashdata('done_insert'))) : ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?php echo session()->getFlashdata('done_insert'); ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>

                </div>

                <div class="col-md-12">
                    <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" data-toggle="modal" data-target="#modalInput">Add Doctor</button>
                </div>
            </div>

            <br>

            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NIK</th>
                                    <th>Doctor name</th>
                                    <th>Doctor address</th>
                                    <th>Gander</th>
                                    <th>Bird date</th>
                                    <th>Phone</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($doctors as $x) : ?>
                                    <tr>
                                        <th scope="row"><?= $x['id']; ?></th>
                                        <td><?= $x['nik']; ?></td>
                                        <td><?= $x['dokter_name']; ?></td>
                                        <td><?= $x['dokter_address']; ?></td>
                                        <td><?= $x['gander'] == 1 ? "Laki - laki" : "Perempuan"; ?></td>
                                        <td><?= $x['bird_date']; ?></td>
                                        <td><?= $x['phone']; ?></td>
                                        <td>
                                            <a class="btn btn-primary" data-toggle="modal" data-target="#modalUpdate<?= $x['id']; ?>"><i class="fas fa-fw fa-edit"></i></a>
                                            <a class="btn btn-danger" data-toggle="modal" data-target="#modalDelete<?= $x['id']; ?>"><i class="fas fa-fw fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <?= $pager->links('doctors', 'bootstrap_pagination'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalInput" tabindex="-1" aria-labelledby="modalInputLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalInputLabel">Add Doctor</h5>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('DoctorsController/createDoctor'); ?>" method="POST">
                    <?= csrf_field() ?>

                    <div class="form-group">
                        <input type="text" name="nik" class="form-control form-control-user" id="nik" value="<?= old('nik'); ?>" placeholder="NIK">
                    </div>
                    <div class="form-group">
                        <input type="text" name="nama" class="form-control form-control-user" id="nama" value="<?= old('nama'); ?>" placeholder="Doctor name">
                    </div>
                    <div class="form-group">
                        <input type="text" name="alamat" class="form-control form-control-user" id="alamat" value="<?= old('alamat'); ?>" placeholder="Doctor address">
                    </div>
                    <div class="form-group">
                        <select class="form-control" id="gander" name="gander">
                            <option>Choose gander</option>
                            <option value="1">Laki - laki</option>
                            <option value="2">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Bird date</label>
                            </div>
                            <div class="col-md-6">
                                <input type="date" name="bird_date" class="form-control form-control-user" id="bird_date" value="<?= old('bird_date'); ?>" placeholder="Bird Date">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" name="telepon" class="form-control form-control-user" id="telepon" value="<?= old('telepon'); ?>" placeholder="Doctor telepone">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <input type="submit" name="process" value="Save" class="btn btn-primary" id="save">
            </div>
            </form>
        </div>
    </div>
</div>

<?php foreach ($doctors as $x) : ?>
    <div class="modal fade" id="modalUpdate<?= $x['id']; ?>" tabindex="-1" aria-labelledby="modalUpdateLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalUpdateLabel">Update Doctor</h5>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('DoctorsController/updateDoctor'); ?>" method="POST">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <input type="text" name="nik" class="form-control form-control-user" id="nik" value="<?= $x['nik']; ?>" readonly>
                            <input type="text" value="<?= $x['id']; ?>" name="id_doctor" hidden>
                        </div>

                        <div class="form-group">
                            <input type="text" name="nama" class="form-control form-control-user" id="nama" value="<?= $x['dokter_name']; ?>">
                        </div>

                        <div class="form-group">
                            <input type="text" name="alamat" class="form-control form-control-user" id="alamat" value="<?= $x['dokter_address']; ?>">
                        </div>

                        <div class="form-group">
                            <select class="form-control" id="gander" name="gander">
                                <option>Choose gander</option>
                                <option value="1" <?= $x['gander'] == 1 ? "selected" : ""; ?>>Laki - laki</option>
                                <option value="2" <?= $x['gander'] == 2 ? "selected" : ""; ?>>Perempuan</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Bird date</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="date" name="bird_date" class="form-control form-control-user" id="bird_date" value="<?= $x['bird_date']; ?>">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="text" name="telepon" class="form-control form-control-user" id="telepon" value="<?= $x['phone']; ?>">
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <input type="submit" name="process" value="Update" class="btn btn-primary" id="update">
                </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<?php foreach ($doctors as $x) : ?>
    <div class="modal fade" id="modalDelete<?= $x['id']; ?>" tabindex="-1" aria-labelledby="modalDeleteLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalDeleteLabel">Delete Doctor</h5>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('DoctorsController/deleteDoctor'); ?>" method="POST">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <p>Are you sure want to delete doctor data NIK <?= $x['nik']; ?> ?</p>
                            <input type="text" value="<?= $x['id']; ?>" name="id_doctor" hidden>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <input type="submit" name="process" value="Delete" class="btn btn-primary" id="delete">
                </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<?= $this->endSection(); ?>