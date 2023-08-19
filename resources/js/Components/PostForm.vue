<script setup>
import {useForm} from "@inertiajs/vue3";
import {usePostStore} from "@/Stores/postStore.js";
import {computed} from "vue";

const emit = defineEmits(['post-created'])

const {replied} = defineProps({
    replied: {
        type: String,
        default: null,
    }
})

const preview = computed({
    get: () => {
        return form.attachment ? URL.createObjectURL(form.attachment) : null
    },
    set: (value) => {
        return value
    }
})

const form = useForm({
    content: "",
    attachment: null,
})

const postStore = usePostStore();

const onSubmitForm = async () => {
    if (replied) {
        form.post(route('posts.reply', {post: replied}), {
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
            <p class="text-gray-500 text-xs"
               :class="{'text-red-500' : form.content.length > 255}"
            > {{ form.content.length }} / 255</p>
            <div class="my-2 flex gap-3 items-center">
                <label :for="`attachment-${replied}`" :class="form.errors.attachment" class="my-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-paperclip" width="24"
                         height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                         stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path
                            d="M15 7l-6.5 6.5a1.5 1.5 0 0 0 3 3l6.5 -6.5a3 3 0 0 0 -6 -6l-6.5 6.5a4.5 4.5 0 0 0 9 9l6.5 -6.5"/>
                    </svg>
                    <input
                        :id="`attachment-${replied}`"
                        class="hidden"
                        accept="image/*"
                        type="file"
                        @input="form.attachment = $event.target.files[0]"
                    >
                </label>
                <p class="text-error">
                    {{ form.errors.attachment }}
                </p>
            </div>
            <div v-if="preview" class="attachment-container relative w-32">
                <img :src="preview" class="attachment-image aspect-square object-cover rounded" alt="Attachment">
                <button @click="form.attachment = null" type="button"
                        class="attachment-remove-btn absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24"
                         height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                         stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M4 7l16 0"/>
                        <path d="M10 11l0 6"/>
                        <path d="M14 11l0 6"/>
                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"/>
                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"/>
                    </svg>
                </button>
            </div>
        </div>
        <div class="form-control">
            <button class="btn btn-sm btn-primary w-full" type="submit">Publish</button>
        </div>
    </form>
</template>

<style scoped>
.attachment-remove-btn {
    display: none;
}

.attachment-container:hover .attachment-image {
    filter: brightness(0.5) blur(1px);
    transition-duration: 500ms;
    transition-property: filter;
}

.attachment-container:hover .attachment-remove-btn {
    display: block;
    opacity: 1;
    transition-duration: 2s;
    transition-property: opacity;
}
</style>
