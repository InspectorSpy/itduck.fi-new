import react from '@vitejs/plugin-react'
import { defineConfig } from 'vite'
import { resolve } from 'path'

// https://vite.dev/config/
export default defineConfig({
  base: '/dist/',
  plugins: [react()],
  build: {
    outDir: '../2026/dist',
    emptyOutDir: true,
    manifest: 'manifest.json',
    rollupOptions: {
      input: {
        contact: resolve(import.meta.dirname, 'src/main.jsx'),
      },
    },
  },
})