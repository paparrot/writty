<script setup>
import DefaultLayout from "@/Layouts/DefaultLayout.vue";
import {Head} from "@inertiajs/vue3";
import PostList from "@/Components/PostList.vue";
import {usePostStore} from "@/Stores/postStore.js";
import {onBeforeMount, onUpdated} from "vue";
import postService from "@/Services/postService.js";

const {posts} = defineProps({
    posts: {
        type: Array,
    }
})

const postStore = usePostStore();

onBeforeMount(() => {
    postStore.setPosts(posts.data)
    postStore.setLastPage(posts.meta.last_page);
    postService.listenCreatingPost();
    postService.listenDeletingPost();
})

</script>

<template>
    <Head>
        <title>Home</title>
    </Head>
    <DefaultLayout>
        <PostList
            @load-more-posts="postService.loadMorePosts"
        ></PostList>
    </DefaultLayout>
</template>
