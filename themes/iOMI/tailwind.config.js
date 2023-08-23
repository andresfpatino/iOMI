const plugin = require('tailwindcss/plugin')

module.exports = {
    content: ["./*.php", "./*/*.php", "./assets/**/*.js"],

    theme: {
        extend: {
            colors: {
				light: "#B2B2B2",
                primary: {
                    DEFAULT: "#3F2460",
					1 : "#673E9B",
					2: "#240E44"
                },
            },
            fontFamily: {
                heading: "Druk",
                text: "Dexa Pro",
            },
            container: {
                center: true,
            },
        },
    },
    plugins: [
        require('@tailwindcss/typography'),
        function ({ addComponents }) {
            addComponents({
                ".container": {
                    maxWidth: "100%",
                    "@screen sm": {
                        maxWidth: "540px",
                    },
                    "@screen md": {
                        maxWidth: "720px",
                    },
                    "@screen lg": {
                        maxWidth: "960px",
                    },
                    "@screen xl": {
                        maxWidth: "1140px",
                    },
                },
            });
        },
    ],
};
