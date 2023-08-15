import {reactive, ref} from "vue";
import {defineStore} from "pinia";

export const usePostStore = defineStore('posts', () => {
    const url = new URL(window.location.href);
    const searchParams = url.searchParams;
    const defaultPage = Number(searchParams.get('page')) ? Number(searchParams.get('page')) : 1;

    const posts = reactive({data: []})
    const currentPage = ref(defaultPage);
    const lastPage = ref(1);

    const setPosts = (newValue) => {
        posts.data = newValue;
    }

    const setLiked = (id) => {
        posts.data = posts.data.map(post => {
            if (post.id === id) post.isLiked = true;
            return post;
        });
    }

    const setUnliked = (id) => {
        posts.data = posts.data.map(post => {
            if (post.id === id) post.isLiked = false;
            return post;
        });
    }

    const setCurrentPage = (newValue) => {
        currentPage.value = newValue;
    }

    const setLastPage = (newValue) => {
        lastPage.value = newValue;
    }

    return {posts, currentPage, lastPage, setPosts, setLiked, setUnliked, setCurrentPage, setLastPage }
})
