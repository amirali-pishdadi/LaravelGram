/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            backgroundColor: (theme) => ({
                primary: "#242526",
                secondary: "#37383a",
                accent: "#18A0FB",
            }),
        },
    },
    variants: {
        extend: {
            backgroundColor: ["dark"],
        },
    },
    plugins: [],
};

module.exports = {
    // ...
    theme: {
        extend: {
            backgroundColor: (theme) => ({
                primary: "#242526",
                secondary: "#37383a",
                accent: "#18A0FB",
            }),
        },
    },
    variants: {
        extend: {
            backgroundColor: ["dark"],
        },
    },
    plugins: [],
};