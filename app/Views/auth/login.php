<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

    <h2>Login</h2>

    <?php if(session()->getFlashdata('error')): ?>
        <p style="color: red;"><?= session()->getFlashdata('error') ?></p>
    <?php endif; ?>

    <form action="<?= base_url('/login') ?>" method="post">
        <p>
            <label>Email</label><br>
            <input type="email" name="email" value="<?= old('email') ?>" required>
        </p>
        <p>
            <label>Password</label><br>
            <input type="password" name="password" required>
        </p>
        <p>
            <button type="submit">Login</button>
        </p>
    </form>

<?= $this->endSection() ?>