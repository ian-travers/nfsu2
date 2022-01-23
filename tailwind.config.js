module.exports = {
    purge: {
        content: [
            './storage/framework/views/*.php',
            './resources/views/**/*.blade.php'
        ]
    },
    darkMode: false, // or 'media' or 'class'
    theme: {
        extend: {
            colors: {
                'nfsu-color': '#003548'
            },
            backgroundImage: theme => ({
                'nfsu-map': "url('/storage/map-d50.png');",
            })
        },
    },
    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
    ],
}
