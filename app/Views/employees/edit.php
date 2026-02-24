<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
    <h2>Edit Data Pegawai</h2>

    <?php $errors = session()->getFlashdata('errors'); ?>
    <?php if (!empty($errors)): ?>
        <div style="color: red; border: 1px solid red; padding: 10px; margin-bottom: 15px;">
            <ul><?php foreach ($errors as $error): ?><li><?= esc($error) ?></li><?php endforeach ?></ul>
        </div>
    <?php endif; ?>

    <form action="/employees/update/<?= $employee['id'] ?>" method="post" enctype="multipart/form-data">
        <p><label>Nama:</label><br><input type="text" name="name" value="<?= old('name', $employee['name']) ?>" required></p>
        <p><label>Email:</label><br><input type="email" name="email" value="<?= old('email', $employee['email']) ?>" required></p>
        <p><label>NIP:</label><br><input type="text" name="nip" value="<?= old('nip', $employee['nip']) ?>" required></p>
        
        <p><label>Jenis Kelamin:</label><br>
            <select name="gender" required>
                <option value="Laki-laki" <?= old('gender', $employee['gender']) == 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                <option value="Perempuan" <?= old('gender', $employee['gender']) == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
            </select>
        </p>

        <p><label>Departemen:</label><br>
            <select name="department_id" required>
                <?php foreach($departments as $dept): ?>
                    <option value="<?= $dept['id'] ?>" <?= old('department_id', $employee['department_id']) == $dept['id'] ? 'selected' : '' ?>><?= $dept['department_name'] ?></option>
                <?php endforeach; ?>
            </select>
        </p>

        <p><label>Jabatan:</label><br>
            <select name="position_id" required>
                <?php foreach($positions as $pos): ?>
                    <option value="<?= $pos['id'] ?>" <?= old('position_id', $employee['position_id']) == $pos['id'] ? 'selected' : '' ?>><?= $pos['position_name'] ?></option>
                <?php endforeach; ?>
            </select>
        </p>

        <p><label>Gaji:</label><br><input type="number" name="salary" value="<?= old('salary', $employee['salary']) ?>" required></p>
        
        <p><label>Foto:</label><br>
            <img src="/uploads/employees/<?= $employee['photo'] ?>" width="100"><br>
            <input type="file" name="photo" accept="image/*">
        </p>

        <button type="submit">Update Data</button>
        <a href="/employees">Batal</a>
    </form>
<?= $this->endSection() ?>