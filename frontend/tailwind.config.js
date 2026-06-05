module.exports = {
    plugins: [require('daisyui')],
    daisyui: {
        themes: ['light'],
    },
    theme: {
        extend: {
            fontFamily: {
                sora: ['Sora', 'sans-serif'],
            },
            colors: {
                red: {
                    light: '#C1121F',
                    dark: '#A20D19',
                },
                green: {
                    light: '#3D6245',
                    dark: '#315739',
                },
                black: {
                    DEFAULT: '#000000',
                    1: '#171717',
                    2: '#222222',
                    3: '#0D1216',
                    4: '#39393A',
                    5: '#121212',
                },
                white: {
                    DEFAULT: '#FFFFFF',
                    section: '#FAFAFA',
                },
                beige: {
                    light: '#FDF0D5',
                },
                grey: {
                    1: '#A6A6A8',
                    2: '#ADB2BD',
                },
            },
        },
    },
};
