<?php
include "model/m_transaction.php";

$tsc = new Transaction($connection);
?>
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section_content section_content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="overview-wrap">
                        <h2 class="title-7">Transaction List</h2>
                        <button class="au-btn au-btn-icon au-btn--blue" data-toggle="modal" data-target="#tambahTransaction">
                            <i class="zmdi zmdi-plus"></i>add item
                        </button>
                    </div>
                </div>
            </div>
            <div class="row m-t-30">
                <div class="col-md-12">
                    <!-- DATA TABLE-->
                    <div class="table-responsive m-b-40">
                        <table class="table table-borderless table-data3">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Pembelian</th>
                                    <th>Detail Pembeli</th>
                                    <th>Detail Barang</th>
                                    <th>Harga Barang</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $tampil = $tsc->tampil();
                                while ($data = $tampil->fetch_object()) {
                                ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $data->tgl_beli; ?></td>
                                        <td><?php echo $data->nm_pembeli . " - " . $data->kota; ?></td>
                                        <td><?php echo $data->nm_brg . " - " . $data->merk . "(" . $data->type . ")"; ?></td>
                                        <td><?php echo $data->harga; ?></td>
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

<div class="modal fade" id="tambahTransaction" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Transaction</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <span class="glyphicon glyphicon-user form-control-feedback pull-left"></span>
                        <input type="number" name="kd_brg" class="form-control" placeholder="Kode Barang" required>
                    </div>

                    <div class="form-group">
                        <span class="glyphicon glyphicon-home form-control-feedback pull-left"></span>
                        <input type="number" name="kd_pembeli" class="form-control" placeholder="Kode Pembeli" required>
                    </div>

                    <div class="form-group">
                        <span class="glyphicon glyphicon-user form-control-feedback pull-left"></span>
                        <input type="date" name="tgl_beli" class="form-control" placeholder="Tanggal Pembelian" required>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" name="tambah" value="Simpan">
                    </div>
                </div>
            </form>
            <?php
            if (@$_POST['tambah']) {
                $kd_brg = $connection->conn->real_escape_string($_POST['kd_brg']);
                $kd_pembeli = $connection->conn->real_escape_string($_POST['kd_pembeli']);
                $tgl_beli = $connection->conn->real_escape_string($_POST['tgl_beli']);
                
                if ($kd_brg == "" || $kd_pembeli == "" || $tgl_beli == "" ) {
                    echo "<script>alert('Lengkapi data !')</script>";
                } else {
                    $tsc->tambah($kd_brg, $kd_pembeli, $tgl_beli);

                    header("location: ?page=transaction");
                    echo "<script>alert('Berhasil !')</script>";
                }
            }
            ?>
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- END DATA TABLE-->
</div>