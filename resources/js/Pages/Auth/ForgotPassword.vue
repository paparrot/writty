<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import DefaultLayout from "@/Layouts/DefaultLayout.vue";

defineProps({
    status: String,
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <Head title="Forgot Password" />

    <DefaultLayout>

        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
        </div>

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
                    required
                    autofocus
                    autocomplete="username"
                />
                <p class="text-error mt-2">
                    {{ form.errors.email }}
                </p>
            </div>

            <div class="flex items-center justify-end mt-4">
                <button class="btn btn-primary" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Email Password Reset Link
                </button>
            </div>
        </form>
    </DefaultLayout>
</template>
