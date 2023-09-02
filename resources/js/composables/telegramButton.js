import {onMounted} from "vue";

export function useTelegramButton(container) {
    function init() {
        const telegramLoginScript = document.createElement('script');
        telegramLoginScript.async
        telegramLoginScript.setAttribute("src", "https://telegram.org/js/telegram-widget.js?22")
        telegramLoginScript.setAttribute("data-telegram-login", "writty_login_bot")
        telegramLoginScript.setAttribute("data-size", "large")
        telegramLoginScript.setAttribute("data-userpic", "false")
        telegramLoginScript.setAttribute("data-radius", 10)
        telegramLoginScript.setAttribute("data-auth-url", import.meta.env.VITE_TELEGRAM_REDIRECT_URL)
        telegramLoginScript.setAttribute("data-request-access", "write")

        const telegramLoginContainer = document.getElementById(container)
        telegramLoginContainer.appendChild(telegramLoginScript)
    }

    onMounted(() => init())
}
