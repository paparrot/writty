import {reactive, ref} from "vue";
import {defineStore} from "pinia";

export const usePostStore = defineStore('posts', () => {
    const url = new URL(window.location.href);
    const searchParams = url.searchParams;
    const defaultPage = Number(searchParams.get('page')) ? Number(searchParams.get('page')) : 1;

    const posts = reactive({data: []})
    const showPostModal = ref(false);
    const currentPage = ref(defaultPage);
    const lastPage = ref(1);
    const postToReply = ref(null);

    const setPosts = (newValue) => {
        posts.data = newValue;
    }

    const setLiked = (id) => {
        posts.data = posts.data.map(post => {
            if (post.id === id) {
                post.isLiked = true;
                post.likesCount += 1;
            }

            return post;
        });
    }

    const setUnliked = (id) => {
        posts.data = posts.data.map(post => {
            if (post.id === id) {
                post.isLiked = false
                post.likesCount -= 1;
            }
            return post;
        });
    }

    const openPostModal = () => {
        showPostModal.value = true;
    }

    const setPostToReply = (post) => {
        postToReply.value = post;
    }

    const openReplyModal = (post) => {
        setPostToReply(post);
        showPostModal.value = true;
    }

    const closePostModal = () => {
        if (postToReply.value) {
            setPostToReply(null);
        }

        showPostModal.value = false;
    }

    const setCurrentPage = (newValue) => {
        currentPage.value = newValue;
    }

    const setLastPage = (newValue) => {
        lastPage.value = newValue;
    }

    return {
        posts,
        currentPage,
        lastPage,
        showPostModal,
        setPostToReply,
        postToReply,
        openPostModal,
        closePostModal,
        openReplyModal,
        setPosts,
        setLiked,
        setUnliked,
        setCurrentPage,
        setLastPage
    }
})
