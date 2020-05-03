<?php
include "model/m_transaction.php";

$tsc = new Transaction($connection);
?>
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="overview-wrap">
                        <h2 class="title-7">Transaction List</h2>
                        <button class="au-btn au-btn-icon au-btn--blue">
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