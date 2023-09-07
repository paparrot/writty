<script setup>
import {Head, Link, usePage} from "@inertiajs/vue3";
import DefaultLayout from "@/Layouts/DefaultLayout.vue";

const page = usePage();
const user = page.props.auth.user;

defineProps({
    conversations: {
        type: Array,
        default: () => ([])
    }
})

</script>

<template>
    <Head>
        <title>
            Conversations
        </title>
    </Head>
    <DefaultLayout>
        <div class="px-3 md:px-0">
            <h1 class="text-center text-2xl font-bold">Your conversations</h1>
            <ul class="py-2 space-y-2">
                <li class="card card-bordered" v-for="conversation of conversations.data" :key="conversation.id">
                    <Link :href="route('chat.show', {conversation: conversation.id})" class="flex gap-3 p-3">
                        <div class="avatar" v-if="conversation.recipient.avatar">
                            <div class="w-12 rounded-full">
                                <img :src="conversation.recipient.avatar"/>
                            </div>
                        </div>
                        <div class="avatar placeholder" v-else>
                            <div class="w-12 aspect-square rounded-full bg-base-100 dark:bg-neutral border dark:border-none">
                                <span class="text-lg uppercase font-bold">{{
                                        conversation.recipient.nickname[0]
                                    }}</span>
                            </div>
                        </div>
                        <div>
                            <p class="font-bold">@{{ conversation.recipient.nickname }}</p>
                            <p class="text-neutral-content">
                                <span class="font-bold" v-if="conversation.message.author.id === user.id">You:</span>
                                {{ conversation.message.message.slice(0,50) }}<span v-if="conversation.message.message.length > 50">...</span>
                            </p>
                        </div>
                    </Link>
                </li>
            </ul>
        </div>
    </DefaultLayout>
</template>

<style scoped>

</style>
