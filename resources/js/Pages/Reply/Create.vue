<script setup>
import PostForm from "@/Components/PostForm.vue";
import {usePostStore} from "@/Stores/postStore.js";
import {Head, usePage } from "@inertiajs/vue3";
import DefaultLayout from "@/Layouts/DefaultLayout.vue";
import {onBeforeMount} from "vue";
import Post from '@/Components/Post.vue';

const page = usePage();
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
            <div v-if="page.props.auth.user" class="card card-bordered p-3">
                <h2 class="text-xl font-semibold">Add new reply</h2>
                <PostForm :replied="post.id" />
            </div>
        </div>
    </DefaultLayout>
</template>

<style scoped>

</style>
