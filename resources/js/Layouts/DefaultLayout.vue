<script setup>
import {router, Link, usePage} from "@inertiajs/vue3";
import {onBeforeMount, onUpdated, ref} from 'vue';
import PostForm from "@/Components/PostForm.vue";
import {usePostStore} from "@/Stores/postStore.js";
import Post from "@/Components/Post.vue";

const page = usePage();
const user = ref(page.props.auth?.user);
const userId = ref(page.props?.auth?.user?.id)

onUpdated(() => {
    userId.value = page.props?.auth?.user?.id;
})

const postStore = usePostStore();

const logout = () => {
    router.post(route('logout'))
}

onBeforeMount(() => {
    postStore.closePostModal();
})


</script>

<template>
    <div class="h-screen overflow-hidden max-w-6xl mx-auto flex gap-4 md:p-4">
        <aside class="card card-bordered w-3/12 hidden md:block p-4">
            <nav>
                <ul class="space-y-3">
                    <li>
                        <Link
                            :class="{'text-primary': route().current('home')}"
                            :href="route('home')" class="btn btn-outline w-full">Home</Link>
                    </li>
                    <template v-if="!userId">
                        <li>
                            <Link
                                :class="{'text-primary': route().current('login')}"
                                class="btn btn-outline w-full"
                                :href="route('login')">
                                Login
                            </Link>
                        </li>
                        <li>
                            <Link
                                :class="{'text-primary': route().current('register')}"
                                :href="route('register')"
                                class="btn btn-outline w-full"
                            >
                                Register
                            </Link>
                        </li>
                    </template>
                    <li>
                        <Link
                            :class="{'text-primary': route().current('posts.search')}"
                            :href="route('posts.search')"
                            class="btn btn-outline w-full"
                        >
                            Search
                        </Link>
                    </li>
                    <template v-if="userId">
                        <li>
                            <Link
                                :class="{'text-primary': route().current('profile.show')}"
                                :href="route('profile.show', {user: user.nickname})"
                                class="btn btn-outline w-full"
                            >Profile</Link>
                        </li>
                        <li>
                            <Link
                                :class="{'text-primary': route().current('posts.favourites')}"
                                :href="route('posts.favourites')"
                                class="btn btn-outline w-full"
                            >Favourites</Link>
                        </li>
                        <li>
                            <button
                                v-if="userId"
                                @click="postStore.openPostModal"
                                class="w-full btn btn-primary"
                            >New post
                            </button>
                        </li>
                    </template>
                </ul>
            </nav>
        </aside>
        <main class="w-full md:w-6/12 overflow-y-scroll rounded">
            <header class="sticky top-0 z-10 backdrop-blur-xl w-full mb-4">
                <nav class="navbar flex justify-between shadow-md rounded-b">
                    <div class="flex gap-3">
                        <Link
                            :class="{'text-primary': route().current('home')}"
                            :href="route('home')" class="btn btn-ghost normal-case text-xl">
                            Writty
                        </Link>
                        <Link
                            v-if="userId"
                            :class="{'text-primary': route().current('posts.following')}"
                            :href="route('posts.following')" class="btn btn-ghost normal-case text-xl">
                            Following
                        </Link>
                    </div>
                    <button v-if="userId" @click="logout">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-logout" width="24"
                             height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                             stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path
                                d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2"></path>
                            <path d="M9 12h12l-3 -3"></path>
                            <path d="M18 15l3 -3"></path>
                        </svg>
                    </button>
                </nav>
            </header>
            <slot></slot>
        </main>
        <aside class="card card-bordered w-3/12 hidden md:block p-4">
            <h2 class="text-xl font-bold text-center mb-3">Latest authors</h2>
            <ul class="space-y-3">
                <li v-for="nickname of page.props.latestAuthors">
                    <Link class="block font-bold w-full rounded px-2 py-1 text-center bg-base-200"
                       :href="route('profile.show', {user: nickname})">@{{ nickname }}</Link>
                </li>
            </ul>
        </aside>
        <footer class="w-full fixed bottom-0 md:hidden">
            <ul class="menu flex justify-between menu-horizontal bg-base-200 rounded-t-box">
                <li>
                    <Link :href="route('home')" :class="{'text-primary': route().current('home')}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-home-2" width="24"
                             height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                             stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M5 12l-2 0l9 -9l9 9l-2 0"></path>
                            <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path>
                            <path d="M10 12h4v4h-4z"></path>
                        </svg>
                    </Link>
                </li>
                <li>
                    <Link
                        :class="{'text-primary': route().current('posts.search')}"
                        :href="route('posts.search')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search" width="24"
                             height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                             stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                            <path d="M21 21l-6 -6"></path>
                        </svg>
                    </Link>
                </li>
                <li v-if="userId">
                    <Link :class="{'text-primary': route().current('posts.create')}" :href="route('posts.create')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-square-rounded-plus"
                             width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                             fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M9 12h6"></path>
                            <path d="M12 9v6"></path>
                            <path d="M12 3c7.2 0 9 1.8 9 9s-1.8 9 -9 9s-9 -1.8 -9 -9s1.8 -9 9 -9z"></path>
                        </svg>
                    </Link>
                </li>
                <li v-if="userId">
                    <Link :class="{'text-primary': route().current('posts.favourites')}" :href="route('posts.favourites')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-heart-filled"
                             width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                             fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path
                                d="M6.979 3.074a6 6 0 0 1 4.988 1.425l.037 .033l.034 -.03a6 6 0 0 1 4.733 -1.44l.246 .036a6 6 0 0 1 3.364 10.008l-.18 .185l-.048 .041l-7.45 7.379a1 1 0 0 1 -1.313 .082l-.094 -.082l-7.493 -7.422a6 6 0 0 1 3.176 -10.215z"
                                stroke-width="0" fill="currentColor"></path>
                        </svg>
                    </Link>
                </li>
                <li>
                    <Link :class="{'text-primary': route().current('profile.edit')}"
                       :href="userId ? route('profile.edit') : route('login') ">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-circle"
                             width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                             fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                            <path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                            <path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855"></path>
                        </svg>
                    </Link>
                </li>
            </ul>
        </footer>
        <div
            v-if="postStore.showPostModal"
            class="absolute inset-0 bg-neutral-focus bg-opacity-95 z-20 grid place-items-center"
            @click="postStore.closePostModal"
        >
            <div
                @click.stop
                class="relative bg-white dark:bg-neutral card card-bordered p-4 w-full rounded md:w-1/2 md:max-w-5xl">
                <div class="flex items-center justify-between w-full mb-3">
                    <h2 v-if="postStore.postToReply" class="font-bold text-xl">Reply to </h2>
                    <h2 v-else class="font-bold text-xl">Make new post</h2>
                    <button
                        @click="postStore.closePostModal"
                        class="btn btn-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="24"
                             height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                             stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M18 6l-12 12"></path>
                            <path d="M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <post
                    without-preview
                    without-actions
                    :post="postStore.postToReply"
                    v-if="postStore.postToReply"
                >
                </post>
                <PostForm :replied="postStore.postToReply" @post-created="postStore.closePostModal"></PostForm>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
