<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
    <h2>Data Pegawai</h2>
    <a href="/employees/create"><button>+ Tambah Pegawai</button></a>
    
    <table>
        <tr>
            <th>Foto</th>
            <th>NIP</th>
            <th>Nama</th>
            <th>Jenis Kelamin</th>
            <th>No HP</th>
            <th>Departemen</th>
            <th>Jabatan</th>
            <th>Aksi</th>
        </tr>
        <?php foreach($employees as $emp): ?>
        <tr>
            <td>
                <?php if($emp['photo'] && $emp['photo'] != 'default.png'): ?>
                    <img src="/uploads/employees/<?= $emp['photo'] ?>" width="50" alt="Foto">
                <?php else: ?>
                    <img src="/uploads/employees/default.png" width="50" alt="No Photo">
                <?php endif; ?>
            </td>
            <td><?= $emp['nip'] ?></td>
            <td><?= $emp['name'] ?></td>
            <td><?= $emp['gender'] ?></td>
            <td><?= $emp['phone'] ?></td>
            <td><?= $emp['department_name'] ?></td>
            <td><?= $emp['position_name'] ?></td>
            <td>
                <a href="/employees/edit/<?= $emp['id'] ?>">Edit</a> |
                <a href="/employees/delete/<?= $emp['id'] ?>" onclick="return confirm('Hapus pegawai ini?')">Hapus</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
<?= $this->endSection() ?>