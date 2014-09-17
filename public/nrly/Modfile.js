// Modfile
// More info at https://github.com/modulejs/modjs/

module.exports = {
    tasks: {
        download: {
            options: {
                dest: "js/libs/"
            },
            less: {
                src: "https://raw.githubusercontent.com/less/less.js/master/dist/less-1.7.0.min.js"
            },
            text: {
                src: "https://raw.githubusercontent.com/requirejs/text/master/text.js"
            },
            zepto: {
                src: "http://zeptojs.com/zepto.min.js"
            },
            backbone: {
                src: "http://backbonejs.org/backbone.js"
            },
            underscore: {
                src: "http://underscorejs.org/underscore-min.js"
            },
            requirejs: {
                src: "http://requirejs.org/docs/release/2.1.9/comments/require.js"
            }
        },
        build: {
            src: "./index.html",
            stripDefine: true
        }
    },

    targets: {
        default: ['build'],
        vendor: ['download']
    }
};
