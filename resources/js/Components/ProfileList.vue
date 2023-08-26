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
                <div class="flex justify-start md:grid md:grid-cols-12 gap-2 items-center md:justify-between">
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
                    <div class="col-span-7 flex-1 text-sm md:text-md">
                        <div v-if="currentUser && currentUser.id === profile.id">
                            <div class="badge badge-info mb-1">You</div>
                            <p class="px-2">{{ profile.name }}</p>
                            <p class="px-2">@{{ profile.nickname }}</p>
                        </div>
                        <div
                            v-if="!currentUser || (currentUser.id !== profile.id && !currentUserFollowers.includes(profile.id))">
                            <p class="px-2">{{ profile.name }}</p>
                            <p class="px-2">@{{ profile.nickname }}</p>
                        </div>
                        <div v-if="currentUserFollowers.includes(profile.id)">
                            <div class="badge badge-info mb-1">Your follower</div>
                            <p class="px-2">{{ profile.name }}</p>
                            <p class="px-2">@{{ profile.nickname }}</p>
                        </div>
                    </div>
                    <div
                        class="col-span-3 flex justify-items-end gap-3"
                        v-if="currentUser && currentUser.nickname !== profile.nickname"
                    >
                        <Link class="btn btn-outline px-2" :href="route('chat.show', {user: profile.nickname})">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mail" width="24"
                                 height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path
                                    d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z"/>
                                <path d="M3 7l9 6l9 -6"/>
                            </svg>
                        </Link>
                        <Link
                            method="post"
                            :href="route('users.follow', {user: profile.nickname})"
                            as="button"
                            v-if="!currentUserFollowing.includes(profile.id)"
                            class="px-2 btn btn-outline"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-check"
                                 width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                 fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"/>
                                <path d="M6 21v-2a4 4 0 0 1 4 -4h4"/>
                                <path d="M15 19l2 2l4 -4"/>
                            </svg>
                        </Link>
                        <Link
                            v-else
                            method="delete"
                            as="button"
                            :href="route('users.unfollow', {user: profile.nickname})"
                            class="btn px-2 btn-outline"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-x"
                                 width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                 fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"/>
                                <path d="M6 21v-2a4 4 0 0 1 4 -4h3.5"/>
                                <path d="M22 22l-5 -5"/>
                                <path d="M17 22l5 -5"/>
                            </svg>
                        </Link>
                    </div>
                </div>
            </Link>
        </li>
    </ul>
</template>

<style scoped>

</style>
