<script setup>
import DefaultLayout from "@/Layouts/DefaultLayout.vue";
import {Head} from '@inertiajs/vue3';
import PostForm from "@/Components/PostForm.vue";
</script>

<template>
    <Head>
        <title>Create post</title>
    </Head>
    <DefaultLayout>
        <div class="px-3">
            <PostForm></PostForm>
        </div>
    </DefaultLayout>
</template>

<style scoped>

</style>
