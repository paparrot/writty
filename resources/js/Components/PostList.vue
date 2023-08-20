<script>
import postService from "@/Services/postService.js";
import {usePostStore} from "@/Stores/postStore.js";
import Post from "@/Components/Post.vue";

export default {
    components: {Post},
    computed: {
        postService() {
            return postService
        }
    },
    setup() {
        const postStore = usePostStore();

        return {
            postStore
        }
    },
    mounted() {
        const observer = new IntersectionObserver(entries => {
                return entries
                    .forEach(entry => entry.isIntersecting && this.postService.loadMorePosts(), {rootMargin: "-150px 0px 0px 0px"})
            }
        );
        observer.observe(this.$refs.loadMoreIntersect)
    }
}
</script>

<template>
    <div class="space-y-2 px-3 md:px-0 pb-16 md:pb-0">
        <div
            v-for="post of postStore.posts.data"
            :key="post"
        >
            <post :post="post" />
        </div>
        <span ref="loadMoreIntersect"></span>
    </div>
</template>

<style scoped>

</style>
