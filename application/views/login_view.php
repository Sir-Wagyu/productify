<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productify</title>
    <link rel="stylesheet" href="<?= base_url('/assets/css/output.css?v=') . time(); ?>">
</head>

<body class="w-screen h-screen flex justify-center items-center">
    <div class="border shadow-md px-5 py-6 w-[28%] flex flex-col items-center">
        <h2 class="font-semibold text-3xl">Login To Productify</h2>
        <?php if ($this->session->flashdata('pesanLogin')) : ?>
            <div class="mt-3 w-full py-1 border border-red-500 bg-red-200 text-red-500">
                <p class="text-center"><?= $this->session->flashdata('pesanLogin') ?></p>
            </div>
        <?php endif; ?>
        <form method="post" action="<?php echo base_url("auth/prosesLogin") ?>" class="mt-6">
            <input type="text" name="username" id="username" placeholder="Username" class="border p-1 w-full my-2">
            <input type="password" name="password" id="password" placeholder="Password" class="border p-1 w-full my-2">
            <button type="submit" class="bg-blue-500 text-white p-2 w-full my-2">Login</button>
        </form>
        <p class="mt-3">Belum punya akun? <span class="text-blue-500"><a href="<?php echo base_url("auth/register") ?>">Register</a></span></p>
    </div>
</body>

</html>