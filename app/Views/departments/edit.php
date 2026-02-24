<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

    <h2>Edit Departemen</h2>
    
    <form action="/departments/update/<?= $department['id'] ?>" method="post">
        <p>
            <label>Nama Departemen:</label><br>
            <input type="text" name="department_name" value="<?= $department['department_name'] ?>" required>
        </p>
        <button type="submit">Update</button>
        <a href="/departments">Batal</a>
    </form>

<?= $this->endSection() ?>