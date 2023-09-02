<script setup>
import {Head, usePage, Link, router} from "@inertiajs/vue3";
import {onBeforeMount} from 'vue';
import DefaultLayout from "@/Layouts/DefaultLayout.vue";
import PostList from "@/Components/PostList.vue";
import {usePostStore} from "@/stores/postStore.js";
import postService from "@/services/postService.js";
import userService from "@/services/userService.js";
import Modal from "@/Components/Modal.vue";

const {user, posts, isFollowing} = defineProps({
    posts: {
        type: Object,
    },
    user: {
        type: Object,
    },
    isFollowing: {
        type: Boolean,
    }
})

const {props: {auth}} = usePage();
const postStore = usePostStore();

onBeforeMount(() => {
    postStore.setPosts(posts.data)
    postStore.setCurrentPage(posts.meta.current_page);
    postStore.setLastPage(posts.meta.last_page);
    postService.listenDeletingPost();
})

const deleteUser = () => {
    router.delete(route('profile.delete'))
}

</script>

<template>
    <Head>
        <title>Profile</title>
    </Head>
    <DefaultLayout>
        <div class="flex justify-center mb-3">
            <div v-if="! user.avatar" class="avatar placeholder">
                <div class="bg-neutral-focus text-neutral-content rounded-full w-16">
                    <span class="text-xl font-bold">{{ user.nickname.toUpperCase()[0] }}</span>
                </div>
            </div>
            <div v-else class="avatar">
                <div class="w-16 rounded-full">
                    <img :src="user.avatar"/>
                </div>
            </div>
        </div>
        <h1 class="text-2xl text-center mb-3 font-bold">{{ user.name }}</h1>
        <div class="flex justify-center gap-3 mb-3">
            <Link :href="route('profile.followers', {user: user.nickname})" class="text-primary">
                Followers
            </Link>
            <Link :href="route('profile.following', {user: user.nickname})" class="text-primary">
                Following
            </Link>
        </div>
        <div v-if="auth.user">
            <div v-if="auth.user.id !== user.id" class="flex justify-center gap-3 items-center my-2">
                <Link class="btn btn-primary btn-outline" :href="route('chat.show', {user: user.nickname})">Chat</Link>
                <button v-if="!isFollowing" @click="userService.follow(user.nickname)"
                        class="btn btn-primary btn-outline">
                    Follow
                </button>
                <button @click="userService.unfollow(user.nickname)" v-else class="btn btn-outline hover:btn-error">
                    Unfollow
                </button>
            </div>
            <div v-else class="flex justify-center gap-2 mb-3">
                <Link class="btn btn-outline" :href="route('profile.edit')">Edit</Link>
                <button class="btn btn-outline btn-error" onclick="deleteModal.showModal()">
                    Delete
                </button>
            </div>
        </div>

        <PostList
            :posts="postStore.posts.data"
            @load-more-posts="postService.loadMorePosts"
        ></PostList>

        <Modal id="deleteModal">
            <p class="text-xl text-center mb-1">Are you sure want delete your profile?</p>
            <p class="text-center mb-3">Your posts and messages will be deleted too.</p>
            <div class="flex gap-3 w-full">
                <button class="btn flex-1">Cancel</button>
                <button class="flex-1 btn btn-outline btn-error" @click="deleteUser">
                    Confirm
                </button>
            </div>
        </Modal>
    </DefaultLayout>
</template>

<style scoped>

</style>
