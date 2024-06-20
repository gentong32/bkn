<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PTK BKN</title>
    <link rel="stylesheet" href="<?= base_url() ?>public/css/style.css?v2.6">
    <link rel="stylesheet" href="<?= base_url() ?>public/css/button.css?v2.3">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <?= $this->renderSection('style') ?>
    <style>
        .href {
            text-decoration: none;
            padding-right: 10px;
            color: blue;
        }

        #userLink {
            color: darkgreen;
            font-weight: bold;
        }

        #logoutDropdown {
            width: 100px;
            padding: 5px;
            text-align: left;
            margin-top: -10px;
            margin-right: 37px;
            background-color: white;
            border: 0.5px solid darkgreen;
        }

        #logoutDropdown a:hover {
            color: darkmagenta;
            background-color: white;
        }
    </style>
    <link rel="icon" href="<?php echo base_url(); ?>public/images/logotut.png" type="image/gif" sizes="16x16">
</head>

<body>
    <div class="header">
        <div class="logo">
            <img src="<?= base_url() ?>public/images/logotut.png" alt="Logo">
            <span>Pemadanan PTK ASN Dapodik - BKN</span>
        </div>
        <div class="user-group">
            <div class="user-info">
                <?php if (session()->get('role') != 'userLogin') { ?>
                    <!-- <a href="https://sso.data.kemdikbud.go.id/sys/login?appkey=">Login</a> -->
                    <a href="<?= base_url('login') ?>" class="href">Login</a>
                <?php } else { ?>
                    <a href="#" id="userLink"><?= session()->get('nama') ?></a>
                    <div class="dropdown" id="logoutDropdown">
                        <ul>
                            <li><a href="<?= base_url('logout') ?>">- Logout</a></li>
                        </ul>
                    </div>
                <?php } ?>
            </div>
            <button id="toggleSidebar">&#9776;</button>
        </div>
    </div>
    <div class="container">
        <div class="sidebar">
            <button id="closeSidebar" class="close-btn">×</button>
            <ul class="menu">
                <li><a href="<?= base_url('beranda') ?>"><i class="material-icons">home</i>Beranda</a></li>
                <li><a href="<?= base_url('dasbor') ?>"><i class="material-icons">legend_toggle</i>Dasbor</a></li>
                <li>
                    <div style="height: 20px;"></div>
                </li>
                <li style="margin: 10px; color: grey; font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif; font-size:14px; ">RANGKUMAN</li>
                <li><a href="<?= base_url('data_ptk') ?>"><i class="material-icons">person</i>Pendidik - Tenaga Kependidikan</a></li>
                <li id="dataResidu"><a href="#"><i class="material-icons">warning</i>Ver-Val Data Master &nbsp;<span class="arrow">></span></a>
                    <ul id="submenuResidu">
                        <li><a href="<?= base_url() ?>residu/kependudukan" class="submenu-link">Residu Kependudukan (NIK)</a></li>
                        <li><a href="<?= base_url() ?>residu/kepegawaian" class="submenu-link">Residu Kepegawaian (NIP)</a></li>
                        <li><a href="<?= base_url() ?>residu/nuptk" class="submenu-link">Residu NUPTK</a></li>
                        <li><a href="<?= base_url() ?>residu/satminkal" class="submenu-link">Residu Satminkal (NPSN)</a></li>
                    </ul>
                </li>
                <li>
                    <div style="height: 20px;"></div>
                </li>
                <li style="margin: 10px; color: grey; font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif; font-size:14px; ">LINK TERKAIT</li>
                <li><a href="https://vervalsp.data.kemdikbud.go.id/pemadanan-unor" target="_blank"><i class="material-icons">start</i>Pemadanan NPSN - Unor BKN</a></li>
                <li><a href="https://referensi.data.kemdikbud.go.id/" target="_blank"><i class="material-icons">start</i>Data Referensi Pendidikan</a></li>
            </ul>
        </div>
        <div class="content">
            <?= $this->renderSection('konten') ?>
            <div class="alamat">
                <p>&copy; 2024 Pusdatin Kemendikbudristek</p>
            </div>
        </div>
    </div>



</body>

</html>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="<?= base_url('public/js/loadingoverlay.min.js') ?>"></script>

<script>
    document.getElementById('toggleSidebar').addEventListener('click', function() {
        const sidebar = document.querySelector('.sidebar');
        const closeSidebarBtn = document.getElementById('closeSidebar');

        sidebar.style.width = sidebar.style.width === '280px' ? '0' : '280px';

        closeSidebarBtn.style.display = 'block';
    });

    document.getElementById('closeSidebar').addEventListener('click', function() {
        const sidebar = document.querySelector('.sidebar');
        sidebar.style.width = '0';
    });

    document.addEventListener('DOMContentLoaded', function() {
        const dataResidu = document.getElementById('dataResidu');
        const submenuResidu = document.getElementById('submenuResidu');
        const submenuLinks = document.querySelectorAll('.submenu-link');
        const currentUrl = window.location.href;

        $("#dataResidu > a").click(function(e) {
            e.preventDefault();
            var submenu = $("#submenuResidu");
            submenu.toggleClass("open");

            var arrow = $(this).find(".arrow");
            arrow.toggleClass("down");

            if (submenu.hasClass("open")) {
                submenuLinks.forEach((link, index) => {
                    setTimeout(() => {
                        link.classList.add("show");
                        // link.classList.remove("hide");
                    }, index * 100); // Delay of 100ms for each item
                });
            } else {
                submenuLinks.forEach((link, index) => {
                    setTimeout(() => {
                        // link.classList.add("hide");
                        link.classList.remove("show");
                    }, index * 100); // Delay of 100ms for each item
                });
            }
        });

        const menuItems = document.querySelectorAll('.menu a');
        menuItems.forEach(item => {
            const itemUrl = item.getAttribute('href');
            if (currentUrl.includes(itemUrl) && itemUrl != "https://referensi.data.kemdikbud.go.id/") {
                item.classList.add('aktif');

                // const parentSubmenu = item.closest('ul');
                // if (parentSubmenu) {
                //     parentSubmenu.classList.add('show');
                // }
                const parentSubmenu = item.closest('ul');

                if (parentSubmenu && parentSubmenu.id === 'submenuResidu') {
                    // submenu.toggleClass("open");
                    var arrow = $(this).find(".arrow");
                    arrow.toggleClass("down");
                    const submenuLinks = document.querySelectorAll('.submenu-link');
                    const submenuResidu = document.getElementById('submenuResidu');
                    submenuLinks.forEach((link, index) => {
                        link.classList.add("show");
                    });
                    submenuResidu.classList.add("open");
                    // parentSubmenu.previousElementSibling.classList.add('aktif'); // Menambahkan class 'aktif' ke parent menu
                }
            }
        });

        submenuLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                submenuReferensi.classList.toggle('show');
                e.preventDefault();
                const url = this.href;
                setTimeout(() => {
                    window.location.href = url;
                }, 100); // Adjust the delay as needed
            });
        });
    });

    <?php if (session()->get('role') == 'userLogin') { ?>
        let logoutDropdown = document.getElementById('logoutDropdown');
        let userLink = document.getElementById('userLink');

        userLink.addEventListener('click', function(event) {
            event.preventDefault(); // Mencegah link mengarahkan ke halaman lain

            if (logoutDropdown.style.display === 'block') {
                logoutDropdown.style.display = 'none'; // Sembunyikan submenu jika sudah terbuka
            } else {
                logoutDropdown.style.display = 'block';
            }
        });
    <?php } ?>
</script>

<?= $this->renderSection('script') ?>