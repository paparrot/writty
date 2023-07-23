<script setup>
import { nextTick, ref } from 'vue';
import { Head, useForm } from '@inertiajs/vue3';
import DefaultLayout from "@/Layouts/DefaultLayout.vue";

const recovery = ref(false);

const form = useForm({
    code: '',
    recovery_code: '',
});

const recoveryCodeInput = ref(null);
const codeInput = ref(null);

const toggleRecovery = async () => {
    recovery.value ^= true;

    await nextTick();

    if (recovery.value) {
        recoveryCodeInput.value.focus();
        form.code = '';
    } else {
        codeInput.value.focus();
        form.recovery_code = '';
    }
};

const submit = () => {
    form.post(route('two-factor.login'));
};
</script>

<template>
    <Head title="Two-factor Confirmation" />

    <DefaultLayout>
        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            <template v-if="! recovery">
                Please confirm access to your account by entering the authentication code provided by your authenticator application.
            </template>

            <template v-else>
                Please confirm access to your account by entering one of your emergency recovery codes.
            </template>
        </div>

        <form @submit.prevent="submit">
            <div v-if="! recovery">
                <label for="code">Code</label>
                <input
                    id="code"
                    ref="codeInput"
                    v-model="form.code"
                    type="text"
                    inputmode="numeric"
                    class="input input-bordered mt-1 block w-full"
                    autofocus
                    autocomplete="one-time-code"
                />
                <p class="mt-2 text-error">
                    {{ form.errors.code }}
                </p>
            </div>

            <div v-else>
                <label for="recovery_code">
                    Recovery Code
                </label>
                <input
                    id="recovery_code"
                    ref="recoveryCodeInput"
                    v-model="form.recovery_code"
                    type="text"
                    class="input input-bordered mt-1 block w-full"
                    autocomplete="one-time-code"
                />
                <p class="mt-2 text-error">
                    {{ form.errors.recovery_code }}
                </p>
            </div>

            <div class="flex items-center justify-end mt-4">
                <button type="button" class="btn btn-primary text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 underline cursor-pointer" @click.prevent="toggleRecovery">
                    {{ recovery ? "Use an authentication code" : "Use a recovery code" }}
                </button>

                <button class="btn primary-btn ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Log in
                </button>
            </div>
        </form>
    </DefaultLayout>
</template>
