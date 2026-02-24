<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

    <h2>Edit Data Jabatan</h2>

    <form action="/positions/update/<?= $position['id'] ?>" method="post">
        <p>
            <label>Nama Jabatan:</label><br>
            <input type="text" name="position_name" value="<?= $position['position_name'] ?>" required>
        </p>
        <p>
            <button type="submit">Update Data</button>
            <a href="/positions"><button type="button">Batal</button></a>
        </p>
    </form>

<?= $this->endSection() ?>