/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js"
    ],
    theme: {
        extend: {
            fontFamily: {
                'GreatVibes': ["Great Vibes"],
                'Cinzel': ['Cinzel']
            }
        },
    },
    plugins: [
        require('flowbite/plugin')
    ],
}
