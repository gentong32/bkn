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

    /* .rangkuman_table table thead {
        background-color: #F5E6E4;
    }

    .rangkuman_table table thead th {
        text-align: center;
        font-weight: bold;
        border: 0.5px solid #abc9aa;
    } */
</style>

<?= $this->endSection() ?>

<?= $this->section('konten') ?>
Ver-Val Data Master

<div class="container">
    <div class="card">
        <h2>Residu Kependudukan (NIK)</h2>

        <div id="breadcrumb">
            <?= $breadcrumb ?>
        </div>

        <div class="rangkuman_table">
            <table class="table" id="rangkuman">
                <thead>
                    <tr>
                        <th rowspan="2" class="align-middle text-center" scope="col">No</th>
                        <th rowspan="2" class="align-middle text-center" scope="col">Wilayah</th>
                        <th rowspan="2" class="align-middle text-center" scope="col">Total PTK ASN</th>
                        <th colspan="2" class="text-center">Status</th>
                        <th rowspan="2" class="align-middle text-center" scope="col">Residu Kependudukan</th>
                        <th colspan="6" class="text-center">Residu Data Kependudukan</th>
                    </tr>
                    <tr>
                        <th class="align-middle" scope="col">Negeri</th>
                        <th class="align-middle" scope="col">Swasta</th>
                        <th class="align-middle" scope="col">NIK</th>
                        <th class="align-middle" scope="col">Nama</th>
                        <th class="align-middle" scope="col">JK</th>
                        <th class="align-middle" scope="col">Tgl Lahir</th>
                        <th class="align-middle" scope="col">Tmp Lahir</th>
                        <th class="align-middle" scope="col">Ibu Kandung</th>
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
                            <td style="text-align: left !important;">
                                <a href="<?= base_url('residu/kependudukan') ?>?wilayah=<?= trim($row['kode_wilayah']) ?>&level=<?= $row['id_level_wilayah'] ?>"><?= $row['wilayah'] ?></a>
                            </td>
                            <td><?= $row['asn'] ?></td>
                            <td><?= $row['asn_n'] ?></td>
                            <td><?= $row['asn_s'] ?></td>
                            <td><?= $row['asn'] - $row['asn_vld_siak'] ?></td>
                            <td class="text-center"><?= $row['asn'] - $row['asn_padan_nik_valid'] ?></td>
                            <td><?= $row['asn'] - $row['asn_vld_nama_siak'] ?></td>
                            <td><?= $row['asn'] - $row['asn_vld_jenis_kelamin_siak'] ?></td>
                            <td><?= $row['asn'] - $row['asn_vld_tanggal_lahir_siak'] ?></td>
                            <td><?= $row['asn'] - $row['asn_vld_tempat_lahir_siak'] ?></td>
                            <td><?= $row['asn'] - $row['asn_vld_nama_ibu_kandung_siak'] ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="2" class="text-center" style="width: 100px !important;">Jumlah</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
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
                "targets": [2, 3, 4, 5, 6, 7, 8, 9, 10, 11],
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

                var totalCols = [2, 3, 4, 5, 6, 7, 8, 9, 10, 11];
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
                "targets": [2, 3, 4, 5, 6, 7, 8, 9, 10, 11],
                "render": $.fn.dataTable.render.number('.', ',', 0, '')
            }]

        });

        $('#rangkuman').show();

    });
</script>
<?= $this->endSection() ?>