<?= $this->extend('layout/layout_default') ?>

<?= $this->section('style') ?>
<link rel="stylesheet" href="<?= base_url() ?>public/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="<?= base_url() ?>public/css/responsive.dataTables.min.css">
<link rel="stylesheet" href="<?= base_url() ?>public/css/tabelverval.css?v1.2">
<style>
    table.dataTable>tfoot>tr>th,
    table.dataTable>tfoot>tr>td {
        padding-right: 5px;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('konten') ?>
Ver-Val Data Master

<div class="container">
    <div class="card">
        <h2>Residu Satminkal (NPSN)</h2>

        <div id="breadcrumb">
            <?= $breadcrumb ?>
        </div>

        <div class="rangkuman_table">
            <table class="table table-hover table-bordered table-striped" id="rangkuman">
                <thead>
                    <tr>
                        <th rowspan="2" class="align-middle text-center" scope="col">No</th>
                        <th rowspan="2" class="align-middle text-center" scope="col">Wilayah</th>
                        <th rowspan="2" class="align-middle text-center" scope="col">Total PTK ASN</th>
                        <th colspan="2" class="text-center">Status</th>
                        <th rowspan="2" class="align-middle text-center" scope="col">Residu Satminkal</th>
                        <th colspan="2" class="text-center">Residu Data Satminkal</th>
                    </tr>
                    <tr>
                        <th class="align-middle" scope="col">Negeri</th>
                        <th class="align-middle" scope="col">Swasta</th>
                        <th class="align-middle" scope="col">Tidak Padan</th>
                        <th class="align-middle" scope="col">Kosong</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $nomor = 0;
                    $asn = 0;
                    $residu = 0;
                    $residu_n = 0;
                    $residu_s = 0;
                    $residu_tidak_padan = 0;
                    $residu_kosong = 0;
                    foreach ($data_wilayah as $row) :
                        $nomor++;
                        $asn += intval($row['asn']);
                        $residu += 0;
                        $residu_n += 0;
                        $residu_s += 0;
                        $residu_tidak_padan += 0;
                        $residu_kosong += 0;
                    ?>
                        <tr>
                            <td scope="row" class="text-center"><?= $nomor ?></td>
                            <td style="text-align: left !important;">
                                <a href="<?= base_url('residu/satminkal') ?>?wilayah=<?= trim($row['kode_wilayah']) ?>&level=<?= $row['id_level_wilayah'] ?>"><?= $row['wilayah'] ?></a>
                            </td>
                            <td><?= $row['asn'] ?></td>
                            <td><?= $row['asn_n'] ?></td>
                            <td><?= $row['asn_s'] ?></td>
                            <td><?= $row['asn'] - $row['satminkal_valid'] ?></td>
                            <td><?= $row['asn'] - $row['satminkal_asn_padan'] ?></td>
                            <td></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="2" class="text-center" style="width: 100px !important;">Jumlah</th>
                        <th><?= $asn ?></th>
                        <th><?= $residu ?></th>
                        <th><?= $residu_n ?></th>
                        <th><?= $residu_s ?></th>
                        <th><?= $residu_tidak_padan ?></th>
                        <th><?= $residu_kosong ?></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>


<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script src="<?= base_url() ?>public/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>public/js/dataTables.responsive.min.js"></script>
<script>
    $(document).ready(function() {
        table11 = $('#rangkuman').DataTable({
            "language": {
                "decimal": ",",
                "thousands": ".",
                "sEmptyTable": "Tidak ada data yang tersedia pada tabel ini",
                "sProcessing": "Sedang memproses...",
                "sLengthMenu": "Tampilkan _MENU_",
                "sZeroRecords": "Tidak ditemukan data yang sesuai",
                "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                "sInfoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
                "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
                "sInfoPostFix": "",
                "sSearch": "Cari:",
                "sUrl": "",
                "oPaginate": {
                    "sFirst": "Pertama",
                    "sPrevious": "Sebelumnya",
                    "sNext": "Selanjutnya",
                    "sLast": "Terakhir"
                },
                "sEmptyTable": "Tidak ada data di database"
            },
            "iDisplayLength": 10,
            "lengthMenu": [
                [5, 10, 25, 50, 100, -1],
                [5, 10, 25, 50, 100, "Semua"]
            ],
            "processing": false,
            "serverSide": false,
            "order": [
                [0, 'asc']
            ],
            "paging": true,
            "ordering": true,
            "info": true,
            "searching": true,
            "columnDefs": [{
                "targets": [2, 3, 4, 5, 6, 7],
                "className": "text-right"
            }],
            "footerCallback": function(row, data, start, end, display) {
                var api = this.api();

                var intVal = function(i) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '') * 1 :
                        typeof i === 'number' ?
                        i : 0;
                };

                var totalCols = [2, 3, 4, 5, 6, 7];
                var totals = totalCols.map(function(index) {
                    return api.column(index).data().reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);
                });

                totals.forEach(function(total, i) {
                    $(api.column(totalCols[i]).footer()).html(total.toLocaleString('id-ID'));
                });
            },
            "columnDefs": [{
                "targets": [2, 3, 4, 5, 6, 7],
                "render": $.fn.dataTable.render.number('.', ',', 0, '')
            }]

        });

        $('#rangkuman').show();
    });
</script>
<?= $this->endSection() ?>