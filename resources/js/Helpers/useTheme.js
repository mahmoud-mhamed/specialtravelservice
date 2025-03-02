import {computed} from "vue";
import {usePage} from "@inertiajs/vue3";

export const useTheme = () => {
    const theme = computed(() => usePage().props.company?.theme)
    function update() {
        document.body.classList.add(theme.value);
    }

    function reload() {
        document.location.href = '/';
    }

    return {update, reload};
}
