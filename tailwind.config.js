import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/wire-elements/modal/resources/views/*.blade.php',
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './app/**/*.php',
        './resources/views/**/*.blade.php',
    ],

    safelist: [
        {
            pattern: /max-w-(sm|md|lg|xl|2xl|3xl|4xl|5xl|6xl|7xl)/,
            variants: ['sm', 'md', 'lg', 'xl', '2xl']
        }
    ],

    theme: {
        screens: {
            'sm': '640px',

            'lg': '960px',

            'xl': '1480px',
        },
        extend: {
            fontSize: {
                'base': '0.9375rem'
            },
            zIndex: {
                100: 100,
                200: 200
            },
            fontFamily: {
                sans: ['Montserrat', ...defaultTheme.fontFamily.sans],
            },
            backgroundImage: {
                rg: "linear-gradient(#f76051 2%,#fb806d 5%,#f76051 5%,#f14635)",
                rgh: "linear-gradient(#f76051 2%,#fb806d 5%,#f76051 5%,#e04131)",
                xicon: "url('/resources/images/xicon.svg')"
            },
            fontSize: {
                xm: '0.8125rem',
                bm: '0.9375rem'
            },
            container: {
                center: true,
                padding: {
                    DEFAULT: '0.5rem',
                    xl: '2.5rem'
                }
            },
            colors: {
                green: {
                    200: "#6cd0a9",
                    250: "#60cca2",
                    300: "#7bd5b2",
                    350: "#84d182",
                    400: "#68cfa7",
                    500: "#00a57a",
                    600: "#037c72"
                },
                red: {
                    400: "#f75f5f",
                },
                primary: {
                    800: "#3a4772"
                },
                gray: {
                    25: "#f4f6f8",
                    50: "#eeeeee",
                    75: "#EEF1F4",
                    100: "#f2f2f2",
                    125: "#A3A3A3",
                    150: "#D3D3D3",
                    200: "#e6e6e6",
                    350: "rgba(255,255,255,.6)",
                    450: "rgba(255,255,255,.8)",
                    500: "#303030"
                },
                yellow: {
                    400: "#ffc954"
                }
            },
            padding: {
                1: '0.3125rem'
            },
            height: {
                '18': '4.5rem',
            }
        },
    },

    plugins: [
        forms,
        require('@tailwindcss/typography'),
    ],
};
