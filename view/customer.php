<?php
include "model/m_customer.php";
$ctm = new Customer($connection);

if (@$_GET['act'] == '') {
?>
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="overview-wrap">
                            <h2 class="title-7">Customer List</h2>
                            <button class="au-btn au-btn-icon au-btn--blue" data-toggle="modal" data-target="#tambahCustomer">
                                <i class="zmdi zmdi-plus"></i>add item
                            </button>
                        </div>
                    </div>
                </div>
                <div class="row m-t-30">
                    <div class="col-md-12">
                        <!-- DATA TABLE-->
                        <div class="table-data__tool">
                            <div class="table-data__tool-left">
                                <div class="rs-select2--light">
                                    <p>Pencarian berdasarkan field</p>
                                </div>
                                <div class="rs-select2--light rs-select2--md">
                                    <select class="js-select2" name="property">
                                        <option selected="selected">Nama Pembeli</option>
                                        <option value="">Jenis Kelamin</option>
                                        <option value="">Alamat</option>
                                        <option value="">Kota</option>
                                    </select>
                                    <div class="dropDownSelect2"></div>
                                </div>
                                <div class="table-data__tool-left">
                                    <div class="rs-select2--light">
                                        <p>Kata kunci</p>
                                    </div>
                                    <div class="rs-select2--light">
                                        <div class="input-group">
                                            <input type="email" id="input2-group2" name="input2-group2" class="form-control">
                                            <div class="input-group-btn">
                                                <button class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive m-b-40">
                    <table class="table table-borderless table-striped table-earning">
                            <thead>
                                <tr>
                                    <th>Nama Pembeli</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Alamat</th>
                                    <th>Kota</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $tampil = $ctm->tampil();
                                while ($data = $tampil->fetch_object()) {
                                ?>
                                    <tr>
                                        <td><?php echo $data->nm_pembeli; ?></td>
                                        <td><?php echo $data->jk; ?></td>
                                        <td><?php echo $data->alamat; ?></td>
                                        <td><?php echo $data->kota; ?></td>
                                        <td>
                                            <button type="button" class="btn btn-primary btn-sm" id="edit_ctm" data-toggle="modal" data-target="#editCustomer" data-kd="<?php echo $data->kd_pembeli; ?>" data-nama="<?php echo $data->nm_pembeli; ?>" data-jk="<?php echo $data->jk; ?>" data-alamat="<?php echo $data->alamat; ?>" data-kota="<?php echo $data->kota; ?>">
                                                <i class="fa fa-edit"></i>&nbsp; Edit</button>
                                            <a href="?page=customer&act=del&id=<?php echo $data->kd_pembeli; ?>">
                                                <button type="button" class="btn btn-danger btn-sm" onclick="return confirm('Yakin akan menghapus data ini?')">
                                                    <i class="fa fa-trash"></i>&nbsp; Hapus</button>
                                            </a>
                                        </td>
                                    </tr>
                                <?php
                                } ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- END DATA TABLE-->
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- END MAIN CONTENT-->

    <div class="modal fade" id="tambahCustomer" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Data Customer</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <span class="glyphicon glyphicon-user form-control-feedback pull-left"></span>
                            <input type="text" name="nm_pembeli" class="form-control" placeholder="Nama Pembeli" required>
                        </div>

                        <div class="form-group">
                            <select name="jk" class="form-control" required>
                                <option value="">Pilih jenis kelamin Anda</option>
                                <option value="P">Perempuan</option>
                                <option value="L">Laki-laki</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <span class="glyphicon glyphicon-home form-control-feedback pull-left"></span>
                            <textarea type="text" name="alamat" class="form-control" placeholder="Alamat Rumah"></textarea>
                        </div>

                        <div class="form-group">
                            <span class="glyphicon glyphicon-user form-control-feedback pull-left"></span>
                            <input type="text" name="kota" class="form-control" placeholder="Kota">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-primary" name="tambah" value="Simpan">
                        </div>
                    </div>
                </form>
                <?php
                if (@$_POST['tambah']) {
                    $nm_pembeli = $connection->conn->real_escape_string($_POST['nm_pembeli']);
                    $jk = $connection->conn->real_escape_string($_POST['jk']);
                    $alamat = $connection->conn->real_escape_string($_POST['alamat']);
                    $kota = $connection->conn->real_escape_string($_POST['kota']);

                    if ($nm_pembeli == "" || $jk == "" || $alamat == "" || $kota == "") {
                        echo "<script>alert('Lengkapi data !')</script>";
                    } else {
                        $ctm->tambah($nm_pembeli, $jk, $alamat, $kota);

                        header("location: ?page=customer");
                        echo "<script>alert('Berhasil !')</script>";
                    }
                }
                ?>
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- END DATA TABLE-->
    </div>

    <div class="modal fade" id="editCustomer" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Data Customer</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="form" enctype="multipart/form-data">
                    <div class="modal-body" id="modal-edit">

                        <div class="form-group">
                            <span class="glyphicon glyphicon-user form-control-feedback pull-left">Nama Pembeli</span>
                            <input type="hidden" name="kd_pembeli" id="kd_pembeli" class="form-control">
                            <input type="text" name="nm_pembeli" id="nm_pembeli" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <span class="glyphicon glyphicon-home form-control-feedback pull-left">Jenis Kelamin</span>
                            <input type="text" name="jk" id="jk" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <span class="glyphicon glyphicon-user form-control-feedback pull-left">Alamat</span>
                            <input type="text" name="alamat" id="alamat" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <span class="glyphicon glyphicon-user form-control-feedback pull-left">Kota</span>
                            <input type="text" name="kota" id="kota" class="form-control" required>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-primary" name="edit" value="Simpan">
                        </div>
                    </div>
                </form>
                <script src="assets/vendor/jquery-3.2.1.min.js"></script>
                <script type="text/javascript">
                    $(document).on("click", "#edit_ctm", function() {
                        var kdpembeli = $(this).data('kd');
                        var nmpembeli = $(this).data('nama');
                        var jkpembeli = $(this).data('jk');
                        var alamatpembeli = $(this).data('alamat');
                        var kotapembeli = $(this).data('kota');
                        $("#modal-edit #kd_pembeli").val(kdpembeli);
                        $("#modal-edit #nm_pembeli").val(nmpembeli);
                        $("#modal-edit #jk").val(jkpembeli);
                        $("#modal-edit #alamat").val(alamatpembeli);
                        $("#modal-edit #kota").val(kotapembeli);
                    })

                    $(document).ready(function(e) {
                        $("#form").on("submit", (function(e) {
                            e.preventDefault();
                            $.ajax({
                                url: 'model/edit_pembeli.php',
                                type: 'POST',
                                data: new FormData(this),
                                contentType: false,
                                cache: false,
                                processData: false,
                                success: function(msg) {
                                    $('.table').html(msg);
                                }
                            });
                        }));
                    })
                </script>

                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- END DATA TABLE-->
    </div>
<?php
} else if (@$_GET['act'] == 'del') {
    $ctm->hapus($_GET['id']);
    header("location: ?page=customer");
}
?>