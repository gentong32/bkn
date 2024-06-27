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

    .tbhal {
        width: 120px;
        height: 40px;
        margin-right: 3px;
        border: 0.5px solid gray;
        cursor: pointer;
    }

    .tbaktif {
        background-color: lightblue;
        border: 1px solid #28BCF3;
    }

    .tbkontain {
        display: flex;
        margin-bottom: 25px;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('konten') ?>
Ver-Val Data Master

<div class="container">
    <div class="card">
        <h2>Residu Kepegawaian (NIP)</h2>
        <div class="tbkontain">
            <button id="tbpar1" class="tbhal" onclick="kedasbor(1)">Parameter 1</button>
            <button id="tbpar2" class="tbhal" onclick="kedasbor(2)">Parameter 2</button>
        </div>
        <script>
            const urlParams = new URLSearchParams(window.location.search);
            if (!urlParams.has('param')) {
                const switchState = localStorage.getItem('parameterSwitch') || '1';
                urlParams.set('param', switchState);
                window.location.search = urlParams.toString();
            }

            function initializeSwitch() {
                const switchState = localStorage.getItem("parameterSwitch");
                const tbpar1 = document.getElementById("tbpar1");
                const tbpar2 = document.getElementById("tbpar2");

                if (switchState === "2") {
                    tbpar2.classList.add('tbaktif');
                    tbpar1.classList.remove('tbaktif');
                } else {
                    tbpar1.classList.add('tbaktif');
                    tbpar2.classList.remove('tbaktif');
                }
            }

            initializeSwitch();
        </script>

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
                            <td style="text-align: left !important;"><?= maskName($row['nama']) ?>
                            </td>
                            <td class="text-center"><?= $row['status_kepegawaian'] ?></td>
                            <td class="khusus"><?= ($row['asn_vld_nik_bkn'] == 0) ? "*" : "" ?></td>
                            <?php if ($param == 1) : ?>
                                <td class="khusus"><?= ($row['asn_vld_nama_bkn'] == 0) ? "*" : "" ?></td>
                            <?php elseif ($param == 2) : ?>
                                <td class="khusus"><?= ($row['asn_vld_nama_2_bkn'] == 0) ? "*" : "" ?></td>
                            <?php endif ?>
                            <td class="khusus"><?= ($row['asn_vld_jenis_kelamin_bkn'] == 0) ? "*" : "" ?></td>
                            <td class="khusus"><?= ($row['asn_vld_tanggal_lahir_bkn'] == 0) ? "*" : "" ?></td>
                            <?php if ($param == 1) : ?>
                                <td class="khusus"><?= ($row['asn_vld_tempat_lahir_bkn'] == 0) ? "*" : "" ?></td>
                            <?php elseif ($param == 2) : ?>
                                <td class="khusus"><?= ($row['asn_vld_tempat_lahir_2_bkn'] == 0) ? "*" : "" ?></td>
                            <?php endif ?>
                        </tr>
                    <?php endforeach ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3" class="text-center" style="width: 100px !important;">Jumlah</th>
                        <th></th>
                        <th></th>
                        <th></th>
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
    function updateLinks() {
        const tbpar2 = document.getElementById('tbpar2');
        const parameter = tbpar2.classList.contains('tbaktif') ? '2' : '1';
        const links = document.querySelectorAll('table a, #breadcrumb a');

        links.forEach(link => {
            const url = new URL(link.href);
            url.searchParams.set('param', parameter);
            link.href = url.toString();
        });

        const breadcrumbDiv = document.getElementById('breadcrumb');
        breadcrumbDiv.innerHTML = breadcrumbDiv.innerHTML.replace(/{param}/g, parameter);
    }

    updateLinks();

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

    function updateUrlParameter(parameter) {
        const currentUrl = new URL(window.location.href);
        currentUrl.searchParams.set('param', parameter);
        window.history.replaceState({}, '', currentUrl);
        window.location.reload();
    }

    function kedasbor(idx) {
        if (idx === "2") {
            tbpar2.classList.add('tbaktif');
            tbpar1.classList.remove('tbaktif');
        } else {
            tbpar1.classList.add('tbaktif');
            tbpar2.classList.remove('tbaktif');
        }
        localStorage.setItem('parameterSwitch', idx);
        updateUrlParameter(idx);
    };
</script>
<?= $this->endSection() ?>