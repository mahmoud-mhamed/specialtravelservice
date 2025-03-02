import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from "@vitejs/plugin-vue";
import {exec} from "node:child_process";

export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        {
            name: "enum_clone",
            enforce: "post",
            handleHotUpdate({ server, file }) {
                if (file.includes("/app/Enums")) {
                    exec(
                        "php artisan enums:clone-to-js",
                        (error, stdout) =>
                            error === null &&
                            console.log(`Enum Js File Generated Successfully !`)
                    );
                }
            },
        },
        {
            name: "lang",
            enforce: "post",
            handleHotUpdate({ server, file }) {
                if (file.includes("/lang/")) {
                    exec(
                        `php artisan lang:copy --lang=${file.includes('/ar/')?'ar':'en'} --file=${file.split('/').pop()}`,
                        (error, stdout) =>
                            error === null &&
                            console.log(`Lang Generated Successfully !`)
                    );
                }
            },
        },
        {
            name: "ability",
            enforce: "post",
            handleHotUpdate({ server, file }) {
                if (file.includes("/Abilities.php")) {
                    exec(
                        "php artisan ability:clone",
                        (error, stdout) =>
                            error === null &&
                            console.log(`Ability Clone Successfully !`)
                    );
                }
            },
        },
    ],
});
