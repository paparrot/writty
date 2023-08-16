<script setup>
import {Head, usePage} from "@inertiajs/vue3";
import {onBeforeMount} from 'vue';
import DefaultLayout from "@/Layouts/DefaultLayout.vue";
import PostList from "@/Components/PostList.vue";
import {usePostStore} from "@/Stores/postStore.js";
import postService from "@/Services/postService.js";
import userService from "@/Services/userService.js";

const {user, posts, isFollowing } = defineProps({
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

</script>

<template>
    <Head>
        <title>Profile</title>
    </Head>
    <DefaultLayout>
        <h1 class="text-2xl text-center mb-2 font-bold">{{ user.name }}</h1>
        <div v-if="user.avatar" class="avatar w-full my-4">
            <div class="w-16 mx-auto rounded-full">
                <img :src="user.avatar" :alt="user.nickname"/>
            </div>
        </div>
        <div v-if="auth.user && auth.user.id !== user.id" class="flex items-center my-2">
            <button v-if="!isFollowing" @click="userService.follow(user.nickname)" class="mx-auto btn btn-primary btn-outline">
                Follow
            </button>
            <button @click="userService.unfollow(user.nickname)" v-else class="mx-auto btn btn-outline">
                Unfollow
            </button>
        </div>
        <PostList
            :posts="postStore.posts.data"
            @load-more-posts="postService.loadMorePosts"
        ></PostList>
    </DefaultLayout>
</template>

<style scoped>

</style>
