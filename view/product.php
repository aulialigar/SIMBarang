<?php
include "model/m_product.php";
$pdc = new Product($connection);

if(@$_GET['act'] == ''){
?>
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="overview-wrap">
                        <h2 class="title-7">Product List</h2>
                        <button class="au-btn au-btn-icon au-btn--blue" data-toggle="modal" data-target="#tambahProduct">
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
                                    <option selected="selected">Nama Barang</option>
                                    <option value="">Merk</option>
                                    <option value="">Harga</option>
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
                <table class="table table-borderless table-striped table-earning">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Merk</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $tampil = $pdc->tampil();
                        while ($data = $tampil->fetch_object()) {
                        ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $data->nm_brg; ?></td>
                                <td><?php echo $data->merk . " - " . $data->type; ?></td>
                                <td><?php echo $data->harga; ?></td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm" id="edit_pdc" data-toggle="modal" data-target="#editProduct" data-kd="<?php echo $data->kd_brg; ?>" data-nama="<?php echo $data->nm_brg; ?>" data-merk="<?php echo $data->merk; ?>" data-type="<?php echo $data->type; ?>" data-harga="<?php echo $data->harga; ?>" data-stok="<?php echo $data->stok; ?>">
                                        <i class="fa fa-edit"></i>&nbsp; Edit</button>
                                        <a href="?page=product&act=del&id=<?php echo $data->kd_brg; ?>">
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
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->

<div class="modal fade" id="tambahProduct" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Product</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <span class="glyphicon glyphicon-user form-control-feedback pull-left"></span>
                        <input type="text" name="nm_brg" class="form-control" placeholder="Nama Barang" required>
                    </div>

                    <div class="form-group">
                        <span class="glyphicon glyphicon-home form-control-feedback pull-left"></span>
                        <input type="text" name="merk" class="form-control" placeholder="Merk" required>
                    </div>

                    <div class="form-group">
                        <span class="glyphicon glyphicon-user form-control-feedback pull-left"></span>
                        <input type="text" name="type" class="form-control" placeholder="Tipe" required>
                    </div>

                    <div class="form-group">
                        <span class="glyphicon glyphicon-user form-control-feedback pull-left"></span>
                        <input type="text" name="harga" class="form-control" placeholder="Harga" required>
                    </div>

                    <div class="form-group">
                        <span class="glyphicon glyphicon-user form-control-feedback pull-left"></span>
                        <input type="number" name="stok" class="form-control" placeholder="Stok" required>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" name="tambah" value="Simpan">
                    </div>
                </div>
            </form>
            <?php
            if (@$_POST['tambah']) {
                $nm_brg = $connection->conn->real_escape_string($_POST['nm_brg']);
                $merk = $connection->conn->real_escape_string($_POST['merk']);
                $type = $connection->conn->real_escape_string($_POST['type']);
                $harga = $connection->conn->real_escape_string($_POST['harga']);
                $stok = $connection->conn->real_escape_string($_POST['stok']);

                if ($nm_brg == "" || $merk == "" || $type == "" || $harga == "" || $stok == "") {
                    echo "<script>alert('Lengkapi data !')</script>";
                } else {
                    $pdc->tambah($nm_brg, $merk, $type, $harga, $stok);
                    header("location: ?page=product");
                    echo "<script>alert('Berhasil !')</script>";
                }
            }
            ?>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- END DATA TABLE-->
</div>

<div class="modal fade" id="editProduct" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Data Product</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form id="form" enctype="multipart/form-data">
                <div class="modal-body" id="modal-edit">

                    <div class="form-group">
                        <span class="glyphicon glyphicon-user form-control-feedback pull-left">Nama Barang</span>
                        <input type="hidden" name="kd_brg" id="kd_brg" class="form-control">
                        <input type="text" name="nm_brg" id="nm_brg" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <span class="glyphicon glyphicon-home form-control-feedback pull-left">Merk</span>
                        <input type="text" name="merk" id="merk" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <span class="glyphicon glyphicon-user form-control-feedback pull-left">Tipe</span>
                        <input type="text" name="type" id="type" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <span class="glyphicon glyphicon-user form-control-feedback pull-left">Harga</span>
                        <input type="text" name="harga" id="harga" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <span class="glyphicon glyphicon-user form-control-feedback pull-left">Stok</span>
                        <input type="number" name="stok" id="stok" class="form-control" required>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" name="edit" value="Simpan">
                    </div>
                </div>
            </form>
            <script src="assets/vendor/jquery-3.2.1.min.js"></script>
            <script type="text/javascript">
                $(document).on("click", "#edit_pdc", function() {
                    var kdbrg = $(this).data('kd');
                    var nmbrg = $(this).data('nama');
                    var merkbrg = $(this).data('merk');
                    var typebrg = $(this).data('type');
                    var hrgbrg = $(this).data('harga');
                    var stokbrg = $(this).data('stok');
                    $("#modal-edit #kd_brg").val(kdbrg);
                    $("#modal-edit #nm_brg").val(nmbrg);
                    $("#modal-edit #merk").val(merkbrg);
                    $("#modal-edit #type").val(typebrg);
                    $("#modal-edit #harga").val(hrgbrg);
                    $("#modal-edit #stok").val(stokbrg);
                })

                $(document).ready(function(e){
                    $("#form").on("submit", (function(e){
                        e.preventDefault();
                        $.ajax({
                            url : 'model/edit_barang.php',
                            type : 'POST',
                            data : new FormData(this),
                            contentType : false,
                            cache : false,
                            processData : false,
                            success : function(msg){
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
} else if (@$_GET['act'] == 'del'){
    $pdc->hapus($_GET['id']);
    header("location: ?page=product");
}
?>