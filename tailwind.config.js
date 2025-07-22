import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                primaryColor: '#3abff8',
                primaryDarkColor: '#1e7ebc',
                whiteColor: '#ffffff',
                blackColor: '#000000',
                redColor: '#ff0000',



                primary: '#26ace2',
                // secondary: '#ff4216',
                secondary: '#26ace2',
                ternary: '#172432',
                white: '#ffffff',
                black: '#000000',
                danger: '#ff0000',
                success: '#28a745',
                warning: '#ffcc00',
            },
        },
    },

    plugins: [forms],
};
