import { defineConfig } from 'vite';
import react from '@vitejs/plugin-react';

// https://vitejs.dev/config/
export default defineConfig({
  base: './',  // Configura las rutas relativas
  plugins: [react()],
  build: {
    outDir: 'build',  // Cambia el nombre del directorio de salida (opcional)
  }
});
