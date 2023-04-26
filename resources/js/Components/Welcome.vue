<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import { ref,watch,inject,reactive } from 'vue';
import { router } from '@inertiajs/vue3';
const Swal = inject('$swal');

const form = reactive({
  file: null,
})

function submit() {
    router.post(route('import.excel'), form);
}

function updates() {
    router.get(route('telegram.updates'));
}

function exportDocument(option){
    if (option == '1') {
        Swal.fire({
            title: '<strong>Export to Excel</strong>',
            showClass: {
                popup: 'animate__animated animate__bounceInDown'
            },
            hideClass: {
                popup: 'animate__animated animate__bounceOutDown'
            },
            icon: 'question',
            html:
                'Exporting <b>all</b> users.',
            showCloseButton: true,
            showCancelButton: true,
            focusConfirm: true,
            confirmButtonText:'Download',
            confirmButtonAriaLabel:'Download',
            cancelButtonText:'Cancel',
            cancelButtonAriaLabel:'Cancel',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href=route('export.users.excel');
            }
        })
    } else if(option == '2') {
        Swal.fire({
            title: '<strong>Export to PDF</strong>',
            showClass: {
                popup: 'animate__animated animate__bounceInDown'
            },
            hideClass: {
                popup: 'animate__animated animate__bounceOutDown'
            },
            icon: 'question',
            html:
                'Exporting <b>all</b> users.',
            showCloseButton: true,
            showCancelButton: true,
            focusConfirm: true,
            confirmButtonText:'Download',
            confirmButtonAriaLabel:'Download',
            cancelButtonText:'Cancel',
            cancelButtonAriaLabel:'Cancel',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href=route('export.users.pdf');
            }
        })
    }
}

</script>

