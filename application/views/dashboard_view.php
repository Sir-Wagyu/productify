<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productify</title>
    <link rel="stylesheet" href="<?= base_url('/assets/css/output.css?v=') . time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
</head>

<body>
    <nav class=" bg-white  fixed w-full z-20 top-0 start-0 border-b border-gray-200  ">
        <div class=" max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <h1 class="font-semibold text-2xl">Productify</h1>
            <a href="<?php echo base_url('auth/logout') ?>" class="hover:text-blue-500 active:scale-95 transition-all ">Logout</a>
        </div>
    </nav>

    <!-- konten -->
    <div class="mt-20 max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <?php
        if (empty($konten)) {
            echo "";
        } else {
            echo $konten;
        }

        ?>
    </div>


    <script src="<?= base_url('node_modules/flowbite/dist/flowbite.min.js'); ?>"></script>
</body>

</html>