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

    .khusus {
        color: red;
        text-align: center !important;
    }

    .rangkuman_table table tfoot th {
        text-align: center;
        padding-right: 10px !important;
    }

    .ket {
        border: 0.5px solid grey;
        border-radius: 3px;
        font-style: italic;
        font-size: smaller;
        width: 150px;
        padding: 6px;
        margin-bottom: 25px;
        display: none;
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
            <table class="table" id="rangkuman">
                <thead>
                    <tr>
                        <th rowspan="2" class="align-middle text-center" scope="col">No</th>
                        <th rowspan="2" class="align-middle text-center" scope="col">Nama PTK</th>
                        <th rowspan="2" class="align-middle text-center" scope="col">Status PTK ASN</th>
                        <th colspan="2" class="text-center">Residu Data Satminkal</th>
                    </tr>
                    <tr>
                        <th class="align-middle" scope="col">Tidak Padan</th>
                        <th class="align-middle" scope="col">Kosong</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $nomor = 0;
                    foreach ($data_wilayah as $row) :
                        $nomor++;
                    ?>
                        <tr>
                            <td scope="row" class="text-center"><?= $nomor ?></td>
                            <td style="text-align: left !important;"><?= maskName($row['nama']) ?>
                            </td>
                            <td class="text-center"><?= $row['status_kepegawaian'] ?></td>
                            <td class="khusus"><?= ($row['satminkal_asn_valid'] == 0) ? "*" : "" ?></td>
                            <td class="khusus"></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3" class="text-center" style="width: 100px !important;">Jumlah</th>
                        <th></th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
            <div class="ket">
                <b>Keterangan:</b><br>
                <span style="color:red">*</span> = Data Residu <br>
            </div>
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
                "targets": [3, 4],
                "className": "text-center"
            }],
            "footerCallback": function(row, data, start, end, display) {
                var api = this.api();

                var intVal = function(i) {
                    return typeof i === 'string' ?
                        i.replace('*', '1') * 1 :
                        typeof i === 'number' ?
                        i : 0;
                };

                var totalCols = [3, 4];
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
                "targets": [3, 4],
                "render": $.fn.dataTable.render.number('.', ',', 0, '')
            }]

        });

        $('#rangkuman').show();
        $('.ket').show();

    });
</script>
<?= $this->endSection() ?>