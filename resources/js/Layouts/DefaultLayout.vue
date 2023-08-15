<script setup>
import {router, usePage} from "@inertiajs/vue3";
import {onUpdated, ref} from 'vue';
import PostForm from "@/Components/PostForm.vue";

const page = usePage();
const userId = ref(page.props?.auth?.user?.id)

onUpdated(() => {
    userId.value = page.props?.auth?.user?.id;
})

const postModal = ref(false);

const logout = () => {
    router.post(route('logout'))
}


</script>

<template>
    <div class="h-screen overflow-hidden flex gap-4 md:p-4">
        <aside class="card card-bordered w-1/5 hidden md:block p-4">
            <nav>
                <ul class="space-y-3">
                    <li>
                        <a
                            :class="{'text-primary': route().current('home')}"
                            :href="route('home')" class="btn btn-outline w-full">Home</a>
                    </li>
                    <template v-if="!userId">
                        <li v-if="!userId">
                            <a
                                :class="{'text-primary': route().current('login')}"
                                class="btn btn-outline w-full"
                                :href="route('login')">
                                Login
                            </a>
                        </li>
                        <li v-if="!userId">
                            <a
                                :class="{'text-primary': route().current('register')}"
                                :href="route('register')"
                                class="btn btn-outline w-full"
                            >
                                Register
                            </a>
                        </li>
                    </template>
                    <template v-else>
                        <li v-if="userId">
                            <a
                                :class="{'text-primary': route().current('profile.edit')}"
                                :href="route('profile.edit')"
                                class="btn btn-outline w-full"
                            >Profile</a>
                        </li>
                        <li class="">
                            <a
                                :class="{'text-primary': route().current('posts.favourites')}"
                                :href="route('posts.favourites')"
                                class="btn btn-outline w-full"
                            >Favourites</a>
                        </li>
                        <li>
                            <button
                                v-if="userId"
                                @click="postModal = true"
                                class="w-full btn btn-primary"
                            >New post
                            </button>
                        </li>
                    </template>
                </ul>
            </nav>
        </aside>
        <main class="w-full md:w-3/5 overflow-y-scroll rounded">
            <header class="sticky top-0 z-10 backdrop-blur-xl w-full mb-4">
                <nav class="navbar flex justify-between shadow-md rounded-b">
                    <div class="flex gap-3">
                        <a
                            :class="{'text-primary': route().current('home')}"
                            :href="route('home')" class="btn btn-ghost normal-case text-xl">
                            Writty
                        </a>
                        <a
                            :class="{'text-primary': route().current('posts.following')}"
                            :href="route('posts.following')" class="btn btn-ghost normal-case text-xl">
                            Following
                        </a>
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
        <aside class="card card-bordered w-1/5 hidden md:block p-4">
            <h2 class="text-xl font-bold text-center mb-3">Latest authors</h2>
            <ul class="space-y-3">
                <li v-for="nickname of page.props.latestAuthors">
                    <a class="block font-bold w-full rounded px-2 py-1 text-center bg-base-200"
                       :href="route('profile.show', {user: nickname})">@{{ nickname }}</a>
                </li>
            </ul>
        </aside>
        <footer class="w-full fixed bottom-0 md:hidden">
            <ul class="menu flex justify-between menu-horizontal bg-base-200 rounded-t-box">
                <li>
                    <a :href="route('home')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-home-2" width="24"
                             height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                             stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M5 12l-2 0l9 -9l9 9l-2 0"></path>
                            <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path>
                            <path d="M10 12h4v4h-4z"></path>
                        </svg>
                    </a>
                </li>
                <li v-if="userId">
                    <a :href="route('posts.create')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-square-rounded-plus"
                             width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                             fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M9 12h6"></path>
                            <path d="M12 9v6"></path>
                            <path d="M12 3c7.2 0 9 1.8 9 9s-1.8 9 -9 9s-9 -1.8 -9 -9s1.8 -9 9 -9z"></path>
                        </svg>
                    </a>
                </li>
                <li v-if="userId">
                    <a :href="route('posts.favourites')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-heart-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M6.979 3.074a6 6 0 0 1 4.988 1.425l.037 .033l.034 -.03a6 6 0 0 1 4.733 -1.44l.246 .036a6 6 0 0 1 3.364 10.008l-.18 .185l-.048 .041l-7.45 7.379a1 1 0 0 1 -1.313 .082l-.094 -.082l-7.493 -7.422a6 6 0 0 1 3.176 -10.215z" stroke-width="0" fill="currentColor"></path>
                        </svg>
                    </a>
                </li>
                <li>
                    <a :href="userId ? route('profile.edit') : route('login') ">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-circle"
                             width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                             fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                            <path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                            <path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855"></path>
                        </svg>
                    </a>
                </li>
            </ul>
        </footer>
        <div
            v-if="postModal"
            class="absolute inset-0 bg-neutral-focus bg-opacity-95 z-20 grid place-items-center"
            @click="postModal = false"
        >
            <div @click.stop class="relative h-60 bg-white dark:bg-neutral card card-bordered p-4 rounded w-1/2 max-w-5xl">
                <div class="flex items-center justify-between w-full">
                    <h2 class="font-bold text-2xl">Make new post</h2>
                    <button
                        @click="postModal = false"
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
                <PostForm @post-created="postModal = false"></PostForm>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
