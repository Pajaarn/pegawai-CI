<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

    <h2>Edit Data Pribadi</h2>

    <form action="/profile/update" method="post" enctype="multipart/form-data">
        <p><label>Nama Lengkap:</label><br>
            <input type="text" name="name" value="<?= $pegawai['name'] ?>" required>
        </p>
        
        <p><label>Email (Tidak bisa diubah):</label><br>
            <input type="email" value="<?= $pegawai['email'] ?>" disabled>
        </p>

        <p><label>Jenis Kelamin:</label><br>
            <select name="gender" required>
                <option value="Laki-laki" <?= $pegawai['gender'] == 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                <option value="Perempuan" <?= $pegawai['gender'] == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
            </select>
        </p>

        <p><label>No HP:</label><br>
            <input type="text" name="phone" value="<?= $pegawai['phone'] ?>">
        </p>

        <p><label>Alamat:</label><br>
            <textarea name="address" rows="3" cols="30"><?= $pegawai['address'] ?></textarea>
        </p>
        
        <p><label>Ganti Foto Profil:</label><br>
            <?php if($pegawai['photo'] && $pegawai['photo'] != 'default.png'): ?>
                <img src="/uploads/employees/<?= $pegawai['photo'] ?>" width="80" alt="Foto Lama"><br>
            <?php endif; ?>
            <input type="file" name="photo" accept="image/*">
            <br><small>*Biarkan kosong jika tidak ingin mengganti foto</small>
        </p>

        <button type="submit">Update Profil</button>
        <a href="/profile">Batal</a>
    </form>

<?= $this->endSection() ?>