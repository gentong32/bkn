<?= $this->extend('layout/layout_default') ?>

<?= $this->section('style') ?>
<link rel="stylesheet" href="<?= base_url() ?>public/css/select2.min.css">
<link rel="stylesheet" href="<?= base_url() ?>public/css/button.css">
<style>
    .rangkuman_table {
        display: none;
    }

    .kohort-wrapper {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        position: relative;

    }

    .kohort {
        background-color: white;
        text-align: center;
        position: relative;
        height: 600px;
        margin-top: -20px;
        margin-left: -25px;
    }

    .infokohort {
        background-color: white;
        width: 120px;
        text-align: left;
        position: absolute;
        margin-top: 115px;
        top: 0;
        margin-left: 700px;
        border: 0px solid gray;
        padding: 10px;
    }

    .infokohort2 {
        background-color: white;
        width: 120px;
        text-align: left;
        position: absolute;
        margin-top: 260px;
        top: 0;
        margin-left: 700px;
        border: 0px solid gray;
        padding: 10px;
    }

    .card h3 {
        margin-bottom: 0px;
        text-align: center;
    }

    .card h4 {
        margin-top: 0px;
        margin-bottom: 20px;
        text-align: center;
    }

    .bagan {
        position: absolute;
        border: 0.5px solid black;
        border-radius: 5px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 140px;
        height: 60px;
        padding-top: 10px;
    }

    .bagan div {
        font-weight: bold;
        font-size: 22px;
        margin-top: 4px;
    }

    .baganbulat {
        position: absolute;
        border: 0.5px solid black;
        border-radius: 30px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 60px;
        height: 50px;
        padding-top: 10px;
    }

    .baganbulat div {
        font-weight: bold;
        font-size: 17px;
        margin-top: 10px;
    }

    #kh_total_ptk {
        background-color: #FFC300;
        top: 60px;
        left: 30px;
    }

    #kh_total_asn {
        background-color: #28BCF3;
        top: 120px;
        left: 208px;
    }

    #kh_valid_ptk {
        background-color: #79C04B;
        top: 120px;
        left: 490px;
    }

    #kh_persen_valid_ptk {
        background-color: #79C04B;
        top: 125px;
        left: 640px;
    }

    #kh_valid_ptk2 {
        background-color: #79C04B;
        top: 265px;
        left: 490px;
    }

    #kh_persen_valid_ptk2 {
        background-color: #79C04B;
        top: 270px;
        left: 640px;
    }


    .pil_select select {
        width: 150px;
    }

    @media (max-width: 768px) {
        .pil_select select {
            width: 100%;
        }
    }

    .info_angka {
        font-weight: bold;
        font-size: 28px;
    }

    .merah {
        color: #dd4499;
    }

    .arrow {
        position: absolute;
        top: 0;
        left: 0;
        /* display: none; */
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
    }
</style>
<?= $this->endSection() ?>

