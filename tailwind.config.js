/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {

        fontFamily: {
            // Font untuk seluruh teks sans-serif
            sans: [
                'Inter',
                'Helvetica',
                'Arial',
                'sans-serif'
            ],
                        // Font untuk seluruh teks serif
            serif: [
                'Merriweather',
                'serif'
            ],
        },
        },

    plugins: [],
};
