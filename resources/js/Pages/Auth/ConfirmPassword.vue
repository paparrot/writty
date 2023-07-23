<script setup>
import { ref } from 'vue';
import { Head, useForm } from '@inertiajs/vue3';
import DefaultLayout from "@/Layouts/DefaultLayout.vue";

const form = useForm({
    password: '',
});

const passwordInput = ref(null);

const submit = () => {
    form.post(route('password.confirm'), {
        onFinish: () => {
            form.reset();

            passwordInput.value.focus();
        },
    });
};
</script>

<template>
    <Head>
        <title>Secure Area</title>
    </Head>

    <DefaultLayout>
        <div class="card">

            <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                This is a secure area of the application. Please confirm your password before continuing.
            </div>

            <form @submit.prevent="submit">
                <div>
                    <label class="label" for="password">
                        Password
                    </label>
                    <input
                        id="password"
                        ref="passwordInput"
                        v-model="form.password"
                        type="password"
                        class="input input-bordered mt-1 block w-full"
                        required
                        autocomplete="current-password"
                        autofocus
                    />
                    <p class="mt-2 text-error">
                        {{ form.errors.password }}
                    </p>
                </div>

                <div class="flex justify-end mt-4">
                    <button class="btn btn-primary ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Confirm
                    </button>
                </div>
            </form>
        </div>
    </DefaultLayout>
</template>
