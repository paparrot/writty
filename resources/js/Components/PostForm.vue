<script setup>
import {useForm} from "@inertiajs/vue3";
import {usePostStore} from "@/Stores/postStore.js";

const emit = defineEmits(['post-created'])

const form = useForm({
    content: "",
})

const postStore = usePostStore();

const onSubmitForm = async () => {
    if (postStore.postToReply) {
        form.post(route('posts.reply', {post: postStore.postToReply.id}), {
            preserveState: false,
            onSuccess: () => {
                form.reset()
                emit('post-created')
            }
        })

        return;
    }

    form.post(route('posts.store'), {
        onSuccess: () => {
            form.reset();
            emit('post-created')
        }
    })
}
</script>

<template>
    <form class="py-3" @submit.prevent="onSubmitForm">
        <div class="mb-2">
            <textarea
                name="content"
                @input="form.errors.content = null"
                v-model="form.content" placeholder="What's happen?"
                :class="{'textarea-error' : (form.content.length > 255) || form.errors.content}"
                class="textarea textarea-bordered resize-none textarea-sm w-full"
            ></textarea>
            <p class="text-error">
                {{ form.errors.content }}
            </p>
            <span class="text-gray-500 text-xs"
                  :class="{'text-red-500' : form.content.length > 255}"
            > {{ form.content.length }} / 255</span>
        </div>
        <div class="form-control">
            <button class="btn btn-sm btn-primary w-full" type="submit">Publish</button>
        </div>
    </form>
</template>

<style scoped>

</style>
