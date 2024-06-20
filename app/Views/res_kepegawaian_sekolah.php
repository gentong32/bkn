<?= $this->extend('layout/layout_default') ?>

<?= $this->section('style') ?>
<link rel="stylesheet" href="<?= base_url() ?>public/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="<?= base_url() ?>public/css/responsive.dataTables.min.css">
<link rel="stylesheet" href="<?= base_url() ?>public/css/tabelverval.css">
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
        <h2>Residu Kepegawaian (NIP)</h2>

        <div class="breadcrumb">
            <?= $breadcrumb ?>
        </div>

        <div class="rangkuman_table">
            <table class="table" id="rangkuman">
                <thead>
                    <tr>
                        <th rowspan="2" class="align-middle text-center" scope="col">No</th>
                        <th rowspan="2" class="align-middle text-center" scope="col">NPSN</th>
                        <th rowspan="2" class="align-middle text-center" scope="col">Nama Satuan Pendidikan</th>
                        <th rowspan="2" class="align-middle text-center" scope="col">Status</th>
                        <th rowspan="2" class="align-middle text-center" scope="col">Total PTK ASN</th>
                        <th rowspan="2" class="align-middle text-center" scope="col">Residu Kepegawaian</th>
                        <th colspan="5" class="text-center">Residu Data Kepegawaian</th>
                    </tr>
                    <tr>
                        <th class="align-middle" scope="col">NIP</th>
                        <th class="align-middle" scope="col">Nama</th>
                        <th class="align-middle" scope="col">JK</th>
                        <th class="align-middle" scope="col">Tgl Lahir</th>
                        <th class="align-middle" scope="col">Tmp Lahir</th>
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
                            <?php if (session()->get('role') == 'userLogin') { ?>
                                <td style="text-align: left !important;">
                                    <a href="<?= base_url('residu/kepegawaian') ?>?wilayah=<?= trim($row['kode_wilayah']) ?>&npsn=<?= trim($row['npsn']) ?>&level=4"><?= $row['npsn'] ?></a>
                                </td>
                            <?php } else { ?>
                                <td style="text-align: left !important;"><?= $row['npsn'] ?></td>
                            <?php } ?>
                            <td style="text-align: left !important;"><?= $row['wilayah'] ?></td>
                            <td style="text-align: center !important;"><?= ($row['status_sekolah'] == 1 ? "Negeri" : "Swasta") ?></td>
                            <td><?= $row['asn'] ?></td>
                            <td><?= $row['asn'] - $row['asn_vld_bkn'] ?></td>
                            <td><?= $row['asn'] - $row['asn_vld_nik_bkn'] ?></td>
                            <td><?= $row['asn'] - $row['asn_vld_nama_bkn'] ?></td>
                            <td><?= $row['asn'] - $row['asn_vld_jenis_kelamin_bkn'] ?></td>
                            <td><?= $row['asn'] - $row['asn_vld_tanggal_lahir_bkn'] ?></td>
                            <td><?= $row['asn'] - $row['asn_vld_tempat_lahir_bkn'] ?></td>
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
                "targets": [4, 5, 6, 7, 8, 9, 10],
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

                var totalCols = [4, 5, 6, 7, 8, 9, 10];
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
                "targets": [4, 5, 6, 7, 8, 9, 10],
                "render": $.fn.dataTable.render.number('.', ',', 0, '')
            }]

        });

        $('#rangkuman').show();
    });
</script>
<?= $this->endSection() ?>