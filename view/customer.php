<?php
include "model/m_customer.php";

$pdc = new Customer($connection);
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
                    <table class="table table-borderless table-data3">
                        <thead>
                            <tr>
                                <th>Nama Pembeli</th>
                                <th>Jenis Kelamin</th>
                                <th>Alamat</th>
                                <th>Kota</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $tampil = $pdc->tampil();
                            while ($data = $tampil->fetch_object()) {
                            ?>
                                <tr>
                                    <td><?php echo $data->nm_pembeli; ?></td>
                                    <td><?php echo $data->jk; ?></td>
                                    <td><?php echo $data->alamat; ?></td>
                                    <td><?php echo $data->kota; ?></td>
                                    <td>
                                        <div class="table-data-feature">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i class="zmdi zmdi-edit"></i>
                                            </button>
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                <i class="zmdi zmdi-delete"></i>
                                            </button>
                                        </div>
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
                <h4 class="modal-title">Tambah Data Product</h4>
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
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- END DATA TABLE-->
</div>