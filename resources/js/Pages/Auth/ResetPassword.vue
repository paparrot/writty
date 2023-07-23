<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import DefaultLayout from "@/Layouts/DefaultLayout.vue";

const props = defineProps({
    email: String,
    token: String,
});

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('password.update'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head title="Reset Password" />

    <DefaultLayout>
        <form @submit.prevent="submit">
            <div>
                <label for="email">
                    Email
                </label>
                <input
                    id="email"
                    v-model="form.email"
                    type="email"
                    class="input input-bordered mt-1 block w-full"
                    required
                    autofocus
                    autocomplete="username"
                />
                <p class="mt-2">{{ form.errors.email }}</p>
            </div>

            <div class="mt-4">
                <label for="password" class="label">Password</label>
                <input
                    id="password"
                    v-model="form.password"
                    type="password"
                    class="input input-bordered mt-1 block w-full"
                    required
                    autocomplete="new-password"
                />
                <p class="mt-2">
                    {{ form.errors.password }}
                </p>
            </div>

            <div class="mt-4">
                <label for="password_confirmation">Confirm Password</label>
                <input
                    id="password_confirmation"
                    v-model="form.password_confirmation"
                    type="password"
                    class="input input-bordered mt-1 block w-full"
                    required
                    autocomplete="new-password"
                />
                <p class="mt-2">
                    {{ form.errors.password_confirmation }}
                </p>
            </div>

            <div class="flex items-center justify-end mt-4">
                <button
                    class="btn btn-primary"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Reset Password
                </button>
            </div>
        </form>
    </DefaultLayout>
</template>
