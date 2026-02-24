<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

    <h2>Data Departemen</h2>
    
    <a href="/departments/create">Tambah Departemen</a>
    <br><br>

    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Nama Departemen</th>
            <th>Aksi</th>
        </tr>
        <?php foreach($departments as $dept): ?>
        <tr>
            <td><?= $dept['id'] ?></td>
            <td><?= $dept['department_name'] ?></td>
            <td>
                <a href="/departments/edit/<?= $dept['id'] ?>">Edit</a> | 
                <a href="/departments/delete/<?= $dept['id'] ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

<?= $this->endSection() ?>