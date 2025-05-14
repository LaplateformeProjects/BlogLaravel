import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            keyframes: {
                colorPulse: {
                  '0%': {
                    backgroundColor: 'rgba(59, 130, 246, 0.5)', // Bleu
                    transform: 'scale(1)',
                    boxShadow: '0 0 8px rgba(59, 130, 246, 0.8)',
                  },
                  '25%': {
                    backgroundColor: 'rgba(168, 85, 247, 0.5)', // Violet
                    transform: 'scale(1.1)',
                    boxShadow: '0 0 12px rgba(168, 85, 247, 0.9)',
                  },
                  '50%': {
                    backgroundColor: 'rgba(236, 72, 153, 0.5)', // Rose
                    transform: 'scale(1.25)',
                    boxShadow: '0 0 16px rgba(236, 72, 153, 1)',
                  },
                  '75%': {
                    backgroundColor: 'rgba(34, 211, 238, 0.5)', // Cyan
                    transform: 'scale(1.1)',
                    boxShadow: '0 0 12px rgba(34, 211, 238, 0.9)',
                  },
                  '100%': {
                    backgroundColor: 'rgba(59, 130, 246, 0.5)', // Retour Bleu
                    transform: 'scale(1)',
                    boxShadow: '0 0 8px rgba(59, 130, 246, 0.8)',
                  },
                },
              },
              animation: {
                'color-pulse': 'colorPulse 4s ease-in-out infinite',
              },
        },
    },

    plugins: [forms],
    darkMode: 'class',
};
