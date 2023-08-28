<script setup>
import PostList from "@/Components/PostList.vue";
import {usePostStore} from "@/Stores/postStore.js";
import postService from "@/Services/postService.js";
import {onBeforeMount} from "vue";
import {usePage, Head} from "@inertiajs/vue3";
import DefaultLayout from "@/Layouts/DefaultLayout.vue";

const postStore = usePostStore();
const {posts} = defineProps({
    posts: {
        type: Array,
        required: true
    }
})

onBeforeMount(() => {
    postStore.setPosts(posts.data);
    postStore.setCurrentPage(posts.meta.current_page);
    postStore.setLastPage(posts.meta.last_page);
})

const page = usePage();
</script>

<template>
    <Head>
        <title>Following</title>
    </Head>
    <DefaultLayout>
        <PostList
            :posts="postStore.posts.data"
            @load-more-posts="postService.loadMorePosts"
        ></PostList>
    </DefaultLayout>
</template>

<style scoped>
</style>
