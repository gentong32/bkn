<?= $this->extend('layout/layout_default') ?>

<?= $this->section('style') ?>
<link rel="stylesheet" href="<?= base_url() ?>public/css/select2.min.css">
<?= $this->endSection() ?>

<?= $this->section('konten') ?>
DATA BELUM TERSEDIA
<button onclick="kembali()">Kembali</button>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script src="<?= base_url() ?>public/js/select2.full.min.js"></script>
<script>
    function kembali() {
        window.history.back();
    }
</script>
<?= $this->endSection() ?>