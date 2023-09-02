<script setup>
import {nextTick, onMounted, reactive, ref} from "vue";
import {usePage, Head, useForm} from "@inertiajs/vue3";
import DefaultLayout from "@/Layouts/DefaultLayout.vue";

const page = usePage();
const currentUser = page.props.auth?.user;
const textarea = ref('textarea');
const end = ref('end');
const disableMessage = ref(false);

const {user, messages} = defineProps({
    user: {
        type: Object,
        default: () => ({})
    },
    messages: {
        type: Array,
        default: () => ([])
    }
})

const messagesList = reactive({
    data: messages.data
})

Echo.private(`chat.${user.id}.${currentUser.id}`)
    .listen('MessageSent', ({message}) => {
        if (!messagesList.data.map(item => item.id).includes(message.id)) {
            messagesList.data.push(message)
            nextTick(() => {
                scrollToEnd()
            })
        }
    })

Echo.private(`chat.${currentUser.id}.${user.id}`)
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
    recipient_id: user.id
})

const scrollToEnd = () => {
    const container = document.getElementById('chat-container');
    container.scrollTop = container.scrollHeight;
}

const submit = () => {
    disableMessage.value = true;
    form.post(route('chat.create'), {
        onSuccess: () => {
            disableMessage.value = false;
            form.reset()
            scrollToEnd()
        }
    });
}

onMounted(() => {
    scrollToEnd();
})

const resize = () => {
    textarea.value.style.height = textarea.value.scrollHeight - 4 + 'px';
}
</script>

<template>
    <Head>
        <title>Chat with {{ user.nickname }}</title>
    </Head>
    <DefaultLayout>
        <div id="chat-container"
             class="flex h-[calc(100%-5.3rem)] pb-16 md:pb-0 px-3 flex-col justify-between  overflow-scroll">
            <div class="flex-1 flex flex-col justify-end border-t-neutral border-t py-3">
                <ul class="flex flex-col justify-end">
                    <li
                        class="chat"
                        :class="{
                            'chat-end': currentUser.id === message.sender.id,
                            'chat-start': currentUser.id === message.recipient.id
                        }"
                        :key="message.id"
                        v-for="(message, idx) of messagesList.data"
                    >
                        <div class="chat-image avatar" v-if="message.sender.avatar">
                            <div class="w-10 rounded-full">
                                <img :src="message.sender.avatar"/>
                            </div>
                        </div>
                        <div class="chat-image avatar placeholder" v-else>
                            <div class="w-10 rounded-full bg-neutral-focus">
                                <span class="text-lg uppercase font-bold">{{ message.sender.nickname[0] }}</span>
                            </div>
                        </div>
                        <div class="chat-header">
                            {{ message.sender.name }}
                            <time class="text-xs opacity-50">{{ message.time }}</time>
                        </div>
                        <div class="chat-bubble" :class="{
                            'chat-bubble-primary' : currentUser.id === message.sender.id,
                            'chat-bubble-accent': currentUser.id === message.recipient.id
                        }">
                            {{ message.message }}
                        </div>
                    </li>
                </ul>
            </div>
            <form @submit.prevent="submit"
                  class="p-2 sticky bottom-0 bg-neutral-focus rounded-lg bg-opacity-10 dark:bg-opacity-70 pt-3 flex w-full gap-3 items-center">
                <textarea @keydown.enter="submit" v-model="form.message" @focusout="resize" @keyup="resize"
                          ref="textarea" type="text" rows="1"
                          class="textarea resize-none textarea-bordered w-full"></textarea>
                <button type="submit" class="p-2">
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
