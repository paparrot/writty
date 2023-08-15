<script setup>
import DefaultLayout from "@/Layouts/DefaultLayout.vue";
import {Head} from "@inertiajs/vue3";
import PostList from "@/Components/PostList.vue";
import {usePostStore} from "@/Stores/postStore.js";
import {onBeforeMount} from "vue";
import postService from "@/Services/postService.js";

const {posts} = defineProps({
    posts: {
        type: Array,
    }
})

const postStore = usePostStore();

onBeforeMount(() => {
    postService.listenCreatingPost();
    postService.listenDeletingPost();
    postStore.setPosts(posts.data)
    postStore.setCurrentPage(posts.meta.current_page);
    postStore.setLastPage(posts.meta.last_page);
})

</script>

<template>
    <Head>
        <title>Home</title>
    </Head>
    <DefaultLayout>
        <PostList
            :posts="postStore.posts.data"
            @load-more-posts="postService.loadMorePosts"
        ></PostList>
    </DefaultLayout>
</template>
