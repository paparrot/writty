import {router, usePage} from "@inertiajs/vue3";
import {usePostStore} from "@/stores/postStore.js";

export default {
    loadMorePosts() {
        const postStore = usePostStore();
        if (postStore.currentPage >= postStore.lastPage) {
            return;
        }

        const nextPage = postStore.currentPage + 1;
        const page = usePage();
        const url = new URL(window.location.href);
        const searchParams = url.searchParams;
        searchParams.set('page', nextPage);
        url.search = searchParams.toString();

        router.get(url.toString(), {}, {
            preserveState: true,
            preserveScroll: true,
            only: ['posts'],
            onSuccess: ({props}) => {
                const prevPosts = postStore.posts.data;
                const nextPosts = props.posts?.data ?? props.replies.data;

                postStore.setPosts([...prevPosts, ...nextPosts]);
                postStore.setCurrentPage(nextPage);

                window.history.replaceState({}, page.title, url.toString());
            }
        })
    },
    deletePost(id) {
        router.delete(route('posts.delete', {post: id}), {
            preserveState: false,
        })
    },
    like(id) {
        const postStore = usePostStore();
        router.post(route('posts.like', {post: id}), {}, {
            preserveState: true,
            preserveScroll: true,
            onSuccess: () => {
                postStore.setLiked(id)
            }
        })
    },
    unlike(id) {
        const postStore = usePostStore();
        router.delete(route('posts.unlike', {post: id}), {
            preserveState: true,
            preserveScroll: true,
            onSuccess: () => {
                postStore.setUnliked(id)
            }
        });
    },
    listenDeletingPost() {
        const channel = import.meta.env.VITE_APP_ENV;
        const postStore = usePostStore();
        Echo.channel(`${channel}_feed`)
            .listen('PostDeleted', (post) => {
                const posts = postStore.posts.data;
                postStore.setPosts(posts.filter(_post => _post.id !== post.id))
            })
    },
    listenCreatingPost() {
        const channel = import.meta.env.VITE_APP_ENV;
        const postStore = usePostStore();
        Echo.channel(`${channel}_feed`)
            .listen('PostCreated', ({post}) => {
                const postExists = postStore.posts.data.map(item => item.id).includes(post.id);
                if (!postExists) {
                    postStore.setPosts([post, ...postStore.posts.data]);
                }
            })
    },
    repost(id) {
        router.post(route('posts.repost', {post: id}), {}, {
            preserveState: false,
        })
    },
    deleteRepost(post) {
        const postStore = usePostStore();
        const newPosts = [post.reposted, ...postStore.posts.data]
        postStore.setPosts(newPosts);

        this.deletePost(post.id);
    }
}
