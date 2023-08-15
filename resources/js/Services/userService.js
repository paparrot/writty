import {router} from "@inertiajs/vue3";

export default {
    follow(nickname) {
        router.post(route('users.follow', {user: nickname}))
    },
    unfollow(nickname) {
        router.delete(route('users.unfollow', {user: nickname}))
    }
}
