<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
            </div>

            <br>

            <form>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table">
                            <tr>
                                <td>Owner</td>
                                <td> : </td>
                                <td>
                                    <select class="simple-select2" id="own_name" name="own_name">
                                        <option>Choose Owner</option>
                                        <?php foreach ($owners->getResult() as $owner) : ?>
                                            <option value="<?= $owner->nik; ?>"><?= $owner->nik . " | " . $owner->owner_name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                                <td> </td>
                                <td>Date</td>
                                <td> : </td>
                                <td colspan="2"><input type="date" name="trans_date" class="form-control"></td>
                            </tr>
                            <tr>
                                <td>Pet</td>
                                <td> : </td>
                                <td>
                                    <select class="simple-select2" id="own_name" name="own_name">
                                        <option>Choose Pet</option>
                                        <?php foreach ($pets->getResult() as $pet) : ?>
                                            <option value="<?= $pet->id; ?>"><?= $pet->pets_name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                                <td> </td>
                                <td>Rawat Inap</td>
                                <td> : </td>
                                <td>
                                    <input class="form-check-input" type="radio" name="inap" value="1">
                                    <label>Yes</label>
                                </td>
                                <td>
                                    <input class="form-check-input" type="radio" name="inap" value="0" checked>
                                    <label>No</label>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>

<?= $this->endSection(); ?>