<template>
    <div>
        <div class="p-6 lg:p-8 bg-stone-900/[0.96] border-b border-gray-200">
            <!-- <ApplicationLogo class="block h-12 w-auto" />

            <h1 class="mt-8 text-2xl font-medium text-yellow-700">
                Welcome to your Jetstream application!
            </h1>

            <p class="mt-6 text-gray-500 leading-relaxed">
                Laravel Jetstream provides a beautiful, robust starting point for your next Laravel application. Laravel is designed
                to help you build your application using a development environment that is simple, powerful, and enjoyable. We believe
                you should love expressing your creativity through programming, so we have spent time carefully crafting the Laravel
                ecosystem to be a breath of fresh air. We hope you love it.
            </p> -->
            <h1 class="text-2xl text-white">NAD TEST PROJECT</h1>
            <p class="text-stone-300">Testing extentions on Laravel 10 & Vue.js [^3.2.31]</p>
            <div>
                <h2 class="text-xl text-white">ADDED EXTENSIONS</h2>
                <ul class="list-decimal ml-10 uppercase">
                    <li><a href="https://docs.laravel-excel.com/3.1/exports/export-formats.html" target="_blank" rel="noopener noreferrer" class="underline text-yellow-800 hover:text-yellow-600 font-semibold">EXCEL</a></li>
                    <li><a href="https://github.com/barryvdh/laravel-dompdf" target="_blank" rel="noopener noreferrer" class="underline text-yellow-800 hover:text-yellow-600 font-semibold">PDF</a></li>
                    <li><a href="https://github.com/laravel-notification-channels/telegram" target="_blank" rel="noopener noreferrer" class="underline text-yellow-800 hover:text-yellow-600 font-semibold">TELEGRAM NOTIFICATION</a></li>
                    <li><a href="https://github.com/barryvdh/laravel-debugbar" target="_blank" rel="noopener noreferrer" class="underline text-yellow-800 hover:text-yellow-600 font-semibold">DEBUGBAR</a></li>
                    <li><a href="https://sweetalert2.github.io/" target="_blank" rel="noopener noreferrer" class="underline text-yellow-800 hover:text-yellow-600 font-semibold">SWEETALERT2 (with animate.css)</a></li>
                    <li><a href="https://fontawesome.com/search" target="_blank" rel="noopener noreferrer" class="underline text-yellow-800 hover:text-yellow-600 font-semibold">fontawesome</a></li>
                    <li><a href="https://github.com/zanysoft/laravel-zip" target="_blank" rel="noopener noreferrer" class="underline text-yellow-800 hover:text-yellow-600 font-semibold">zıp</a></li>
                    <li><a href="https://github.com/stevebauman/location" target="_blank" rel="noopener noreferrer" class="underline text-yellow-800 hover:text-yellow-600 font-semibold">Location</a></li>
                </ul>
            </div>
        </div>

        <div class="bg-stone-900/[0.95] grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
            <div class="border p-8">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                    </svg>
                    <h2 class="ml-3 text-xl font-semibold text-yellow-700 hover:text-yellow-600" @click="exportDocument('1')">
                        Export Users With Excel Class
                    </h2>
                </div>
                
                <p class="mt-4 text-gray-300 text-sm leading-relaxed">
                    <font-awesome-icon icon="fa-solid fa-file-export" class="text-yellow-700 hover:text-yellow-500" size="lg" />
                    Export Users With Excel Class
                </p>
            </div>
            <div class="border p-8">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                    </svg>
                    <h2 class="block mx-3 text-xl font-semibold text-yellow-700 hover:text-yellow-600">
                        Import With Excel Class
                    </h2>
                    <a :href="route('import.excel.example.download')">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline-flex stroke-yellow-700 hover:stroke-yellow-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                        </svg>
                    </a>
                </div>
                <form @submit.prevent="submit" enctype="multipart/form-data">
                    <!-- <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload file</label> -->
                    <input class="block w-full text-sm text-stone-400 border border-stone-600 rounded-lg cursor-pointer bg-stone-900 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="file_input" type="file" @input="form.file = $event.target.files[0]" >
                    <button class="text-white border p-2 mt-2" type="submit">
                        <font-awesome-icon icon="fa-solid fa-file-excel" class="text-yellow-700 hover:text-yellow-500" size="lg" />
                        Import With Excel Class
                    </button>
                </form>

                <!-- <p class="mt-4 text-gray-300 text-sm leading-relaxed">
                    Import With Excel Class
                </p> -->
            </div>
            <div class="border p-8">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                    </svg>
                    <h2 class="ml-3 text-xl font-semibold text-yellow-700 hover:text-yellow-600" @click="exportDocument('2')">
                        Export Users With PDF Class
                    </h2>
                </div>
                <p class="mt-4 text-gray-300 text-sm leading-relaxed">
                    Export Users With PDF Class
                </p>
            </div>
            <div class="border p-8">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                    </svg>
                    <h2 class="ml-3 text-xl font-semibold text-yellow-700 hover:text-yellow-600">
                        <a @click="updates">
                            Get Messages Which Sent Bot
                        </a>
                    </h2>
                </div>

                <p class="mt-4 text-gray-300 text-sm leading-relaxed">
                    Get Messages Which Sent Bot
                </p>
            </div>
            <div class="border p-8">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                    </svg>
                    <h2 class="ml-3 text-xl font-semibold text-yellow-700 hover:text-yellow-600" 
                        @click="
                        router.get(
                            route('telegram.send.message'),
                            {
                                preserveState: true,
                                preserveScroll: true,
                            }
                        )"
                    >
                        Send Message By Telegram Bot
                    </h2>
                </div>

                <p class="mt-4 text-gray-300 text-sm leading-relaxed">
                    Send Message By Telegram Bot
                </p>
            </div>
            <div class="border p-8">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                    </svg>
                    <Dropdown>
                        <template #trigger>
                            <button><h2 class="ml-3 text-xl font-semibold text-yellow-700 hover:text-yellow-600">Zip</h2></button>
                        </template>
                        <template #content>
                            <ul class="bg-yellow-900">
                                <li class="hover:text-yellow-600" @click="router.get(route('zip.index'),{ option: 'open' })">Open</li>
                                <li class="hover:text-yellow-600" @click="router.get(route('zip.index'),{ option: 'create' })">Create</li>
                                <li class="hover:text-yellow-600" @click="router.get(route('zip.index'),{ option: 'check' })">Check</li>
                                <li class="hover:text-yellow-600" @click="router.get(route('zip.index'),{ option: 'uncompressed' })">Uncompressed</li>
                                <li class="hover:text-yellow-600" @click="router.get(route('zip.index'),{ option: 'has' })">Has</li>
                                <li class="hover:text-yellow-600" @click="router.get(route('zip.index'),{ option: 'addByPath' })">Add to zip by path</li>
                            </ul>
                        </template>
                    </Dropdown>
                </div>

                <p class="mt-4 text-gray-300 text-sm leading-relaxed">
                    Export as Zip
                </p>
            </div>
            <div class="border p-8">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                    </svg>
                    <h2 class="ml-3 text-xl font-semibold text-yellow-700 hover:text-yellow-600" @click="router.get(route('location'))">
                        Get Location
                    </h2>
                </div>

                <p class="mt-4 text-gray-300 text-sm leading-relaxed">
                    Get Location
                </p>
            </div>

            <div class="md:col-span-2 flex justify-center">
                <img class="object-contain" src="properties.webp" alt="">
            </div>

        </div>
    </div>
</template>
