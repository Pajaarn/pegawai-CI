<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

    <h2>Tambah Departemen</h2>
    
    <form action="/departments/store" method="post">
        <p>
            <label>Nama Departemen:</label><br>
            <input type="text" name="department_name" required>
        </p>
        <button type="submit">Simpan</button>
        <a href="/departments">Batal</a>
    </form>

<?= $this->endSection() ?>