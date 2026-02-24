<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
    <h2>Profil Pegawai</h2>
    <a href="/profile/edit"><button>Edit Profil</button></a>
    <br><br>

    <?php if(!empty($pegawai)): ?>
        <table style="width: 50%;">
            <tr>
                <td colspan="2" style="text-align: center; background-color: #fff;">
                    <?php if($pegawai['photo'] && $pegawai['photo'] != 'default.png'): ?>
                        <img src="/uploads/employees/<?= $pegawai['photo'] ?>" width="150" alt="Foto Profil">
                    <?php else: ?>
                        <img src="/uploads/employees/default.png" width="150" alt="No Photo">
                    <?php endif; ?>
                </td>
            </tr>
            <tr><th width="30%">NIP</th><td><?= $pegawai['nip'] ?></td></tr>
            <tr><th>Nama</th><td><?= $pegawai['name'] ?></td></tr>
            <tr><th>Email</th><td><?= $pegawai['email'] ?></td></tr>
            <tr><th>Departemen</th><td><?= $pegawai['department_name'] ?></td></tr>
            <tr><th>Jabatan</th><td><?= $pegawai['position_name'] ?></td></tr>
            <tr><th>No HP</th><td><?= $pegawai['phone'] ?></td></tr>
            <tr><th>Alamat</th><td><?= $pegawai['address'] ?></td></tr>
        </table>
    <?php else: ?>
        <p>Data pegawai belum lengkap. Silakan hubungi Admin.</p>
    <?php endif; ?>
<?= $this->endSection() ?>