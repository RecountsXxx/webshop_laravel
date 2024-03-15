const { defineConfig } = require('@vue/cli-service')
module.exports = defineConfig({
  transpileDependencies: true,
  devServer: {
    proxy: {
      '/api': {
        target: 'http://localhost',
        changeOrigin: true,
        pathRewrite: { '^/api': '' },
      },
    },
  },
})
