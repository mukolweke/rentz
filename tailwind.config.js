/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    important: true,
    theme: {
        extend: {
            colors: {
                primary: '#19355E',
                primaryAlt: '#4fcdff',
                primaryAltLight: '#a8e6ff',
                primaryBlack: '#333333'
            }
        },
    },
    plugins: [],
}
