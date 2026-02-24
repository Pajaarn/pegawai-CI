<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

    <h2>Tambah Pegawai</h2>
    
    <?php $errors = session()->getFlashdata('errors'); ?>
    <?php if (!empty($errors)): ?>
        <div style="color: red; border: 1px solid red; padding: 10px; margin-bottom: 15px;">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="/employees/store" method="post" enctype="multipart/form-data">
        <p><label>Nama Pegawai:</label><br>
            <input type="text" name="name" value="<?= old('name') ?>" required>
        </p>
        
        <p><label>Email (Untuk Login):</label><br>
            <input type="email" name="email" value="<?= old('email') ?>" required>
        </p>
        
        <p><label>NIP:</label><br>
            <input type="text" name="nip" value="<?= old('nip') ?>" required>
        </p>
        
        <p><label>Jenis Kelamin:</label><br>
            <select name="gender" required>
                <option value="">-- Pilih Jenis Kelamin --</option>
                <option value="Laki-laki" <?= old('gender') == 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                <option value="Perempuan" <?= old('gender') == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
            </select>
        </p>

        <p><label>No HP:</label><br>
            <input type="text" name="phone" value="<?= old('phone') ?>">
        </p>

        <p><label>Alamat:</label><br>
            <textarea name="address" rows="3" cols="30"><?= old('address') ?></textarea>
        </p>

        <p><label>Departemen:</label><br>
            <select name="department_id" required>
                <option value="">-- Pilih Departemen --</option>
                <?php foreach($departments as $dept): ?>
                    <option value="<?= $dept['id'] ?>" <?= old('department_id') == $dept['id'] ? 'selected' : '' ?>>
                        <?= $dept['department_name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </p>

        <p><label>Jabatan:</label><br>
            <select name="position_id" required>
                <option value="">-- Pilih Jabatan --</option>
                <?php foreach($positions as $pos): ?>
                    <option value="<?= $pos['id'] ?>" <?= old('position_id') == $pos['id'] ? 'selected' : '' ?>>
                        <?= $pos['position_name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </p>

        <p><label>Gaji (Rp):</label><br>
            <input type="number" name="salary" value="<?= old('salary') ?>" required>
        </p>
        
        <p><label>Foto Pegawai (Wajib Gambar):</label><br>
            <input type="file" name="photo" accept="image/*">
        </p>

        <button type="submit">Simpan Data Pegawai</button>
        <a href="/employees">Batal</a>
    </form>

<?= $this->endSection() ?>