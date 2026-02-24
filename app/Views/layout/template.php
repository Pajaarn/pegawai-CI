<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Manajemen Pegawai</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        nav { background-color: #f4f4f4; padding: 10px; margin-bottom: 20px; border: 1px solid #ddd; }
        nav a { margin-right: 15px; text-decoration: none; color: #333; font-weight: bold; }
        nav a:hover { color: #007BFF; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #eee; }
    </style>
</head>
<body>

    <?php if(session()->get('logged_in')): ?>
        <nav>
            <?php if(session()->get('role') == 'admin'): ?>
                <a href="/dashboard">Dashboard</a>
                <a href="/departments">Departemen</a>
                <a href="/positions">Jabatan</a>
                <a href="/employees">Pegawai</a>
            <?php else: ?>
                <a href="/profile">Profil Saya</a>
            <?php endif; ?>
            
            <a href="/logout" style="color: red; float: right;" onclick="return confirm('Yakin ingin keluar?')">Logout (<?= session()->get('name') ?>)</a>
            <div style="clear: both;"></div>
        </nav>
    <?php endif; ?>

    <main>
        <?= $this->renderSection('content') ?>
    </main>

    <footer style="margin-top: 30px; border-top: 1px solid #ddd; padding-top: 10px; font-size: 12px; color: #777;">
        &copy; <?= date('Y') ?> - Sistem Manajemen Pegawai
    </footer>

</body>
</html>