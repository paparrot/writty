import {router, usePage} from "@inertiajs/vue3";
import {usePostStore} from "@/Stores/postStore.js";

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
                const prevPosts = postStore.posts;
                const nextPosts = props.posts.data;

                postStore.setPosts([...prevPosts, ...nextPosts]);
                postStore.setCurrentPage(nextPage);

                window.history.replaceState({}, page.title, url.toString());
            }
        })
    },
    deletePost(id) {
        router.delete(route('posts.delete', {post: id}))
    },
    listenDeletingPost() {
        const postStore = usePostStore();

        Echo.channel('feed')
            .listen('PostDeleted', (post) => {
                const posts = postStore.posts;
                postStore.setPosts(posts.filter(_post => _post.id !== post.id))
            })
    },
    listenCreatingPost() {
        const postStore = usePostStore();
        Echo.channel('feed')
            .listen('PostCreated', (post) => {
                postStore.setPosts([post, ...postStore.posts])
            })
    }
}
