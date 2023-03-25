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
                primaryGreen: '#038743'
            }
        },
    },
    plugins: [],
}
