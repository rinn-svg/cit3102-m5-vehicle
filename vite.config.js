import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { bunny } from 'laravel-vite-plugin/fonts';
import tailwindcss from '@tailwindcss/vite';

const input = ['resources/css/app.css', 'resources/js/app.js'];

const fonts = [
  bunny('Instrument Sans', {
    weights: [400, 500, 600],
  }),
];

export default defineConfig({
  plugins: [
    laravel({ input, fonts, refresh: true }),
    tailwindcss(),
  ],
  server: {
    watch: {
      ignored: ['**/storage/framework/views/**'],
    },
  },
});