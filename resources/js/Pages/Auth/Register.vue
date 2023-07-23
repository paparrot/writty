<script setup>
import {Head, Link, useForm} from '@inertiajs/vue3';
import DefaultLayout from "@/Layouts/DefaultLayout.vue";

const form = useForm({
    name: '',
    email: '',
    password: '',
    nickname: '',
    password_confirmation: '',
});

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
        <div class="card card-bordered max-w-xl mx-auto p-4">
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
                        Register
                    </button>
                </div>
            </form>
        </div>
    </DefaultLayout>
</template>
