<script setup>
import {useForm, usePage} from "@inertiajs/vue3";
import DefaultLayout from "@/Layouts/DefaultLayout.vue";

const page = usePage();
const form = useForm({
    email: page.props.auth?.user?.email,
    name: page.props.auth?.user?.name,
});

const updateUser = () => {
    form.put(route('profile.update', {user: page.props.auth.user.id}))
}
</script>

<template>
    <DefaultLayout>
        <h1 class="text-2xl text-center mb-2 font-bold">Profile information</h1>
        <div class="card card-bordered p-4 mx-auto max-w-xl">
            <form @submit.prevent="updateUser" class="space-y-4">
                <div>
                    <label for="email" class="label">
                        Email
                    </label>
                    <input type="text" name="email" class="w-full input input-bordered" v-model="form.email">
                    <p class="text-error" v-if="form.errors.email">{{ form.errors.email }}</p>
                </div>
                <div>
                    <label for="name" class="label">
                        Name
                    </label>
                    <input type="text" class="input input-bordered w-full" v-model="form.name">
                    <p class="text-error" v-if="form.errors.name">{{ form.errors.name }}</p>
                </div>
                <button type="submit" class="w-full btn btn-primary">
                    Update
                </button>
            </form>
        </div>
    </DefaultLayout>
</template>
