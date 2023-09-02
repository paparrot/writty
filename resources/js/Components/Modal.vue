<script setup>
defineProps({
    id: {
        type: String,
        required: true,
    }
})

</script>

<template>
    <dialog :id="id" class="modal">
        <form method="dialog" class="modal-box">
            <slot></slot>
        </form>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>
</template>

<style scoped>

</style>
