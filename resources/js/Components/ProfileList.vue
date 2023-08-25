<script setup>

import {Link, usePage} from "@inertiajs/vue3";

const page = usePage();
const currentUser = page.props.auth.user;

defineProps({
    profiles: {
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
</script>

<template>
    <div v-if="profiles.length === 0" class="text-center text-lg">There are no users yet.</div>
    <ul class="space-y-3">
        <li v-for="profile of profiles" :key="profile.id">
            <Link
                :href="route('profile.show', {user: profile.nickname})"
                class="flex gap-3 card card-bordered border-neutral p-4"
            >
                <div class="grid grid-cols-12 gap-1 items-center justify-between">
                    <div v-if="! profile.avatar" class="col-span-2 avatar placeholder">
                        <div class="bg-neutral-focus text-neutral-content rounded-full w-16">
                            <span class="text-xl font-bold">{{ profile.nickname.toUpperCase()[0] }}</span>
                        </div>
                    </div>
                    <div v-else class="avatar col-span-2">
                        <div class="w-16 rounded-full">
                            <img :src="profile.avatar"/>
                        </div>
                    </div>
                    <div class="col-span-7">
                        <div v-if="currentUser && currentUser.id === profile.id" class="indicator">
                            <span class="indicator-item badge badge-neutral">You</span>
                            <div>
                                <p>{{ profile.name }}</p>
                                <p>@{{ profile.nickname }}</p>
                            </div>
                        </div>
                        <div v-else>
                            <div>
                                <p>{{ profile.name }}</p>
                                <p>@{{ profile.nickname }}</p>
                            </div>
                        </div>
                        <div v-if="currentUserFollowers.includes(profile.id)" class="indicator">
                            <span class="indicator-item badge badge-neutral">Your follower</span>
                            <div>
                                <p>{{ profile.name }}</p>
                                <p>@{{ profile.nickname }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-3 justify-items-end" v-if="currentUser && currentUser.nickname !== profile.nickname">
                        <Link
                            method="post"
                            :href="route('users.follow', {user: profile.nickname})"
                            as="button"
                            v-if="!currentUserFollowing.includes(profile.id)"
                            class="flex btn btn-outline"
                        >
                            Follow
                        </Link>
                        <Link
                            v-else
                            method="delete"
                            as="button"
                            :href="route('users.unfollow', {user: profile.nickname})"
                            class="btn btn-outline"
                        >
                            Unfollow
                        </Link>
                    </div>
                </div>
            </Link>
        </li>
    </ul>
</template>

<style scoped>

</style>
