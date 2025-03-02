import {usePage} from '@inertiajs/vue3'

export const ability_if = {
    beforeMount: (el, binding, vnode) => {
        if (!checkAbility(binding.value)) {
            el.classList.add('hidden');
            setTimeout(function () {
                el.remove();
            }, 1);
        }
    },
};
export const ability_else = {
    beforeMount: (el, binding, vnode) => {
        if (checkAbility(binding.value)) {
            el.classList.add('hidden');
            setTimeout(function () {
                el.remove();
            }, 1);
        }
    },
};

function checkAbility(abilities) {
    let auth_data = usePage().props.auth;
    let auth_user = auth_data?.user;
    if (!auth_user)
        return false;
    if (usePage().props.auth.user.id === 1)
        return true;
    if (abilities == null)
        return true;
    if (auth_user?.is_company_admin || auth_user?.is_department_admin || auth_user?.is_system_admin)
        return true;
    if (!auth_user?.abilities)
        return false;

    if (Array.isArray(abilities)) {
        let result = true;
        for (const abilityKey in abilities) {
            let item = abilities[abilityKey];
            if (Array.isArray(item)) {
                let temp_result = false;
                for (const itemKey in item) {
                    temp_result = temp_result || auth_data.abilities.includes(item[itemKey]);
                }
                result = result && temp_result;
            } else {
                result = result && auth_data.abilities.includes(item);
            }
        }
        return result;
    } else {
        return auth_data.abilities.includes(abilities);
    }
}

