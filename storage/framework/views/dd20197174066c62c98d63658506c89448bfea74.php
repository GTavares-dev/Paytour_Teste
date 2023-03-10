<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">

    <title>Paytour</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }

        textarea {
            border: 1px solid;
        }

        input {
            height: 38px;
            border: 1px solid;
        }
    </style>
</head>

<body class="antialiased">
    <div
        class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-200 sm:items-center py-4 sm:pt-0 ">
        <!--
  This example requires some changes to your config:

  ```
  // tailwind.config.js
  module.exports = {
    // ...
    plugins: [
      // ...
      require('@tailwindcss/forms'),
    ],
  }
  ```
-->

        <div class="md:grid md:grid-cols-12 md:gap-6 m-4">
            <div class="md:col-span-12">
                <div class="px-4 sm:px-0">
                    <h2 class="text-lg font-medium leading-6 text-gray-900">Currículo</h2>
                    <p class="mt-1 text-sm text-gray-600">
                        Envie seu currículo aqui !
                    </p>

                </div>
                <?php if($errors->any()): ?>
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="text-red-600"><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                    
                <?php endif; ?>
            </div>

            <div class="mt-5 md:col-span-12 md:mt-0">
                <form action="<?php echo e(route('send')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="shadow sm:overflow-hidden sm:rounded-md">
                        <div class="bg-white px-4 py-2 sm:p-4">
                            <div class="grid grid-cols-8 gap-6">
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="first_name" class="block text-sm font-medium text-gray-700">
                                        Nome *</label>
                                    <input type="text" name="name" id="first_name" autocomplete="given-name"
                                        class="mt-1 block w-full rounded-md border-gray-400 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-2"
                                        value="<?php echo e(old('name')); ?>" placeholder="Ex: Gabriel">
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="last_name" class="block text-sm font-medium text-gray-700">Sobrenome *
                                    </label>
                                    <input type="text" name="last_name" id="last_name" autocomplete="family-name"
                                        class="mt-1 block w-full rounded-md border-gray-400 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm  px-2"
                                        value="<?php echo e(old('last_name')); ?>" placeholder="Ex: Tavares">
                                </div>


                                <div class="col-span-6 sm:col-span-2">
                                    <label for="phone" class="block text-sm font-medium text-gray-700">Telefone
                                        *</label>
                                    <input type="text" name="phone" id="phone" autocomplete="family-name"
                                        class="mt-1 block w-full rounded-md border-gray-400 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm  px-2"
                                        value="<?php echo e(old('phone')); ?>" placeholder="(XX) XXXX-XXXX">
                                </div>

                                <div class="col-span-6 sm:col-span-4">
                                    <label for="email" class="block text-sm font-medium text-gray-700">E-mail *
                                    </label>
                                    <input type="email" name="email" id="email" autocomplete="email"
                                        class="mt-1 block w-full rounded-md border-gray-400 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-2"
                                        value="<?php echo e(old('email')); ?>" placeholder="seunome@email.com">
                                </div>

                                <div class="col-span-6 sm:col-span-2">
                                    <label for="schooling" class="block text-sm font-medium text-gray-700">Escolaridade
                                        *</label>
                                    <select id="schooling" name="schooling"
                                        class="mt-1 block w-full rounded-md border border-gray-400 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                        <option>Ensino médio incompleto</option>
                                        <option>Ensino médio completo</option>
                                        <option>Ensino superior incompleto</option>
                                        <option>Ensino superior completo</option>
                                        <option>Mestrado</option>
                                        <option>Doutorado</option>
                                    </select>
                                </div>

                                <div class="col-span-6 sm:col-span-4">
                                    <label for="desiredjob" class="block text-sm font-medium text-gray-700">Cargo
                                        desejado *</label>
                                    <input type="text" name="desiredjob" id="desiredjob"
                                        class="mt-1 block w-full rounded-md border-gray-400 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-2"
                                        value="<?php echo e(old('desiredjob')); ?>">
                                </div>

                            </div>
                        </div>
                        <div class="space-y-6 bg-white px-4 py-5 sm:p-4">
                            <div>
                                <label for="comments"
                                    class="block text-sm font-medium text-gray-700">Observações</label>
                                <div class="mt-1">
                                    <textarea id="about" name="comments" rows="3"
                                        class="mt-1 block p-4 w-full rounded-md border-gray-400 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-2"><?php echo e(old('comments')); ?></textarea>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Currículo *</label>
                                <div
                                    class="mt-1 flex justify-center rounded-md border-2 border-dashed border-gray-400 px-6 pt-5 pb-6">
                                    <div class="space-y-1 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor"
                                            fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                            <path
                                                d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <div class="flex text-sm text-gray-600">
                                            <label for="file"
                                                class="relative cursor-pointer rounded-md bg-white font-medium text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 hover:text-indigo-500">
                                                <span>Envie um arquivo</span>
                                                <input id="file" name="file" type="file" class="sr-only"
                                                    accept=".pdf" value="<?php echo e(old('file')); ?>">
                                            </label>
                                            <p class="pl-1">ou arraste e solte</p>
                                        </div>
                                        <p class="text-xs text-gray-500">arquivo(.pdf .docx ou .doc) de no máximo 1MB
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                            <button type="submit"
                                class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                Enviar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
<?php /**PATH C:\laragon\www\paytour 2\resources\views/form.blade.php ENDPATH**/ ?>