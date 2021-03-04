const path = require('path');

module.exports = {
    resolve: {
        fallback: {
            os: require.resolve("os-browserify/browser"),
            zlib: require.resolve("browserify-zlib"),
            path: require.resolve("path-browserify"),
            stream: require.resolve("stream-browserify"),
            crypto: require.resolve("crypto-browserify"),
            http: require.resolve("stream-http"),
            https: require.resolve("https-browserify"),
            fs: false,
            dns:false

        },
        alias: {
            '@': path.resolve('resources/js'),
        },
    },
};
