<script setup>
import {nextTick, onMounted, reactive, ref} from "vue";
import {usePage, Head, useForm} from "@inertiajs/vue3";
import DefaultLayout from "@/Layouts/DefaultLayout.vue";

const page = usePage();
const currentUser = page.props.auth?.user;
const textarea = ref('textarea');
const end = ref('end');
const disableMessage = ref(false);

const {conversation, messages} = defineProps({
    conversation: {
        type: String,
        required: true,
    },
    messages: {
        type: Array,
        default: () => ([])
    },
    recipient: {
        type: String,
        required: true,
    }
})

const messagesList = reactive({
    data: messages.data
})

Echo.private(`chat.${conversation}`)
    .listen('MessageSent', ({message}) => {
        if (!messagesList.data.map(item => item.id).includes(message.id)) {
            messagesList.data.push(message)
            nextTick(() => {
                scrollToEnd()
            })
        }
    })

const form = useForm({
    message: "",
    conversation: conversation.id
})

const scrollToEnd = () => {
    const container = document.getElementById('chat-container');
    container.scrollTop = container.scrollHeight;
}

const submit = () => {
    if (disableMessage.value) return;

    form.post(route('chat.store', {conversation: conversation}), {
        preserveState: false,
        onStart: () => {
            disableMessage.value = true;
        },
        onSuccess: () => {
            form.reset()
            disableMessage.value = false;
            scrollToEnd()
        }
    });
}

onMounted(() => {
    scrollToEnd();
})

const resize = () => {
    if (!textarea.value) return;

    textarea.value.style.height = textarea.value.scrollHeight - 4 + 'px';
}
</script>

<template>
    <Head>
        <title>Chat with @{{ recipient.nickname }}</title>
    </Head>
    <DefaultLayout>
        <div id="chat-container"
             class="flex h-[calc(100%-5.3rem)] pb-16 md:pb-0 px-3 flex-col justify-between  overflow-scroll">
            <div class="card card-bordered p-4 sticky top-0 z-10 backdrop-blur-xl">
                <div class="flex gap-3 items-center">
                    <div class="avatar" v-if="recipient.avatar">
                        <div class="w-10 rounded-full">
                            <img :src="recipient.avatar"/>
                        </div>
                    </div>
                    <div class="avatar placeholder" v-else>
                        <div class="w-10 rounded-full bg-base-100 dark:bg-neutral border dark:border-none">
                            <span class="text-lg uppercase font-bold">{{ recipient.nickname[0] }}</span>
                        </div>
                    </div>
                    <p class="font-bold">@{{ recipient.nickname }}</p>
                </div>
            </div>
            <div class="flex-1 flex flex-col justify-end py-3">
                <ul class="flex flex-col justify-end">
                    <li
                        class="chat"
                        :class="{
                            'chat-end': currentUser.id === message.author.id,
                            'chat-start': currentUser.id !== message.author.id
                        }"
                        :key="message.id"
                        v-for="(message, idx) of messagesList.data"
                    >
                        <div class="chat-image avatar" v-if="message.author.avatar">
                            <div class="w-10 rounded-full">
                                <img :src="message.author.avatar"/>
                            </div>
                        </div>
                        <div class="chat-image avatar placeholder" v-else>
                            <div class="w-10 rounded-full bg-base-100 border dark:border-none dark:bg-neutral-focus">
                                <span class="text-lg uppercase font-bold">{{ message.author.nickname[0] }}</span>
                            </div>
                        </div>
                        <div class="chat-header">
                            @{{ message.author.nickname }}
                            <time class="text-xs opacity-50">{{ message.time }}</time>
                        </div>
                        <div class="chat-bubble break-words" :class="{
                            'chat-bubble-primary' : currentUser.id === message.author.id,
                            'chat-bubble-accent': currentUser.id !== message.author.id
                        }">
                            {{ message.message }}
                        </div>
                    </li>
                </ul>
            </div>
            <form @submit.prevent="submit"
                  class="p-2 sticky bottom-0 bg-neutral-focus rounded-lg bg-opacity-10 dark:bg-opacity-70 pt-3 flex w-full gap-3 items-center">
                <textarea
                    @keydown.prevent.enter="submit"
                    v-model="form.message"
                    @focusout="resize"
                    @keyup="resize"
                    ref="textarea" type="text" rows="1"
                    class="textarea resize-none textarea-bordered w-full"></textarea>
                <button :disabled="disableMessage" type="submit" class="p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-send" width="24"
                         height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                         stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M10 14l11 -11"/>
                        <path d="M21 3l-6.5 18a.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a.55 .55 0 0 1 0 -1l18 -6.5"/>
                    </svg>
                </button>
            </form>
            <div ref="end"/>
        </div>
    </DefaultLayout>
</template>

<style scoped>

</style>
