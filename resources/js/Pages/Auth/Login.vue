<script setup>
import {Head, Link,  useForm} from '@inertiajs/vue3';
import DefaultLayout from "@/Layouts/DefaultLayout.vue";

defineProps({
    canResetPassword: Boolean,
    status: String,
});

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
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <Head>
        <title>Log in</title>
    </Head>

    <DefaultLayout>
        <div class="card card-bordered bg-base-100 max-w-xl mx-auto p-4">
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
                    <Link class="text-primary" :href="route('register')">Register</Link>, if you don't have account yet.
                </div>

                <div class="flex items-center justify-end mt-4">

                    <button class="btn btn-primary btn-sm ml-4" :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing">
                        Log in
                    </button>
                </div>
            </form>
        </div>
    </DefaultLayout>
</template>
