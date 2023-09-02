<script setup>
import PostList from "@/Components/PostList.vue";
import {usePostStore} from "@/stores/postStore.js";
import postService from "@/services/postService.js";
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
        <title>Your favourites posts</title>
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
