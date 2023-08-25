<script setup>
import DefaultLayout from "@/Layouts/DefaultLayout.vue";
import {Head, Link, usePage} from '@inertiajs/vue3';
import ProfileList from "@/Components/ProfileList.vue";

const {user} = defineProps({
    user: {
        type: Object,
        default: () => ({})
    },
    followers: {
        type: Array,
        default: () => ([])
    },
    currentUserFollowers: {
        type: Array,
        default: () => ([])
    },
    currentUserFollowing: {
        type: Array,
        default: () => ([])
    }
})
const page = usePage();
const currentUser = page.props.auth.user;

</script>

<template>
    <Head>
        <title>
            {{ user.name }} followers
        </title>
    </Head>
    <DefaultLayout>
        <div class="px-3">
            <div class="flex justify-between items-center mb-3">
                <Link class="text-primary text-center w-full font-bold text-lg" :href="route('profile.show',{user: user.nickname})">{{ user.name }}</Link>
            </div>
            <h1 class="text-xl font-semibold text-center mb-3">Followers</h1>
            <ProfileList
                :profiles="followers.data"
                :current-user-followers="currentUserFollowers"
                :current-user-following="currentUserFollowing"
            />
        </div>
    </DefaultLayout>
</template>

<style scoped>

</style>
