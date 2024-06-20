<?= $this->extend('layout/layout_default') ?>

<?= $this->section('style') ?>
<style>
    .popup {
        display: none;
        position: fixed;
        z-index: 9999;
        font-size: 20px;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
    }

    .popup-content {
        background-color: #fefefe;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        padding: 20px;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        max-width: 300px;
        text-align: center;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 15px;
        font-weight: bold;
        cursor: pointer;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
    }
</style>

<?= $this->endSection() ?>

<?= $this->section('konten') ?>
<div id="infoPopup" class="popup">
    <div class="popup-content">
        <p>Dalam Proses Debug Integrasi Data</p>
        <button class="close">OK</button>
    </div>
</div>
<img src="<?= base_url('public/images/berandaok.jpg') ?>" alt="Gambar">
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var popup = document.getElementById("infoPopup");
        popup.style.display = "block";

        // setTimeout(function() {
        //     popup.style.display = "none";
        // }, 3000);

        document.querySelector(".close").addEventListener("click", function() {
            popup.style.display = "none";
        });

        window.onclick = function(event) {
            if (event.target == popup) {
                popup.style.display = "none";
            }
        };
    });
</script>

<?= $this->endSection() ?>