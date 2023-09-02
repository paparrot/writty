<script setup>
import {Head, useForm, usePage} from '@inertiajs/vue3';
import DefaultLayout from "@/Layouts/DefaultLayout.vue";
import {ref} from "vue";

const disabledButton = ref(false);
const page = usePage();
const user = page.props.auth.user;

const form = useForm({
    email: null
})

const submit = () => {
    disabledButton.value = true;
    form.put(route('profile.update', {user}), {
        onFinish: () => {
            disabledButton.value = false;
        }
    })
}
</script>

<template>
    <Head>
        <title>Add email</title>
    </Head>
    <DefaultLayout>
        <div class="px-3 md:px-0">
            <div class="card card-bordered bg-base-100 max-w-xl mx-auto p-4 space-y-4">
                <div class="mx-auto">
                    <img height="64" width="64" src="/icons/icon-192x192.png" alt="Writty">
                    <p class="font-bold text-xl">Writty</p>
                </div>

                <p class="text-center text-lg">Please, add email</p>
                <form @submit.prevent="submit" class="space-y-4 flex flex-col">
                    <div class="w-full">
                        <label for="email" class="label">
                            Email
                        </label>
                        <input id="email" type="text" name="email" class="w-full input input-bordered" v-model="form.email">
                        <p class="text-error" v-if="form.errors.email">{{ form.errors.email }}</p>
                    </div>
                    <button class="btn" type="submit">Submit</button>
                </form>
            </div>
        </div>
    </DefaultLayout>
</template>

<style scoped>

</style>
