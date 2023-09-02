import {router} from "@inertiajs/vue3";

export default {
    follow(nickname) {
        router.post(route('profile.follow', {user: nickname}))
    },
    unfollow(nickname) {
        router.delete(route('profile.unfollow', {user: nickname}))
    }
}
