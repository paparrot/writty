import {ref} from "vue";
import {defineStore} from "pinia";

export const usePostStore = defineStore('posts', () => {
    const url = new URL(window.location.href);
    const searchParams = url.searchParams;
    const defaultPage = Number(searchParams.get('page')) ? Number(searchParams.get('page')) : 1;

    const posts = ref([]);
    const currentPage = ref(defaultPage);
    const lastPage = ref(1);

    const setPosts = (newValue) => {
        posts.value = newValue;
    }

    const setCurrentPage = (newValue) => {
        currentPage.value = newValue;
    }

    const setLastPage = (newValue) => {
        lastPage.value = newValue;
    }

    return {posts, currentPage, lastPage, setPosts, setCurrentPage, setLastPage }
})
