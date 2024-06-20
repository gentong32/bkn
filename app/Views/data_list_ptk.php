<?= $this->extend('layout/layout_default') ?>

<?= $this->section('style') ?>
<link rel="stylesheet" href="<?= base_url() ?>public/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="<?= base_url() ?>public/css/responsive.dataTables.min.css">
<link rel="stylesheet" href="<?= base_url() ?>public/css/tabelverval.css">
<style>
    #rangkuman {
        display: none;
    }

    .rangkuman_table {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    .rangkuman_table table thead {
        background-color: #D5EDD4;
    }

    .rangkuman_table table thead th {
        text-align: center;
        font-weight: bold;
        border: 0.5px solid #ABC9AA;
    }

    .rangkuman_table table tbody td {
        text-align: right;
    }

    .rangkuman_table table tfoot th {
        text-align: right;
    }

    table {
        width: 1300px !important;
    }

    .dataTables_length {
        margin-bottom: 10px;
    }

    .text-left {
        text-align: left;
    }

    .text-right {
        text-align: right;
    }

    .text-center {
        text-align: center !important;
    }

    .text-center2 {
        text-align: center !important;
        padding-right: 10px !important;
    }

    a {
        text-decoration: none;
        color: #3DAD38;
    }

    .breadcrumb {
        font-size: 16px;
        font-style: italic;
        padding: 0;
        margin-bottom: 20px;
    }

    #rangkuman {
        margin-top: 20px;
    }

    table.dataTable>tfoot>tr>th,
    table.dataTable>tfoot>tr>td {
        padding-right: 5px;
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
PENDIDIK DANs TENAGA KEPENDIDIKAN

<div class="container">
    <div class="card">
        <h2>Rangkuman Pendidik dan Tenaga Kependidikan
            <br>
            Menurut Status dan Validitas Data
        </h2>

        <div class="breadcrumb">
            <?= $breadcrumb ?>
        </div>

        <div class="rangkuman_table">
            <table class="table table-hover table-bordered table-striped" id="rangkuman">
                <thead>
                    <tr>
                        <th rowspan="2" class="align-middle text-center" scope="col">No</th>
                        <th rowspan="2" class="align-middle text-center" scope="col">Nama PTK</th>
                        <th rowspan="2" class="align-middle text-center" scope="col">Status</th>
                        <th rowspan="2" scope="col" class="text-center khusus">Validitas PTK ASN</th>
                        <th colspan="4" class="text-center">Validitas Data ASN</th>
                    </tr>
                    <tr>
                        <th class="align-middle" scope="col">Kependudukan</th>
                        <th class="align-middle" scope="col">Kepegawaian</th>
                        <th class="align-middle" scope="col">NUPTK</th>
                        <th class="align-middle" scope="col">Satminkal</th>
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
                            <td class="text-center" <?= ($row['valid_ptk'] == 0) ? "style='color:red'" : "" ?>><?= ($row['valid_ptk'] == 1) ? "✔" : "✘" ?></td>
                            <td class="text-center" <?= ($row['asn_vld_siak'] == 0) ? "style='color:red'" : "" ?>><?= ($row['asn_vld_siak'] == 1) ? "✔" : "✘" ?></td>
                            <td class="text-center" <?= ($row['asn_vld_bkn'] == 0) ? "style='color:red'" : "" ?>><?= ($row['asn_vld_bkn'] == 1) ? "✔" : "✘" ?></td>
                            <td class="text-center" <?= ($row['asn_padan_nik_valid_nuptk'] == 0) ? "style='color:red'" : "" ?>><?= ($row['asn_padan_nik_valid_nuptk'] == 1) ? "✔" : "✘" ?></td>
                            <td class="text-center" <?= ($row['satminkal_valid'] == 0) ? "style='color:red'" : "" ?>><?= ($row['satminkal_valid'] == 1) ? "✔" : "✘" ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="2" class="text-center" style="width: 100px !important;">Jumlah</th>
                        <th></th>
                        <th class="text-center2"></th>
                        <th class="text-center2"></th>
                        <th class="text-center2"></th>
                        <th class="text-center2"></th>
                        <th class="text-center2"></th>
                    </tr>
                </tfoot>
            </table>
            <div class="ket">
                <b>Keterangan:</b><br>
                ✔ = Data Valid <br>
                <span style="color:red">✘</span> = Data Residu <br>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script src="<?= base_url() ?>public/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>public/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/plug-ins/1.11.3/dataRender/number.js"></script>
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
                "targets": [3, 4, 5, 6, 7],
                "className": "text-right"
            }],
            "footerCallback": function(row, data, start, end, display) {
                var api = this.api();

                var intVal = function(i) {
                    return typeof i === 'string' ?
                        i.replace('✔', '1') * 1 :
                        i.replace('✘', '0') * 0;
                    // "✔": "✘"
                };

                var intVal = function(i) {
                    return typeof i === 'string' && i == '✔' ?
                        i.replace('✔', '1') * 1 : typeof i === 'string' && i == '✘' ? i.replace('✘', '0') * 1 :
                        typeof i === 'number' ?
                        i : 0;
                };

                var totalCols = [3, 4, 5, 6, 7];
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
                "targets": [3, 4, 5, 6, 7],
                "render": $.fn.dataTable.render.number('.', ',', 0, '')
            }]

        });

        $('#rangkuman').show();
        $('.ket').show();
    });
</script>
<?= $this->endSection() ?>