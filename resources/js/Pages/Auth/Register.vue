<script setup>
import {Head, Link, useForm} from '@inertiajs/vue3';
import DefaultLayout from "@/Layouts/DefaultLayout.vue";
import {useTelegramButton} from "@/composables/telegramButton.js";

const form = useForm({
    name: '',
    email: '',
    password: '',
    nickname: '',
    password_confirmation: '',
});

useTelegramButton('telegram-container');

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head>
        <title>
            Register
        </title>
    </Head>

    <DefaultLayout>
        <div class="px-3 md:px-0">
            <div class="card card-bordered max-w-xl mx-auto p-4 space-y-4">
                <div class="mx-auto">
                    <img height="64" width="64" src="/icons/icon-192x192.png" alt="Writty">
                    <p class="font-bold text-xl">Writty</p>
                </div>

                <div class="socials space-y-3">
                    <h2 class="text-center font-bold text-xl">Join via socials</h2>
                    <div class="flex justify-center">
                        <a
                            class="py-2 px-[1.125rem] rounded-lg bg-sky-400 text-white font-bold"
                            :href="route('auth.social.redirect', {driver: 'twitter'})"
                        >Log in with Twitter</a>
                    </div>
                    <div class="flex justify-center" id="telegram-container"></div>
                </div>

                <hr class="my-0 py-0">

                <div class="form">
                    <h2 class="text-center font-bold text-xl mb-3">Register</h2>

                    <form @submit.prevent="submit">
                        <div>
                            <label for="name">Name</label>
                            <input
                                id="name"
                                v-model="form.name"
                                type="text"
                                class="input input-bordered mt-1 block w-full"
                                required
                                autofocus
                                autocomplete="name"
                                :class="{'input-error': form.errors.name}"
                                @input="form.errors.name = null"
                            />
                            <span class="text-error mt-2" v-for="message of form.errors.name">
                    {{ message }}
                    </span>
                        </div>

                        <div class="mt-4">
                            <label for="nickname">Nickname</label>
                            <input
                                id="name"
                                v-model="form.nickname"
                                type="text"
                                class="input input-bordered mt-1 block w-full"
                                required
                                autofocus
                                autocomplete="name"
                                :class="{'input-error': form.errors.nickname}"
                                @input="form.errors.nickname = null"
                            />
                            <span class="text-error mt-2" v-for="message of form.errors.nickname">
                        {{ message }}
                    </span>
                        </div>

                        <div class="mt-4">
                            <label for="email">Email</label>
                            <input
                                id="email"
                                v-model="form.email"
                                type="email"
                                class="input input-bordered mt-1 block w-full"
                                required
                                autocomplete="username"
                                :class="{'input-error': form.errors.email}"
                                @input="form.errors.email = null"
                            />
                            <span class="text-error mt-2" v-for="message of form.errors.email">
                    {{ message }}
                </span>
                        </div>

                        <div class="mt-4">
                            <label for="password">Password</label>
                            <input
                                id="password"
                                v-model="form.password"
                                type="password"
                                class="input input-bordered mt-1 block w-full"
                                required
                                autocomplete="new-password"
                                @input="form.errors.password = null"
                                :class="{'input-error': form.errors.password}"
                            />
                            <span class="text-error mt-2" v-for="message of form.errors.password">
                    {{ message }}
                </span>
                        </div>

                        <div class="mt-4">
                            <label for="password_confirmation">Password confirmation</label>
                            <input
                                id="password_confirmation"
                                v-model="form.password_confirmation"
                                type="password"
                                class="input input-bordered mt-1 block w-full"
                                required
                                autocomplete="new-password"
                            />
                            <p class="text-error mt-2">
                                {{ form.errors.password_confirmation }}
                            </p>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <Link :href="route('login')"
                                  class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                                Already registered?
                            </Link>

                            <button class="btn btn-primary ml-4" :class="{ 'opacity-25': form.processing }"
                                    :disabled="form.processing">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </DefaultLayout>
</template>
