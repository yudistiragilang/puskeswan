<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?= $title; ?></title>
    <link href="<?= base_url('public/vendor/fontawesome-free/css/all.min.css'); ?>" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="<?= base_url('public/css/sb-admin-2.min.css'); ?>" rel="stylesheet">
    <link rel="icon" href="<?= base_url('public/favicon.png'); ?>" type="image/gif">
</head>

<body class="bg-gradient-warning">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Daftar Akun !</h1>
                                    </div>

                                    <div class="text-center">
                                        <?php if (!empty(session()->getFlashdata('error'))) : ?>
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <?php echo session()->getFlashdata('error'); ?>
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        <?php endif; ?>

                                        <?php if (!empty(session()->getFlashdata('email_ada'))) : ?>
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <?php echo session()->getFlashdata('email_ada'); ?>
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

                                    <form action="<?= base_url('PagesController/createAkun'); ?>" method="POST" class="user">
                                        <?= csrf_field() ?>
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="text" class="form-control form-control-user" value="<?= old('first_name'); ?>" name="first_name" placeholder="First Name">
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control form-control-user" value="<?= old('last_name'); ?>" name="last_name" placeholder="Last Name">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user" value="<?= old('email'); ?>" name="email" placeholder="Email Address">
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="password" class="form-control form-control-user" value="<?= old('password'); ?>" name="password" placeholder="Password">
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="password" class="form-control form-control-user" value="<?= old('re_password'); ?>" name="re_password" placeholder="Repeat Password">
                                            </div>
                                        </div>
                                        <input type="submit" name="process" value="Daftar" class="btn btn-primary btn-user btn-block">
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="<?= base_url('/forgot'); ?>">Lupa password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="<?= base_url(); ?>">Sudah punya akun? Login!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= base_url('public/vendor/jquery/jquery.min.js'); ?>"></script>
    <script src="<?= base_url('public/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
    <script src="<?= base_url('public/vendor/jquery-easing/jquery.easing.min.js'); ?>"></script>
    <script src="<?= base_url('public/js/sb-admin-2.min.js'); ?>"></script>

</body>

</html>