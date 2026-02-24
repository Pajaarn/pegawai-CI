<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

    <h2>Tambah Jabatan Baru</h2>

    <form action="/positions/store" method="post">
        <p>
            <label>Nama Jabatan:</label><br>
            <input type="text" name="position_name" required>
        </p>
        <p>
            <button type="submit">Simpan</button>
            <a href="/positions"><button type="button">Batal</button></a>
        </p>
    </form>

<?= $this->endSection() ?>