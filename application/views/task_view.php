<div class="w-full">
    <div class="py-4 border-b-2 border-gray-200 flex justify-between items-center mb-5">
        <h1 class="text-center font-semibold text-xl ">Task</h1>
        <button href="" data-modal-target="task-modal" data-modal-toggle="task-modal"><i class="fa-solid fa-plus bg-slate-100 p-4 rounded-md shadow-md"></i></button>

    </div>
    <div class="w-full flex flex-col gap-6">
        <?php foreach (['tinggi', 'sedang', 'rendah'] as $priority): ?>
            <div class="h-72">
                <h3>Prioritas: <?php echo ucfirst($priority); ?></h3>
                <div class="flex w-full overflow-x-auto flex-wrap py-3">
                    <div class="flex gap-4">
                        <?php foreach ($tasks as $task): ?>
                            <?php if ($task->prioritas == $priority): ?>
                                <a href="?edit=<?php echo $task->id ?>" class="p-4 h-60 aspect-[4/4] border shadow-lg flex flex-col justify-between cursor-pointer" data-drawer-target="drawer-right-example" data-drawer-show="drawer-right-example" data-drawer-placement="right" type="button">
                                    <div>
                                        <p class="text-sm"><?php echo $task->kategori; ?></p>
                                        <h1 class="font-semibold line-clamp-1"><?php echo $task->judul; ?></h1>
                                        <p class="mt-5 line-clamp-3 text-pretty"><?php echo $task->deskripsi; ?></p>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <?php
                                        $deadline_date = new DateTime($task->deadline);
                                        $current_date = new DateTime();
                                        $interval = $current_date->diff($deadline_date);
                                        $days_remaining = $interval->format('in %a days');

                                        $status_class = '';
                                        if ($task->status == 'belum') {
                                            $status_class = 'bg-slate-200';
                                        } elseif ($task->status == 'proses') {
                                            $status_class = 'bg-blue-500';
                                        } elseif ($task->status == 'selesai') {
                                            $status_class = 'bg-green-500';
                                        }
                                        ?>

                                        <p class="w-max text-sm px-5 py-2 rounded-md <?php echo $status_class; ?>"><?php echo $task->status; ?></p>
                                        <p class="w-max text-sm font-semibold"><?php echo $days_remaining; ?></p>


                                    </div>
                                </a>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>


    </div>
</div>




<!-- Main modal -->
<div id="task-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Add Task
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="task-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <?php $id_user = $this->session->userdata('id'); ?>
            <form class="p-4 md:p-5" method="post" action="<?php echo base_url('dashboard/simpanTask/' . $id_user) ?>">
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="judul" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Judul</label>
                        <input type="text" name="judul" id="judul" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="kategori" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori</label>
                        <input type="text" name="kategori" id="kategori" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="prioritas" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Prioritas</label>
                        <select id="prioritas" name="prioritas" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option selected="" value="rendah">rendah</option>
                            <option value="sedang">sedang</option>
                            <option value="tinggi">tinggi</option>
                        </select>
                    </div>
                    <div class="col-span-2">
                        <label for="deskripsi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                        <textarea id="deskripsi" rows="4" name="deskripsi" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                    </div>
                    <div class="col-span-2">
                        <label for="deadline" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deadline</label>
                        <input type="date" name="deadline" id="deadline" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
                    </div>
                </div>
                <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                    </svg>
                    Add new task
                </button>
            </form>
        </div>
    </div>
</div>




<?php if (isset($_GET['edit'])): ?>
    <?php
    $prioritas = ['rendah', 'sedang', 'tinggi'];
    $status = ['belum', 'proses', 'selesai'];
    function loadTaskData($taskId)
    {
        $CI = &get_instance();
        $CI->load->model('tasks_model');
        return $CI->tasks_model->getTaskById($taskId);
    }
    $task = loadTaskData($_GET['edit']);
    ?>

    <!-- script to show the drawer -->
    <?php
    echo
    "
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('drawer-right');
            const overlay = document.getElementById('drawer-overlay');
            modal.classList.remove('hidden');
            modal.classList.add('block');
            overlay.classList.remove('hidden');
        });
        </script>
        "
    ?>


    <!-- drawer component -->
    <div id="drawer-overlay" class="hidden w-screen h-screen fixed inset-0 bg-black/50 z-40 transition-all"></div>
    <div id="drawer-right" class="fixed top-0 right-0 py-14 px-20 z-40 w-1/2 h-full overflow-y-auto bg-white">
        <button type="button" data-drawer-hide="drawer-right" aria-controls="drawer-right" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 inline-flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
        </button>
        <form action="<?php echo base_url("dashboard/editTask/" . $task->id) ?>" method="post">
            <i class="fa-solid fa-note-sticky text-4xl text-gray-700 mb-2"></i>
            <div class="flex flex-col">
                <input type="text" name="judul" class="mb-6 text-3xl font-semibold border-none p-0 focus:ring-0 focus:outline-0" value="<?php echo $task->judul ?>">
                <div class="grid grid-cols-2 w-[50%]">
                    <p class="font-medium text-xl w-max">Kategori :</p>
                    <input type="text" name="kategori" class="text-xl border-none p-0 focus:ring-0 focus:outline-0 focus:bg-gray-50" value="<?php echo $task->kategori ?>">
                </div>
                <div class="mt-3 grid grid-cols-2 w-[50%]">
                    <p class="font-medium text-xl">Deadline :</p>
                    <input type="date" name="deadline" class="text-xl border-none p-0 focus:ring-0 focus:outline-0 focus:bg-gray-50" value="<?php echo $task->deadline ?>">
                </div>
                <div class="mt-3 grid grid-cols-2 w-[50%]">
                    <p class="font-medium text-xl">Prioritas :</p>
                    <select name="prioritas" id="prioritas" class="text-xl p-0 border-0 focus:ring-0 focus:outline-0">
                        <?php foreach ($prioritas as $prioritas): ?>
                            <option value="<?php echo $prioritas ?>" <?php echo $task->prioritas == $prioritas ? 'selected' : '' ?>><?php echo $prioritas ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mt-3 grid grid-cols-2 w-[50%]">
                    <p class="font-medium text-xl">Status :</p>
                    <select name="status" id="status" class="text-xl p-0 border-0 focus:ring-0 focus:outline-0">
                        <?php foreach ($status as $status): ?>
                            <option value="<?php echo $status ?>" <?php echo $task->status == $status ? 'selected' : '' ?>><?php echo $status ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mt-8">
                    <p class="font-medium text-2xl mb-2">Deskripsi :</p>
                    <textarea name="deskripsi" id="deskripsi" rows="20" class="w-full border-none p-0 focus:ring-0 focus:outline-0 text-xl"><?php echo $task->deskripsi ?></textarea>
                </div>
                <div class="mt-8">
                    <button type="submit" class="bg-blue-500 text-white font-semibold py-2 px-4 rounded-lg">Simpan Perubahan</button>
                    <a href="<?php echo base_url('dashboard/hapusTask/' . $task->id) ?>" class="bg-red-500 text-white font-semibold py-2 px-4 rounded-lg">Hapus Task</a>
                </div>
            </div>
        </form>
    </div>

    <!-- buat close drawer -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const closeModalButtons = document.querySelectorAll('[data-drawer-hide]');
            closeModalButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const modal = document.getElementById('drawer-right');
                    const overlay = document.getElementById('drawer-overlay');
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                    overlay.classList.add('hidden');
                    window.location.href = "<?php echo base_url('dashboard'); ?>";
                });
            });
        });
    </script>




<?php endif; ?>