<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Manage Pets</h1>
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
                    <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" data-toggle="modal" data-target="#modalInput">Add Pet</button>
                </div>
            </div>

            <br>
            <div class="col-md-6">
                <select class="simple-select2 w-100" id="owner" name="owner">
                    <option>Choose role</option>
                    <?php foreach ($owners->getResult() as $owner) : ?>
                        <option value="<?= $owner->nik; ?>"><?= $owner->owner_name; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <br>

            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Pet name</th>
                                    <th>Pet owner</th>
                                    <th>Gander</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($pets as $x) : ?>
                                    <tr>
                                        <th scope="row"><?= $x['id']; ?></th>
                                        <td><?= $x['pets_name']; ?></td>
                                        <td><?= $x['pets_owner']; ?></td>
                                        <td><?= $x['gander'] == 1 ? "Jantan" : "Betina"; ?></td>
                                        <td>
                                            <a class="btn btn-primary" data-toggle="modal" data-target="#modalUpdate<?= $x['id']; ?>"><i class="fas fa-fw fa-edit"></i></a>
                                            <a class="btn btn-danger" data-toggle="modal" data-target="#modalDelete<?= $x['id']; ?>"><i class="fas fa-fw fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <?= $pager->links('pets', 'bootstrap_pagination'); ?>
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
                <h5 class="modal-title" id="modalInputLabel">Add Pet</h5>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('PetsController/createPet'); ?>" method="POST">
                    <?= csrf_field() ?>
                    <div class="form-group">
                        <input type="text" name="pets_name" class="form-control form-control-user" id="pets_name" value="<?= old('pets_name'); ?>" placeholder="Pets name">
                    </div>

                    <div class="form-group">
                        <input type="text" name="own_name" class="form-control form-control-user" id="own_name" value="<?= old('own_name'); ?>" placeholder="Owner name">
                    </div>

                    <div class="form-group">
                        <select class="form-control" id="gander" name="gander">
                            <option>Choose gander</option>
                            <option value="1">Jantan</option>
                            <option value="2">Betina</option>
                        </select>
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

<?php foreach ($pets as $x) : ?>
    <div class="modal fade" id="modalUpdate<?= $x['id']; ?>" tabindex="-1" aria-labelledby="modalUpdateLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalUpdateLabel">Update Pet</h5>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('PetsController/updatePet'); ?>" method="POST">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <input type="text" name="pets_name" class="form-control form-control-user" id="pets_name" value="<?= $x['pets_name']; ?>">
                            <input type="text" value="<?= $x['id']; ?>" name="id_pet" hidden>
                        </div>
                        <div class="form-group">
                            <input type="text" name="own_name" class="form-control form-control-user" id="own_name" value="<?= $x['pets_owner']; ?>">
                        </div>
                        <div class="form-group">
                            <select class="form-control" id="gander" name="gander">
                                <option>Choose gander</option>
                                <option value="1" <?= $x['gander'] == 1 ? "selected" : ""; ?>>Jantan</option>
                                <option value="2" <?= $x['gander'] == 2 ? "selected" : ""; ?>>Betina</option>
                            </select>
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

<?php foreach ($pets as $x) : ?>
    <div class="modal fade" id="modalDelete<?= $x['id']; ?>" tabindex="-1" aria-labelledby="modalDeleteLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalDeleteLabel">Delete Pet</h5>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('PetsController/deletePet'); ?>" method="POST">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <p>Are you sure want to delete data pet <?= $x['pets_name']; ?> ?</p>
                            <input type="text" value="<?= $x['id']; ?>" name="id_pet" hidden>
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