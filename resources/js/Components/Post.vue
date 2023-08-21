<script setup>
import {usePostStore} from "@/Stores/postStore.js";
import postService from "@/Services/postService.js";
import {computed} from "vue";
import {usePage} from "@inertiajs/vue3";

const {withoutActions, post} = defineProps({
    post: {
        type: Object,
        default: null,
    },
    withoutActions: {
        type: Boolean,
        default: false,
    },
    withoutPreview: {
        type: Boolean,
        default: false,
    }
})

const postStore = usePostStore();
const page = usePage();

const canDeletePost = computed(() => {
    return page.props.auth?.user?.nickname === post.author.nickname && !withoutActions
})

const showActions = computed(() => {
    return !withoutActions && page.props.auth.user;
})

const canDeleteRepost = computed(() => {
    return post.author.id === page.props.auth.user.id && post.reposted;
})

const canRepost = computed(() => {
    return page.props.auth.user.id !== post.author.id
})

</script>

<template>
    <article class="card card-bordered rounded p-3">
        <div class="card-header mb-3 flex justify-between">
            <div class="author items-center flex gap-5">
                <div class="avatar" v-if="post.author.avatar">
                    <div class="w-12 rounded-full">
                        <a :href="route('profile.show', {user: post.author.nickname})">
                            <img

                                :src="post.author.avatar"
                                alt="post.author.name"
                            />
                        </a>
                    </div>
                </div>
                <div class="avatar placeholder" v-else>
                    <div class="bg-neutral-focus text-neutral-content w-12 rounded-full">
                        <span class="text-2xl font-bold">{{ post.author.nickname.toUpperCase()[0] }}</span>
                    </div>
                </div>
                <div class="author-text">
                    <h6 class="font-bold">
                        <a :href="route('profile.show', {user: post.author.nickname})">
                            {{ post.author.name }}
                        </a>
                    </h6>
                    <p class="font-mono text-gray-500 text-sm">
                        <a :href="route('profile.show', {user: post.author.nickname})">
                            @{{ post.author.nickname }}
                        </a>
                    </p>
                    <p class="font-mono text-gray-500 text-sm">{{ post.created }}</p>
                </div>
            </div>
            <button
                @click="postService.deletePost(post.id)"
                v-if="canDeletePost"
            >
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
        <div v-if="! post.reposted" class="main">
            <p class="break-words text-lg">{{ post.content }}</p>
            <img
                v-if="!withoutPreview && post.attachment"
                class="object-cover aspect-square my-2 rounded"
                :src="post.attachment"
                alt="Attachment" />
        </div>
        <div v-else>
            <post without-actions :post="post.reposted" />
        </div>
        <div v-if="showActions" class="actions mt-2 flex items-center gap-2 justify-start">
            <div class="likes flex gap-1">
                <p class="font-bold text-lg" v-if="post.likesCount">{{ post.likesCount }}</p>
                <button @click="post.isLiked ? postService.unlike(post.id) : postService.like(post.id)">
                    <svg
                        :class="{'fill-pink-300 stroke-pink-500': post.isLiked }"
                        xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-heart" width="24"
                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572"></path>
                    </svg>
                </button>
            </div>
            <button
                v-if="!canDeleteRepost"
                :disabled="!canRepost"
                :class="{'text-neutral': !canRepost}"
                @click="postService.repost(post.id)"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-repeat" width="24"
                     height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                     stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M4 12v-3a3 3 0 0 1 3 -3h13m-3 -3l3 3l-3 3"/>
                    <path d="M20 12v3a3 3 0 0 1 -3 3h-13m3 3l-3 -3l3 -3"/>
                </svg>
            </button>
            <button @click="postService.deletePost(post.id)" v-else>
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-repeat-off" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M4 12v-3c0 -1.336 .873 -2.468 2.08 -2.856m3.92 -.144h10m-3 -3l3 3l-3 3" />
                    <path d="M20 12v3a3 3 0 0 1 -.133 .886m-1.99 1.984a3 3 0 0 1 -.877 .13h-13m3 3l-3 -3l3 -3" />
                    <path d="M3 3l18 18" />
                </svg>
            </button>
            <button class="hidden md:block" @click.stop="postStore.openReplyModal(post)">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-message-circle-2"
                     width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                     stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M3 20l1.3 -3.9a9 8 0 1 1 3.4 2.9l-4.7 1"/>
                </svg>
            </button>
            <a class="md:hidden" :href="route('posts.reply.create', {post: post.id })">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-message-circle-2"
                     width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                     stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M3 20l1.3 -3.9a9 8 0 1 1 3.4 2.9l-4.7 1"/>
                </svg>
            </a>
            <div v-if="post.repliesCount > 0">
                <a class="text-lg text-accent font-bold" :href="route('posts.show', {post: post.id })">Show
                    {{ post.repliesCount }} replies...</a>
            </div>
        </div>
    </article>
</template>

<style scoped>

</style>
