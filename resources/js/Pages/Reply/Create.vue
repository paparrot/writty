<script setup>
import PostForm from "@/Components/PostForm.vue";
import Post from "@/Components/Post.vue";
import {usePostStore} from "@/Stores/postStore.js";
import {Head} from "@inertiajs/vue3";
import DefaultLayout from "@/Layouts/DefaultLayout.vue";
import {onBeforeMount} from "vue";

const postStore = usePostStore();

onBeforeMount(() => {
    postStore.setPostToReply(post)
})

const {post} = defineProps({
    post: {
        type: Object,
        default: null,
    }
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
            <div class="card card-bordered border-neutral p-3">
                <h2 class="text-xl font-semibold">Add new reply</h2>
                <PostForm />
            </div>
        </div>
    </DefaultLayout>
</template>

<style scoped>

</style>
