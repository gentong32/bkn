<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PTK BKN</title>
    <link rel="stylesheet" href="<?= base_url() ?>public/css/style.css?v2.4">
    <link rel="stylesheet" href="<?= base_url() ?>public/css/button.css?v2.3">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="icon" href="<?php echo base_url(); ?>public/images/logotut.png" type="image/gif" sizes="16x16">
    <style>
        .eror {
            font-size: 15px;
            margin: 30px;
            background-color: #e0dede;
            text-align: center;
            border: 1px solid black;
            padding: 10px;
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="logo">
            <img src="<?= base_url() ?>public/images/logotut.png" alt="Logo">
            <span>Pemadanan PTK ASN Dapodik - BKN</span>
        </div>
        <div class="user-group">
            <button id="toggleSidebar">&#9776;</button>
        </div>
    </div>
    <div class="container">
        <div class="sidebar">
            <button id="closeSidebar" class="close-btn">×</button>
            <ul class="menu">
                <li><a href="<?= base_url('beranda') ?>"><i class="material-icons">home</i>&nbsp; Beranda</a></li>
                <li><a href="<?= base_url('dasbor') ?>"><i class="material-icons">legend_toggle</i>&nbsp; Dasbor</a></li>
                <li>
                    <div style="height: 20px;"></div>
                </li>
                <li style="margin: 10px; color: grey; font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif; font-size:14px; ">RANGKUMAN</li>
                <li><a href="<?= base_url('data_ptk') ?>"><i class="material-icons">person</i>&nbsp; Pendidik - Tenaga Kependidikan</a></li>
                <li id="dataResidu"><a href="#"><i class="material-icons">warning</i>&nbsp; Ver-Val Data Master &nbsp;<span class="arrow">></span></a>
                    <ul id="submenuResidu">
                        <li><a href="<?= base_url() ?>residu/kependudukan" class="submenu-link">Residu Kependudukan (NIK)</a></li>
                        <li><a href="<?= base_url() ?>residu/kepegawaian" class="submenu-link">Residu Kepegawaian (NIP)</a></li>
                        <li><a href="<?= base_url() ?>residu/nuptk" class="submenu-link">Residu NUPTK</a></li>
                        <li><a href="<?= base_url() ?>residu/satminkal" class="submenu-link">Residu Satminkal (NPSN)</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="content">
            <div class="eror">
                Data dalam proses update rangkuman satuan pendidikan dan wilayah.
            </div>
            <div class="alamat">
                <p>&copy; 2024 Pusdatin Kemendikbudristek</p>
            </div>
        </div>
    </div>



</body>

</html>