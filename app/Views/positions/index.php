<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

    <h2>Data Jabatan</h2>
    
    <a href="/positions/create">Tambah Jabatan</a>
    <br><br>

    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Jabatan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($positions)): ?>
                <?php foreach($positions as $pos): ?>
                <tr>
                    <td><?= $pos['id'] ?></td>
                    <td><?= $pos['position_name'] ?></td>
                    <td>
                        <a href="/positions/edit/<?= $pos['id'] ?>">Edit</a> | 
                        <a href="/positions/delete/<?= $pos['id'] ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3" style="text-align: center;">Belum ada data jabatan.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

<?= $this->endSection() ?>