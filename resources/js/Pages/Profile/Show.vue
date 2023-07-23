<script setup>
import {useForm, usePage, Head, router} from "@inertiajs/vue3";
import DefaultLayout from "@/Layouts/DefaultLayout.vue";

const page = usePage();
const form = useForm({
    email: page.props.auth?.user?.email,
    name: page.props.auth?.user?.name,
    nickname: page.props.auth?.user?.nickname,
    photo: page.props.auth?.user?.profile_photo_path
});

const updateUser = () => {
    form.post(route('profile.update', {user: page.props.auth.user.id}), {
        forceFormData: true,
    })
}
</script>

<template>
    <Head title="Profile"></Head>
    <DefaultLayout>
        <h1 class="text-2xl text-center mb-2 font-bold">Profile information</h1>
        <div v-if="page.props.auth.user.profile_photo_path" class="avatar w-full my-4">
            <div class="w-16 mx-auto rounded-full">
                <img :src="page.props.auth.user.profile_photo_path"/>
            </div>
        </div>
        <div v-else class="avatar placeholder w-full my-4">
            <div class="bg-neutral-focus text-neutral-content rounded-full w-16 mx-auto">
                <span class="font-bold text-2xl">{{ page.props.auth.user.email[0].toUpperCase() }}</span>
            </div>
        </div>
        <div class="card card-bordered p-4 mx-auto max-w-xl">
            <form @submit.prevent="updateUser" class="space-y-4">
                <div>
                    <label for="email" class="label">
                        Email
                    </label>
                    <input id="email" type="text" name="email" class="w-full input input-bordered" v-model="form.email">
                    <p class="text-error" v-if="form.errors.email">{{ form.errors.email }}</p>
                </div>
                <div>
                    <label for="name" class="label">
                        Name
                    </label>
                    <input
                        :class="{'input-error': form.errors.name}"
                        id="name"
                        type="text"
                        class="input input-bordered w-full"
                        v-model="form.name">
                    <p class="text-error" v-if="form.errors.name">{{ form.errors.name }}</p>
                </div>
                <div>
                    <label for="nickname" class="label">
                        Nickname
                    </label>
                    <input
                        :class="{'input-error': form.errors.nickname}"
                        id="name"
                        type="text"
                        class="input input-bordered w-full"
                        v-model="form.nickname"
                    >
                    <p class="text-error" v-if="form.errors.nickname">{{ form.errors.nickname }}</p>
                </div>
                <div>
                    <label class="label" for="photo">
                        Profile photo
                    </label>
                    <input type="file" @input="form.photo = $event.target.files[0]" id="photo"
                           class="file-input file-input-bordered w-full max-w-xs"/>
                </div>
                <button type="submit" class="w-full btn btn-primary">
                    Update
                </button>
            </form>
        </div>
    </DefaultLayout>
</template>
