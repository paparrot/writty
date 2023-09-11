<script setup>
import {Head, Link, useForm} from '@inertiajs/vue3';
import DefaultLayout from "@/Layouts/DefaultLayout.vue";
import {onBeforeMount, onMounted} from "vue";
import {useTelegramButton} from "@/composables/telegramButton.js";

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const telegramButton = useTelegramButton('telegram-container');

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.transform(data => ({
        ...data,
        remember: form.remember ? 'on' : '',
    })).post(route('login'), {
        onError: () => {
            console.log(form.errors)
        },
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <Head>
        <title>Log in</title>
    </Head>

    <DefaultLayout>
        <div class="px-3 md:px-0">
            <div class="card card-bordered bg-base-100 max-w-xl mx-auto p-4 space-y-4">
                <div class="mx-auto">
                    <img height="64" width="64" src="/icons/icon-192x192.png" alt="Writty">
                    <p class="font-bold text-xl">Writty</p>
                </div>

                <div class="socials space-y-3">
                    <h2 class="text-center font-bold text-xl">Log in via socials</h2>
                    <div class="flex justify-center">
                        <a
                            class="py-2 px-[1.125rem] rounded-lg bg-sky-400 text-white font-bold"
                            :href="route('auth.social.redirect', {driver: 'twitter'})"
                        >Log in with Twitter</a>
                    </div>
                    <div class="flex justify-center" id="telegram-container"></div>
                </div>

                <hr class="my-0 py-0">

                <div class="log-in">
                    <h2 class="text-center font-bold text-xl mb-3">Log in</h2>

                    <div v-if="status" class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                        {{ status }}
                    </div>

                    <form @submit.prevent="submit">
                        <div>
                            <label for="email">Email</label>
                            <input
                                id="email"
                                v-model="form.email"
                                type="email"
                                class="input input-bordered mt-1 block w-full"
                                :class="{'input-error': form.errors.email}"
                                @input="form.errors.email = null"
                                required
                                autofocus
                                autocomplete="username"
                            />
                            <p class="text-error" v-if="form.errors.email">{{ form.errors.email }}</p>
                        </div>

                        <div class="mt-4">
                            <label for="email">Password</label>
                            <input
                                id="password"
                                v-model="form.password"
                                type="password"
                                @input="form.errors.password = null"
                                :class="{'input-error': form.errors.password}"
                                class="input input-bordered mt-1 block w-full"
                                required
                                autocomplete="current-password"
                            />
                            <p class="text-error" v-if="form.errors.password">
                                {{ form.errors.password }}
                            </p>
                        </div>

                        <div class="block mt-4">
                            <label class="flex items-center">
                                <input type="checkbox" class="checkbox" v-model="form.remember" name="remember"/>
                                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">Remember me</span>
                            </label>
                        </div>

                        <div class="text-sm py-4">
                            <Link class="text-primary" :href="route('register')">Register</Link>
                            , if you don't have account yet.
                        </div>

                        <div class="flex items-center justify-end mt-4">

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