<?php $nama_bulan = array('Januari', 'Pebruari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'Nopember', 'Desember'); ?>

<?= $this->section('konten') ?>
DASBOR 2
<div class="container">
    <div class="card">
        <div class="tbkontain">
            <button class="tbhal <?= ($hal == 1) ? 'tbaktif' : '' ?>" onclick="kedasbor(1)">Parameter 1</button>
            <button class="tbhal <?= ($hal == 2) ? 'tbaktif' : '' ?>" onclick="kedasbor(2)">Parameter 2</button>
            <button class="tbhal <?= ($hal == 3) ? 'tbaktif' : '' ?>" onclick="kedasbor(3)">Resume</button>
        </div>
        <h3>Kohort Verifikasi PTK-ASN</h3>
        <h4>(Kondisi <?= date('d') . " " . $nama_bulan[date('n') - 1] . " " . date('Y') ?>)</h4>
        <div class="kohort-wrapper">
            <div class="kohort">
                <div class='bagan' id='kh_total_ptk'>
                    <b>Total PTK</b>
                    <div><?= number_format($data_nasional['total_ptk_aktif'], 0, ',', '.') ?></div>
                </div>
                <div class='bagan' id='kh_total_asn'>
                    <b>Total PTK ASN</b>
                    <div><?= number_format($data_nasional['asn'], 0, ',', '.') ?></div>
                </div>

                <div class='bagan' id='kh_valid_ptk'>
                    <b>Valid PTK ASN</b>
                    <div><?= number_format($data_nasional['valid_ptk'], 0, ',', '.') ?></div>
                </div>
                <div class='baganbulat' id='kh_persen_valid_ptk'>
                    <div><?= number_format((($data_nasional['valid_ptk']) * 100 / $data_nasional['asn']), 2, ',', '.') ?>%</div>
                </div>

                <div class='bagan' id='kh_valid_ptk2'>
                    <b>Valid PTK ASN</b>
                    <div><?= number_format($data_nasional['valid_ptk'], 0, ',', '.') ?></div>
                </div>
                <div class='baganbulat' id='kh_persen_valid_ptk2'>
                    <div><?= number_format((($data_nasional['valid_ptk']) * 100 / $data_nasional['asn']), 2, ',', '.') ?>%</div>
                </div>

                <svg class="arrow" width="810" height="500">
                    <defs>
                        <marker id="arrowhead" markerWidth="9" markerHeight="6" refX="0" refY="3" orient="auto">
                            <polygon points="0 0, 9 3, 0 6" />
                        </marker>
                        <marker id="arrowhead2" stroke="red" fill="red" markerWidth="9" markerHeight="6" refX="0" refY="3" orient="auto">
                            <polygon points="0 0, 9 3, 0 6" />
                        </marker>
                    </defs>
                    <line x1="170" y1="90" x2="275" y2="90" stroke="black" stroke-width="1" />
                    <line x1="275" y1="90" x2="275" y2="113" stroke="black" stroke-width="1" marker-end="url(#arrowhead)" />

                    <line x1="275" y1="190" x2="275" y2="300" stroke="black" stroke-width="1" />
                    <line x1="275" y1="300" x2="475" y2="300" stroke="black" stroke-width="1" marker-end="url(#arrowhead)" />
                    <line x1="349" y1="155" x2="475" y2="155" stroke="black" stroke-width="1" marker-end="url(#arrowhead)" />

                </svg>
            </div>
            <div class="infokohort">
                Parameter 1
            </div>
            <div class="infokohort2">
                Parameter 2
            </div>
        </div>
    </div>
    <div class="card">
        <div class="sebaris">
            <div class="form-group">
                <label for="load-provinsi">
                    Provinsi
                </label>
                <div class="pil_select" id="load-provinsi">
                    <select id="provinsi" name="provinsi" class="select-search form-control">
                        <option value="000000" selected>Nasional</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="load-kabupaten">
                    Kabupaten/Kota
                </label>
                <div class="pil_select" id="load-kabupaten">
                    <select id="kabupaten" name="kabupaten" class="select-search form-control">
                        <option value="0">Semua</option>
                    </select>
                </div>
            </div>
            <div class="button-group">
                <button id="terapkan" class="tb_hijau">Terapkan</button>
            </div>
        </div>
    </div>

    <div class="card-container">
        <div class="small_card">
            <div class="info_angka" id="total_ptk_aktif"></div>
            Total PTK Aktif
        </div>
        <div class="small_card">
            <div class="info_angka" id="total_asn"></div>
            Total PTK ASN
        </div>
        <!-- <div class="small_card">
            <div class="info_angka" id="total_asn_padan"></div>
            Total ASN PADAN
        </div>
        <div class="small_card merah">
            <div class="info_angka" id="total_asn_residu"></div>
            Total ASN RESIDU
        </div> -->
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script src="<?= base_url() ?>public/js/select2.full.min.js"></script>
<script>
    muat_provinsi();
    muatDataPerWilayah();

    function muat_provinsi() {
        $("#load-provinsi").LoadingOverlay("show");
        $.ajax({
            url: "<?= base_url('dasbor/list_provinsi') ?>",
            method: "POST",
            data: {},
            dataType: "html",
            success: function(response) {
                $("#provinsi").html(response);
            },
            complete: function() {
                $("#load-provinsi").LoadingOverlay("hide");
            }
        });
    }

    function muat_kabupaten(provinsi) {
        $("#load-kabupaten").LoadingOverlay("show");
        $.ajax({
            url: "<?= base_url('dasbor/list_kabupaten') ?>",
            method: "POST",
            data: {
                provinsi
            },
            dataType: "html",
            success: function(response) {
                $("#kabupaten").html(response);
            },
            complete: function() {
                $("#load-kabupaten").LoadingOverlay("hide");
            }
        });
    }

    function muatDataPerWilayah() {
        $("#total_ptk_aktif, #total_asn, #total_asn_padan, #total_asn_residu").LoadingOverlay("show");
        var provinsi = $(' #provinsi').val();
        var kabupaten = $('#kabupaten').val();
        console.log(provinsi + "-" + kabupaten);
        $.ajax({
            url: "<?= base_url('dasbor/get_data_wilayah') ?>",
            method: "POST",
            data: {
                provinsi,
                kabupaten
            },
            dataType: "json",
            success: function(response) {
                update_data(response)
            },
            complete: function() {
                $("#total_ptk_aktif, #total_asn, #total_asn_padan, #total_asn_residu").LoadingOverlay("hide");
            }
        });
    }

    function update_data(dataCard) {
        $("#total_ptk_aktif").text(dataCard.total_ptk_aktif.toLocaleString('ID'));
        $("#total_asn").text(dataCard.asn.toLocaleString('ID'));
        $("#total_asn_padan").text(dataCard.asn_padan.toLocaleString('ID'));
        $("#total_asn_residu").text(dataCard.asn_residu.toLocaleString('ID'));
    }

    $('#provinsi').on('select2:select', function(e) {
        var data = e.params.data;
        muat_kabupaten(data.id)
    });

    $("#provinsi").select2({
        placeholder: "Pilih salah satu",
        allowClear: true,
        width: 'resolve',
        dropdownAutoWidth: true
    });

    $("#kabupaten").select2({
        placeholder: "Pilih salah satu",
        allowClear: true,
        width: 'resolve',
        dropdownAutoWidth: true
    });

    $("#terapkan").on("click", function() {
        muatDataPerWilayah();
    });

    function kedasbor(idx) {
        window.open("<?= base_url() ?>dasbor?hal=" + idx, "_self");
    }
</script>
<?= $this->endSection() ?>