<script setup>
import PostList from "@/Components/PostList.vue";
import {usePostStore} from "@/Stores/postStore.js";
import {Head} from '@inertiajs/vue3';
import {onBeforeMount, onUpdated} from "vue";
import DefaultLayout from "@/Layouts/DefaultLayout.vue";
import PostForm from "@/Components/PostForm.vue";
import postService from "@/Services/postService.js";

const postStore = usePostStore();

const {post, replies } = defineProps({
    post: {
        type: Object,
        default: null,
    },
    replies: {
        type: Array,
        default: () => [],
    }
})

onBeforeMount(() => {
    postService.listenDeletingPost();
    postStore.closePostModal()
    postStore.setPosts(replies.data)
    postStore.setLastPage(replies.meta.last_page);
})

</script>

<template>
    <Head>
        <title>Show post</title>
    </Head>
    <DefaultLayout>
        <div class="px-3 space-y-2">
            <h1 class="text-xl font-bold">Main post</h1>
            <Post without-actions :post="post" />
            <div v-if="$page.props.auth.user" class="card card-bordered p-3">
                <h2 class="text-xl font-semibold">Add new reply</h2>
                <PostForm :replied="post.id" />
            </div>
            <div class="px-0 replies space-y-3" v-if="replies.data.length > 0">
                <h2 class="text-xl font-semibold">Replies:</h2>
                <PostList />
            </div>
        </div>
    </DefaultLayout>
</template>

<style scoped>

</style>
