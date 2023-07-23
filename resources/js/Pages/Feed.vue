<script setup>
import DefaultLayout from "@/Layouts/DefaultLayout.vue";
import {Head} from "@inertiajs/vue3";
import {router} from "@inertiajs/vue3";

const deletePost = (id) => {
    router.delete(route('posts.delete', {post: id}))
}

defineProps({
    posts: [],
    auth: {
        type: Object,
    }
})
</script>

<template>
    <Head>
        <title>Home</title>
    </Head>
    <DefaultLayout>
        <div class="space-y-2 px-3">
            <div
                v-for="post of posts"
                :key="post"
                class="card border rounded p-3"
            >
                <div class="card-header mb-3 flex justify-between">
                    <div class="author items-center flex gap-5">
                        <div class="avatar" v-if="post.author.profile_photo_path">
                            <div class="w-12 rounded-full">
                                <img

                                    :src="post.author.profile_photo_path"
                                    alt="post.author.name"
                                />
                            </div>
                        </div>
                        <div class="avatar placeholder" v-else>
                            <div class="bg-neutral-focus text-neutral-content w-12 rounded-full">
                                <span class="text-2xl font-bold">{{ post.author.email[0].toUpperCase() }}</span>
                            </div>
                        </div>
                        <div class="author-text">
                            <h6 class="font-bold">
                                <a :href="route('home', {author: post.author.nickname})">
                                    {{ post.author.name }}
                                </a>
                            </h6>
                            <p class="font-mono text-gray-500 mb-2 text-sm">
                                <a :href="route('home', {author: post.author.nickname})">
                                    @{{ post.author.nickname }}
                                </a>
                            </p>
                        </div>
                    </div>
                    <button @click="deletePost(post.id)"
                            v-if="auth.user && auth.user.id && auth.user.id === post.author.id">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash-x"
                             width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                             fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M4 7h16"></path>
                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                            <path d="M10 12l4 4m0 -4l-4 4"></path>
                        </svg>
                    </button>
                </div>
                <p class="break-words text-lg">{{ post.content }}</p>
            </div>
        </div>
    </DefaultLayout>
</template>
